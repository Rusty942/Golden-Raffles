<?php include 'header.php'; ?>
    <!-- Create Raffle Form -->
    <div class="form-container">
        <h2>Create Raffle</h2>
        <form id="raffle-form" action="includeFiles/createraffleInc.php" method="post">
            <label for="raffle-title">Raffle Title:</label><br>
            <input type="text" id="raffle-title" name="raffle-title"><br>

            <label for="raffle-description">Raffle Description:</label><br>
            <textarea id="raffle-description" name="raffle-description"></textarea><br>
            
            <label for="raffle-length">Raffle Length (hours):</label><br>
            <input type="number" id="raffle-length" name="raffle-length"><br><br>


            <label for="max-entries">Max Entries:</label><br>
            <input type="number" id="max-entries" name="max-entries"><br><br>

            <input type="submit" value="Submit" name="raffleSubmit">
        </form>
    </div>

    <!-- create raffle Validation messages -->
    <div class="validation-messages">
    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyInput"){
                echo"<p>Make sure all fields have been filled in</p>";
            }

            else if($_GET["error"] == "invalidTitle"){
                echo"<p>Invalid raffle title</p>"; 
            }

            else if($_GET["error"] == "invalidDescription"){
                echo"<p>Invalid raffle description</p>"; 
            }

            else if($_GET["error"] == "invalidLength"){
                echo"<p>Raffles can only be between 1 and 120 hours long</p>"; 
            }
            else if($_GET["error"] == "invalidEntries"){
                echo"<p>Raffles can only have between 10 and 500 entries</p>"; 
            }
            else if($_GET["error"] == "stmtFailed"){
                echo"<p>Something went wrong</p>"; 
            }
            else if($_GET["error"] == "none"){
                echo"<p>You have successfully signed up!</p>"; 
            }
        }
    ?>
    </div>
    
    <?php include 'footer.php'; ?>

</body>
</html>