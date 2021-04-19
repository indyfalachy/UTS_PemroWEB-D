<?php
include_once 'config/core.php';
 
include_once 'config/database.php';
include_once 'model/city.php';
include_once 'model/country.php';
 
$database = new Database();
$db = $database->getConnection();
 
$city = new city($db);
$country = new country($db);
 
$search_term=isset($_GET['s']) ? $_GET['s'] : '';
 
$page_title = "You searched for \"{$search_term}\"";
include_once "layout_header.php";
 
$stmt = $city->search($search_term, $from_record_num, $records_per_page);
 
$page_url="search.php?s={$search_term}&";
 
$total_rows=$city->countAll_BySearch($search_term);
 
include_once "read_city.php";
 
include_once "layout_footer.php";
?>