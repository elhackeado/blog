<?php
if(isset($_GET['update'])){
    $update_id = $_GET['update'];
    $query = "SELECT * FROM posts WHERE post_id = $update_id ";
    $get_update_data = mysqli_query($connection, $query);
    
        while($row = mysqli_fetch_assoc($get_update_data))
        {
        $post_title = $row['post_title'];
        $post_comment_count = $row['post_comment_count'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_date = $row['post_date'];
        $post_content = $row['post_content'];
        }

        if(isset($_POST['update_post'])){
        $post_title = $_POST['title'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];
        $post_image = $_FILES['post_image']['name'];
        $tmp_post_image = $_FILES['post_image']['tmp_name'];
        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
    
        move_uploaded_file($tmp_post_image, "../images/$post_image");
        
        if(empty($post_image)){
            
            $query = "SELECT * FROM posts WHERE post_id =$update_id";
            $select_image = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_image)){
                
                $post_image = $row['post_image'];
            }
        }
    
        $query = "UPDATE posts SET post_title ='{$post_title}', post_category_id ='{$post_category_id}', post_status = '{$post_status}', post_image = '{$post_image}', post_tags = '{$post_tags}', post_content= '{$post_content}', post_date = now() WHERE post_id = $update_id ";
        
        $update_posts = mysqli_query($connection, $query);
        confirm_query($update_posts);
        
        echo "<h5 class='well col-xs-6'>Post Updated! <a href='../post.php?post_id=$update_id'>  View Post </a></h5>";
    }
}
?>
<!--What enctype does is..it prepares form to receive the file such as image using type="file" in input form   -->
<div class="col-md-9">
<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
       <label for="title">Enter title</label>
        <input value="<?php echo $post_title; ?>" type="text" class="form-control" name="title">
    </div>
    
    <div class="form-group">
       <label for="post_category_id">Post Category ID</label>
        <select class="form-control" name="post_category_id" id="">
            <?php
            $query = "SELECT * FROM categories WHERE cat_id = $post_category_id";
            $get_categories = mysqli_query($connection, $query);
            
            confirm_query($get_categories);
            
            while($row = mysqli_fetch_assoc($get_categories)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                
                echo "<option value='$cat_id'>{$cat_title}</option>";
            }
            
            $query = "SELECT * FROM categories";
            $get_categories = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($get_categories)){
                $cat_title = $row['cat_title'];
                $cat_id = $row['cat_id'];
                if($cat_id != $post_category_id){
                echo "<option value='$cat_id'>{$cat_title}</option>";
                }
            }
            ?>
        </select>
    </div>
    
    <div class="form-group">
       <label for="post_status">Post Status</label>
       <select name="post_status" class="form-control" id="">
            <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>
            <?php
           if($post_status == "Draft"){
               echo "<option value='Publish'>Publish</option>";
           }else{
              echo "<option value='Draft'>Draft</option>";
           }
            ?>
            
        </select>
    </div>
    
    <div class="form-group">
        <img width="200" src="../images/<?php echo $post_image; ?>" alt="">
    </div>
    <div class="form-group">
       <label for="post_image">Post Image</label>
        <input type="file" name="post_image">
    </div>
    
    <div class="form-group">
       <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>
    
    <div class="form-group">
       <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?></textarea>
    </div>
    
    <div class="form-group">
        <input type="submit" value="Update Post" class="btn btn-primary" name="update_post">
    </div>
</form>
</div>