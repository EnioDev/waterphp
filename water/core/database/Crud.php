<?php namespace core\database;

use core\contracts\ICrud;

class Crud extends Db implements ICrud
{
    private $sql;
    protected $table;
    protected $primary_key;

    use \core\traits\ClassMethods;

    private function setDebugBacktrace($file, $line)
    {
        $_SESSION['debug_backtrace_file'] = $file;
        $_SESSION['debug_backtrace_line'] = $line;
    }

    private function orderBy($column, $direction)
    {
        if (!is_null($column) and is_string($column))
        {
            $this->sql .= " ORDER BY " . $column;

            if (!is_null($direction) and is_string($direction))
            {
                $this->sql .= " " . strtoupper($direction);
            }
        }

        if (!is_null($column) and is_array($column))
        {
            if (!is_null($direction) and is_array($direction))
            {
                if (count($column) === count($direction))
                {
                    foreach ($column as $i => $field)
                    {
                        if ($i < 1) {
                            $this->sql .= " ORDER BY " . $field . " " . strtoupper($direction[$i]);
                        } else {
                            $this->sql .= ", " . $field . " " . strtoupper($direction[$i]);
                        }
                    }
                }
            }
        }
    }

    public final function insert($data)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $data, 1, ['array']);

        $continue = false;

        if (is_array($data) and isset($data['fields']) and isset($data['values'])) {
            if (count($data['fields']) === count($data['values'])) {
                $continue = true;
            }
        }
        if (!$continue) { return false; }

        $fields = implode(',', $data['fields']);
        $total  = count($data['fields']);

        $this->sql = "INSERT INTO " . $this->table . " (" . $fields . ") VALUES (";

        foreach ($data['fields'] as $i => $field)
        {
            $this->sql .= "?";
            if ((++$i) != $total) {
                $this->sql .= ", ";
            } else {
                $this->sql .= ")";
            }
        }

        try {
            $stmt = parent::prepare($this->sql);
            return $stmt->execute($data['values']);
        } catch (\Exception $e) {
            $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
            throw new \Exception($e->getMessage());
        }
    }

    public final function update($id, $data)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 2, 2);
        self::validateArgType(__FUNCTION__, $id, 1, ['string', 'integer']);
        self::validateArgType(__FUNCTION__, $data, 2, ['array']);

        $continue = false;

        if (is_array($data) and isset($data['fields']) and isset($data['values'])) {
            if (count($data['fields']) === count($data['values'])) {
                $continue = true;
            }
        }
        if (is_string($id) or is_integer($id)) {
            $continue = true;
        }
        if (!$continue) { return false; }

        $total = count($data['fields']);

        $this->sql = "UPDATE " . $this->table . " SET ";

        foreach ($data['fields'] as $i => $field)
        {
            $this->sql .= $field . " = ?";
            if ((++$i) != $total) {
                $this->sql .= ", ";
            }
        }
        $this->sql .= " WHERE ";
        $this->sql .= $this->primary_key . " = ?";

        try {
            $stmt = parent::prepare($this->sql);
            array_push($data['values'], $id);
            return $stmt->execute($data['values']);
        } catch (\Exception $e) {
            $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
            throw new \Exception($e->getMessage());
        }
    }

    public final function delete($id)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $id, 1, ['string', 'integer']);

        if ($id and (is_string($id) or is_integer($id))) {

            $this->sql = "DELETE FROM " . $this->table . " WHERE id = :id";

            try {
                $stmt = parent::prepare($this->sql);
                $stmt->bindParam(':id', $id, parent::paramType($id));
                return $stmt->execute();
            } catch (\Exception $e) {
                $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
                throw new \Exception($e->getMessage());
            }

        } else { return false; }
    }

    public final function deleteAll()
    {
        self::validateNumArgs(__FUNCTION__, func_num_args());

        $this->sql = "DELETE FROM " . $this->table;

        try {
            $stmt = parent::prepare($this->sql);
            return $stmt->execute();
        } catch (\Exception $e) {
            $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
            throw new \Exception($e->getMessage());
        }
    }

    public final function find($id)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 1);
        self::validateArgType(__FUNCTION__, $id, 1, ['string', 'integer']);

        if ($id and (is_string($id) or is_integer($id))) {

            $this->sql = "SELECT * FROM " . $this->table . " WHERE id = :id";

            try {
                $stmt = parent::prepare($this->sql);
                $stmt->bindParam(':id', $id, parent::paramType($id));
                $result = $stmt->execute();
                if ($result) {
                    return $stmt->fetch();
                } else {
                    return false;
                }
            } catch (\Exception $e) {
                $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
                throw new \Exception($e->getMessage());
            }

        } else { return null; }
    }

    public final function where($args, $column = null, $direction = null)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 3);
        self::validateArgType(__FUNCTION__, $args, 1, ['array']);
        self::validateArgType(__FUNCTION__, $column, 2, ['string', 'null']);
        self::validateArgType(__FUNCTION__, $direction, 3, ['string', 'null']);

        $continue = false;

        if (is_array($args) and isset($args['fields']) and isset($args['values'])) {
            if (count($args['fields']) === count($args['values'])) {
                $continue = true;
            }
        }
        if (!$continue) { return []; }

        $this->sql = "SELECT * FROM " . $this->table . " WHERE 1 = 1";

        foreach ($args['fields'] as $field) {
            $this->sql .= " AND " . $field . " LIKE ?";
        }

        $this->orderBy($column, $direction);

        try {
            $stmt = parent::prepare($this->sql);
            $result = $stmt->execute($args['values']);
            if ($result) {
                return $stmt->fetchAll();
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
            throw new \Exception($e->getMessage());
        }
    }

    public final function all($column = null, $direction = null)
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 0, 2);
        self::validateArgType(__FUNCTION__, $column, 1, ['string', 'null']);
        self::validateArgType(__FUNCTION__, $direction, 2, ['string', 'null']);

        $this->sql = "SELECT * FROM " . $this->table;

        $this->orderBy($column, $direction);

        try {
            $stmt = parent::prepare($this->sql);
            $result = $stmt->execute();
            if ($result) {
                return $stmt->fetchAll();
            } else {
                return false;
            }
        } catch (\Exception $e) {
            $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
            throw new \Exception($e->getMessage());
        }
    }

    public final function query($sql, $values = array())
    {
        self::validateNumArgs(__FUNCTION__, func_num_args(), 1, 2);
        self::validateArgType(__FUNCTION__, $sql, 1, ['string']);
        self::validateArgType(__FUNCTION__, $values, 2, ['array']);

        if (!is_string($sql)) { return []; }

        $this->sql = $sql;

        try {
            $stmt = parent::prepare($this->sql);
            if (count($values) > 0) {
                $result = $stmt->execute($values);
            } else {
                $result = $stmt->execute();
            }
            try {
                $records = $stmt->fetchAll();
                return $records;
            } catch (\Exception $e) {
                return $result;
            }
        } catch (\Exception $e) {
            $this->setDebugBacktrace(debug_backtrace()[0]['file'], debug_backtrace()[0]['line']);
            throw new \Exception($e->getMessage());
        }
    }
}
