          <div class="col-md-12 col-lg-4 sidebar">
            <div class="sidebar-box search-form-wrap">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" id="s" placeholder="Type a keyword and hit enter">
                </div>
              </form>
            </div>
            <!-- END sidebar-box -->
            <div class="sidebar-box">
              <div class="bio text-center">
                <img src="images/person_2.jpg" alt="Image Placeholder" class="img-fluid">
                <div class="bio-body">
                  <h2>Craig David</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Exercitationem facilis sunt repellendus excepturi beatae porro debitis voluptate nulla quo veniam fuga sit molestias minus.</p>
                  <p><a href="#" class="btn btn-primary btn-sm rounded">Read my bio</a></p>
                  <p class="social">
                    <a href="#" class="p-2"><span class="fa fa-facebook"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-twitter"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-instagram"></span></a>
                    <a href="#" class="p-2"><span class="fa fa-youtube-play"></span></a>
                  </p>
                </div>
              </div>
            </div>
            <!-- END sidebar-box -->  
            <div class="sidebar-box">
              <h3 class="heading">Popular Posts</h3>
              <div class="post-entry-sidebar">
                <ul>
                  
                  <?php 
                   $query = "SELECT * FROM `posts` WHERE post_status = 'Publish' ORDER BY post_views DESC LIMIT 3";
                    $get_recent_posts = mysqli_query($connection, $query);
    
                    while($row = mysqli_fetch_assoc($get_recent_posts)){
                    $post_id = $row['post_id'];
                      $post_title = $row['post_title'];
                    $post_date = $row['post_date'];
                    $post_date = date('F d, Y', strtotime($post_date));
                    $post_views = $row['post_views'];
                    $post_image = $row['post_image'];
                    if ($post_image == ''){
                      $post_image = 'big_image_3.jpg';
                    }
                    ?>

                  <li>
                    <a href="post.php?post_id=<?php echo $post_id; ?>">
                          <img href="post.php?post_id=<?php echo $post_id; ?>" src="images/<?php echo $post_image; ?>" alt="Image placeholder" class="mr-4">
                      <div class="text">
                        <h4><?php echo $post_title; ?></h4>
                        <div class="post-meta">
                          <span class="mr-2"><?php echo $post_date; ?> </span>
                        </div>
                      </div>
                    </a>
                  </li>
                  


                    <?php
                        }
                        ?>
                  
                  
                </ul>
              </div>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Categories</h3>
              <ul class="categories">
                <?php 
                   $query = "SELECT * FROM categories ORDER BY cat_id LIMIT 5";
                    $get_categories = mysqli_query($connection, $query);

    
                    while($row = mysqli_fetch_assoc($get_categories)){
                    
                    $category_id = $row['cat_id'];
                    $category_title = $row['cat_title'];

                    $que = "SELECT * FROM posts WHERE post_category_id=$category_id";
                    $get_post_count = mysqli_query($connection, $que);
                    $post_count = mysqli_num_rows($get_post_count);

                    ?>

                <li><a href="#"><?php echo $category_title ?> <span>(<?php echo $post_count ?>)</span></a></li>
                
                <?php
                  }
                ?>
              </ul>
            </div>
            <!-- END sidebar-box -->

            <div class="sidebar-box">
              <h3 class="heading">Tags</h3>
              <ul class="tags">
                <li><a href="#">Travel</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Freelancing</a></li>
                <li><a href="#">Travel</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Business</a></li>
                <li><a href="#">Freelancing</a></li>
              </ul>
            </div>
          </div>