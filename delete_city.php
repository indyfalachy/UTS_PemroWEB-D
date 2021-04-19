<?php

if($_POST){
 
    include_once 'config/database.php';
    include_once 'model/city.php';
 
    $database = new Database();
    $db = $database->getConnection();
 
    $city = new City($db);
     
    $city->id = $_POST['model_id'];
     
    if($city->delete()){
        echo "model was deleted.";
    }
     
    else{
        echo "Unable to delete model.";
    }
}
