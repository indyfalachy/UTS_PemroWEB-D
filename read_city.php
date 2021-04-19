<?php
$search_value=isset($search_term) ? "value='{$search_term}'" : "";
// search form
?>

<!-- <form role='search' action='search.php'>
    <div class='input-group col-md-3 pull-left margin-right-1em'>

        <input type='text' class='form-control' placeholder='Type city name or description...' name='s' id='srch-term' required <?= $search_value ?> />
        <div class='input-group-btn'>
            <button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>
        </div>
    </div>
</form> -->

<?php 
// create city button
echo "<div class='right-button-margin'>";
    echo "<a href='create_city.php' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create City";
    echo "</a>";
echo "</div>";
 
// display the citys if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Id</th>";
            echo "<th>Name</th>";
            echo "<th>Contry Code</th>";
            echo "<th>District</th>";
            echo "<th>Population</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            
            extract($row);
            
 
            echo "<tr>";
                echo "<td>{$id}</td>";
                echo "<td>{$name}</td>";
                echo "<td>{$countrycode}</td>";
                echo "<td>{$district}</td>";
                echo "<td>{$population}</td>";
                echo "<td>";
                    $country->code = $countrycode;
                    $country->readName();
                    echo $country->name;
                echo "</td>";
 
                echo "<td>";
 
                    // read city button
                    echo "<a href='read_one.php?id={$id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";
 
                    // edit city button
                    echo "<a href='update_city.php?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete city button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-model'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once 'paging.php';
}
 
// tell the user there are no citys
else{
    echo "<div class='alert alert-danger'>No citys found.</div>";
}
?>