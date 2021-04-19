<?php
// core.php holds pagination variables
include_once 'config/core.php';
 
// include database and model files
include_once 'config/database.php';
// include_once 'model/city.php';
include_once 'model/country.php';
include_once 'model/city.php';
 
// instantiate database and city model
$database = new Database();
$db = $database->getConnection();
 
$city = new City($db);
$country = new Country($db);
 
$page_title = "LIST NAME OF DISTRICT";
include_once "layout_header.php";
 
// query citys
$stmt = $city->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "index.php?";
 
// count total rows - used for pagination
$total_rows=$city->countAll();
 
// read_city.php controls how the city list will be rendered
include_once "read_city.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
?>