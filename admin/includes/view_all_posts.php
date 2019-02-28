<?php

if(isset($_SESSION['user_role'])){
    if($_SESSION['user_role'] == "Admin"){
?>
        <?php
        if(isset($_POST['checkBoxArray'])){

            bulk_post_options();
        }
        if(isset($_GET['delete'])){
            
            delete_posts(); 
        }
        ?>
          <style>
              #BulkOptionContainer{
                  padding:0;
              }
            
            </style>
		   <?php include "delete_modal.php"; ?>
           <form action="" method="post">
            <div id="BulkOptionContainer" class="col-md-4">
                    <select class="form-control" name="bulk_options" id="">
                        <option value="">Select Option</option>
                        <option value="Draft">Draft</option>
                        <option value="Publish">Publish</option>
                        <option value="Delete">Delete</option>
                        <option value="Clone">Clone</option>
                        <option value="Reset Views">Reset Views</option>
                    </select>
            </div>
            <div class="col-md-4">
                <input type="submit" class="btn btn-default" value="Apply">
                <a class="btn btn-primary" href="posts.php?source=add_posts">Add New Post</a>
            </div>
             <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th><input id="selectAllBoxes" type="checkbox"></th>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Image</th>
                                    <th>Comments No.</th>
                                    <th>Post Views</th>
                                    <th>Date</th>
                                    <th>Content</th>
                                    <th>Delete</th>
                                    <th>Update</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
                                $query = "SELECT * FROM posts ORDER BY post_id DESC";
                                $get_posts = mysqli_query($connection,$query);
                                
                                while($row = mysqli_fetch_assoc($get_posts)){
                                    
                                    $post_id = $row['post_id'];
                                    $post_author = $row['post_author'];
                                    $post_title = $row['post_title'];
                                    
                                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
                                    $get_comment_count = mysqli_query($connection,$query);
                                    $post_comment_count = mysqli_num_rows($get_comment_count);
                                    
                                    $post_category_id = $row['post_category_id'];
                                    $post_status = $row['post_status'];
                                    $post_image = $row['post_image'];
                                    $post_tags = $row['post_tags'];
                                    $post_date = $row['post_date'];
                                    $post_views = $row['post_views'];
                                    $post_content = substr($row['post_content'],0,150);
                                    
                                    $query = "SELECT * FROM categories WHERE cat_id = $post_category_id ";
                                    $get_categories = mysqli_query($connection,$query);
                                    while($row = mysqli_fetch_assoc($get_categories)){
                                        $cat_title = $row['cat_title'];
                                    }
                                    
                                    echo "<tr>";
                                    ?>
                                    <td><input class='checkBoxes' type='checkbox' name="checkBoxArray[]" value="<?php echo $post_id; ?>"></td>
                                                                       
                                    <?php
                                    echo "<td>$post_id</td>";
                                    echo "<td>$post_author</td>";
                                    echo "<td><a href='../post.php?post_id=$post_id'>$post_title</a></td>";
                                    echo "<td>$cat_title</td>";
                                    echo "<td>$post_status</td>";
                                    echo "<td><img width='140px' src='../images/$post_image' alt='images'></td>";
                                    echo "<td>$post_comment_count</td>";
                                    echo "<td>$post_views</td>";
                                    echo "<td>$post_date</td>";
                                    echo "<td>$post_content</td>";
 
                                    echo "<td><a href='javascript:void(0)' data-href='posts.php?delete=$post_id' data-toggle='modal' data-target='#myModal' class='btn btn-danger'>Delete</a></td>";
                                  //  echo "<td><a rel='$post_id' href='javascript:void(0)' class='btn btn-danger delete_link'>Delete</a></td>";
//                                    echo "<td><a onClick=\"javascript: return confirm('Are you sure?') \" class='btn btn-danger' href='posts.php?delete=$post_id'>Delete</a></td>";
                                    echo "<td><a class='btn btn-primary' href='posts.php?source=edit_posts&update=$post_id'>Update</a></td>";
                                    echo "</tr>";
                                }
                                ?>
                                  </tbody>
                        </table>
            </form>
                
<script>
  
  $('#myModal').on('show.bs.modal', function (e) {
	
    	$(this).find('.modal_delete_link').attr('href', $(e.relatedTarget).data('href'));

});
/*
$('document').ready(function(){
	
  $('.delete_link').on('click',function(){
        var id = $(this).attr("rel");
        var delete_url = "posts.php?delete="+id; 
        
        $('.modal_delete_link').attr('href', delete_url);
        
        $('#myModal').modal('show');
    })


});*/
    


</script>


<?php

 }
}
else{
    header("Location: ../index.php");
}
?>