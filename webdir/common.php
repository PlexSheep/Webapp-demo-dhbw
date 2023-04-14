<?php
/*
 * This file contains common functionality found in many parts of the webapp.
 *
 */

$ini_path = "php.ini";

// Parse with sections
$ini_array = parse_ini_file($ini_path, true);

$servername = $ini_array["database"]["servername"];
$username = $ini_array["database"]["username"];
$password = $ini_array["database"]["password"];
$dbname = $ini_array["database"]["dbname"];

class DatabaseConnection {
    private $servername;
    private $username;
    private $password;
    private $dbname;

    public $connection;

    // constructor
    function __construct($ini_array) {
        $this->servername = $ini_array["database"]["servername"];
        $this->username = $ini_array["database"]["username"];
        $this->password = $ini_array["database"]["password"];
        $this->dbname = $ini_array["database"]["dbname"];

        // actually connect
        $this->connection = new mysqli(
            $this->servername, 
            $this->username, 
            $this->password, 
            $this->dbname
        );
        if ($this->connection->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

    }

    // destructor
    function __destruct() {
        $this->connection->close();
    }

    // query the db and display the result
    function query_database(string $query) {
        $result = $this->connection->query($query);
        return $result;
    }
}
?>
