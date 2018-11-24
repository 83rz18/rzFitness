<?php session_start(); // welcome page

// Include config file
require_once 'config.php';

// set variables
$id = $_SESSION['id'];

// If id variable is not set it will redirect to login page
if(!isset($id) || empty($id)){
    header("location: index.php");
    exit;
} 

//handle post from form
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // Validate weight
    if(empty(trim($_POST['weight']))){
        $weight_err = "Please enter weight.";     
    } else{
        $weight = trim($_POST['weight']);
    }
    // Validate waist
    if(empty(trim($_POST['waist']))){
        $waist_err = "Please enter waist.";     
    } else{
        $waist = trim($_POST['waist']);
    }
    // Validate wrist
    if(empty(trim($_POST['wrist']))){
        $wrist_err = "Please enter wrist.";     
    } else{
        $wrist = trim($_POST['wrist']);
    }
    // Validate hip
    if(empty(trim($_POST['hip']))){
        $hip_err = "Please enter hip.";     
    } else{
        $hip = trim($_POST['hip']);
    }
    // Validate forearm
    if(empty(trim($_POST['forearm']))){
        $forearm_err = "Please enter forearm.";     
    } else{
        $forearm = trim($_POST['forearm']);
    }
        
    // Check input errors before inserting in database
    if(empty($weight_err) && empty($waist_err) && empty($wrist_err) && empty($hip_err) && empty($forearm_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO assessments (accountID, weight, waist, wrist, hip, forearm) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "iiiiii", $param_accountID, $param_weight, $param_waist, $param_wrist, $param_hip, $param_forearm);
            
            // Set parameters
            $param_accountID = $id;
            $param_weight = $weight;
            $param_waist = $waist; 
            $param_wrist = $wrist; 
            $param_hip = $hip; 
            $param_forearm = $forearm; 
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: welcome.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
// set variables
$username = $_SESSION['username'];
//select records
$sql = "SELECT assessments.date,  assessments.weight,  assessments.waist,  assessments.wrist,  assessments.hip,  assessments.forearm, users.sex FROM assessments RIGHT JOIN users ON assessments.accountID = users.id WHERE accountID = ".$_SESSION['id']." ORDER BY date DESC LIMIT 1" ;
$result = $link->query($sql);
$link->close();
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {          
        $date = $row["date"];
        $weight = $row["weight"];
        $waist = $row["waist"];
        $wrist = $row["wrist"];
        $hip = $row["hip"];
        $forearm = $row["forearm"];
        $sex = $row["sex"];
    }     
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="../image/rzRepeat2.png">
    <title>Fitness</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 50%; padding: 20px; margin-left: 25%}
    </style>

    <!--google charts | Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <script type="text/javascript">
      
      let weight = <?php echo $weight; ?>;
    let waist = <?php echo $waist; ?>;
      let wrist = <?php echo $wrist; ?>;
      let hip = <?php echo $hip; ?>;
      let forearm = <?php echo $forearm; ?>;
      let lean = 0;
      if(<?php echo $sex; ?> = 'Male'){
      	console.log('male');
      	lean = (weight*1.082+94.42)-(waist*4.15);
      }else if(<?php echo $sex; ?> = 'Female'){
      	console.log('female');
      	lean = (weight*0.732+8.987) + (wrist/3.14) - (waist*0.157) - (hip*0.249) + (forearm*0.434);
      }else{
      	lean = ((weight*1.082+94.42)-(waist*4.15) + (weight*0.732+8.987) + (wrist/3.14) - (waist*0.157) - (hip*0.249) + (forearm*0.434))/2;
      }; 
      let fat = weight - lean;


      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Tissue');
        data.addColumn('number', 'Pounds');
        data.addRows([
          ['Lean', lean],
          ['Fat', fat]
        ]);

        // Set chart options
        var options = {
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
     
    </script>

</head>
<body>
    <div class="wrapper">
        <!--Greetings-->
        <h2><?php echo "Hello, ",$_SESSION['username'],'!<br>'; ?></h2>
        <div class="form-group">
            <a href='logout.php'><input type="submit" class="btn btn-primary" value="Logout"></a>
        </div>
        
        <p>Last Assessment: <?php echo $date,'<br>'; ?></p>
        <!--Div that will hold the pie chart-->
        <div id="chart_div"></div> 
        
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($weight_err)) ? 'has-error' : ''; ?>">
                <label>Weight:<sup>*</sup></label>
                <input type="text" name="weight"class="form-control" value="<?php echo $weight; ?>">
                <span class="help-block"><?php echo $weight_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($waist_err)) ? 'has-error' : ''; ?>">
                <label>Waist:<sup>*</sup></label>
                <input type="text" name="waist" class="form-control"value="<?php echo $waist; ?>">
                <span class="help-block"><?php echo $waist_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($wrist_err)) ? 'has-error' : ''; ?>">
                <label>Wrist:<sup>*</sup></label>
                <input type="text" name="wrist" class="form-control"value="<?php echo $wrist; ?>">
                <span class="help-block"><?php echo $wrist_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($hip_err)) ? 'has-error' : ''; ?>">
                <label>Hip:<sup>*</sup></label>
                <input type="text" name="hip" class="form-control"value="<?php echo $hip; ?>">
                <span class="help-block"><?php echo $hip_err; ?></span>
            </div>   
            <div class="form-group <?php echo (!empty($forearm_err)) ? 'has-error' : ''; ?>">
                <label>Forearm:<sup>*</sup></label>
                <input type="text" name="forearm" class="form-control"value="<?php echo $forearm; ?>">
                <span class="help-block"><?php echo $forearm_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
        
        
    </div>    
</body>
</html>
