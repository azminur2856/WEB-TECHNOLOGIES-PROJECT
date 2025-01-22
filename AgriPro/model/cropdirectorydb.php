<?php
class CropDirectoryDB {
    private $host = 'localhost';
    private $db_name = 'agripro';
    private $username = 'root';
    private $password = '';
    private $conn;
 
   
 
    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            die("Connection error: " . $e->getMessage());
        }
        return $this->conn;
    }
}
?>
 