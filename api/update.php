<?php
    // headers

    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

    include_once('../core/initialize.php');

    // instantiate post class
    $post = new POST($db);

    // get raw pasted data
    $data = json_decode(file_get_contents("php://input"));

    $post->id           = $data->id;
    $post->title        = $data->title;
    $post->body         = $data->body;
    $post->author       = $data->author;
    $post->category_id  = $data->category_id;
    // create post
    echo $post->update()? json_encode(array('message' => 'Post updated.')): json_encode(array('message' => 'Post not updated.')) ;

?>