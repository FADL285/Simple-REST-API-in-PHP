<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/25/2021
 * Time: 10:01 PM
 */

class Database {

    // DB Params
    private $host = 'localhost';
    private $db_name = 'blog';
    private $username = 'fadl';
    private $password = 1234;
    private $conn;
    private $pdo_options = [
        PDO::ATTR_EMULATE_PREPARES         => false, // turn off emulation mode for "real" prepared statements
        PDO::ATTR_ERRMODE                  => PDO::ERRMODE_EXCEPTION, //turn on errors in the form of exceptions
        PDO::ATTR_DEFAULT_FETCH_MODE       => PDO::FETCH_OBJ, //make the default fetch be an anonymous object with column names as properties
        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true
    ];

    // DB Connect
    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password, $this->pdo_options);
        } catch (PDOException $e) {
            echo "Connection Error <br />" . $e->getMessage();
        }
    }
}