<?php namespace core\database;

use core\contracts\ICrud;

class Crud extends Db implements ICrud
{
    protected $table;
    protected $primary_key;

    public final function insert($data)
    {
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

        return $stmt->execute($data['values']);
    }

    public final function update($id, $data)
    {
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
        $sql .= $this->primary_key . " = ?";

		$stmt = parent::prepare($sql);

        array_push($data['values'], $id);

        return $stmt->execute($data['values']);
    }

    public final function delete($id = null)
    {
        if ($id and (is_string($id) or is_integer($id)))
        {
            $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
            $stmt = parent::prepare($sql);
            $stmt->bindParam(':id', $id, parent::paramType($id));

        } else if ($id === null) {

            $sql = "DELETE FROM " . $this->table;
            $stmt = parent::prepare($sql);
        }
        return $stmt->execute();
    }

    public final function find($id)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE id = :id";

        $stmt = parent::prepare($sql);
        $stmt->bindParam(':id', $id, parent::paramType($id));
        $stmt->execute();

        return $stmt->fetch();
	}

    public final function where($args)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE 1 = 1";

        foreach ($args['fields'] as $field) {
            $sql .= " AND " . $field . " = ?";
        }

        $stmt = parent::prepare($sql);
        $stmt->execute($args['values']);

        return $stmt->fetch();
    }

    public final function all()
    {
		$sql = "SELECT * FROM " . $this->table;

		$stmt = parent::prepare($sql);
		$stmt->execute();

        return $stmt->fetchAll();
	}
}