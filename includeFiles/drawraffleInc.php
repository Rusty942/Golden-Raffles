<?php
/* code for when user presses enter raffle */ 
 if(isset($_POST["drawRaffle"])){
    /* Get entry fields */
    $compId = $_POST["competition_id"];
    require_once 'dbhInc.php';
    require_once 'functionsInc.php';

    /*Draw a user from the competition to win*/
    drawRaffleWinner($connection, $compId);
    deleteCompetition($connection, $compId);
 }

 else {
    header("location: ../login.php");
    exit();
 }