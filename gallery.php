<?php include 'head.php' ?>

    <!--Page Title-->
    <section class="page-title" style="background-image:url(images/background/16.jpg);">
        <div class="auto-container">
            <div class="inner-container clearfix">
                <h1>Properties</h1>
                <ul class="bread-crumb clearfix">
                    <li><a href="index">Home</a></li>
                    <li>Properties</li>
                </ul>
            </div>
        </div>
    </section>
    <!--End Page Title-->

    <!-- Property Filter Section -->
    <section class="property-filter-section">
        <div class="auto-container">
            <!--MixitUp Galery-->
            <div class="mixitup-gallery">
                <div class="upper-box clearfix">
                    <div class="sec-title">
                        <span class="title">FIND YOUR HOUSE IN YOUR CITY</span>
                        <h2>PROPERTY TYPES</h2>
                    </div>

                    <!--Filter-->
                    <div class="filters">
                        <ul class="filter-tabs filter-btns clearfix">
                            <li class="active filter" data-role="button" data-filter="all">All</li>
                        </ul>
                    </div>
                </div>

                <div class="filter-list row">
                    <?php
                    $user = dbConnect()->prepare("SELECT * FROM estates ORDER BY RAND() LIMIT 12");
                    $user->execute();
                    $i = 0;
                    while($rr = $user->fetch()){
                        $eid = $rr['id'];
                        $estNam = $rr['estate_name'];
                        $dsc = $rr['estate_description'];
                        $loc = $rr['estate_location'];
                        $prs = $rr['price'];
                        
                        $im= dbConnect()->prepare("SELECT * FROM estate_images WHERE estate_name='$estNam'");
                        $im->execute();
                        $r=$im->fetch();
                        $img= $r['image'];
                                                                     
                           ?>
                    <!-- Property Block -->
                    <div class="property-block all mix house villa col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="app/app/admin/<?php echo $img; ?>" alt=""></figure>
                                <span class="for">FOR SALE</span>
                                <span class="featured">FEATURED</span>
                                <ul class="option-box">
                                    <li><a href="admin/<?php echo $img; ?>" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                    <li><a href="property-detail?id=<?php echo $eid; ?>"><i class="la la-heart"></i></a></li>
                                    
                                </ul>
                                <ul class="info clearfix">
                                    <li><a href="l"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <div class="thumb"><img src="app/app/admin/<?php echo $img; ?>" alt=""></div>
                                <h3><a href="property-detail?id=<?php echo $eid; ?>"><?php echo $estNam; ?></a></h3>
                                <div class="lucation"><i class="la la-map-marker"></i> <?php echo $loc; ?></div>
                                <ul class="property-info clearfix">
                                    <li><i class="flaticon-dimension"></i> <?php echo $rr['feature1'];?></li>
                                    <li><i class="flaticon-dimension"></i> <?php echo $rr['feature2'];?></li>
                                    <li><i class="flaticon-dimension"></i> <?php echo $rr['feature3'];?></li>
                                    <li><i class="flaticon-dimension"></i> <?php echo $rr['feature4'];?></li>
                                </ul>
                                <div class="property-price clearfix">
                                    <div class="read-more"><a href="property-detail?id=<?php echo $eid; ?>" class="theme-btn">More Detail</a></div>
                                    <div class="price"><?php echo number_format($prs) ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
<?php /*
                    <!-- Property Block -->
                    <div class="property-block all mix restaurent apprtment form col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/property-2.jpg" alt=""></figure>
                                <span class="for">FOR SALE</span>
                                <span class="featured">FEATURED</span>
                                <ul class="option-box">
                                    <li><a href="images/resource/property-2.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                    <li><a href="#"><i class="la la-heart"></i></a></li>
                                    <li><a href="#"><i class="la la-retweet"></i></a></li>
                                </ul>
                                <ul class="info clearfix">
                                    <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <ul class="tags">
                                    <li><a href="property-detail.html">Apartment</a>,</li>
                                    <li><a href="property-detail.html">Bar</a>,</li>
                                    <li><a href="property-detail.html">House</a>,</li>
                                </ul>
                                <div class="thumb"><img src="images/resource/thumb-6.jpg" alt=""></div>
                                <h3><a href="property-detail.html">Apartment Morden 1243, W No...</a></h3>
                                <div class="lucation"><i class="la la-map-marker"></i> Orland Park, IL 35785, Chicago, United State</div>
                                <ul class="property-info clearfix">
                                    <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                                    <li><i class="flaticon-bed"></i> 4 Bedrooms</li>
                                    <li><i class="flaticon-car"></i> 2 Garage</li>
                                    <li><i class="flaticon-bathtub"></i> 3 Bathroom</li>
                                </ul>
                                <div class="property-price clearfix">
                                    <div class="read-more"><a href="property-detail.html" class="theme-btn">More Detail</a></div>
                                    <div class="price">$ 13,65,000</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Block -->
                    <div class="property-block all mix house restaurent villa col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/property-3.jpg" alt=""></figure>
                                <span class="for">FOR SALE</span>
                                <span class="featured">FEATURED</span>
                                <ul class="option-box">
                                    <li><a href="images/resource/property-3.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                    <li><a href="#"><i class="la la-heart"></i></a></li>
                                    <li><a href="#"><i class="la la-retweet"></i></a></li>
                                </ul>
                                <ul class="info clearfix">
                                    <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <ul class="tags">
                                    <li><a href="property-detail.html">Apartment</a>,</li>
                                    <li><a href="property-detail.html">Bar</a>,</li>
                                    <li><a href="property-detail.html">House</a>,</li>
                                </ul>
                                <div class="thumb"><img src="images/resource/thumb-7.jpg" alt=""></div>
                                <h3><a href="property-detail.html">Great Home for Single fmaily</a></h3>
                                <div class="lucation"><i class="la la-map-marker"></i> Orland Park, IL 35785, Chicago, United State</div>
                                <ul class="property-info clearfix">
                                    <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                                    <li><i class="flaticon-bed"></i> 4 Bedrooms</li>
                                    <li><i class="flaticon-car"></i> 2 Garage</li>
                                    <li><i class="flaticon-bathtub"></i> 3 Bathroom</li>
                                </ul>
                                <div class="property-price clearfix">
                                    <div class="read-more"><a href="property-detail.html" class="theme-btn">More Detail</a></div>
                                    <div class="price">$ 13,65,000</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Block -->
                    <div class="property-block all mix apprtment villa form col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/property-4.jpg" alt=""></figure>
                                <span class="for">FOR SALE</span>
                                <span class="featured">FEATURED</span>
                                <ul class="option-box">
                                    <li><a href="images/resource/property-4.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                    <li><a href="#"><i class="la la-heart"></i></a></li>
                                    <li><a href="#"><i class="la la-retweet"></i></a></li>
                                </ul>
                                <ul class="info clearfix">
                                    <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <ul class="tags">
                                    <li><a href="property-detail.html">Apartment</a>,</li>
                                    <li><a href="property-detail.html">Bar</a>,</li>
                                    <li><a href="property-detail.html">House</a>,</li>
                                </ul>
                                <div class="thumb"><img src="images/resource/thumb-8.jpg" alt=""></div>
                                <h3><a href="property-detail.html">Single House Near Orland Park.</a></h3>
                                <div class="lucation"><i class="la la-map-marker"></i> Orland Park, IL 35785, Chicago, United State</div>
                                <ul class="property-info clearfix">
                                    <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                                    <li><i class="flaticon-bed"></i> 4 Bedrooms</li>
                                    <li><i class="flaticon-car"></i> 2 Garage</li>
                                    <li><i class="flaticon-bathtub"></i> 3 Bathroom</li>
                                </ul>
                                <div class="property-price clearfix">
                                    <div class="read-more"><a href="property-detail.html" class="theme-btn">More Detail</a></div>
                                    <div class="price">$ 13,65,000</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Block -->
                    <div class="property-block all mix house restaurent villa col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/property-5.jpg" alt=""></figure>
                                <span class="for">FOR SALE</span>
                                <span class="featured">FEATURED</span>
                                <ul class="option-box">
                                    <li><a href="images/resource/property-5.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                    <li><a href="#"><i class="la la-heart"></i></a></li>
                                    <li><a href="#"><i class="la la-retweet"></i></a></li>
                                </ul>
                                <ul class="info clearfix">
                                    <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <ul class="tags">
                                    <li><a href="property-detail.html">Apartment</a>,</li>
                                    <li><a href="property-detail.html">Bar</a>,</li>
                                    <li><a href="property-detail.html">House</a>,</li>
                                </ul>
                                <div class="thumb"><img src="images/resource/thumb-9.jpg" alt=""></div>
                                <h3><a href="property-detail.html">Apartment Morden 1243, W No...</a></h3>
                                <div class="lucation"><i class="la la-map-marker"></i> Orland Park, IL 35785, Chicago, United State</div>
                                <ul class="property-info clearfix">
                                    <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                                    <li><i class="flaticon-bed"></i> 4 Bedrooms</li>
                                    <li><i class="flaticon-car"></i> 2 Garage</li>
                                    <li><i class="flaticon-bathtub"></i> 3 Bathroom</li>
                                </ul>
                                <div class="property-price clearfix">
                                    <div class="read-more"><a href="property-detail.html" class="theme-btn">More Detail</a></div>
                                    <div class="price">$ 13,65,000</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Block -->
                    <div class="property-block all mix apprtment restaurent form col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="inner-box">
                            <div class="image-box">
                                <figure class="image"><img src="images/resource/property-6.jpg" alt=""></figure>
                                <span class="for">FOR SALE</span>
                                <span class="featured">FEATURED</span>
                                <ul class="option-box">
                                    <li><a href="images/resource/property-6.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                    <li><a href="#"><i class="la la-heart"></i></a></li>
                                    <li><a href="#"><i class="la la-retweet"></i></a></li>
                                </ul>
                                <ul class="info clearfix">
                                    <li><a href="properties.html"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                </ul>
                            </div>
                            <div class="lower-content">
                                <ul class="tags">
                                    <li><a href="property-detail.html">Apartment</a>,</li>
                                    <li><a href="property-detail.html">Bar</a>,</li>
                                    <li><a href="property-detail.html">House</a>,</li>
                                </ul>
                                <div class="thumb"><img src="images/resource/thumb-10.jpg" alt=""></div>
                                <h3><a href="property-detail.html">Great Home for Single fmaily</a></h3>
                                <div class="lucation"><i class="la la-map-marker"></i> Orland Park, IL 35785, Chicago, United State</div>
                                <ul class="property-info clearfix">
                                    <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                                    <li><i class="flaticon-bed"></i> 4 Bedrooms</li>
                                    <li><i class="flaticon-car"></i> 2 Garage</li>
                                    <li><i class="flaticon-bathtub"></i> 3 Bathroom</li>
                                </ul>
                                <div class="property-price clearfix">
                                    <div class="read-more"><a href="property-detail.html" class="theme-btn">More Detail</a></div>
                                    <div class="price">$ 13,65,000</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    */
                    ?>

                </div>
            </div>
        </div>
    </section>
    <!--End Property Filter Section -->


   <!--Clients Section-->
    <section class="clients-section style-two alternate">
        <div class="auto-container">
            <div class="sponsors-outer">
                <!--Sponsors Carousel-->
                <ul class="sponsors-carousel owl-carousel owl-theme">
                     <?php
                         $q = dbConnect()->prepare("SELECT * FROM estates ORDER BY RAND() LIMIT 3");
                        $q->execute();
                        $i =0;
                        while($rr=$q->fetch()){
                            $eid = $rr['id'];
                            $estNam = $rr['estate_name'];
                    
                
                        $im= dbConnect()->prepare("SELECT * FROM estate_images WHERE estate_name='$estNam'");
                        $im->execute();
                        while($r=$im->fetch()){
                            $img= $r['image'];
                      ?>
                    
                    <li class="slide-item"><figure class="image-box"><a href='property-detail?id=<?php echo $eid; ?>'><img src='app/app/admin/<?php echo $img ?>' alt="Kerae Homes"></a></figure></li>
                        <?php } }?>
                </ul>
            </div>
        </div>
    </section>
    <!--End Clients Section-->

    <?php // include 'foot.php' ?>

    
    
      <!-- Main Footer -->
    <footer class="main-footer" style="background-image: url(images/main-slider/image-30.jpg);">
        <div class="auto-container">
            <div class="upper-box">
                <div class="row">
                    <!-- Upper column -->
                    <div class="upper-column col-lg-3 col-md-12 col-sm-12">
                        <div class="footer-logo">
                            <figure class="image"><a href="index"><img src="images/footer-logo.png" alt=""></a></figure>
                        </div>
                    </div>

                    <!-- Upper column -->
                    <div class="upper-column col-lg-6 col-md-12 col-sm-12">
                        <div class="subscribe-form">
                            <form method="post" action="blog">
                                <div class="form-group">
                                    <input type="email" name="email" value="" placeholder="Enter Your Email" required="">
                                    <button type="submit" class="theme-btn btn-style-four">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Upper column -->
                    <div class="upper-column col-lg-3 col-md-12 col-sm-12">
                        <div class="social-links">
                            <ul class="social-icon-two">
                                <li><a href="#"><i class="la la-facebook"></i></a></li>
                                <li><a href="#"><i class="la la-twitter"></i></a></li>
                                <li><a href="#"><i class="la la-google-plus"></i></a></li>
                                <li><a href="#"><i class="la la-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!--Widgets Section-->
            <div class="widgets-section">
                <div class="row">
                    <!--Big Column-->
                    <div class="big-column col-xl-7 col-lg-12 col-md-12 col-sm-12">
                        <div class="row">


                            <!--Footer Column-->
                            <div class="footer-column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget cities-widget">
                                    <h2 class="widget-title">PROPERTY CITIES</h2>
                                    <div class="widget-content">
                                        <ul class="list clearfix">
                                            <?php
                                            $imm= dbConnect()->prepare("SELECT * FROM estates LIMIT 10");
                                            $imm->execute();
                                            while($rr=$imm->fetch()){
                                                $esName= $rr['estate_name'];
                                          ?>
                                            <li><a href="properties"><?php echo $esName ;?></a></li>
                                            <?php }  ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                             <div class="footer-column col-xl-6 col-lg-6 col-md-6 col-sm-12">
                                <!--Footer Column-->
                                <div class="footer-widget popular-posts">
                                    <h2 class="widget-title">Recent Posts</h2>
                                     <!--Footer Column-->
                                    <div class="widget-content">
                                        <?php
                                            $im= dbConnect()->prepare("SELECT * FROM estate_images ORDER BY RAND() LIMIT 2");
                                            $im->execute();
                                            while($r=$im->fetch()){
                                                $img= $r['image'];
                                          ?>
                                        <div class="post">
                                            <div class="thumb"><a href="property-detail"><img src="app/app/admin/<?php echo $img; ?>" alt=""></a></div>
                                            <h4><a href="blog-detail"><?php echo $r['estate_name']; ?> </a></h4>
                                            <span class="date"><?php echo $r['created']; ?></span>
                                        </div>
                                        <?php }?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Big Column-->
                    <div class="big-column col-xl-5 col-lg-12 col-md-12 col-sm-12">
                        <div class="row clearfix">


                            <!--Footer Column-->
                            <div class="footer-column col-xl-5 col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget links-widget">
                                    <h2 class="widget-title">USEFUL LINKS</h2>
                                    <div class="widget-content">
                                        <ul class="list clearfix">
                                            <li><a href="properties">Rental Builidngs</a></li>
                                            <li><a href="properties">Browe all Categories</a></li>
                                            <li><a href="properties">Mortagages Rates</a></li>
                                            <li><a href="properties">Terms of use</a></li>
                                            <li><a href="properties">Privacy Policy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!--Footer Column-->
                            <div class="footer-column col-xl-7 col-lg-6 col-md-6 col-sm-12">
                                <div class="footer-widget contact-widget">
                                    <h2 class="widget-title">Get in Touch</h2>
                                    <div class="widget-content">
                                        <ul class="contact-list">
                                            <li><span class="la la-map-marker"></span> Km 36, Ero’s House, Duplex 2 Eputu, Lekki, Expressway, Lagos</li>
                                            <li><span class="la la-phone"></span>(+234) 913 3332 200</li>
                                            <li><span class="la la-envelope"></span><a href="">info@keraehomes.com</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Footer Bottom-->
        <div class="footer-bottom">
            <div class="auto-container">
                <!--Scroll to top-->
                <div class="scroll-to-top scroll-to-target" data-target="html"><span class="la la-angle-double-up"></span></div>

                <div class="inner-container clearfix">
                    <div class="footer-nav">
                        <ul class="clearfix">
                           <li><a href="index">Home</a></li>
                           <li><a href="galary">Galary</a></li>
                           <li><a href="about">About</a></li>
                           <li><a href="contact">Contact</a></li>
                        </ul>
                    </div>

                    <div class="copyright-text">
                        <p>© Copyright <?php date('Y'); ?>  <a href="">Karae Homes LTD</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Main Footer -->
</div>
<!--End pagewrapper-->


<script src="js/jquery.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script src="js/jquery.fancybox.js"></script>
<script src="js/owl.js"></script>
<script src="js/wow.js"></script>
<script src="js/isotope.js"></script>
<script src="js/mixitup.js"></script>
<script src="js/appear.js"></script>
<script src="js/script.js"></script>
<!-- Color Setting -->
<script src="js/color-settings.js"></script>
</body>
</html>
