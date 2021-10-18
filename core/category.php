<?php

class Category{
    // properties
    private $conn;
    private $table = 'categories';

    //post properties
    public $id;
    public $name;
    public $created_at;

    // constructor with db connection
    public function __construct($db){
        try{
            $this->conn = $db;
        }catch(PDOException $e){    echo $e->getMessage(); }
    }

    // getting post from our database
    public function read(){
        // create query
        $query = 'SELECT * FROM '.$this->table;
        // prepare the statements
        try{
            $stmnt = $this->conn->prepare($query);
            // execute query
            $stmnt->execute();
        }catch(PDOException $e){    echo $e->getMessage(); }
        return $stmnt;
    }

    public function read_single(){
        // create query
        $query = 'SELECT * FROM '.$this->table.' WHERE id = :id';
        // prepare the statements
        $stmnt = $this->conn->prepare($query);
        // binding params
        $stmnt->bindParam(1, $this->id);
        // execute query
        $stmnt->execute();
        $row = $stmnt->fetch(PDO::FETCH_ASSOC);

        $this->title            = $row['title'];
        $this->body             = $row['body'];
        $this->author           = $row['author'];
        $this->category_id      = $row['category_id'];
        $this->category_name    = $row['category_name'];

        return $row;
    }

}

?>