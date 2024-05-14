<?php include 'header.php'; ?>
<body>
    <!--The main body of the page where competition winners will be displayed-->
    <main>
        <h1>Raffle Winners</h1>

        <?php
        // Include PHP code to fetch and display raffle winners
        require_once 'winners.php';
        ?>
    </main>

    <?php include 'footer.php'; ?>

</body>