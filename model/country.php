<?php
class Country
{

    // database connection and table name
    private $conn;
    private $table_name = "country";

    // model properties
    public $code;
    public $name;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // used by select drop-down list
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

    // used to read country name by its ID
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
