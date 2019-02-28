<?php

$query = "SELECT * FROM categories";
$get_categories = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($get_categories)){
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

echo "<tr><td>{$cat_id}</td><td>{$cat_title}</td>
<td><a class='btn btn-danger' data-toggle='modal' data-target='#myModal' data-href='categories.php?delete=$cat_id' href='javascript:void(0)'>Delete</a> <a class='btn btn-primary' href='categories.php?update={$cat_id}'>Update</a></td></tr>";
}

?>