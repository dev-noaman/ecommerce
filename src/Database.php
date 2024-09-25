<?php
class DataBase{
    private $host = 'localhost';
    private $user = 'root';
    private $password = '';
    private $db = 'drophut';
    public $conn;
    public function getConnection()
    {
       $this->conn =  mysqli_connect($this->host,$this->user,$this->password,$this->db);
       if(mysqli_connect_error())
       {
        die("connectiond failed : " . $this->conn->connect_error);
       }
       return $this->conn;

    }
   
    
}

?>
