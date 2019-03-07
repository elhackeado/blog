<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$user_email = $mysqli->escape_string($_POST['user_email']);
$result = $mysqli->query("SELECT * FROM users WHERE user_email='$user_email' AND user_role='Admin'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    echo '<script type="text/javascript">

          window.onload = function () { alert("Wrong Email"); }

            </script>';
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['user_password'], $user['user_password']) ) {
        
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_firstname'] = $user['user_firstname'];
        $_SESSION['user_lastname'] = $user['user_lastname'];
        $_SESSION['user_image'] = $user['user_image'];
        $_SESSION['active'] = $user['active'];
        $_SESSION['user_role'] = $user['user_role'];
        // This is how we'll know the user is logged in
        $_SESSION['logged_in'] = true;

        header("location: index.php");
    }
    else {
        $_SESSION['message'] = "You have entered wrong password, try again!";
        echo '<script type="text/javascript">

          window.onload = function () { alert("Wrong Password "); }

            </script>';
    }
}
