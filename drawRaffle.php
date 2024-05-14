<?php include 'header.php'; ?>
<body>
    <!--The main body of the site where competitions will be displayed-->
    <main>
    <?php include 'competitionsDraw.php'; ?>
    </main>

    <!-- draw raffle Validation messages -->
    <div class="validation-messages">
        <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "stmtfailed"){
                echo"<p>Something went wrong with the database operation. Please try again later.</p>"; 
            }
            else if($_GET["error"] == "noentries"){
                echo"<p>No entries found for this competition.</p>"; 
            }
        }
        else if(isset($_GET["draw"]) && $_GET["draw"] == "success"){
            echo"<p>Raffle winner has been successfully drawn and processed.</p>"; 
        }
        ?>
    </div>
    
    <?php include 'footer.php'; ?>

</body>