<?php
/* code for when raffle holder presses sign up */ 
 if(isset($_POST["raffleSubmit"])){
    /* Get sign up fields */
    $raffleTitle = $_POST["raffle-title"];
    $raffleDescription = $_POST["raffle-description"];
    $raffleLength = $_POST["raffle-length"];
    $maxEntries = $_POST["max-entries"];

    require_once 'dbhInc.php';
    require_once 'functionsInc.php';

    /*Raffle creation input validaton*/ 

    /*Checks to make sure the raffle holder has filled in all raffle fields*/
    if(emptyInputCreateRaffle($raffleTitle, $raffleDescription, $raffleLength, $maxEntries) !== false){
        header("location: ../createRaffle.php?error=emptyInput");
        exit();
    }

    /*Checks to make sure the raffle holder has entered a valid raffle title*/
    if(invalidRaffleTitle($raffleTitle) !== false){
        header("location: ../createRaffle.php?error=invalidTitle");
        exit();
    }


    /*Checks to make sure the raffle holder has entered a valid raffle description*/
    if(invalidRaffleDescription($raffleDescription) !== false){
        header("location: ../createRaffle.php?error=invalidDescription");
        exit();
    }

    /*Checks to make sure the raffle holder has entered a valid raffle length*/
    if(invalidRaffleLength($raffleLength) !== false){
        header("location: ../createRaffle.php?error=invalidLength");
        exit();
    }

    /*Checks to make sure the raffle holder has entered a valid raffle entries amount*/
    if(invalidRaffleMaxEntries($maxEntries) !== false){
        header("location: ../createRaffle.php?error=invalidEntries");
        exit();
    }

    /*If all validation is passed create a new raffle in the database*/
    createRaffle($connection, $raffleTitle, $raffleDescription, $raffleLength, $maxEntries);
 }

 else {
    header("location: ../createRaffle.php");
    exit();
 }