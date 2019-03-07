<?php include "includes/database.php"; ?>
<?php include "user_header.php"; ?>
<?php include "user_navigation.php"; ?>
      
      <section class="site-section pt-5 pb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-12">

              <div class="owl-carousel owl-theme home-slider">
                

                <?php 
                   
                   


                   $query = "SELECT * FROM `posts` WHERE post_status = 'Publish' ORDER BY post_views DESC LIMIT 3";
                    $get_recent_posts = mysqli_query($connection, $query);

                    
    
                    while($row = mysqli_fetch_assoc($get_recent_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_date = date('F d, Y', strtotime($post_date));
                    $post_views = $row['post_views'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_content = substr($post_content, 0, 100);
                    $post_category_id = $row['post_category_id'];
                    
                    $queryy="SELECT user_image FROM `users` WHERE username='$post_author'";
                    $get_image = mysqli_query($connection,$queryy);
                    $roww = mysqli_fetch_assoc($get_image);
                    $author_image = $roww['user_image'];

                    $queryyy = "SELECT cat_title FROM Categories WHERE cat_id=$post_category_id";
                    $get_category = mysqli_query($connection, $queryyy);
                    $rowww = mysqli_fetch_assoc($get_category);
                    $category_title = $rowww['cat_title'];




                    if ($post_image == ''){
                      $post_image = 'big_image_3.jpg';
                    }
                    ?>


                <div>
                  <a href="post.php?post_id=<?php echo $post_id; ?>" class="a-block d-flex align-items-center height-lg" style="background-image: url('images/<?php echo $post_image; ?>'); ">
                    <div class="text half-to-full">
                      <span class="category mb-5"><?php echo $category_title; ?></span>
                      <div class="post-meta">
                        
                        <span class="author mr-2"><img src="admin/images/<?php echo $author_image; ?>" alt="placeholder"> <?php echo $post_author; ?></span>&bullet;
                        <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-eye"></span> <?php echo $post_views; ?></span>
                        
                      </div>
                      <h3><?php echo $post_title; ?></h3>
                      <p><?php echo $post_content; ?></p>
                    </div>
                  </a>
                </div>
                
                <?php
                  }
                  ?>
                
              </div>
              
            </div>
          </div>
          
        </div>


      </section>
      <!-- END section -->

      <section class="site-section py-sm">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
              <h2 class="mb-4">Latest Posts</h2>
            </div>
          </div>
          <div class="row blog-entries">
            <div class="col-md-12 col-lg-8 main-content">
              <div class="row">

                <?php
                    $per_page = 8;
                
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                    
                    $page_1 = ($page*$per_page)-$per_page;
                    }
                else{
                    $page = 1;
                    $page_1 = 0;
                }
                
                $query="SELECT * FROM posts";
                $find_post_count =mysqli_query($connection, $query);
                $post_count = mysqli_num_rows($find_post_count);
                $post_count = ceil($post_count/$per_page);
                
                $query = "SELECT * FROM posts WHERE post_status ='Publish' ORDER BY post_id DESC LIMIT $page_1,$per_page";
                $get_all_posts = mysqli_query($connection, $query);
                
                while($row = mysqli_fetch_assoc($get_all_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_date = date('F d, Y', strtotime($post_date));
                    $post_image = $row['post_image'];
                    $post_content =substr($row['post_content'],0,220);
                    $post_views = $row['post_views'];
                ?>


                <div class="col-md-6">
                  <a href="post.php?post_id=<?php echo $post_id; ?>" class="blog-entry element-animate" data-animate-effect="fadeIn">
                    <img src="images/<?php echo $post_image; ?>" alt="Image placeholder" height="250" width="400">
                    <div class="blog-content-body">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="admin/images/<?php echo $author_image; ?>" alt="placeholder"> <?php echo $post_author; ?></span>&bullet;
                        <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-eye"></span> <?php echo $post_views; ?></span>
                      </div>
                      <h2><?php echo $post_title; ?></h2>
                    </div>
                  </a>
                </div>
                

                <?php } 
                    //Display No result
                    $count = mysqli_num_rows($get_all_posts);
                    if($count == 0 ){
                        
                        echo "<h1 class='text-center'>No Posts Found!</h1>";
                    }  
                ?>
                </div>
              <div class="row mt-5">
                <div class="col-md-12 text-center">
                  <nav aria-label="Page navigation" class="text-center">
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" >&lt;</a></li>
                      
                      <?php
                for($i =1;$i <= $post_count;$i++){
                    if($i == $page){
                        echo "<li class='page-item active'><a class='page-link' href='index.php?page=$i'>$i</a></li>";
                    }
                    else{
                        echo "<li><a href='index.php?page=$i'>$i</a></li>";
                    }
                    
                }
                ?>
                      
                      
                      <li class="page-item"><a class="page-link" >&gt;</a></li>
                    </ul>
                  </nav>
                </div>
              </div>


              </div>

              

            

            <!-- END main-content -->

            <?php include 'user_sidebar.php'; ?>
            <!-- END sidebar -->
            </div>

          </div>
        
      </section>
    
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