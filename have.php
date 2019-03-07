<?php include "includes/database.php"; ?>
<?php
    $holder_email = 'amanthakur0001@gmail.com';
    $holder_email = mysqli_real_escape_string($connection, $holder_email);
    $query="INSERT into ebook_holders (holder_email, holding_date) VALUES ('$holder_email', now())";
    $exe = mysqli_query($connection,$query);
    echo mysqli_error($connection);
    ?>
