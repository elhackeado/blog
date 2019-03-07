<?php include "includes/database.php"; ?>
<?php
                if(isset($_GET['post_id'])){
                    
                $post_id = $_GET['post_id'];
                $post_id = preg_replace("/[^0-9]/", "", $post_id);

                if(empty($post_id)){
                  header("location: index.php");
                  exit;
                } ?>


<?php include "user_header.php"; ?>
<?php include "user_navigation.php"; ?>
      

    <section class="site-section py-lg">
      <div class="container">
        
        <div class="row blog-entries element-animate">


          
                <?php

                $current_post_id = $post_id;
                    
                $query="UPDATE posts SET post_views = post_views + 1 WHERE post_id = $post_id";
                $get_post_view = mysqli_query($connection,$query);

                $query="SELECT user_image FROM `users` WHERE user_role='Admin' ORDER BY user_id LIMIT 1";
                $get_image = mysqli_query($connection,$query);
                $row = mysqli_fetch_assoc($get_image);
                $admin_image = $row['user_image'];
                    
                $query = "SELECT * FROM posts WHERE post_id ={$post_id} AND post_status = 'Publish' ";
                $get_all_posts = mysqli_query($connection, $query);
                $post_count = mysqli_num_rows($get_all_posts);
                
                while($row = mysqli_fetch_assoc($get_all_posts)){
                    
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_date = date('F d, Y', strtotime($post_date));
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_views = $row['post_views'];
                    $post_category_id = $row['post_category_id'];
                    $current_post_category_id = $post_category_id;

                    $queryy = "SELECT cat_title FROM Categories WHERE cat_id=$current_post_category_id";
                    $get_current_category = mysqli_query($connection, $queryy);
                    $roww = mysqli_fetch_assoc($get_current_category);
                    $current_post_title = $roww['cat_title'];
                ?>



          <div class="col-md-12 col-lg-8 main-content">
            <img src="images/<?php echo $post_image; ?>" alt="Image" class="img-fluid mb-5">
             <div class="post-meta">
                        <span class="author mr-2"><img src="admin/images/<?php echo $admin_image; ?>" alt="Colorlib" class="mr-2"> <?php echo $post_author; ?></span>&bullet;
                        <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-eye"></span><?php echo $post_views; ?></span>
                      </div>
            <h1 class="mb-4"><?php echo $post_title; ?></h1>
            <a class="category mb-5" href="category.php?cat_id=<?php echo $current_post_category_id ?>"><?php echo $current_post_title ?> </a> 
           
            <div class="post-content-body">
              
          
            <?php echo $post_content; ?>
            
            </div>

            
            <div class="pt-5">
              <p>Category:  <a href="category.php?cat_id=<?php echo $current_post_category_id ?>"><?php echo $current_post_title ?></a></p>
            </div>

            <?php } 
                }
                else{
                    header("Location: index.php");    
                }
                ?>

            <!--Display Only Approved Comments Comment -->


                <?php
                
                if(isset($_GET['post_id'])){
                    $post_id = $_GET['post_id'];
                    $post_id = preg_replace("/[^0-9]/", "", $post_id);
                    $query = "SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status ='Approved' ORDER BY comment_id DESC";
                    $get_comments = mysqli_query($connection,$query);
                    $comment_count = mysqli_num_rows($get_comments);
                    ?><div class="pt-5">
              <h3 class="mb-5"><?php echo $comment_count; ?> Comments</h3>
              <ul class="comment-list"> <?php
                    
                    while($row = mysqli_fetch_assoc($get_comments)){
                        $comment_author = $row['comment_author'];
                        $comment_email = $row['comment_email'];
                        $comment_content = $row['comment_content'];

                        $comment_date = $row['comment_date'];
                        $comment_date = date('F d, Y', strtotime($comment_date));

                        $comment_status = $row['comment_status'];

                         ?>
                         <li class="comment">
                  <div class="vcard">
                    <img src="images/person_1.jpg" alt="Image placeholder">
                  </div>
                  <div class="comment-body">
                    <h3><?php echo $comment_author; ?></h3>
                    <div class="meta"><?php echo $comment_date; ?></div>
                    <p><?php echo $comment_content; ?></p>
                    <p><a href="#" class="reply rounded">Reply</a></p>
                  </div>
                </li>



                          <?php } } ?>


    

                
              </ul>
              <!-- END comment-list -->
              

              <?php if(!isset($_SESSION['user_role'])){ ?> 
                        <div>
            
            <div class="pt-5">
              <p>
            
            To leave a comment please <a href="user_login.php">Log In</a>
            </p>
            </div>
          
          </div>
                    <?php }else{ ?>
                    
                   <?php
                
                if(isset($_POST['add_comment'])){
                        $comment_post_id = $current_post_id;
                        $comment_author = $_SESSION['username'];
                        $comment_email = $_SESSION['user_email'];
                        $comment_content = $_POST['comment_content'];
                        $comment_content = mysqli_real_escape_string($connection, $comment_content);
                        $comment_date = date('d-m-y');

                        if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
                             $query = "INSERT INTO comments(comment_post_id ,comment_author ,comment_email, comment_content, comment_date) values($comment_post_id,'$comment_author','$comment_email','$comment_content',now() )";

                            $add_comment = mysqli_query($connection, $query);

                            confirm_query($add_comment);
                                $success = "Comment sent for Admin approval !";
                        }
                        else{
                            $error = "All fields are requried!";
                        }
                } 
                ?>





              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form role="form" action="" method="post" class="p-5 bg-light">
                  
                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="comment_content" name="comment_content" cols="30" rows="5" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    
                    <button type="submit" class="btn btn-primary" name="add_comment">Add Comment</button>
                  </div>
                  <?php 
                  
                    if(isset($success)){
                         
                        if($success=='Comment sent for Admin approval !'){
                           ?> <div class="alert alert-success" role="alert">
                                Comment sent for Admin approval !
                            </div> <?php
                        }
                    unset($success);
              
                    }
                     ?>

                </form>
              </div>
            
                <?php } ?>


            </div>

          </div>

          <!-- END main-content -->
          <?php include 'user_sidebar.php'; ?>

          <!-- END sidebar --------------------------------------------------------->

        </div>
      
      
    </section>

    <section class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2 class="mb-3 ">Related Post</h2>
          </div>
        </div>
        <div class="row">
          
          <?php 
                    
                    

                    $query = "SELECT * FROM posts WHERE post_status = 'Publish' AND post_category_id=$current_post_category_id AND post_id<>$current_post_id LIMIT 3";
                    $get_related_posts = mysqli_query($connection, $query);
    
                    while($row = mysqli_fetch_assoc($get_related_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_date = date('F d, Y', strtotime($post_date));
                    $post_image = $row['post_image'];
                    if ($post_image == ''){
                    $post_image = 'big_image_3.jpg';
                    }
                    ?>


          <div class="col-md-6 col-lg-4">
            <a href="post.php?post_id=<?php echo $post_id; ?>" class="a-block sm d-flex align-items-center height-md" style="background-image: url('images/<?php echo $post_image; ?>'); ">
              <div class="text">
                <div class="post-meta">
                  <span class="category"><?php echo $current_post_title ?></span>
                  <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                  <span class="ml-2"><span class="fa fa-eye"></span> <?php echo $post_views; ?></span>
                </div>
                <h3><?php echo $post_title; ?></h3>
              </div>
            </a>
          </div>

          <?php
           }
          ?>
          
          
        </div>
      </div>
      


    </section>
    <!-- END section -->
  
    
    <?php include "user_footer.php"; ?>

    
    
    <!-- loader -->
    <div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#f4b214"/></svg></div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/jquery-migrate-3.0.0.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.stellar.min.js"></script>

    
    <script src="js/main.js"></script>
  </body>
</html>