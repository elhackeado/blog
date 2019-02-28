<?php
/* User login process, checks if user exists and password is correct */

// Escape email to protect against SQL injections
$email = $mysqli->escape_string($_POST['email']);
$result = $mysqli->query("SELECT * FROM users WHERE email='$email'");

if ( $result->num_rows == 0 ){ // User doesn't exist
    $_SESSION['message'] = "User with that email doesn't exist!";
    echo '<script type="text/javascript">

          window.onload = function () { alert("Wrong Email"); }

            </script>';
}
else { // User exists
    $user = $result->fetch_assoc();

    if ( password_verify($_POST['password'], $user['password']) ) {
        
        $_SESSION['email'] = $user['email'];
        $_SESSION['first_name'] = $user['first_name'];
        $_SESSION['last_name'] = $user['last_name'];
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