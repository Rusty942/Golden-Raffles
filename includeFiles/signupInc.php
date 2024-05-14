 <?php
/* code for when user presses sign up */ 
 if(isset($_POST["signUpSubmit"])){
    /* Get sign up fields */
    $userName = $_POST["signup-username"];
    $phoneNumber = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["signup-password"];
    $passwordRepeat = $_POST["confirm-password"];

    require_once 'dbhInc.php';
    require_once 'functionsInc.php';

    /*Sign up input validaton*/ 

    /*Checks to make sure the user has filled in all sign up fields*/
    if(emptyInputSignup($userName, $phoneNumber, $email, $password, $passwordRepeat) !== false){
        header("location: ../login.php?error=emptyInput");
        exit();
    }

    /*Checks to make sure the user has entered a valid username*/
    if(invalidUsername($userName) !== false){
        header("location: ../login.php?error=invalidUsername");
        exit();
    }


    /*Checks to make sure the user has entered a valid email*/
    if(invalidEmail($email) !== false){
        header("location: ../login.php?error=invalidEmail");
        exit();
    }

    /*Checks to make sure the user has entered a valid password*/
    if(invalidPassword($password) !== false){
        header("location: ../login.php?error=invalidPassword");
        exit();
    }

    /*Checks to make sure the user has entered the same password in both password fields*/
    if(passwordMatch($password, $passwordRepeat) !== false){
        header("location: ../login.php?error=passswordsUnmatch");
        exit();
    }

    /*Checks to make sure the user has entered a username or email that doesn't already exist in the database*/
    if(usernameExists($connection, $userName, $email) !== false){
        header("location: ../login.php?error=usernameTaken");
        exit();
    }

    /*If all validation is passed create a new user in the database*/
    createUser($connection, $userName, $phoneNumber, $email, $password);
 }

 else {
    header("location: ../login.php");
    exit();
 }