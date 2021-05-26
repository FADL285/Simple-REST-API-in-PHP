<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/25/2021
 * Time: 11:02 PM
 */

class Post {

    private $conn;

    // Constructor with DB
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Get all Posts or single post with id
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

    // Create new post
    public function create($title, $body, $author)
    {
        $title = htmlentities(strip_tags($title), ENT_QUOTES, 'UTF-8');
        $body = htmlentities(strip_tags($body), ENT_QUOTES, 'UTF-8');
        $author = htmlentities(strip_tags($author), ENT_QUOTES, 'UTF-8');
        // Create query
        $sql = "INSERT INTO `posts` (`title`, `body`, `author`) VALUES (:title, :body, :author)";
        // Prepare statement
        $stmt = $this->conn->prepare($sql);
        // Bind data
        $stmt->bindParam(':title', $title, PDO::PARAM_INT);
        $stmt->bindParam(':body', $body, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);

        // Execute query
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

}