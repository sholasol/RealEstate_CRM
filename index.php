<?php include 'head.php'; ?>
<?php include 'slider.php'; ?>
    
    
    <!-- Property Search Section -->
   <!-- <section class="property-search-section">
        <div class="auto-container">
            <div class="property-search-tabs tabs-box">

                <div class="tabs-content">
                    <div class="tab active-tab" id="sale">
                        <div class="property-search-form">
                            <form method="post" action="galary">
                                <div class="row">
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label>Location</label>
                                        <select class="custom-select-box">
                                            <option>Any</option>
                                            <option>California</option>
                                            <option>Florida</option>
                                            <option>Georgia</option>
                                            <option>New York</option>
                                            <option>Texas</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label>Property</label>
                                        <select class="custom-select-box">
                                            <option>Any</option>
                                            <option>$1000</option>
                                            <option>$2000</option>
                                            <option>$5000</option>
                                            <option>$10000</option>
                                            <option>$100000</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <label>Price</label>
                                        <select class="custom-select-box">
                                            <option>Any</option>
                                            <option>$1000</option>
                                            <option>$2000</option>
                                            <option>$5000</option>
                                            <option>$10000</option>
                                            <option>$100000</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-3 col-md-6 col-sm-12">
                                        <button type="submit" class="theme-btn btn-style-five">Search</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
    <!-- End Property Search Section -->
    
    
    <!-- About Us -->
    <section class="about-us" style="background-image: url(images/background/1.jpg);">
        <div class="auto-container">
            <div class="row">
                <!-- Info Column -->
                <div class="info-column col-xl-6 col-lg-12 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="sec-title light">
                            <span class="title"><span style="color: #ffffff;">THE BEST PLACE TO FIND THE HOUSE YOU WANT</span></span>
                            <h2>Kerae Homes Limited</h2>
                        </div>

                        <div class="text"><strong>KERAE HOMES</strong> 
                            <p align="justify" style="color: #fff;"> We pride ourselves in our unwavering commitment to delivering quality building projects, sales of lands and homes with authentic verifiable documents, and topnotch customer service to all our clients. We are structured in estate development with a customer partnership approach at heart.</p>
                           <p align="justify" style="color: #fff;">We explore the virgin dimensions of architecture giving Nigeria a reputation among other African nations when it comes to luxurious and vintage homes. We take the vision which comes from our dreams synergized with thought and we apply the magic of engineering and architectural prowess, building you a heritage out of our profession.</p>
                        </div>

                    </div>
                </div>

                <!-- Video Column -->
                <div class="video-column col-xl-6 col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="video-box">
                            <figure class="image"><img src="images/resource/image-2.jpg" alt=""></figure>
                            <a href="#" class="play-now" data-fancybox="gallery" data-caption=""><i class="icon la la-play" aria-hidden="true"></i><span class="ripple"></span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- About Us -->
    
    
    
    <!-- News Section -->
    <section class="news-section">
        <div class="auto-container">
            <div class="sec-title">
                <span class="title">NEWEST ADDITIONS FROM KARAE HOMES</span>
                <h2>HOTTEST PROPERTIES</h2>
            </div>

            <div class="row">
                <!-- News Block -->
                <?php
                $q = dbConnect()->prepare("SELECT * FROM estates ORDER BY RAND() LIMIT 3");
                $q->execute();
                $i =0;
                while($rr=$q->fetch()){
                
                
                $eid = $rr['id'];
                $estNam = $rr['estate_name'];
                $dsc = $rr['estate_description'];
                $loc = $rr['estate_location'];
                    
                           ?>
                       
                         <div class='news-block col-lg-4 col-md-6 col-sm-12'>
                              <div class='inner-box'>
                                  <div class='image-box'>
                                      <div class='single-item-carousel owl-carousel owl-theme'>
                                          <?php
                                            $im= dbConnect()->prepare("SELECT * FROM estate_images WHERE estate_name='$estNam'");
                                            $im->execute();
                                            while($r=$im->fetch()){
                                                $img= $r['image'];
                                          ?>
                                          <figure class='image'><a href='property-detail?id=<?php echo $eid; ?>'><img src='app/app/admin/<?php echo $img ?>' alt='Karea Homes' style="width: 200 !important; height: 200 !important;"></a></figure>
                                            <?php }?>
                                      </div>
                                  </div>
                                  <div class='lower-content'>
                                      <ul class='info'>
                                          <li><span><?php echo $estNam.' | '.$loc ;?></span></li>
                                      </ul>
                                      <h5>
                                          <a href='property-detail?id=<?php echo $eid; ?>' style="color: #111;">
                                              <p align="justify"><?php echo htmlspecialchars_decode(substr($dsc, 0 , 300)) ;?>...</p>
                                          </a>
                                      </h5>
                                  </div>
                              </div>
                          </div>
                    <?php  }?>
            </div>
        </div>
    </section>
    <!--End News Section -->
    
    
    <!-- App Section -->
    <section class="app-section" style="background-image: url(images/background/17.jpg);">
        <div class="auto-container">
            <div class="row">
                <!-- Image Box -->
                <div class="image-column order-last col-lg-5 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <div class="image-box">
                            <figure class="image"><img src="images/resource/image-2.jpg" alt=""></figure>
                        </div>
                    </div>
                </div>

                <!-- Content Box -->
                <div class="content-column col-lg-7 col-md-12 col-sm-12">
                    <div class="inner-column">
                        <h2>Property Find On Your Finger Tip</h2>
                        <div class="text">
                           At Kerae Homes We explore the virgin dimensions of architecture giving Nigeria a reputation among other African nations when it comes to luxurious and vintage homes. We take the vision which comes from our dreams synergized with thought and we apply the magic of engineering and architectural prowess, building you a heritage out of our profession.
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End App Section -->
    <?php  include 'prop.php'; ?>
    
    
    
 


<?php include 'foot.php'; ?>