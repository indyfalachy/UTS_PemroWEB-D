<?php
// check if value was posted
if($_POST){
 
    // include database and model file
    include_once 'config/database.php';
    include_once 'model/city.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare city model
    $city = new City($db);
     
    // set city id to be deleted
    $city->id = $_POST['model_id'];
     
    // delete the city
    if($city->delete()){
        echo "model was deleted.";
    }
     
    // if unable to delete the city
    else{
        echo "Unable to delete model.";
    }
}
