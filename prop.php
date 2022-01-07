   <!-- Recent Property Section -->
    <section class="recent-property-section">
        <div class="auto-container">
            <div class="sec-title">
                <span class="title">FIND YOUR HOUSE IN YOUR CITY</span>
                <h2>RECENT PROPERTIES</h2>
            </div>

            <div class="single-item-carousel owl-carousel owl-theme">
                <?php
                $user = dbConnect()->prepare("SELECT * FROM estates ORDER BY RAND() LIMIT 3");
                $user->execute();
                $i = 0;
                while($rr= $user->fetch()){
                    $eid = $rr['id'];
                    $estNam = $rr['estate_name'];
                    $dsc = $rr['estate_description'];
                    $loc = $rr['estate_location'];
                    $prs = $rr['price'];
                           
                ?>
                <!-- Slide Item -->
                <div class="slide-item">
                    <!-- Property Block -->
                    <div class="property-block-two">
                        <div class="inner-box">
                            <div class="row no-gutters">
                                <?php
                                $im= dbConnect()->prepare("SELECT * FROM estate_images WHERE estate_name='$estNam' ");
                                $im->execute();
                                $r=$im->fetch();
                                    $img= $r['image'];
                               
                                ?>
                                <div class="image-box col-lg-6 col-md-12 col-sm-12">
                                    <figure class="image"><img src='app/app/admin/<?php echo $img; ?>' alt="" style="width: 200 !important; height: 200 !important;"></figure>
                                    <span class="for">FEATURED</span>
                                    <!--<span class="featured">FEATURED</span>-->
                                    <ul class="option-box">
                                        <li><a href='admin/<?php echo $imgs; ?>' class="lightbox-image" data-fancybox="property"><i class="la la-heart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="lower-content col-lg-6 col-md-12 col-sm-12">
                                    <div class="lucation"><i class="la la-map-marker"></i> <?php echo $loc ;?></div>
                                    <div class="thumb"><img src='app/app/admin/<?php echo $img; ?>' alt=""></div>
                                    <h3><a href="property-detail?id=<?php echo $eid; ?>"><?php echo $estNam ;?></a></h3>
                                    <ul class="property-info clearfix">
                                         <li><i class="flaticon-dimension"></i> <?php echo $rr['feature5']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature6']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature1']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature2']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature3']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature4']?></li>
                                    </ul>
                                    <div class="property-price clearfix">
                                        <div class="read-more"><a href="property-detail?id=<?php echo $eid; ?>" class="theme-btn">More Detail</a></div>
                                        <div class="price">₦ <?php echo number_format($prs) ;?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Block -->
                    <div class="property-block-two">
                        <div class="inner-box">
                            <div class="row no-gutters">
                                 <?php
                                $im= dbConnect()->prepare("SELECT * FROM estate_images WHERE estate_name='$estNam' AND image !='$img'");
                                $im->execute();
                                $r1=$im->fetch();
                                    $imgs= $r1['image'];
                               
                                ?>
                                <div class="image-box col-lg-6 col-md-12 col-sm-12">
                                    <figure class="image"><img src='app/app/admin/<?php echo $imgs; ?>' alt="" style="width: 200 !important; height: 200 !important;"></figure>
                                    <span class="for">SUBSCRIBE</span>
                                    <ul class="option-box">
                                        <li><a href='app/app/admin/<?php echo $imgs; ?>' class="lightbox-image" data-fancybox="property"><i class="la la-heart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="lower-content col-lg-6 col-md-12 col-sm-12">
                                    <div class="lucation"><i class="la la-map-marker"></i> <?php echo $loc ;?></div>
                                    <div class="thumb"><img src='app/app/admin/<?php echo $imgs; ?>' alt=""></div>
                                    <h3><a href="property-detail?id=<?php echo $eid; ?>"><?php echo $estNam ;?></a></h3>
                                    <ul class="property-info clearfix">
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature5']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature6']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature1']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature2']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature3']?></li>
                                        <li><i class="flaticon-dimension"></i> <?php echo $rr['feature4']?></li>
                                    </ul>
                                    <div class="property-price clearfix">
                                        <div class="read-more"><a href="property-detail?id=<?php echo $eid; ?>" class="theme-btn">More Detail</a></div>
                                        <div class="price">₦ <?php echo number_format($prs) ;?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                    <?php } ?>

                <?php 
                /*
                <!-- Slide Item -->
                <div class="slide-item">
                    <!-- Property Block -->
                    <div class="property-block-two">
                        <div class="inner-box">
                            <div class="row no-gutters">
                                <div class="image-box col-lg-6 col-md-12 col-sm-12">
                                    <figure class="image"><img src="images/gallery/4.jpg" alt=""></figure>
                                    <span class="for">FOR SALE</span>
                                    <span class="featured">FEATURED</span>
                                    <ul class="option-box">
                                        <li><a href="images/gallery/4.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                        <li><a href="#"><i class="la la-heart"></i></a></li>
                                        <li><a href="#"><i class="la la-retweet"></i></a></li>
                                    </ul>
                                    <ul class="info clearfix">
                                        <li><a href="properties"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                    </ul>
                                </div>
                                <div class="lower-content col-lg-6 col-md-12 col-sm-12">
                                    <ul class="tags">
                                        <li><a href="property-detail.html">Apartment</a>,</li>
                                        <li><a href="property-detail.html">Bar</a>,</li>
                                        <li><a href="property-detail.html">House</a>,</li>
                                    </ul>
                                    <div class="thumb"><img src="images/gallery/4.jpg" alt=""></div>
                                    <h3><a href="property-detail.html">Single House Near Orland Park.</a></h3>
                                    <div class="lucation"><i class="la la-map-marker"></i> Orland Park, IL 35785, Chicago, United State</div>
                                    <ul class="property-info clearfix">
                                        <li><i class="flaticon-dimension"></i> 356 Sq-Ft</li>
                                        <li><i class="flaticon-bed"></i> 4 Bedrooms</li>
                                        <li><i class="flaticon-car"></i> 2 Garage</li>
                                        <li><i class="flaticon-bathtub"></i> 3 Bathroom</li>
                                    </ul>
                                    <div class="property-price clearfix">
                                        <div class="read-more"><a href="property-detail" class="theme-btn">More Detail</a></div>
                                        <div class="price">$ 13,65,000</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Property Block -->
                    <div class="property-block-two">
                        <div class="inner-box">
                            <div class="row no-gutters">
                                <div class="image-box col-lg-6 col-md-12 col-sm-12">
                                    <figure class="image"><img src="images/gallery/5.jpg" alt=""></figure>
                                    <span class="for">FOR SALE</span>
                                    <span class="featured">FEATURED</span>
                                    <ul class="option-box">
                                        <li><a href="images/gallery/5.jpg" class="lightbox-image" data-fancybox="property"><i class="la la-camera"></i></a></li>
                                        <li><a href="#"><i class="la la-heart"></i></a></li>
                                        <li><a href="#"><i class="la la-retweet"></i></a></li>
                                    </ul>
                                    <ul class="info clearfix">
                                        <li><a href="properties"><i class="la la-calendar-minus-o"></i>2 Years Ago</a></li>
                                    </ul>
                                </div>
                                <div class="lower-content col-lg-6 col-md-12 col-sm-12">
                                    <ul class="tags">
                                        <li><a href="property-detail.html">Apartment</a>,</li>
                                        <li><a href="property-detail.html">Bar</a>,</li>
                                        <li><a href="property-detail.html">House</a>,</li>
                                    </ul>
                                    <div class="thumb"><img src="images/gallery/5.jpg" alt=""></div>
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
                    </div>
                </div>
                
               */ ?>
            </div>
        </div>
    </section>
    <!--End Recent Property Section -->