<?php include "includes/database.php"; ?>
<?php session_start(); ?>


<?php

if(isset($_POST['login'])){
    
    $user_email = $_POST['user_email'];
    $password = $_POST['user_password'];
    
    $user_email = mysqli_real_escape_string($connection, $user_email);
    $password = mysqli_real_escape_string($connection, $password);
    
    $query = "SELECT * FROM users WHERE user_email = '{$user_email}' ";
    $get_user_login = mysqli_query($connection, $query);
    
    if(!$get_user_login){
        die("Query failed".mysqli_error($connection));
    }
    while($row = mysqli_fetch_assoc($get_user_login)){
        
        $db_user_id = $row['user_id'];
        $db_username = $row['username'];
        $db_user_email = $row['user_email'];
        $db_user_password = $row['user_password'];
        $db_user_firstname = $row['user_firstname'];
        $db_user_lastname = $row['user_lastname'];
        $db_user_role = $row['user_role'];
    }
    
    
    if($user_email && $password){
//        $hashed_password = crypt($password, $db_user_password);
        if($user_email === $db_user_email && password_verify($password,$db_user_password)){
            $_SESSION['username'] = $db_username;
            $_SESSION['user_email'] = $db_user_email;
            $_SESSION['user_firstname'] = $db_user_firstname;
            $_SESSION['user_lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            $_SESSION['password'] = $password;
            header("Location: admin");
        }
        else{
            
            $_SESSION['login_message_class'] = 'alert alert-danger'; 
            header("location: user_login.php");
            
        }
    }
    else{
        
            $_SESSION['login_message_class'] = 'alert alert-danger';
            header("location: user_login.php");
    }

}


?>