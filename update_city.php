<?php
// retrieve one city will be here
// get ID of the city to be edited
$id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

// include database and object files
include_once 'config/database.php';
include_once 'objects/country.php';
include_once 'objects/city.php';
 
// instantiate database and city object
$database = new Database();
$db = $database->getConnection();
 
$city = new City($db);
$country = new Country($db);

// set ID property of city to be edited
$city->id = $id;

// read the details of city to be edited
$city->readOne();



// set page header
$page_title = "Update city";
include_once "layout_header.php";



// contents will be here
echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-primary pull-right'><span class='glyphicon glyphicon-list'></span> Read City</a>";
echo "</div>";
?>

<!-- 'update city' form will be here -->
<!-- post code will be here -->
<?php
// if the form was submitted
if ($_POST) {

 // set city property values
 $city->name = $_POST['name'];
 $city->district = $_POST['district'];
 $city->population = $_POST['population'];
 $city->countrycode = $_POST['countrycode'];
 if($city->name =="") {
    $errorMsg=  "error : You did not enter a name.";
    $code= "1" ;
  }
  elseif($city->population == "") {
    $errorMsg=  "error : Please enter number.";
    $code= "2";
  }
  //check if the number field is numeric
  elseif(is_numeric(trim($city->population)) == false){
    $errorMsg=  "error : Please enter numeric value.";
    $code= "2";
  }
  elseif($city->district == ""){
    $errorMsg=  "error : You did not enter a District.";
    $code= "3";
  }elseif($city->countrycode == 0){
    $errorMsg=  "error : You did not enter a Country.";
    $code= "4";
  } 
else{
  //final code will execute here.
// update the city
if ($city->update()) {
    echo "<div class='alert alert-success alert-dismissable'>";
    echo "city was updated.";
    echo "</div>";
}

// if unable to update the city, tell the user
else {
    echo "<div class='alert alert-danger alert-dismissable'>";
    echo "Unable to update city.";
    echo "</div>";
}
}
    
}
?>


<?php if (isset($errorMsg)) { 
    // echo "<p class='message'>" .$errorMsg. "</p>" ;
    echo "<div class='alert alert-danger alert-dismissable'>";
    echo $errorMsg;
    echo "</div>";
    } ?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}"); ?>" method="post">
    <table class='table table-hover table-responsive table-bordered'>

    <tr <?php if(isset($code) && $code == 1){echo "class='errorMsg'" ;} ?>>
            <td>Name</td>
            <td><input type='text' name='name' value='<?php echo $city->name; ?>' class='form-control' /></td>
        </tr>
        <tr <?php if(isset($code) && $code == 2){echo "class='errorMsg'" ;} ?>>
            <td>population</td>
            <td><input type='text' name='population' value='<?php echo $city->population; ?>' class='form-control' /></td>
        </tr>
        <tr <?php if(isset($code) && $code == 3){echo "class='errorMsg'" ;} ?>>
            <td>district</td>
            <td><input type='text' name='district' value='<?php echo $city->district; ?>' class='form-control' /></td>
        </tr>
   
       

        <tr <?php if(isset($code) && $code == 4){echo "class='errorMsg'" ;} ?>>
            <td>country</td>
            <td>


                <!-- categories select drop-down will be here -->
                <?php
                $stmt = $country->read();

                // put them in a select drop-down
                echo "<select class='form-control' name='countrycode'>";

                echo "<option>Please select...</option>";
                while ($row_country = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $countrycode = $row_country['code'];
                    $country_name = $row_country['name'];

                    // current country of the city must be selected
                    if ($city->countrycode == $countrycode) {
                        echo "<option value='$countrycode' selected>";
                    } else {
                        echo "<option value='$countrycode'>";
                    }

                    echo "$country_name</option>";
                }
                echo "</select>";
                ?>


            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>

    </table>
</form>



<?php
// set page footer
include_once "layout_footer.php";
?>