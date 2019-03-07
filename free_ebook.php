<?php include "includes/database.php"; ?>
<?php include "user_header.php"; ?>
<?php include "user_navigation.php"; ?>
<?php include "includes/mail_with_ebook.php"; ?>




    <section class="site-section">
      <div class="container">
        <div class="row mb-4">
          <div class="col-md-6">
            <h1>Get your free Ebook by Carlos Bermudez!</h1>
          </div>

        </div>
        <div class="row blog-entries">

          <div class="col-md-12 col-lg-8 main-content">

            <?php 
            if(!empty($alert_class) && !empty($result)){ ?>
            <div class="<?php echo $alert_class ?>" role="alert">
                  <?php echo $result ?>
                </div> 
          <?php    }
                ?>
            
            <form action="" method="post">
                  <div class="row">
                    
                    
                    <div class="col-md-12 form-group">
                      <label for="email">Email</label>
                      <input name="email" type="email" id="email" class="form-control " required>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input type="submit" name='submit' id="submit" value="Get Ebook" class="btn btn-primary">
                    </div>
                  </div>
                </form>
            

          </div>

          <!-- END main-content -->

          <?php include 'user_sidebar.php'; ?>
            
          <!-- END sidebar -->

        </div>
      </div>
    </section>
  
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