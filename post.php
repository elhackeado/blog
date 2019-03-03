<?php include "includes/database.php"; ?>
<?php
                if(isset($_GET['post_id'])){
                    
                $post_id = $_GET['post_id'];
                $post_id = preg_replace("/[^0-9]/", "", $post_id);

                if(empty($post_id)){
                  header("location: index.php");
                  exit;
                } ?>


<!doctype html>
<html lang="en">
  <head>
    <title>Colorlib Wordify &mdash; Minimal Blog Template</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Josefin+Sans:300, 400,700|Inconsolata:400,700" rel="stylesheet">

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <link rel="stylesheet" href="fonts/ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <!-- Theme Style -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    

    <div class="wrap">

      <?php include "user_header.php"; ?>
      

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
                        <span class="ml-2"><span class="fa fa-comments"></span><?php echo $post_views; ?></span>
                      </div>
            <h1 class="mb-4"><?php echo $post_title; ?></h1>
            <a class="category mb-5" href="#"><?php echo $current_post_title ?> </a> 
           
            <div class="post-content-body">
              
          
            <?php echo $post_content; ?>
            
            </div>

            
            <div class="pt-5">
              <p>Categories:  <a href="#">Food</a>, <a href="#">Travel</a>  Tags: <a href="#">#manila</a>, <a href="#">#asia</a></p>
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
              
              <div class="comment-form-wrap pt-5">
                <h3 class="mb-5">Leave a comment</h3>
                <form action="#" class="p-5 bg-light">
                  <div class="form-group">
                    <label for="name">Name *</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" class="form-control" id="email">
                  </div>
                  <div class="form-group">
                    <label for="website">Website</label>
                    <input type="url" class="form-control" id="website">
                  </div>

                  <div class="form-group">
                    <label for="message">Message</label>
                    <textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                    <input type="submit" value="Post Comment" class="btn btn-primary">
                  </div>

                </form>
              </div>
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
                  <span class="ml-2"><span class="fa fa-comments"></span> <?php echo $post_views; ?></span>
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

    </div>
    
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