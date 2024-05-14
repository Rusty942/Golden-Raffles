<?php
require_once 'includeFiles/dbhInc.php';

// Fetch raffle winners from the database
$query = "SELECT * FROM raffle_winners";
$result = mysqli_query($connection, $query);

// Check if there are winners
if (mysqli_num_rows($result) > 0) {
    ?>
    <h2>Raffle Winners</h2>
    <div class="raffle-winners">
        <table>
            <tr>
                <th>Raffle Title</th>
                <th>Winner Name</th>
                <th>Winner Email</th>
            </tr>
            <?php
            // Loop through each winner and display their information
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                    <td><?php echo $row['raffle_title']; ?></td>
                    <td><?php echo $row['winner_name']; ?></td>
                    <td><?php echo $row['winner_email']; ?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
} else {
    echo "No raffle winners found.";
}

// Close the database connection
mysqli_close($connection);
?>
