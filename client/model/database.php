<?php
class database{


 private $servername = "localhost";
 private $usernamedb = "root";
 private $passworddb = "yanis";
 private $database = "projet_tdw";

 public function connectDb() {
    $dsn = "mysql:host=" . $this->servername . ";dbname=" . $this->database;
    try {
        $conn = new PDO($dsn, $this->usernamedb, $this->passworddb);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $ex) {
        echo "Connection failed: " . $ex->getMessage();
        exit();
    }

    return $conn;
}

public function disconnectDb(&$conn) {
    $conn = null;
}

public function request($conn, $req) {
    $stmt = $conn->prepare($req); 
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}}
 ?>