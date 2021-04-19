<?php

include_once 'config/core.php';
 
include_once 'config/database.php';

include_once 'model/country.php';
include_once 'model/city.php';
 
$database = new Database();
$db = $database->getConnection();
 
$city = new City($db);
$country = new Country($db);
 
$page_title = "LIST NAME OF DISTRICT";
include_once "layout_header.php";
 
$stmt = $city->readAll($from_record_num, $records_per_page);
 
$page_url = "index.php?";
 
$total_rows=$city->countAll();
 
include_once "read_city.php";
 
include_once "layout_footer.php";
?>