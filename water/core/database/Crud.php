<?php namespace core\database;

use core\contracts\ICrud;

class Crud extends Db implements ICrud
{
    private $sql;
    protected $table;
    protected $primary_key;

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
        $stmt = parent::prepare($this->sql);

        return $stmt->execute($data['values']);
    }

    public final function update($id, $data)
    {
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

        $stmt = parent::prepare($this->sql);

        array_push($data['values'], $id);

        return $stmt->execute($data['values']);
    }

    public final function delete($id = null)
    {
        if ($id and (is_string($id) or is_integer($id)))
        {
            $this->sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = parent::prepare($this->sql);
            $stmt->bindParam(':id', $id, parent::paramType($id));

        } else if ($id === null) {

            $this->sql = "DELETE FROM " . $this->table;
            $stmt = parent::prepare($this->sql);
        }
        return $stmt->execute();
    }

    public final function find($id)
    {
        $this->sql = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = parent::prepare($this->sql);
        $stmt->bindParam(':id', $id, parent::paramType($id));
        $stmt->execute();

        return $stmt->fetch();
    }

    public final function where($args, $column = null, $direction = null)
    {
        $this->sql = "SELECT * FROM " . $this->table . " WHERE 1 = 1";

        foreach ($args['fields'] as $field) {
            $this->sql .= " AND " . $field . " = ?";
        }

        $this->orderBy($column, $direction);

        $stmt = parent::prepare($this->sql);
        $stmt->execute($args['values']);

        return $stmt->fetch();
    }

    public final function all($column = null, $direction = null)
    {
        $this->sql = "SELECT * FROM " . $this->table;

        $this->orderBy($column, $direction);

        $stmt = parent::prepare($this->sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public final function query($sql, $values = array())
    {
        $this->sql = $sql;

        $stmt = parent::prepare($this->sql);

        if (count($values) > 0) {
            $stmt->execute($values);
        } else {
            $stmt->execute();
        }

        return $stmt->fetch();
    }
}
