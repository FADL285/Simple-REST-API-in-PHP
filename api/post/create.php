<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/26/2021
 * Time: 3:00 PM
 */

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once '../../config/Database.php';
require_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->connect();

// Instantiate blog post object
$post = new Post($db);

// Get posted data in the request
$data = json_decode(file_get_contents("php://input"));

try {
    if (isset($data->title, $data->body, $data->author) && !empty($data->title) && !empty($data->body) && !empty($data->author)) {
        $status = $post->create($data->title, $data->body, $data->author);
    } else {
        throw new Exception("Posts params not set :(");
    }

    if ($status) {
        echo json_encode(
            array('status' => 'success', 'message' => 'Post Created Successfully :)')
        );
    } else {
        echo json_encode(
            array('status' => 'failed', 'message' => 'Error: failed to create the post :( , please try again')
        );
    }
} catch (Exception $e) {
    echo json_encode(
        array('status' => 'failed', 'message' => 'Error: ' . $e->getMessage())
    );
}


