<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/26/2021
 * Time: 1:52 AM
 */

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT) : die();

// Blog Post
$result = $post->read($id);

// number of posts that return
$num = $result->rowCount();

// Check if there is posts
if ($num) {
    $item = $result->fetch();

    $posts_arr = array(
        'id' => $item->id,
        'title' => $item->title,
        'body' => html_entity_decode($item->body),
        'author' => $item->author,
        'category_id' => $item->category_id,
        'category_name' => $item->category_name,
        'created_at' => $item->created_at
    );

    // Turn to JSON & output it
    echo json_encode($posts_arr);

} else {
    // No Posts
    echo json_encode(array(
        'message' => 'Post Not Found'
    ));
}