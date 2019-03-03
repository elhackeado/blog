

<footer class="site-footer">
        <div class="container">
          <div class="row mb-5">
            <div class="col-md-4">
              <h3>About Us</h3>
              <p class="mb-4">
                <img src="images/img_1.jpg" alt="Image placeholder" class="img-fluid">
              </p>

              <p>Lorem ipsum dolor sit amet sa ksal sk sa, consectetur adipisicing elit. Ipsa harum inventore reiciendis. <a href="#">Read More</a></p>
            </div>
            <div class="col-md-6 ml-auto">
              <div class="row">
                <div class="col-md-7">
                  <h3>Latest Post</h3>
                  <div class="post-entry-sidebar">
                    <ul>

                  <?php 
                    $query = "SELECT * FROM posts WHERE post_status = 'Publish' ORDER BY post_id DESC LIMIT 4";
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
                              <span class="mr-2"><?php echo $post_date; ?> </span> &bullet;
                              <span class="ml-2"><span class="fa fa-comments"></span><?php echo $post_views; ?></span>
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
                <div class="col-md-1"></div>
                
                <div class="col-md-4">

                  <div class="mb-5">
                    <h3>Quick Links</h3>
                    <ul class="list-unstyled">
                      <li><a href="#">About Us</a></li>
                      <li><a href="#">Travel</a></li>
                      <li><a href="#">Adventure</a></li>
                      <li><a href="#">Courses</a></li>
                      <li><a href="#">Categories</a></li>
                    </ul>
                  </div>
                  
                  <div class="mb-5">
                    <h3>Social</h3>
                    <ul class="list-unstyled footer-social">
                      <li><a href="#"><span class="fa fa-twitter"></span> Twitter</a></li>
                      <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                      <li><a href="#"><span class="fa fa-instagram"></span> Instagram</a></li>
                      <li><a href="#"><span class="fa fa-vimeo"></span> Vimeo</a></li>
                      <li><a href="#"><span class="fa fa-youtube-play"></span> Youtube</a></li>
                      <li><a href="#"><span class="fa fa-snapchat"></span> Snapshot</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 text-center">
              <p class="small">
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy; <script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All Rights Reserved | Developed By <a href="https://ProjectusCreativity.ml">ProjectusCreativity.ml</a>
            </p>
            </div>
          </div>
        </div>
      </footer>
      <!-- END footer -->
      <div class="wrap">