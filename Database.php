<?php
// echo '<pre>';
// print_r($_POST);
// exit();
class Database
{
    private $host='localhost';
    private $db_name='assignmentdb';
    private $username='root';
    private $password='';

    public $connection;

    //creating connection
    public function getConnection(){
 
        $this->connection = null; 
        
        //checking connection

        try{
            $this->connection = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);

        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
            exit();
        }
 
        return $this->connection;
    }
}

// echo "connected";






