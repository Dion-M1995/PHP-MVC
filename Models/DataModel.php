<?php

class DataModel
{
    private $db;

    public function __construct()
    {
        $this->db = new mysqli('localhost', 'root', '', 'test');

        if ($this->db->connect_error) {
            die('Connection failed: ' . $this->db->connect_error);
        }

        $this->createTable();
    }

    private function createTable()
    {
        $query = "CREATE TABLE IF NOT EXISTS data (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            content TEXT UNIQUE
        )";

        if ($this->db->query($query) !== true) {
            die('Error creating table: ' . $this->db->error);
        }
    }

    public function saveData($data)
    {
        $sanitizedData = strip_tags($data); 
        $sanitizedData = htmlspecialchars($sanitizedData, ENT_QUOTES);
    
        if (empty($sanitizedData)) {
            return; // Don't save empty data
        }
        $stmt = $this->db->prepare("INSERT INTO data (content) VALUES (?)");
        $stmt->bind_param("s", $sanitizedData);

        $stmt->execute();

        $stmt->close();
    }

    public function getData()
    {
        $result = $this->db->query("SELECT content FROM data ORDER BY id DESC LIMIT 1");

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['content'];
        }

        return '';
    }
}