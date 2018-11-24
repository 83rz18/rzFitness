<?php
// index page

// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            /* Password is correct, so start a new session and
                            save the username to the session */
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['id'] = $id;      
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = 'The password you entered was not valid.';
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = 'No account found with that username.';
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
    <link rel="icon" href="../image/rzRepeat1.png">
    <title>| Index</title>
    <link rel="stylesheet" href="style.css">

    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="js/newheader.js"></script>-->
    <script type="text/javascript">
    	$( document ).ready(function() {
   //scroll ;
    // Create cross browser requestAnimationFrame method:
    window.requestAnimationFrame = window.requestAnimationFrame
    || window.mozRequestAnimationFrame
    || window.webkitRequestAnimationFrame
    || window.msRequestAnimationFrame
    || function(f){setTimeout(f, 1000/60)}
    function scroll(){
       var pos = window.pageYOffset ;
       if (pos<=50){
 	        document.getElementById('navOne').style.top='0vh';
 		document.getElementById('navTwo').style.top='10vh';
 		document.getElementById('img0').style.top='5.45vh';
 		document.getElementById('img0').style.height='10vh';
       }else{
 		document.getElementById('navOne').style.top='-10vh';
 		document.getElementById('navTwo').style.top='0vh';
 		document.getElementById('img0').style.top='1.91vh';
     		document.getElementById('img0').style.height='6.18vh';
       }
    }
    window.addEventListener('scroll', function(){requestAnimationFrame(scroll)}, false)
    $(window).resize(scroll);
});  
    </script>
</head>
<body>
    <div id="navOne" class="nav fixed">
    	<form id="logIn" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
     		<input type="password" id="password" name="password" value="<?php echo $password_err; ?>">
                <input type="text" id="username" name="username" class="form-control" value="<?php echo $username_err; ?>">
                <input id="submitLogIn" type="submit" class="btn btn-primary" value="Log In">
        </form>
    </div> 
    <div id='navTwo' class="nav fixed">
        <form action="register.php" >
        	<input id="create" type="submit" value="Create An Account"/>
        </form>
    </div>
    <img id="img0" class="fixed" src="https://rickyrodriguez.name/image/rzGold.png" /> <!--  -->
</body>
</html>
