<?php include "includes/database.php"; ?>



<?php include "user_header.php"; ?>
<?php include "user_navigation.php"; ?>


    <section class="site-section pt-5">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-6">
            <?php
                
                 if(isset($_GET['cat_id'])){ //Displaying Title header of Category
                    $cat_id = $_GET['cat_id'];
                    $cat_id = preg_replace("/[^0-9]/", "", $cat_id);
                    $query = "SELECT cat_title FROM categories WHERE cat_id = $cat_id";
                    $get_category_header = mysqli_query($connection, $query);
                
                    $row = mysqli_fetch_assoc($get_category_header);
                    $cat_title = $row['cat_title'];
                 }
                ?>
            <h2 class="mb-4">Category: <?php echo $cat_title; ?></h2>
          </div>
        </div>
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            <div class="row mb-5 mt-5">

              <div class="col-md-12">



                <?php 
                if(isset($_GET['cat_id'])){
                        
                    $per_page = 8;
                    if(isset($_GET['page'])){
                        
                        $page = $_GET['page'];

                        $page_1 = ($page*$per_page)-$per_page;
                        }
                    else{
                        $page = 1;
                        $page_1 = 0;
                    }
                    
                    $cat_id = $_GET['cat_id'];
                    $cat_id = preg_replace("/[^0-9]/", "", $cat_id);
                    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status ='Publish' ";
                    
                    $find_post_count = mysqli_query($connection, $query);
                    $post_count = mysqli_num_rows($find_post_count);
                    $post_count = ceil($post_count/$per_page);
                    
                    
                    $query = "SELECT * FROM posts WHERE post_category_id = $cat_id AND post_status ='Publish' LIMIT $page_1,$per_page ";
                    $get_cat_post = mysqli_query($connection, $query);
                
                    while($row = mysqli_fetch_assoc($get_cat_post)){
                        $post_id = $row['post_id'];
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_date = date('F d, Y', strtotime($post_date));
                        $post_image = $row['post_image'];
                        $post_content = $row['post_content'];
                        $post_views = $row['post_views'];

                    $queryy="SELECT user_image FROM `users` WHERE username='$post_author'";
                    $get_image = mysqli_query($connection,$queryy);
                    $roww = mysqli_fetch_assoc($get_image);
                    $author_image = $roww['user_image'];

                    
                ?>

                <div class="post-entry-horzontal">
                  <a href="post.php?post_id=<?php echo $post_id; ?>">
                    <div class="image element-animate" data-animate-effect="fadeIn" style="background-image: url(images/<?php echo $post_image; ?>);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="admin/images/<?php echo $author_image ?>" alt="Image Placeholder"> <?php echo $post_author; ?></span>&bullet;
                        <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                        <span class="mr-2"><?php echo $cat_title; ?></span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> <?php echo $post_views; ?></span>
                      </div>
                      <h2><?php echo $post_title; ?></h2>
                    </span>
                  </a>
                </div>
                <!-- END post -->
                <?php }
                    if($post_count == 0 ){
                        
                        echo "<h1 class='text-center'>No Posts Found!</h1>";
                    }
                
                }
                else{
                    header("Location: index.php");
                }
                ?>
                

                
                <!-- END post -->

                
                <!-- END post -->

                
                <!-- END post -->

                
                <!-- END post -->

                
                <!-- END post -->

                
                <!-- END post -->

                
                <!-- END post -->

                
                <!-- END post -->

              </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-12 text-center">
                  <nav aria-label="Page navigation" class="text-center">
                    <ul class="pagination">
                      <li class="page-item"><a class="page-link" >&lt;</a></li>
                      
                      <?php
                
                for($i =1;$i <= $post_count;$i++){
                    if($i == $page){
                        echo "<li class='page-item active'><a class='page-link' href='category.php?cat_id=$cat_id&page=$i'>$i</a></li>";
                    }
                    else{
                        echo "<li><a href='category.php?cat_id=$cat_id&page=$i'>$i</a></li>";
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

          <?php include 'user_sidebar.php';  ?>
          <!-- END sidebar -->

        </div>
      </div>
    </section>
  
<?php include 'user_footer.php'; ?>
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