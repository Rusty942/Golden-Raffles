<?php
require_once 'includeFiles/dbhInc.php';

/* Fetch competitions from the database */
$query = "SELECT * FROM raffle_competitions";
$result = mysqli_query($connection, $query);

// Check if there are competitions
if (mysqli_num_rows($result) > 0) {
    // Loop through each competition and display it
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <div class="competition-box">
            <h2><?php echo $row['title']; ?></h2>
            <p>Raffle ID: <?php echo $row['competition_id']; ?></p>
            <form action="includeFiles/drawraffleInc.php" method="POST">
                <input type="hidden" name="competition_id" value="<?php echo $row['competition_id']; ?>">
                <button type="submit" name="drawRaffle">Draw Raffle</button>
            </form>
        </div>
        <?php
    }
} else {
    echo "No competitions found.";
}

// Close the database connection
mysqli_close($connection);
?>