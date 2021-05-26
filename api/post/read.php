<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/25/2021
 * Time: 11:47 PM
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

// Blog Posts
$result = $post->read();

// number of posts that return
$num = $result->rowCount();

// Check if there is posts
if ($num) {
    $posts = $result->fetchAll();

    $posts_arr = array();
    $posts_arr['data'] = array();
    foreach ($posts as $item) {
        $post_items = array(
            'id' => $item->id,
            'title' => $item->title,
            'body' => html_entity_decode($item->body),
            'author' => $item->author,
            'category_id' => $item->category_id,
            'category_name' => $item->category_name,
            'created_at' => $item->created_at
        );
        // Push to data
        array_push($posts_arr['data'], $post_items);
    }

    // Turn to JSON & output it
    echo json_encode($posts_arr);

} else {
    // No Posts
    echo json_encode(array(
       'message' => 'No Posts Found'
    ));
}