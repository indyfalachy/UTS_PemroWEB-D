<?php
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
include_once 'config/database.php';
include_once 'model/city.php';
include_once 'model/country.php';
 
$database = new Database();
$db = $database->getConnection();
 
$city = new city($db);
$country = new Country($db);
 
$city->id = $id;
 
$city->readOne();


$page_title = "Read One City";
include_once "layout_header.php";


echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read City";
    echo "</a>";
echo "</div>";


echo "<table class='table table-hover table-responsive table-bordered'>";
 
    echo "<tr>";
        echo "<td>Name</td>";
        echo "<td>{$city->name}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>Country Code</td>";
        echo "<td>{$city->countrycode}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>District</td>";
        echo "<td>{$city->district}</td>";
    echo "</tr>";
 
    echo "<tr>";
        echo "<td>country</td>";
        echo "<td>";
            
            $country->code=$city->countrycode;
            $country->readName();
            echo $country->name;
        echo "</td>";
    echo "</tr>";
 
echo "</table>";
 


// set footer
include_once "layout_footer.php";
?>