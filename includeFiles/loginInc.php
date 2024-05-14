<?php
/* code for when user presses login */ 
if(isset($_POST["loginSubmit"])){
    /* Get login fields */
    $userName = $_POST["username"];
    $password = $_POST["password"];

    require_once 'dbhInc.php';
    require_once 'functionsInc.php';

    /*Login input validaton*/ 

    /*Checks to make sure the user has filled in all login fields*/
    if(emptyInputLogin($userName, $password) !== false){
        header("location: ../login.php?error=emptyInput");
        exit();
    }
    /*Logs in the user*/
    loginUser($connection, $userName, $password);
}
else{
    header("location: ../login.php");
    exit();    
}