<?php

    class POST{
        // db properties

        private $conn;
        private $table = 'posts';

        //post properties
        public $id;
        public $category_id;
        public $category_name;
        public $title;
        public $body;
        public $author;
        public $create_at;

        // constructor with db connection
        public function __construct($db){
            try{
                $this->conn = $db;
            }catch(PDOException $e){    echo $e->getMessage(); }
            
        }

        // getting post from our database
        public function read(){
            // create query
            $query = 'SELECT
                c.name as category_name, 
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
                FROM 
                '.$this->table.' p 
                LEFT JOIN
                    categories c ON p.category_id = c.id
                    ORDER BY p.created_at DESC';

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
            $query = 'SELECT
                c.name as category_name, 
                p.id,
                p.category_id,
                p.title,
                p.body,
                p.author,
                p.created_at
                FROM 
                '.$this->table.' p 
                LEFT JOIN
                    categories c ON p.category_id = c.id
                    WHERE p.id = ? LIMIT 1';

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

        // create post
        public function create(){
            // create query
            $query = 'INSERT INTO '.$this->table.' SET title = :title, body = :body, author = :author, category_id = :category_id';
            // prepare statment
            $stmnt = $this->conn->prepare($query);
            // clean data
            $this->title        = htmlspecialchars(strip_tags($this->title));
            $this->body         = htmlspecialchars(strip_tags($this->body));
            $this->author       = htmlspecialchars(strip_tags($this->author));
            $this->category_id  = htmlspecialchars(strip_tags($this->category_id));
            // binding of parameters
            $stmnt->bindParam(':title', $this->title);
            $stmnt->bindParam(':body', $this->body);
            $stmnt->bindParam(':author', $this->author);
            $stmnt->bindParam(':category_id', $this->category_id);
            // execute the query
            return $stmnt->execute() ? true : false;
        }

        // update post
        public function update(){
            // create query
            $query = 'UPDATE '.$this->table.' 
            SET title = :title, body = :body, author = :author, category_id = :category_id 
            WHERE id = :id';
            // prepare statment
            $stmnt = $this->conn->prepare($query);
            // clean data
            $this->title        = htmlspecialchars(strip_tags($this->title));
            $this->body         = htmlspecialchars(strip_tags($this->body));
            $this->author       = htmlspecialchars(strip_tags($this->author));
            $this->category_id  = htmlspecialchars(strip_tags($this->category_id));
            // binding of parameters
            $stmnt->bindParam(':title', $this->title);
            $stmnt->bindParam(':body', $this->body);
            $stmnt->bindParam(':author', $this->author);
            $stmnt->bindParam(':category_id', $this->category_id);
            $stmnt->bindParam(':id', $this->id);
            // execute the query
            return $stmnt->execute()? true: false;
        }

        // delete post
        public function delete(){
            // create query
            $query = 'DELETE FROM '.$this->table.' WHERE id = :id';
            // prepare statement
            $stmnt = $this->conn->prepare($query);
            // clean data
            $this->idate    = htmlspecialchars(strip_tags($this->id));
            // binding params
            $stmnt->bindParam(':id', $this->id);
            // execute query
            return $stmnt->execute()? true: false;
        }

    }



?>