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
            <p><?php echo $row['description']; ?></p>
            <p>Duration: <?php echo $row['duration_hours']; ?> days</p>
            <p>Max Entries: <?php echo $row['max_entries']; ?></p>
            
            <!-- Form for entering name and email to participate -->
            <form action="includeFiles/createentryInc.php" method="POST">
                <div>
                    <label for="entryName">Your Name:</label><br>
                    <input type="text" id="entryName" name="entryName" placeholder="Your Name" required>
                </div>
                <br>
                <div>
                    <label for="entryEmail">Your Email:</label><br>
                    <input type="email" id="entryEmail" name="entryEmail" placeholder="Your Email" required>
                </div>
                <input type="hidden" name="competition_id" value="<?php echo $row['competition_id']; ?>">
                <button type="submit" name="enterRaffle">Enter Raffle</button>
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
