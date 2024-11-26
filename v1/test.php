<?php

class testing{

    public function display($id){
        echo "given id: ".$id;

    }


    public function hello(){
        echo "Hello this class function call worked";
    }

    public function displaydata($id,$data){
        echo json_encode($data);
        echo $id;
    }
}