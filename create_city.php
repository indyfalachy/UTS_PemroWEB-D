<?php
include_once 'config/database.php';
include_once 'model/country.php';
include_once 'model/city.php';
 
$database = new Database();
$db = $database->getConnection();
 
$city = new City($db);
$country = new Country($db);


$page_title = "Create City";
include_once "layout_header.php";




echo "<div class='right-button-margin'>";
echo "<a href='index.php' class='btn btn-default pull-right'>Read City</a>";
echo "</div>";
?>




<?php
if($_POST){

  $name=trim($_POST["name"]);
  $district=trim($_POST["district"]);
  $population=trim($_POST["population"]);
  $countrycode=trim($_POST["countrycode"]);

  if($name =="") {
    $errorMsg=  "error : You did not enter a name.";
    $code= "1" ;
  }
  elseif($population == "") {
    $errorMsg=  "error : Please enter number.";
    $code= "2";
  }

  elseif(is_numeric(trim($population)) == false){
    $errorMsg=  "error : Please enter numeric value.";
    $code= "2";
  }
  elseif($district == ""){
    $errorMsg=  "error : You did not enter a District.";
    $code= "3";
  }elseif($countrycode == 0){
    $errorMsg=  "error : You did not enter a Country.";
    $code= "4";
  } 
else{

  $city->name = $_POST['name'];
  $city->district = $_POST['district'];
  $city->population = $_POST['population'];
  $city->countrycode = $_POST['countrycode'];

  // create the city
  if ($city->create()) {
      echo "<div class='alert alert-success'>city was created.</div>";

  }

  else {
      echo "<div class='alert alert-danger'>Unable to create city.</div>";
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
<!-- HTML form for creating a city -->
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <table class='table table-hover table-responsive table-bordered'>

        <tr <?php if(isset($code) && $code == 1){echo "class='errorMsg'" ;} ?>>
            <td>Name</td>
            <td><input type='text' name='name' class='form-control' value="<?php if(isset($name)){echo $name;} ?>"
                    <?php if(isset($code) && $code == 1){echo "class=errorMsg" ;} ?> /></td>
        </tr>

       

        <tr <?php if(isset($code) && $code == 2){echo "class='errorMsg'" ;} ?>>
            <td>Pupulasi</td>
            <td><input type='number' name='population' class='form-control'
                    value="<?php if(isset($population)){echo $population;} ?>"
                    <?php if(isset($code) && $code == 2){echo "class=errorMsg" ;} ?> /></td>
        </tr>
        <tr <?php if(isset($code) && $code == 3){echo "class='errorMsg'" ;} ?>>
            <td>District</td>
            <td><input type='text' name='district' class='form-control'
                    value="<?php if(isset($district)){echo $district;} ?>"
                     /></td>
        </tr>
        <tr <?php if(isset($code) && $code == 4){echo "class='errorMsg'" ;} ?>>
            <td>Country</td>
            <td>


                <!-- categories from database will be here -->
                <?php
                // read the city categories from the database
                $stmt = $country->read();

                echo "<select class='form-control' name='countrycode'>";
                echo "<option value='0'>Select country...</option>";

                while ($row_country = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    var_dump($row_country);
                    echo "<option value='{$row_country['code']}'>{$row_country['name']}</option>";
                }

                echo "</select>";
                ?>


            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button type="submit" class="btn btn-primary">Create</button>
            </td>
        </tr>

    </table>
</form>


<?php
// footer
include_once "layout_footer.php";
?>