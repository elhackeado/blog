<?php include 'includes/database.php'; ?>
<?php include 'user_header.php'; ?>
<?php include "user_navigation.php"; ?>
    

    <section class="site-section pt-5">
      <div class="container">
        
        <div class="row blog-entries">
          <div class="col-md-12 col-lg-8 main-content">
            
            <div class="row">
              <div class="col-md-12">
                <h2 class="mb-4">Hi There! I'm Carlos Bermudez</h2>
                <p class="mb-5"><img src="images/img_6.jpg" alt="Image placeholder" class="img-fluid"></p>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum minima eveniet recusandae suscipit eum laboriosam fugit amet deleniti iste et. Ad dolores, necessitatibus non saepe tenetur impedit commodi quibusdam natus repellat, exercitationem accusantium perferendis officiis. Laboriosam impedit quia minus pariatur!</p>
                <p>Dignissimos iste consectetur, nemo magnam nulla suscipit eius quibusdam, quo aperiam quia quae est explicabo nostrum ab aliquid vitae obcaecati tenetur beatae animi fugiat officia id ipsam sint? Obcaecati ea nisi fugit assumenda error totam molestiae saepe fugiat officiis quam?</p>
                <p>Culpa porro quod doloribus dolore sint. Distinctio facilis ullam voluptas nemo voluptatum saepe repudiandae adipisci officiis, explicabo eaque itaque sed necessitatibus, fuga, ea eius et aliquam dignissimos repellendus impedit pariatur voluptates. Dicta perferendis assumenda, nihil placeat, illum quibusdam. Vel, incidunt?</p>
                <p>Dolorum blanditiis illum quo quaerat, possimus praesentium perferendis! Quod autem optio nobis, placeat officiis dolorem praesentium odit. Vel, cum, a. Adipisci eligendi eaque laudantium dicta tenetur quod, pariatur sunt sed natus officia fuga accusamus reprehenderit ratione, provident possimus ut voluptatum.</p>
              </div>
            </div>

            <div class="row mb-5 mt-5">
              <div class="col-md-12 mb-5">
                <h2>My Latest Posts</h2>
              </div>
              <div class="col-md-12">

                <?php 

                    $query="SELECT user_image FROM `users` WHERE user_role='Admin' ORDER BY user_id LIMIT 1";
                    $get_image = mysqli_query($connection,$query);
                    $row = mysqli_fetch_assoc($get_image);
                    $admin_image = $row['user_image'];

                    $query = "SELECT * FROM posts WHERE post_status = 'Publish' ORDER BY post_id DESC LIMIT 2";
                    $get_recent_posts = mysqli_query($connection, $query);
    
                    while($row = mysqli_fetch_assoc($get_recent_posts)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_date = date('F d, Y', strtotime($post_date));
                    $post_views = $row['post_views'];
                    $post_image = $row['post_image'];
                    $post_author = $row['post_author'];
                    if ($post_image == ''){
                    $post_image = 'big_image_3.jpg';
                    }
                    ?>

                <div class="post-entry-horzontal">
                  <a href="post.php?post_id=<?php echo $post_id; ?>">
                    <div class="image" style="background-image: url(images/<?php echo $post_image; ?>);"></div>
                    <span class="text">
                      <div class="post-meta">
                        <span class="author mr-2"><img src="admin/images/<?php echo $admin_image; ?>" alt="Image placeholder"> <?php echo $post_author; ?></span>&bullet;
                        <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                        <span class="ml-2"><span class="fa fa-comments"></span> <?php echo $post_views; ?></span>
                      </div>
                      <h2><?php echo $post_title; ?></h2>
                    </span>
                  </a>
                </div>
                <!-- END post -->

                <?php
                        }
                        ?>

                
              

                
                

               
              </div>
            </div>

            

            

          </div>

          <!-- END main-content -->
            <?php include 'user_sidebar.php'; ?>
            <!-- END sidebar-box -->
           
            <!-- END sidebar-box  
            
             END sidebar-box -->

            
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