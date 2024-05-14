<?php
/*File that stores all php website functions*/


/* Sign up validation */


/*Checks to make sure the user has filled in all sign up fields*/
function emptyInputSignup($userName, $phoneNumber, $email, $password, $passwordRepeat) {
    $result = false;
    if(empty($userName) || empty($phoneNumber) || empty($email) || empty($password) || empty($passwordRepeat)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the user has entered a valid username*/
function invalidUsername($userName) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the user has entered a valid email*/
function invalidEmail($email) {
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the user has entered a valid password*/
function invalidPassword($password) {
    $result = false;
    $passLen = true;
    $incNum = true;
    $specChar = true;
    if(strlen($password) < 7) {
        $passLen = false;
    }
    
    if(!preg_match("/\d/", $password)) {
        $incNum = false;
    }

    if(!preg_match("/[!@#$%^&*()_+\-=\[\]{}|;':\",.<>?~]/", $password)) {
        $specChar = false;
    }

    if($passLen == true && $incNum == true && $specChar == true){
        $result = false;
        return $result;
    }

    else{
        $result = true;
        return $result;
    }
}

/*Checks to make sure the user has entered the same password in both password fields*/
function passwordMatch($password, $passwordRepeat) {
    $result = false;
    if($password !== $passwordRepeat) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the user has entered a username or email that doesn't already exist in the database*/
function usernameExists($connection, $userName, $email) {
    $sql = "SELECT * FROM users WHERE userUsername = ? OR userEmail = ?;";
    $stmt = mysqli_stmt_init($connection);
    /*Prepare statement to counter sql injection*/
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();   
    }

    mysqli_stmt_bind_param($stmt, "ss", $userName, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        mysqli_stmt_close($stmt);
        return $row;
    }
    else{
        mysqli_stmt_close($stmt);
        return false;
    }
}

/*If all validation is passed create a new user in the database*/
function createUser($connection, $userName, $phoneNumber, $email, $password) {
    $sql = "INSERT INTO users (userUsername, userPhoneNumber, userEmail, userPassword) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($connection);
    /*Prepare statement to counter sql injection*/
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();   
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $userName, $phoneNumber, $email, $hashedPassword);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?error=none");
    exit();   
}


/* Login validation */


/*Checks to make sure the user has filled in all login fields*/
function emptyInputLogin($userName, $password) {
    $result = false;
    if(empty($userName)|| empty($password)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Logs in the user*/
function loginUser($connection, $userName, $password){
    $userExists = usernameExists($connection, $userName, $userName);

    if($userExists === false){
        header("location: ../login.php?error=wrongLogin");
        exit();
    }   

    $passwordHashed = $userExists["userPassword"];
    $checkPassword = password_verify($password, $passwordHashed);

    if($checkPassword === false){
        header("location: ../login.php?error=wronglogin");
        exit();
    }
    else if($checkPassword === true){
        session_start();
        $_SESSION["userid"] = $userExists["userId"];
        $_SESSION["useruser"] = $userExists["userUsername"];
        header("location: ../index.php");
        exit();
    }
}


/* Raffle Creation validation */

function emptyInputCreateRaffle($raffleTitle, $raffleDescription, $raffleLength, $maxEntries) {
    $result = false;
    if(empty($raffleTitle) || empty($raffleDescription) || empty($raffleLength) || empty($maxEntries)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the user has entered a valid raffle title*/
function invalidRaffleTitle($raffleTitle) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9\s]*$/", $raffleTitle)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the raffle holder has entered a valid raffle description*/
function invalidRaffleDescription($raffleDescription) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9\s]*$/", $raffleDescription)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the raffle holder has entered a valid raffle length (integer ONLY between 1 and 120)*/
function invalidRaffleLength($raffleLength) {
    if (!ctype_digit($raffleLength) || $raffleLength < 1 || $raffleLength > 120 || strpos($raffleLength, '.') !== false) {
        return true;
    } else {
        return false;
    }
}

/*Checks to make sure the raffle holder has entered a valid raffle max entry amount (integer ONLY between 10 and 500)*/
function invalidRaffleMaxEntries($maxEntries) {
    if (!ctype_digit($maxEntries) || $maxEntries < 10 || $maxEntries > 500 || strpos($maxEntries, '.') !== false) {
        return true;
    } else {
        return false;
    }
}

/*If all validation is passed create a new raffle in the database*/
function createRaffle($connection, $raffleTitle, $raffleDescription, $raffleLength, $maxEntries) {
    $sql = "INSERT INTO raffle_competitions (title, description, duration_hours, max_entries) VALUES (?, ?, ?, ?)";
    
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../createRaffle.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssii", $raffleTitle, $raffleDescription, $raffleLength, $maxEntries);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../createRaffle.php?error=none");
    exit();
}


/* Raffle entry validation */


/*Checks to make sure the user has entered a valid username*/
function invalidNameEnterComp($name) {
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9\s]*$/", $name)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

/*Checks to make sure the user has filled in all sign up fields*/
function emptyInputEnterComp($email, $name) {
    $result = false;
    if(empty($name) || empty($email)) {     
        $result = true;
    }
    else{
        $result = false;    
    }
    return $result;
}

// Function to check if an email already exists for a specific competition
function compEmailExists($connection, $email, $compId) {
    // Prepare SQL statement to check if the email exists for the given competition ID
    $sql = "SELECT * FROM raffle_entries WHERE email = ? AND competition_id = ?";
    
    // Prepare the SQL statement
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=sqlerror");
        exit();
    } else {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "si", $email, $compId);
        
        // Execute the prepared statement
        mysqli_stmt_execute($stmt);
        
        // Store the result
        mysqli_stmt_store_result($stmt);
        
        // Check if a row exists with the given email and competition ID
        if (mysqli_stmt_num_rows($stmt) > 0) {
            mysqli_stmt_close($stmt);
            return true; // Email already exists for this competition
        } else {
            mysqli_stmt_close($stmt);
            return false; // Email does not exist for this competition
        }
    }
}


/*If all validation is passed create a new raffle entry database*/
function createRaffleUser($connection, $compId, $email, $name) {
    $sql = "INSERT INTO raffle_entries (competition_id, email, entry_name) VALUES (?, ?, ?)";
    
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../index.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $compId, $email, $name);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../index.php?error=none");
    exit();
}



function drawRaffleWinner($connection, $competition_id) {
    // Select a random entry from the specified competition
    $sql_select_entry = "SELECT * FROM raffle_entries WHERE competition_id = ? ORDER BY RAND() LIMIT 1";
    $stmt_select_entry = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt_select_entry, $sql_select_entry)) {
        // Handle SQL statement preparation error
        header("location: ../drawRaffle.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt_select_entry, "i", $competition_id);
    mysqli_stmt_execute($stmt_select_entry);
    $result_select_entry = mysqli_stmt_get_result($stmt_select_entry);
    
    if ($row = mysqli_fetch_assoc($result_select_entry)) {
        // Extract winner's information
        $winner_name = $row['entry_name'];
        $winner_email = $row['email'];

        // Insert winner's information into raffle_winners table
        $sql_insert_winner = "INSERT INTO raffle_winners (competition_id, winner_name, winner_email) VALUES (?, ?, ?)";
        $stmt_insert_winner = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt_insert_winner, $sql_insert_winner)) {
            // Handle SQL statement preparation error
            header("location: ../drawRaffle.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt_insert_winner, "iss", $competition_id, $winner_name, $winner_email);
        mysqli_stmt_execute($stmt_insert_winner);
        
        // Delete the competition and all associated entries
        $sql_delete_entries = "DELETE FROM raffle_entries WHERE competition_id = ?";
        $stmt_delete_entries = mysqli_stmt_init($connection);
        if (!mysqli_stmt_prepare($stmt_delete_entries, $sql_delete_entries)) {
            // Handle SQL statement preparation error
            header("location: ../drawRaffle.php?error=stmtfailed");
            exit();
        }
        
        mysqli_stmt_bind_param($stmt_delete_entries, "i", $competition_id);
        mysqli_stmt_execute($stmt_delete_entries);
        
        // Redirect with success message
        header("location: ../drawRaffle.php?draw=success");
        exit();
    } else {
        // No entries found for the competition
        header("location: ../drawRaffle.php?error=noentries");
        exit();
    }
  
}

function deleteCompetition($connection, $competition_id) {
    // Delete the competition from raffle_competitions
    $sql_delete_competition = "DELETE FROM raffle_competitions WHERE competition_id = ?";
    $stmt_delete_competition = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt_delete_competition, $sql_delete_competition)) {
        // Handle SQL statement preparation error
        header("location: ../drawRaffle.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt_delete_competition, "i", $competition_id);
    mysqli_stmt_execute($stmt_delete_competition);
    
    // Redirect with success message
    header("location: ../drawRaffle.php?delete=success");
    exit();
}