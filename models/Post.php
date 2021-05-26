<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/25/2021
 * Time: 11:02 PM
 */

class Post {

    private $conn;

    // Post Properties
    public $id;
    public $category_id;
    public $category_name;
    public $title;
    public $body;
    public $author;
    public $created_at;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get Posts
    public function read($id = NULL)
    {
        // Select query
        $sql = 'CALL get_posts(?)';
        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        // Execute query
        $stmt->execute([$id]);

        return $stmt;
    }

}