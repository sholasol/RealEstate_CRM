<?php 
include 'nav.php';

$ord=$_GET['order'];

$q1=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$ord'");
$q1->execute();
$ro=$q1->fetch();

$itm=$ro['item'];

$cus =$ro['custID'];
$q= dbConnect()->prepare("SELECT fname, lname, address, phone, state FROM customer WHERE custID='$cus'");
$q->execute();
$r=$q->fetch();

$q2=  dbConnect()->prepare("SELECT * FROM company");
$q2->execute();
$rw=$q2->fetch();

$q3=  dbConnect()->prepare("SELECT id,  address FROM project WHERE project='$itm'");
$q3->execute();
$row=$q3->fetch();
$prj= $row['id'];
$projAddress = $row['address'];

$qq=  dbConnect()->prepare("SELECT * FROM family WHERE project='$prj'");
$qq->execute();
$ra=$qq->fetch();

$amot = $ro['paid'];

include 'num.php';
?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="sorder">Sales Order</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Deed of Assignment</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>Deed of Assignment</h4>
                    </div>
		   <div class="d-flex">
                        <a href="#" onclick="printContent('print')" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                    </div>
                </div>
                <!-- /Title -->
                
                
                <!-- Row -->
                <div class="row" id="print">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="text-center col-md-12 mb-20"><br><br><br><br><br><br>
                                        <h6 class="mb-5">DEED OF ASSIGNMENT</h6><br>
                                        <h6 class="mb-5">BETWEEN</h6> <br>
                                        <h6><?php echo $ra['family'];?></h6><br>
                                            REPRESENTED BY<br><br>
                                            <?php echo $ra['head'];?>  <br>       	

                                            <?php echo $ra['baale'];?>  <br>                

                                            <?php echo $ra['secretary'];?>  <br>
                                            <?php echo $ra['member1'];?>  <br>

                                            <?php echo $ra['member2'];?>  <br> 
                                        <h6>(ASSIGNORS) </h6><br>
                                        <h6>AND</h6><br><br>
                                        <h6><?php echo $r['fname']." ".$r['lname']; ?></h6><br>
                                        <h6>(ASSIGNEE) </h6><br><br><br>
                                        …………………………………….…………………………………………………<br><br>
                                        IN RESPECT OF 1800SQM OF LAND LYING, BEING AND SITUATE AT <?php echo $projAddress ?>. <br><br>
                                         ……….………………………………………………………………………………
                                        <br><br><br><br>
                                        
                                        <h6>DATED THIS …….. DAY OF ………………………., 2020.</h6><br>
                                        <h6>PREPARED BY</h6><br>
                                        <address>
                                                <span class="d-block text-right">PRINCE S.A ABIMBOLA (ESQ)</span>
                                                <span class="d-block text-right">ABIMBOLA & ABIMBOLA </span>
                                                <span class="d-block text-right">9 Lewis Street, Lagos Island</span>
                                                <span class="d-block text-right">Lagos State</span>
                                                <span class="d-block text-right">opadachambers@yahoo.com</span>
                                                <span class="d-block text-right">08062371636</span>
                                        </address>
                                        
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br><br><br><br><br>
                            <h5>DEED OF ASSIGNMENT</h5><br>
                            <span class="text-right">THIS DEED OF ASSIGNMENT is made this ……… day of …………………………… 2020.</span><br><br>
                            
                            <div class="invoice-details">
                                <div class="offset-col-md-4">
                                    BETWEEN
                                </div>
                                <div align="justify">
                                    <?php echo $ra['family'];?> represented by <?php echo $ra['head'];?>, <?php echo $ra['baale'];?>, <?php echo $ra['member1'];?> and <?php echo $ra['secretary'];?> all of <?php echo $projAddress; ?>, Otolu Township, Lagos hereinafter referred to as “THE ASSIGNOR” (which expression shall where the context so admits include their assigns, agents and personal /legal representatives) of the ONE PART.<br><br>
                                </div><br>
                                <div align="justify">
                                    AND
                                    <?php echo $r['fname']." ".$r['lname']; ?> of <?php echo $r['address']; ?> hereinafter referred to as “THE ASSIGNEE” (which expression shall where the context so admits include his assigns, agents and personal legal representatives) of the SECOND PART. <br><br>

                                </div><br>
                                <div align="justify">
                                    WHEREAS:<br>
                                   <ol type="A">
                                       <li> a)	The <?php echo $ro['qty']*600; ?>SQM of land, the subject matter of this Assignment forms part of a large tract of land lying, being and situate at <?php echo $projAddress; ?> Village Excision, via Otolu Town, Lagos State originally belonged to <?php echo $ra['family'];?>  by virtue of their first settlement and/or inheritance under the Yoruba Native Law and custom and they have been in undisputed possession and occupation.  </li>
                                
 


                                       <li> b)	The family has since been in effective Possession and Occupation of the parcels of land described in paragraph “a” above exercising full act of ownership and possession without any let and or hindrance from any quarters whatsoever</li>

                                       <li> 
                                          c) The Assignor herein purchased the said land from <?php echo $ra['family'];?> Family of <?php echo $projAddress;?> Village Ibeju-Lekki Local Government Area of Lagos State.  
                                       </li>
                                        <li> 
                                           d) The said land defined in paragraph “a” above, which is the subject matter of this Deed of Assignment was before the Land Use Act 1978, Cap L60 Laws of the Federation of Nigeria, 2004 held by the <?php echo $ra['family'];?>, of <?php echo $projAddress;?> Ibeju-Lekki Local Government Area of Lagos State under Customary Law and by virtue of Section 34 of the Land Use Act, the said Land continued to be so held as if the Family is a holder of a Statutory right of Occupancy issued by the Governor of Lagos State under the Land Use Act 1978. 
                                       </li>
                                        <li> 
                                           e)	The Assignor herein being the Lawful and Accredited Representatives of <?php echo $ra['family'];?>, of <?php echo $projAddress;?> Ibeju-Lekki Local Government Area of Lagos State by virtue of the purchase mentioned in paragraph C above is desirous of Assigning all its rights and interest in the <?php echo $ro['qty']*600; ?>SQM of land described in paragraph “a” to the Assignee herein for a consideration herein stated. The Assignee has accepted to take all the rights and interests of the family in the said land described in paragraph “a” above from the said family Land for the said sum. 
                                       </li>
                                   </ol>
                                </div><br>
                                
                                
                                <div align="justify">
                                    <h6>THIS DEED WITNESSES AS FOLLOWS: </h6>
                                    THAT IN CONSIDERATION of the sum of N<?php echo number_format($ro['paid']); ?> (<?php echo $figure ?> Naira only), given by the ASSIGNEE to the ASSIGNORS, the receipt whereof the ASSIGNOR as Beneficial Owner hereby acknowledge, the Assignor hereby assign, transfer and give the said <?php echo $ro['qty']*600; ?>SQM of land situate at <?php echo $projAddress; ?>, via Otolu Town, Lagos State which is described herein TO HOLD the same UNTO the use of the ASSIGNEE ABSOLUTELY free from all encumbrances. <br><br>
                                    
                                    2.	THE ASSIGNOR HEREBY COVENANT WITH THE ASSIGNEE AS FOLLOWS: <br><br>
                                    
                                    <ol type="A">
                                        <li>
                                            1.	To hold and enjoy the <?php echo $ro['qty']*600; ?>SQM of land peaceably without any interruption and or disturbance from the ASSIGNOR or any person(s) claiming through or in trust for it. 
                                        </li>
                                        <li>
                                            2.	To fully and immediately indemnify the ASSIGNEE from any expenses whatsoever incurred by the ASSIGNEE in the event of any defect in title, adverse claim or challenge from any person in respect of the <?php echo $ro['qty']*600; ?>QM of land under this Deed. 
                                        </li>
                                        <li>  
                                            3.	The ASSIGNOR confirm it unencumbered title to the property and agree to indemnify the ASSIGNEE to the full purchase price paid and against all manner of loss and damages suffered by the ASSIGNEE arising from any want, defect in or encumbrance to the ASSIGNOR title or sustained by the ASSIGNEE in consequence of any adverse claim for title or otherwise from any person or company in respect of the property and guarantee the ASSIGNEE the peaceable and peaceful enjoyment of the property without any interruption from the ASSIGNOR or anyone claiming through, under or in trust for them and/or third party. 
                                        </li>
                                        <li>
                                            4.	The ASSIGNOR shall and hereby undertake to do all necessary things and execute all necessary instruments to more perfectly assure the conveyance of the property to the ASSIGNEE and/or to enable the ASSIGNEE perfect its title and to obtain the consent of the Lagos State Governor required for the perfection of this assignment. 

                                        </li>
                                    </ol>
                                    
                                    	
                                    IN WITNESS WHEREOF the parties have hereunto set their hands and seals the date and year first above written: <br><br>
                                    
                                    
                                    SIGNED, SEALED AND DELIVERED <br><br>
                                    By the within named “ASSIGNORS” <br><br>
                                    1. <?php echo $ra['head'];?>          	 ………………………….……<br><br>

                                    2. <?php echo $ra['baale'];?>                  	……………………………….<br><br>

                                    3. <?php echo $ra['secretary'];?>    	………………………………..<br><br>

                                    4. <?php echo $ra['member1'];?>		    	………………………………..<br><br>

                                    In the presence of: <br><br>
                                    NAME: …………………………………………………………<br><br>
                                    ADDRESS: ………………………………………………….…<br><br>
                                    OCCUPATION: ……………………………………………….<br><br>
                                    SIGNATURE: …………………………………………….…..<br><br>

                                    The foregoing having been read over in the English Language and interpreted into the Yoruba Language by me …………………………. of ……………………………………………………. to …………………………. and they appeared perfectly to understand the same before affixing their right thumb impression. <br><br>

                                    BEFORE ME<br><br>


                                    NOTARY PUBLIC<br><br>

                                    SIGNED, SEALED AND DELIVERED <br><br>
                                    By the within named “ASSIGNEE” <br><br>
                                    OKAFOR ANTHONIA CHINENYE ..……………………….. <br><br>

                                    In the presence of: <br><br>
                                    NAME:…………………………………………………………. <br><br>
                                    ADDRESS: ………………………………………………….…<br><br>
                                    OCCUPATION: ……………………………………………….<br><br>
                                    SIGNATURE: …………………………………………….…..<br><br>

                                    I CONSENT TO THE TRANSACTION HEREIN CONTAINED<br><br>
                                    DATED THIS ……. DAY OF ………………….. 20…………<br><br>


                                    ATTORNEY GENERAL AND HONOURABLE COMMISSIONER FOR JUSTICE FOR THE   <br><br>     EXECUTIVE GOVERNOR OF LAGOS STATE


                                </div><br>
                                
                            </div>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
                
            </div>
            <!-- /Container -->
            
            
            
           

                <!-- Footer -->
            <div class="hk-footer-wrap container">
                <footer class="footer">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <p>Powered by<a href="" class="text-dark">Hybridsoft</a> © <?php echo date('Y'); ?></p>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <p class="d-inline-block">Follow us</p>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-facebook"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-twitter"></i></span></a>
                            <a href="#" class="d-inline-block btn btn-icon btn-icon-only btn-indigo btn-icon-style-4"><span class="btn-icon-wrap"><i class="fa fa-google-plus"></i></span></a>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

    </div>
    <!-- /HK Wrapper -->
    <!-- jQuery -->
   <script src="../vendors/jquery/dist/jquery.min.js" type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="../dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="../dist/js/dropdown-bootstrap-extended.js"></script>

    <!-- FeatherIcons JavaScript -->
    <script src="../dist/js/feather.min.js"></script>

    <!-- Toggles JavaScript -->
    <script src="../vendors/jquery-toggles/toggles.min.js"></script>
    <script src="../dist/js/toggle-data.js"></script>
	
	<!-- Counter Animation JavaScript -->
	<script src="../vendors/waypoints/lib/jquery.waypoints.min.js"></script>
	<script src="../vendors/jquery.counterup/jquery.counterup.min.js"></script>
	
	<!-- EChartJS JavaScript -->
    <script src="../vendors/echarts/dist/echarts-en.min.js"></script>
    
	<!-- Sparkline JavaScript -->
    <script src="../vendors/jquery.sparkline/dist/jquery.sparkline.min.js"></script>
	
	<!-- Vector Maps JavaScript -->
    <script src="../vendors/vectormap/jquery-jvectormap-2.0.3.min.js"></script>
    <script src="../vendors/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../dist/js/vectormap-data.js"></script>
    
    <!-- Form Wizard JavaScript -->
    <script src="../vendors/jquery-steps/build/jquery.steps.min.js"></script>
    <script src="../dist/js/form-wizard-data.js"></script>
    <!-- Select2 JavaScript -->
    <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
    <script src="../dist/js/select2-data.js"></script>
	<!-- Owl JavaScript -->
    <script src="../vendors/owl.carousel/dist/owl.carousel.min.js"></script>
    
    <!-- Data Table JavaScript -->
    <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../dist/js/dataTables-data.js"></script>
	<!-- Toastr JS -->
<!--    <script src="vendors/jquery-toast-plugin/dist/jquery.toast.min.js"></script>-->
    
    <!-- Init JavaScript -->
    <script src="../dist/js/init.js"></script>
    <script src="../dist/js/dashboard-data.js"></script>
    <script src="../dist/js/validation-data.js"></script>
    <!-- Daterangepicker JavaScript -->
    <script src="../vendors/moment/min/moment.min.js"></script>
    <script src="../vendors/daterangepicker/daterangepicker.js"></script>
    <script src="../dist/js/daterangepicker-data.js"></script>
    <script>
        function printContent(el){
                var restorepage = document.body.innerHTML;
                var printcontent = document.getElementById(el).innerHTML;
                document.body.innerHTML = printcontent;
                window.print();
                document.body.innerHTML = restorepage;
            }
</script>
</body>

</html>


