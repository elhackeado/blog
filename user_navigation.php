<div class="wrap">
<header role="banner">
        <div class="top-bar">
          <div class="container">
            <div class="row">
              <div class="col-9 social">
                <a href="#"><span class="fa fa-twitter"></span></a>
                <a href="#"><span class="fa fa-facebook"></span></a>
                <a href="#"><span class="fa fa-instagram"></span></a>
                <a href="#"><span class="fa fa-youtube-play"></span></a>
              </div>
              <div class="col-3 search-top">
                <!-- <a href="#"><span class="fa fa-search"></span></a> -->
                <form action="#" class="search-top-form">
                  <span class="icon fa fa-search"></span>
                  <input type="text" id="s" placeholder="Type keyword to search...">
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="container logo-wrap">
          <div class="row pt-5">
            <div class="col-12 text-center">
              <a class="absolute-toggle d-block d-md-none" data-toggle="collapse" href="#navbarMenu" role="button" aria-expanded="false" aria-controls="navbarMenu"><span class="burger-lines"></span></a>
              <h1 class="site-logo"><a href="index.php">Diy.Entrepreneur</a></h1>
            </div>
          </div>
        </div>
        
        <nav class="navbar navbar-expand-md  navbar-light bg-light">
          <?php
                    
                    
                        $home_class = 'nav-link';
                        $freeebook_class = 'nav-link';
                        $freeguides_class = 'nav-link';  
                        $about_class = 'nav-link';
                        $contact_class = 'nav-link';
                        $account_class = 'nav-link';
                          
                        
                        $pageName = basename($_SERVER['PHP_SELF']);
                        
                        if($pageName == 'index.php'){
                            $home_class = 'nav-link active';
                        }
                        else if($pageName == 'free_ebooks.php'){
                            $freeebook_class ='nav-link active';
                        }
                        else if($pageName == 'free_guides.php'){
                            $freeguides_class = 'nav-link active';
                        }
                        else if($pageName == 'about.php'){
                            $about_class = 'nav-link active';
                        }
                        else if($pageName == 'contact.php'){
                            $contact_class = 'nav-link active';
                        }
                        else if($pageName == 'user_login.php'){
                            $account_class = 'nav-link active';
                        }

                        
                        
                    
                   ?>







          <div class="container">
            
           
            <div class="collapse navbar-collapse" id="navbarMenu">
              <ul class="navbar-nav mx-auto">
                <li class="nav-item">
                  <a class="<?php echo $home_class; ?>" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="<?php echo $freeebook_class; ?>" href="free_ebook.php">Free E-Book</a>
                </li>
                
                <li class="nav-item">
                  <a class="<?php echo $freeguides_class; ?>" href="#">Free Guides</a>
                </li>
              
                
                
                
                <li class="nav-item">
                  <a class="<?php echo $about_class; ?>" href="about.php">About</a>
                </li>
                <li class="nav-item">
                  <a class="<?php echo $contact_class; ?>" href="contact.php">Contact</a>
                </li>

                <?php if(!isset($_SESSION['user_role'])){ ?> 
                        <li class="nav-item">
                        <a class="<?php echo $account_class; ?>" href="user_login.php">Log In</a>
                        </li>
                    <?php }else{ ?>
                    <li class="nav-item">
                    <a class="<?php echo $account_class; ?>" href="user_logout.php">Log Out</a>
                    </li>
                   <?php } ?>
                    
                
              </ul>
              
            </div>
          </div>
        </nav>
      </header>
      <!-- END header -->