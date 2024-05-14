<?php include 'header.php'; ?>
    <!-- Login and sign up forms -->
    <div class="login-signup-container">
        <!-- Login form -->
        <div class="login-container">
            <h2>Login</h2>
            <form action="includeFiles/loginInc.php" method="post">
                <!-- Username -->
                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username"><br>

                <!-- Password -->
                <label for="password">Password:</label><br>
                <input type="password" id="password" name="password"><br><br>

                <!-- Submit button -->
                <input type="submit" value="Login" name="loginSubmit">
            </form>
        </div>

        <!-- Vertical line -->
        <div class="vertical-line"></div>

        <!-- Sign up form -->
        <div class="signup-container">
            <h2>Sign Up</h2>
            <form action="includeFiles/signupInc.php" method="post">
                <!-- Username -->
                <label for="signup-username">Username:</label><br>
                <input type="text" id="signup-username" name="signup-username"><br>

                <!-- Phone number -->
                <label for="phone">Phone Number:</label><br>
                <input type="text" id="phone" name="phone"><br>

                <!-- Email -->
                <label for="email">Email:</label><br>
                <input type="email" id="email" name="email"><br>

                <!-- Pssword -->
                <label for="signup-password">Password:</label><br>
                <input type="password" id="signup-password" name="signup-password"><br>
                
                <!-- Password Confirm -->
                <label for="confirm-password">Confirm Password:</label><br>
                <input type="password" id="confirm-password" name="confirm-password"><br><br>

                <!-- Submit button -->
                <input type="submit" value="Sign Up" name="signUpSubmit">
            </form>
        </div>
    </div>

    <!-- Sign Up Validation messages -->
    <div class="validation-messages">
    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyInput"){
                echo"<p>Make sure all fields have been filled in</p>";
            }

            else if($_GET["error"] == "invalidUsername"){
                echo"<p>Usernames can only have numbers and letters</p>"; 
            }

            else if($_GET["error"] == "invalidEmail"){
                echo"<p>Enter a suitable email</p>"; 
            }

            else if($_GET["error"] == "invalidPassword"){
                echo"<p>Passwords must be at least 7 characters long and have a space and a special character</p>"; 
            }
            else if($_GET["error"] == "passwordsUnmatch"){
                echo"<p>Passwords do not match</p>"; 
            }
            else if($_GET["error"] == "stmtFailed"){
                echo"<p>Something went wrong</p>"; 
            }
            else if($_GET["error"] == "usernameTaken"){
                echo"<p>Username already exists</p>"; 
            }
            else if($_GET["error"] == "none"){
                echo"<p>You have successfully signed up!</p>"; 
            }
        }
    ?>

    <?php
        if(isset($_GET["error"])){
            if($_GET["error"] == "emptyInput"){
                echo"<p>Make sure all fields have been filled in</p>";
            }
            
            else if($_GET["error"] == "wrongLogin"){
                echo"<p>Incorrect login details</p>"; 
            }
        }
    ?>
    </div>

    <?php include 'footer.php'; ?>

</body>
</html>