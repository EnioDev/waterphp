<?php namespace core\database;

use core\contracts\Crud as CrudContract;

class Crud extends Db implements CrudContract
{
    protected $table;
    protected $pk;

    /**
     * Creates a new row in a database table.
     *
     * @param  array $data
     * @return bool
     */
	public final function insert($data)
    {
        $result = false;

        $fields = implode(',', $data['fields']);
        $total  = count($data['fields']);

        $sql = "INSERT INTO " . $this->table . " (" . $fields . ") VALUES (";

        foreach ($data['fields'] as $i => $field)
        {
            $sql .= "?";
            if ((++$i) != $total) {
                $sql .= ", ";
            } else {
                $sql .= ")";
            }
        }
		$stmt = parent::prepare($sql);

        try {
            $result = $stmt->execute($data['values']);
        } catch (\PDOException $e) {
            parent::showErrorDetail($e);
        }
		return $result;
    }
    
    /**
     * Updates the specified row in a database table.
     *
     * @param  int   $key
     * @param  array $data
     * @return bool
     */
	public final function update($key, $data)
    {
        $result = false;

        $total = count($data['fields']);

        $sql = "UPDATE " . $this->table . " SET ";

        foreach ($data['fields'] as $i => $field)
        {
            $sql .= $field . " = ?";
            if ((++$i) != $total) {
                $sql .= ", ";
            }
        }
        $sql .= " WHERE ";
        $sql .= $this->pk . " = ?";

		$stmt = parent::prepare($sql);

        array_push($data['values'], $key);

        try {
            $result = $stmt->execute($data['values']);
        } catch (\PDOException $e) {
            parent::showErrorDetail($e);
        }
        return $result;
    }

    /**
     * Removes the specified row in a database table.
     *
     * @param  int  $key
     * @return bool
     */
    public final function delete($key)
    {
        $result = false;

        $sql = "DELETE FROM " . $this->table . " WHERE id = :id";

        $stmt = parent::prepare($sql);
        $stmt->bindParam(':id', $key, parent::paramType($key));

        try {
            $result = $stmt->execute();
        } catch (\PDOException $e) {
            parent::showErrorDetail($e);
        }
        return $result;
    }
    
    /**
     * Retrieves the specified row from database table.
     *
     * @param  int  $key
     * @return mixed
     */
	public final function find($key)
    {
        $result = false;

        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = parent::prepare($sql);
        $stmt->bindParam(':id', $key, parent::paramType($key));
        $stmt->execute();

        try {
            $result = $stmt->fetch();
        } catch (\PDOException $e) {
            parent::showErrorDetail($e);
        }
        return $result;
	}

    /**
     * Retrieves a row from database table with specified arguments.
     *
     * @param  array $args
     * @return mixed
     */
    public final function where($args)
    {
        $result = false;

        $sql = "SELECT * FROM " . $this->table . " WHERE 1 = 1";

        foreach ($args['fields'] as $field) {
            $sql .= " AND " . $field . " = ?";
        }

        $stmt = parent::prepare($sql);
        $stmt->execute($args['values']);

        try {
            $result = $stmt->fetch();
        } catch (\PDOException $e) {
            parent::showErrorDetail($e);
        }
        return $result;
    }

    /**
     * Retrieves all data from database table.
     *
     * @return mixed
     */
	public final function all()
    {
        $result = false;

		$sql = "SELECT * FROM " . $this->table;

		$stmt = parent::prepare($sql);
		$stmt->execute();

        try {
            $result = $stmt->fetchAll();
        } catch (\PDOException $e) {
            parent::showErrorDetail($e);
        }
        return $result;
	}
}