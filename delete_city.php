<?php
// check if value was posted
if($_POST){
 
    // include database and object file
    include_once 'config/database.php';
    include_once 'objects/city.php';
 
    // get database connection
    $database = new Database();
    $db = $database->getConnection();
 
    // prepare city object
    $city = new City($db);
     
    // set city id to be deleted
    $city->id = $_POST['object_id'];
     
    // delete the city
    if($city->delete()){
        echo "Object was deleted.";
    }
     
    // if unable to delete the city
    else{
        echo "Unable to delete object.";
    }
}
