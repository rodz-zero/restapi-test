<?php
    // headers

    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    // initialize our api
    include_once('../core/initialize.php');

    // instantiate post class
    $post = new POST($db);

    // get raw pasted data
    $data = json_decode(file_get_contents("php://input"));

    $post->id           = $data->id;
    // create post
    echo $post->delete()? json_encode(array('message' => 'Post deleted.')): json_encode(array('message' => 'Post not deleted.')) ;

?>