<?php 
include 'nav.php';

$ord=$_GET['order'];

$q1=  dbConnect()->prepare("SELECT * FROM sorder WHERE order_no='$ord'");
$q1->execute();
$ro=$q1->fetch();

$itm=$ro['item'];
$qty=$ro['qty'];

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

$amot = $ro['amount'];

include 'num.php';
?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="sorder">Contract of Sale</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sale Contract</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>Sale Contract</h4>
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
                                    <div class="text-center col-md-12 mb-20"><br><br><br><br><br><br><br>
                                        <h6 class="mb-5">SALES AGREEMENT</h6><br><br><br>
                                        <h6 class="mb-5">BETWEEN</h6> <br><br><br>
                                        <h6><?php echo $rw['name']; ?></h6>
                                        <h6>(VENDOR)</h6><br><br>
                                        <h6>AND</h6><br><br><br>
                                        <h6><span style="font-size: 25; text-transform: uppercase;"><?php echo $r['fname']." ".$r['lname']; ?></span></h6><br>
                                        <h6>(PURCHASER)</h6><br><br>
                                        <h6>IN RESPECT OF:</h6><br><br><br><br>
                                        
                                      
                                        <address>
                                            <span class="d-block">ALL THAT SERVICED <span style="font-size: 25; text-transform: uppercase;"><?php echo $qt; ?></span>  (<?php echo $ro['qty']; ?> )  PLOT(S) OF LAND, MEASURING <span style="font-size: 25; text-transform: uppercase;"><?php echo $ro['qty']*600; ?>sqm2</span></span>
                                                <span class="d-block">KNOWN AS<span style="font-size: 25; text-transform: uppercase;"> <?php echo $ro['item']; ?></span>, LYING, BEING, SITUATED AT </span>
                                                <span class="d-block" style="font-size: 25; text-transform: uppercase;"><?php echo $projAddress; ?>.</span>
                                        </address><br>
                                        <h6>DATED THIS …….. DAY OF ………………………., 2021.</h6><br><br><br>
                                        <h6>PREPARED BY</h6><br><br><br>
                                        <address style="padding-right:15px;">
                                            <span class="d-block text-right"><h6>F.A OKONI (ESQ)</h6></span>
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
                            <br><br><br><br><br><br><br><br><br><br>
                            <span class="text-right">THIS SALES AGREEMENT is made the ……… day of …………………………… 2021.</span><br><br>
                            
                            
                            <div class="invoice-details">
                                <div class="offset-col-md-4">
                                    BETWEEN
                                </div>
                                <div align="justify">
                                    <?php echo $rw['name']; ?>, a Private Limited Liability Company Incorporated 
                                    in in the Federal Republic of Nigeria of km 28,Off Abijo GRA Bus Stop,  Lekki-Epe Expressway, Ibeju-Lekki Local Government Area, Lagos State (herein after referred to as “THE VENDOR” which expression shall where the context so admits include its Successors-in-Title, Administrators and Assigns) of one part;
                                </div><br>
                                <div align="justify">
                                    AND
                                    <?php echo $r['fname']." ".$r['lname']; ?> OF <?php echo $r['address'].", ".$r['state']; ?> State, (Herein referred to as  “THE PURCHASER” which expression shall here the context so admits includes his Heirs, Executors, Legal Personal Representatives and Assigns) of the other part.

                                </div><br>
                                <div align="justify">
                                    In this Agreement, <?php echo $rw['name']; ?> and <?php echo $r['fname']." ".$r['lname']; ?> may 
                                    together be referred to as “Parties” and individually as a “Party”.
                                </div><br>
                                <div align="justify">
                                    WHEREAS:<br>
                                   <ol type="A">
                                       <li> By virtue of a Lagos State of Nigeria Excision, the <?php echo $rw['name'] ?> being original owners of the <?php echo $itm ?>
                                            land being lying and situate at <?php echo $projAddress; ?> 
 


                                       <li> By virtue of Deed of conveyance between <?php echo $rw['name'] ?> and <?php echo $r['fname']." ".$r['lname']; ?> all
                                            interest on the entire <?php echo $qty ?> Plot(s) of the land situate, being and lying at <?php echo $projAddress; ?> was transferred to <?php echo $r['fname']." ".$r['lname']; ?> </li>


 


                                       <li> Subject to a Deed of Assignment to be made by the Parties, Parties have agreed to execute this Sales 
                                           Agreement on the Property upon the following terms and condition. </li>
                                   </ol>
                                </div><br>
                                <div align="justify">
                                    <h6>NOW THIS SALE AGREEMENT WITNESSES as follows:</h6>
                                    1.	CONSIDERATION:<br>
                                    In consideration of the sum of N<?php echo number_format($ro['amount']); ?> (<?php echo $figure ?> Naira only), which was received from the
                                    Purchaser by the Vendor on <?php echo $ro['created']; ?> and for <?php echo $ro['qty'];?> plots of land, measuring <?php echo $ro['qty']*600; ?>SQM in <?php echo $itm; ?>, <?php echo $projAddress; ?>, 
                                    the  Vendor                                                  
                                    hereby covenants to assign to the Purchaser the Demised Property after full payment       on the following terms and conditions.

                                    2.	THE VENDOR HEREBY COVENANTS AS FOLLOWS:<br><br>
                                    
                                    2.1 To execute Deed of the Assignment with the Purchaser not later than 6 (Six) months after the payment of documentation fee <br><br>
                                    
                                    	
                                    2.2	To let the Purchaser into physical and quiet possession of the Property free from an encumbrance.<br><br>
                                    2.3	To manage the Estate and provide the infrastructures in the sequence
                                    listed in SCHEDULE  I  for the common use of  other  occupants
                                    in the  Vendor ’s  Estate .
                                    <br><br>
                                    2.4	To indemnify and keep the Purchaser indemnified against the loss due to any adverse claim of a third party to the title by reason of any defect in the Vendor’s title over the
                                    Property PROVIDED ALWAYS that in the event of the adverse claim or challenge to the Vendor’s title by a third party, the Purchaser shall be reallocated to another property of the same value and within the same geographical location.
                                    <br><br>
                                    2.5	To provide all necessary documents to the Purchaser for the perfection of title of the Property upon completion of all payments.<br><br>



                                    3.	THE PURCHASER HEREBY COVENANTS AS  FOLLOWS:<br><br>

                                    3.1 To pay the Development Levy on or before commencing the development of the Property into Residential building in conformity with Lagos state building code PROVIDED that development shall not be later than 12 (twelve) month effective from payment date.<br><br>


                                    3.2 To abide and comply with the Vendor’s Property Managers in terms of rules, directives, regulations of the estate and orders regulating the development and/or usage of its Common Areas as may be issued from time to time by the Vendor or Agents/Managers provided such rules, directives, regulations and orders are reasonable and in accordance with prevailing practice.<br><br>

                                    3.3 To be responsible for perfection of title in Purchaser’s name over the Property and bear the incidental cost towards its documentation.<br><br>

                                    3.4 To accept and deem as properly being served, any document served from the Vendor’s registered address, its authorized Attorney delivered to the Purchaser in his official address or on the Property upon completion in the exchange of correspondence between the parties.<br><br>

                                    3.5 To be responsible for his own share of all Utility Bills which include but not limited to municipal charges, water rate, Land Use Charge, Neighbourhood Improvement Rates, Assessments, duties, charges, impositions and other outgoings assessed or imposed by Government and/or Service Charges as enunciated in SCHEDULE II as levied by the Vendor or its Property Managers provided such levies are reasonable and in accordance with the prevailing rates in conjunction with other occupants within the Estate.<br><br>

                                    4.	EVENTS OF GROSS DEFAULT<br>

                                    4.1	The following shall constitute a gross default:<br>


                                    i.Failure of the Purchaser to abide by Clauses 3.1 and 3.2 of this Agreement; and <br><br>

                                    ii.	Where the Vendor discontinues from the scheme or fails to perform the obligations contained in Clauses 2.1 and 2.2 of this Agreement.<br><br>


                                    4.2	REMEDIES FOLLOWING DEFAULT<br>

                                    A Defaulting Party who is in default for 3 (Three) consecutive months shall be notified in writing by an Aggrieved Party demanding 30 (Thirty) days within which to remedy the default PROVIDED that:<br>

                                    i.	Where the Vendor is the Defaulting Party, it shall pay a penalty fee of 0.1% of the total payment received to the Purchaser during the continuance of the default within which it will make alternative arrangement towards provision of a similar PROPERTY without which the Purchaser determines the contract. <br><br>

                                    ii.	Where the Purchaser is the Defaulting Party, he/she/they shall pay a penalty fee

                                    0.7% of the total payment made by the Purchaser PROVIDED that upon further default by the Purchaser to pay the penalty fee, the Vendor shall have absolute right to determine the contract whence it shall make refund of the total payment less 20% made by the Purchaser being severance fee after completing the construction of the Property and giving it out to another purchaser.
                                    <br><br>

                                    5.	SEVERABILITY:<br>

                                    Each of the provisions of this Agreement is severable and distinct from the others and if at any time one or more of such provisions is or becomes invalid, illegal or unenforceable, the legality, validity and enforceability of the other provisions of this Agreement shall not in any way be affected or impaired hereby.<br><br>

                                    6.	UTMOST GOOD FAITH:<br>

                                    The parties herein agree to exercise utmost good faith in the discharge of their obligations towards each other as contained in this Sales Agreement. Each of the parties hereto undertakes with each other to do all things reasonable within their/its power which are necessary or desirable to give effect to the spirit and intent of this Agreement.<br><br>


                                    7.	GOVERNING LAW:<br>

                                    This Agreement shall be subjected, construed and interpreted in accordance with the Laws of the Federal Republic of Nigeria.<br><br>


                                    8.	DISPUTE RESOLUTION:<br>

                                    Any dispute, controversy or claim arising out of or in relation to or in connection with this Contract of Sale, including without limitation any dispute as to the construction, validity, interpretation, enforceability or breach of this Agreement shall be referred to a single Arbitrator to be mutually appointed by both parties and the decision of the Arbitrator shall be final and binding on the parties hereto and the Arbitration and Conciliation Act Cap. A18, LFN 2004 shall govern these presents. <br><br> 
                                    9.	FORCE MAJEURE:<br>

                                    Neither party hereto shall incur any liability by reason of any failure to fulfil any obligations in terms of this Agreement if such failure is occasioned by an event of force majeure consisting of events such as Acts of God, fire, accident, governmental acts, explosion, industrial dispute or any other act, omission or event beyond the reasonable control of such party. The onus of proving that such failure was occasioned by a force majeure shall rest on the Party alleging same.<br><br> 
                                </div><br>
                                <div align="justify">
                                    FIRST SCHEDULE<br><br>

                                    (The Infrastructures Common with <?php echo $itm ?>)<br>

                                    <ol type="i">
                                        <li>
                                           Perimeter fence
                                        </li>
                                        <li>
                                            Road Network
                                        </li>
                                        <li>
                                           Drainages
                                        </li>
                                    </ol>  
                                </div><br>
                                <div align="justify">
                                    <span style="margin-left: 20px !important;">
                                    SECOND SCHEDULE<br><br>
                                    (The Provisions that Constitute Services in Southern Atlantic Estate)<br>
                                    <ol type="i" stlye="margin-left: 20px !important;">
                                        <li>Security </li>
                                        <li> Road/Drainage Maintenance</li>
                                        <li> Sewage Disposal</li>
                                        <li> Central Water System</li>
                                        <li> Perimeter Fence</li>
                                        <li> Green Area</li>
                                    </ol>
                                    </span>
                                </div><br>
                                 <div align="justify">
                                     IN WITNESS WHEREOF, the Vendor has hereunto set its common seal and the Purchaser has set his hand and seal the day and year first above written.<br><br>




                                    THE COMMON SEAL OF THE VENDOR IS HEREBY AFFIXED in the presence of:<br><br>










                                    <span style="padding-right: 300px;"> …………………………................</span>		........................................ <br><br>







                                    <span style="padding-right: 450px;">DIRECTOR</span>							SECRETARY	<br><br>							











                                    

                                    SIGNED, SEALED AND DELIVERED
                                    By the within named Purchaser <br><br>




                                    <span style="font-size: 25; text-transform: uppercase;"><?php echo $r['fname']." ".$r['lname']; ?></span> ………….………………………<br><br>





                                    In the presence of<br><br>

                                    Name: …………………………………………………………<br><br>

                                    Address: ………………………………………………………<br><br>

                                    Occupation: ………………………………………………….<br><br>

                                    Signature:……………………………………………………..<br><br>

                                    
                                </div><br>
                                <div align="justify">
                                    
                                </div><br>
                                <div align="justify">
                                    
                                </div><br>
                                <div align="justify">
                                    
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


