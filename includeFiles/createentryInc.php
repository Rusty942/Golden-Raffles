<?php
/* code for when user presses enter raffle */ 
 if(isset($_POST["enterRaffle"])){
    /* Get entry fields */
    $email = $_POST["entryEmail"];
    $name = $_POST["entryName"];
    $compId = $_POST["competition_id"];
    require_once 'dbhInc.php';
    require_once 'functionsInc.php';

    /*Enter raffle input validaton*/ 

    /*Checks to make sure the user has filled in all enter raffle fields*/
    if(emptyInputEnterComp($email, $name) !== false){
        header("location: ../index.php?error=emptyInput");
        exit();
    }

    /*Checks to make sure the user has entered a valid username*/
    if(invalidNameEnterComp($name) !== false){
        header("location: ../index.php?error=invalidUsername");
        exit();
    }


    /*Checks to make sure the user has entered a valid email*/
    if(invalidEmail($email) !== false){
        header("location: ../index.php?error=invalidEmail");
        exit();
    }

    /*Checks to make sure the user has entered an email that doesn't already exist in the competition*/
    if(compEmailExists($connection, $email, $compId) !== false){
        header("location: ../index.php?error=alreadyEntered");
        exit();
    }

    /*If all validation is passed create a new entry in the competition*/
    createRaffleUser($connection, $compId, $email, $name);
 }

 else {
    header("location: ../login.php");
    exit();
 }