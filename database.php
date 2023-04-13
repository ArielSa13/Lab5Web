<?php

class Database
{
    private $host;
    private $username;
    private $password;
    private $database;
    private $conn;

    public function __construct($host, $username, $password, $database)
    {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;

        // membuat koneksi
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // cek apakah koneksi berhasil
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($query)
    {
        // melakukan query ke database
        $result = $this->conn->query($query);

        // cek apakah query berhasil
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        // mengembalikan hasil query dalam bentuk array
        $rows = array();
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function insert($table, $data)
    {
        // memformat data untuk dimasukkan ke database
        $columns = implode(",", array_keys($data));
        $values = implode("','", array_values($data));
        $query = "INSERT INTO $table ($columns) VALUES ('$values')";

        // melakukan query ke database
        $result = $this->conn->query($query);

        // cek apakah query berhasil
        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }
    }

    public function close()
    {
        // menutup koneksi
        $this->conn->close();
    }
}
