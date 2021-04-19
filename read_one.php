<?php
// get ID of the city to be read
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');
 
// include database and object files
include_once 'config/database.php';
include_once 'objects/city.php';
include_once 'objects/country.php';
 
// get database connection
$database = new Database();
$db = $database->getConnection();
 
// prepare objects
$city = new city($db);
$country = new Country($db);
 
// set ID property of city to be read
$city->id = $id;
 
// read the details of city to be read
$city->readOne();


// set page headers
$page_title = "Read One City";
include_once "layout_header.php";



// read citys button
echo "<div class='right-button-margin'>";
    echo "<a href='index.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-list'></span> Read City";
    echo "</a>";
echo "</div>";

// HTML table for displaying a city details
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
            // display country name
            $country->code=$city->countrycode;
            $country->readName();
            echo $country->name;
        echo "</td>";
    echo "</tr>";
 
echo "</table>";
 


// set footer
include_once "layout_footer.php";
?>