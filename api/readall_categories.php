<?php
    // headers

    header('Access-Control-Allow-Origin');
    header('Content-Type: application/json');

    include_once('../core/initialize.php');

    // instantiate post class
    $category = new Category($db);

    // blog query post
    $result = $category->read();
    // get the row count
    $num = $result->rowCount();

    if($num > 0){
        $category_arr = array();
        $category_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);
            $category_item = array(
                'id' => $id,
                'name' => $name,
                'created_at' => $create_at 
            );
            array_push($category_arr['data'], $category_item);
        }
        // convert JSON and output
        echo json_encode($category_arr);

    }else{
        echo json_encode(array('message' => 'No posts found.'));
    }

?>