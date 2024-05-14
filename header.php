<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!--The site navbar-->
    <div class="navbar">
        <div class="navbar-inner">           
            <h1><img src="images/trophy.png" alt="Trophy" style="height: 50px; width: auto; vertical-align: middle;"> Golden Raffles</h1>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="createRaffle.php">Create Raffle</a></li>
                    <li><a href="recentWinners.php">Winners</a></li>
                    <li><a href="drawRaffle.php">Raffles</a></li>
                    <?php
                        if(isset($_SESSION["userid"])){
                            echo "<li class='login'><a href='includeFiles/logoutInc.php'>Log out</a></li>";                                
                        }    
                        else{
                            echo"<li class='login'><a href='login.php'>Log in / Sign Up</a></li>";       
                        }                
                    ?>
                </ul>
            </nav>
        </div>
    </div> 