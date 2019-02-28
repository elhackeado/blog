<?php
    
    if(isset($_POST['add_post'])){
    
    $post_title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $post_author = $_SESSION['username'];
    $post_status = $_POST['post_status'];
    
    $post_image = $_FILES['post_image']['name'];
    $tmp_post_image = $_FILES['post_image']['tmp_name'];
    
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');

    move_uploaded_file($tmp_post_image, "../images/$post_image");
    
    $query = "INSERT INTO posts(post_category_id,post_title,post_author,post_status,post_tags,post_content,post_date,post_image) ";
    
    $query .= "VALUES ($post_category_id,'$post_title','$post_author','$post_status','$post_tags','$post_content',now(),'$post_image')";
    
    $create_post = mysqli_query($connection,$query);
    
    $post_id = mysqli_insert_id($connection);
    
    echo "<h5 class='well col-xs-6'>Post Created! '<a href='../post.php?post_id=$post_id'>  View Post </a>'</h5>";
    }
    

?>
<!--What enctype does is..it prepares form to receive the file such as image using type="file" in input form   -->

<div class="col-md-9">

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
       <label for="title">Enter title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="form-group">
       <label for="post_category_id">Post Category Title</label>
        <select class="form-control" name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM categories";
            $get_categories = mysqli_query($connection, $query);
            
            confirm_query($get_categories);
            
            while($row = mysqli_fetch_assoc($get_categories)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>
       
    <div class="form-group">
       <label for="post_status">Post Status</label>
        <select name="post_status" class="form-control" id="">
            <option value="Draft">Draft</option>
            <option value="Publish">Publish</option>
        </select>
    </div>
    
    <div class="form-group">
       <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
       <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" value="Publish Post" class="btn btn-primary" name="add_post">
    </div>
</form>
</div>