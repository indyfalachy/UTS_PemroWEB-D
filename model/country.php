<?php
class Country
{

    private $conn;
    private $table_name = "country";

    public $code;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    function read()
    {
        //select all data
        $query = "SELECT
                    code, name
                FROM
                    " . $this->table_name . "
                ORDER BY
                    name";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function readName()
    {

        $query = "SELECT name FROM " . $this->table_name . " WHERE code = ? limit 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->code);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
    }
    
}
