<?php 
include 'nav.php';

$ord=$_GET['order'];

$q1=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$ord'");
$q1->execute();
$ro=$q1->fetch();

$itm=$ro['item'];

$cus =$ro['custID'];
$q= dbConnect()->prepare("SELECT fname, lname, address, phone, state, gender FROM customer WHERE custID='$cus'");
$q->execute();
$r=$q->fetch();

$gnd=$r['gender'];
if($gnd=='Male'){$salute=" Mr"; $salu=" Sir";}else{$salute=" Mrs"; $salu=" Ma";}

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
                            <div class="invoice-from-wrap" style="border: 3px solid black ;">
                                <div class="row">
                                    <div class="text-center col-md-12 mb-20"><br><br><br><br><br><br>
                                        <h6 class="mb-5">DEED OF ASSIGNMENT</h6><br>
                                        <h6 class="mb-5">BETWEEN</h6> <br>
                                        <h4>PRIME PINNACLE BUSINESS INVESTMENT LTD</h4><br><br><br><br><br>
                                        <span>'ASSIGNOR'</span><br><br><br>
                                        <h6>AND</h6><br><br>
                                        <h6><?php echo $r['fname']." ".$r['lname']; ?></h6><br>
                                        <h6>'ASSIGNEE' </h6><br><br><br>
                                        …………………………………….…………………………………………………<br><br>
                                        IN RESPECT OF 1800SQM OF LAND LYING, BEING AND SITUATE AT <?php echo $projAddress ?>. <br><br>
                                         ……….………………………………………………………………………………
                                        <br><br><br><br>
                                        
                                        <h6>DATED THIS …….. DAY OF ………………………., 2020.</h6><br><br>
                                        <h6>PREPARED BY</h6><br><br>
                                        <address style="padding-right:15px;">
                                            <span class="d-block text-right"><h6>PRINCE S.A ABIMBOLA (ESQ)</h6></span>
                                            <span class="d-block text-right"><h6>ABIMBOLA & ABIMBOLA</h6> </span>
                                                <span class="d-block text-right">Chi_Town Plaza,</span>
                                                <span class="d-block text-right">Tolani Saba Complex,</span>
                                                <span class="d-block text-right">Shapati Bus Stop, Ibeju_Lekki,</span>
                                                <span class="d-block text-right">Lagos State.</span>
                                                <span class="d-block text-right">Email: opadachambers@yahoo.com</span>
                                        </address>
                                        
                                    </div>
                                </div>
                            </div>
                            <br><br><br><br><br><br><br><br>
                            <h5>DEED OF ASSIGNMENT</h5><br>
                            <p><span>
                                <h3>THIS DEED OF ASSIGNMENT</h3> is made this ….. Day of ………………… 20……….<br>
                                BETWEEN <br>
                                PRIME PINNACLE BUSINESS INVESTMENT LTD, a Company duly registered under the Companies 
                                and Allied Matters Act with registered office address at Km 28, Off Abijo Gra Bus stop,
                                Abijo, Lekki-Epe Expressway, Ibeju Lekki, Lagos State (hereinafter referred to as 
                                “THE ASSIGNOR” which expression shall where the context so admits includes her assigns,
                                legal representatives, agents and privies of the FIRST PART<br> AND <br>
                                </span></p><br>
                            <p>
                                <span>
                                    <span style="font-size: 25; text-transform: uppercase;"><?php echo $r['fname']." ".$r['lname']; ?></span> Of  8, Omo Alahaja Close Ikola.  (Herein after referred to as
                                “THE ASSIGNEE” which expression shall where the context so admits includes his heirs, assigns, 
                                personal/legal representatives of the SECOND PART.<br>
                                WHEREAS:

                                </span>
                            </p>
                            <p><span>
                                a.	The one plot of land, the subject matter of this Assignment forms part of a large tract 
                                of land lying, being and situated at <?php echo $projAddress ?>, belonging to the Assignor by virtue
                                deed of assignment dated 28/2/2020
                                </span>
                            </p>
                            <p><span>
                                b.	That the Assignor has been in exclusive and unimpaired possession of the said parcel of land and 
                                exercised all acts of ownership on the properties without let or hindrance.
                            </span></p>
                            <p><span>
                                c.	Whereas the Assignor has agreed to assign to the Assignee her proprietary interest and statutory
                                right of Occupancy in a portion of the said  one plot of land, situated at <?php echo $projAddress ?>, herein
                                described and intended to be conveyed to the Assignee upon the terms and conditions herein contained.
                            </span></p>
                            <p><span>
                                d.	The Assignor has agreed to assign his interest, title and or any other Rights Occupancy in the 
                                said portion of the Property lying and been situated at <?php echo $projAddress ?>.
                            </span></p>
                            <h4>THIS DEED WITNESSES AS FOLLOWS:</h4>
                            <span style="font-size: 25; text-transform: uppercase;">THAT IN CONSIDERATION </span>  of the sum of N<?php echo number_format($ro['amount']); ?> (<?php echo $figure ?> Naira only),
                            paid by the ASSIGNEE to the ASSIGNORS, the receipt whereof the ASSIGNOR as Beneficial Owner hereby acknowledge, the Assignor hereby assign, transfer and give the said plot(s) of land 
                            of land situate at <?php echo $projAddress; ?>, which is described and delineated in the Survey Plan attached here to and as described in the schedule herein.
                            
                            <span style="font-size: 25; text-transform: uppercase;">TO HOLD</span> the same <span style="font-size: 25; text-transform: uppercase;">UNTO</span> the use of the <span style="font-size: 25; text-transform: uppercase;">ASSIGNEE ABSOLUTELY</span> 
                            free from all encumbrances.
                            
                            <h5>THE ASSIGNOR HEREBY COVENANT WITH THE ASSIGNEE AS FOLLOWS:</h5><br>
                            <p>
                                <span>
                                   1.	To hold and enjoy the parcel of land peaceably without any interruption and or disturbance from the ASSIGNOR or any person(s) claiming through or in trust for him. 
                                </span>
                            </p>
                            <p>
                                <span>
                                 2.	To fully indemnify the ASSIGNEE from any expenses whatsoever incurred by the ASSIGNEE in the event of any defect in title, adverse claim or challenge from any person in respect of the parcel of land under this Deed.
                                </span>
                            </p>
                            <p>
                                <span>
                                3.	The ASSIGNOR confirm her unencumbered title to the property and agree to indemnify the ASSIGNEE to the full purchase price paid and against all manner of loss and damage 
                                suffered by the ASSIGNEE arising from any want or defect in or encumbrance to the ASSIGNOR title or sustained by the ASSIGNEE in consequence of any adverse claim for title or otherwise 
                                from any person or company in respect of the property and guarantee the ASSIGNEE the peaceable and peaceful enjoyment of the property without any interruption from the ASSIGNOR or anyone 
                                claiming through, under or in trust for him.    
                                </span>
                            </p>
                            <p>
                                <span>
                                 4.	The ASSIGNOR shall and hereby undertake to do all necessary things and execute all necessary instruments to more perfectly assure the conveyance of the property to the ASSIGNEE 
                                 and or to enable the   ASSIGNEE   perfect his title and to obtain the consent of the Lagos State Governor required for the perfection of this assignment.
                                </span>
                            </p>
                            <h5>SCHEDULE</h5><br>
                            <p>The One (1) plot of land lying, being and situate at <?php echo $projAddress; ?> Lekki Free Trade Zone with: ¬¬-</p>
                            <p> 1. Beacon No: -</p>
                            <p>2. Measuring an Area of Approximately:-  </p>
                            <p>3. Survey Plan No: ¬¬¬¬-  </p>
                            <p>4. Drawn by:  </p>
                            <p>5. Dated:- </p><br><br>
                            
                            <p> <span style="font-size: 25; text-transform: uppercase;">IN WITNESS WHEREOF </span>the parties have hereunto set their hands and seals the date and year first above written.
                            </p><br>
                            <p>SIGNED, SEALED AND DELIVERED </p>
                            <p>By the within named” ASSIGNOR”</p><br>
                            <p>
                                <span>
                                    THE COMMON SEAL OF THE WITHIN NAMED ‘ASSIGNOR’ <strong>PRIME PINNACLE BUSINESS INVESTMENT LTD</strong> WAS AFFIXED TO THIS DEED IN THE PRESENCE OF
                                </span>
                            </p><br><br><br><br><br>
                            <p>
                                <span class="float-left">DIRECTOR</span>	<span class="float-right">DIRECTOR/SECRETARY</span>
                            </p><br><br><br><br>
                            <p>
                                <span>
                                    SIGNED, SEALED AND DELIVERED <br>
                                    By the within named” ASSIGNEE”

                                </span>
                            </p><br>
                            <p>
                                <span style="font-size: 25; text-transform: uppercase;"><?php echo $salute.' '. $r['fname']." ".$r['lname']; ?></span> :..............................................................................
                            </p><br><br>
                            <h6>IN THE PRESENCE OF:</h6><br>  
                            <span>NAME: ………………..……………………………………………</span><br>
                            <span>ADDRESS: ………………..……………………………………………</span><br>
                            <span>OCCUPATION: ………………..……………………………………………</span><br>
                            <span>SIGNATURE: ………………..……………………………………………</span><br><br>
                            
                            <div style="border: 3px solid black ;"><br><br>
                                <h5 align='center'>I CONSENT TO THE TRANSACTION HEREIN CONTAINED</h5><br>
                                <p align='center'>DATED THIS ……. DAY OF ………………….. 20…………</p><br>
                                <p align='center'>ATTORNEY GENERAL AND HONOURABLE COMMISSIONER </p>
                                <p align='center'>
                                    FOR JUSTICE FOR THE EXECUTIVE GOVERNOR OF LAGOS STATE
                                </p>
                                
                                <br><br>
                            </div>
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


