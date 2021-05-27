<?php
/**
 * Author: Mohamed Fadl <Mohamed.Fadl2852@gmail.com>
 * Date: 5/27/2021
 * Time: 5:43 PM
 */

// Headers
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');
header('Access-Control-Allow-Methods: DELETE');
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
    if (isset($data->id) && !empty($data->id)) {
        $status = $post->delete($data->id);
    } else {
        throw new Exception("Posts params not set :(");
    }

    if ($status) {
        echo json_encode(
            array('status' => 'success', 'message' => 'Post Deleted Successfully :)')
        );
    } else {
        echo json_encode(
            array('status' => 'failed', 'message' => 'Error: Post not found :(')
        );
    }
} catch (Exception $e) {
    echo json_encode(
        array('status' => 'failed', 'message' => 'Error: ' . $e->getMessage())
    );
}


