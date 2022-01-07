<?php include 'nav.php'; ?>

        <!-- Main Content -->
        <div class="hk-pg-wrapper">
            <!-- Breadcrumb -->
            <nav class="hk-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-light bg-transparent">
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Invoice</li>
                </ol>
            </nav>
            <!-- /Breadcrumb -->

            <!-- Container -->
            <div class="container">
                <!-- Title -->
                <div class="hk-pg-header mb-10">
                    <div>
                            <h4 class="hk-pg-title"><span class="pg-title-icon"><span class="feather-icon"><i data-feather="book"></i></span></span>Invoice</h4>
                    </div>
		   <div class="d-flex">
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="printer"></i></span></a>
                        <a href="#" class="text-secondary mr-15"><span class="feather-icon"><i data-feather="download"></i></span></a>
                        <button class="btn btn-primary btn-sm">Create New</button>
                    </div>
                </div>
                <!-- /Title -->

                <!-- Row -->
                <form>
                <div class="row">
                    <div class="col-xl-12">
                        <section class="hk-sec-wrapper hk-invoice-wrap pa-35">
                            <div class="invoice-from-wrap">
                                <div class="row">
                                    <div class="col-md-4 mb-20">
                                        <div class="col-md-12 mb-10">
                                            <label for="validationCustom01">Vendor <small><a href="avendor">Add</a></small></label>
                                            <select class="form-control select2" name="vendor" required>
                                                <option value="">Select</option>
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                <option value="AK">Alaska</option>
                                                <option value="HI">Hawaii</option>
                                            </optgroup>
                                            </select>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <textarea class="form-control" name="address"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-20"></div>
                                    <div class="col-md-4 mb-20">
                                        <div class="col-md-12 mb-10">
                                            <input type="text" class="form-control" id="validationCustom01" name="num" placeholder="Invoice Number" required>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <input type="date" class="form-control" id="validationCustom02" placeholder="Date" name="date"  required>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                        <div class="col-md-12 mb-10">
                                            <select class="form-control select2" name="vendor" required>
                                                <option value="">Select Quote/Order No</option>
                                                <optgroup label="Alaskan/Hawaiian Time Zone">
                                                    <option value="AK">Alaska</option>
                                                    <option value="HI">Hawaii</option>
                                                </optgroup>
                                            </select>
                                            <div class="valid-feedback"> Looks good! </div> <div class="invalid-feedback"> Error </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br/><br/><br/>
                            <!--<div class="invoice-to-wrap pb-20">
                                <div class="row">
                                    <div class="col-md-7 mb-30">
                                        <span class="d-block text-uppercase mb-5 font-13">billing to</span>
                                        <h6 class="mb-5">Supersonic Co.</h6>
                                        <address>
												<span class="d-block">Sycamore Street</span>
												<span class="d-block">San Antonio Valley, CA 34668</span>
												<span class="d-block">thompson_peter@super.co</span>
												<span class="d-block">ABC:325487</span>
											</address>
                                    </div>
                                    <div class="col-md-5 mb-30">
                                        <span class="d-block text-uppercase mb-5 font-13">Payment info</span>
                                        <span class="d-block">Scott L Thompson</span>
                                        <span class="d-block">MasterCard#########1234</span>
                                        <span class="d-block">Customer #<span class="text-dark">324148</span></span>
                                        <span class="d-block text-uppercase mt-20 mb-5 font-13">amount due</span>
                                        <span class="d-block text-dark font-18 font-weight-600">$22,010</span>
                                    </div>
                                </div>
                            </div>-->
                            
                            <div class="col-md-3 pull-right">
                               <div class="col-md-12 mb-20">
                                    <select class="form-control select2" name="project" required>
                                        <option value="">Select Project</option>
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
                                        <option value="AK">Alaska</option>
                                        <option value="HI">Hawaii</option>
                                    </optgroup>
                                    </select>
                                </div> 
                            </div>
                              
                            <h5>Items</h5>
                            <hr>
                            <div class="invoice-details">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-border mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="">S/N</th>
                                                    <th class="w-40">Items</th>
                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right">Unit Cost</th>
                                                    <th class="text-right">Amount</th>
                                                    <th class="text-right">Tax</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-right">2</td>
                                                    <td class="w-70">Design Service</td>
                                                    <td class="text-right">$1500</td>
                                                    <td class="text-right">$3000</td>
                                                    <td class="text-right">$1500</td>
                                                    <td class="text-right">$3000</td>
                                                </tr>
                                                <tr class="bg-transparent">
                                                    <td colspan="3" class="text-right text-light">Subtotals</td>
                                                    <td class="text-right">$19,500</td>
                                                </tr>
                                                <tr class="bg-transparent">
                                                    <td colspan="3" class="text-right text-light border-top-0">Tax</td>
                                                    <td class="text-right border-top-0">$3510</td>
                                                </tr>
                                                <tr class="bg-transparent">
                                                    <td colspan="3" class="text-right text-light border-top-0">Discount</td>
                                                    <td class="text-right border-top-0">$1000</td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="border-bottom border-1">
                                                <tr>
                                                    <th colspan="3" class="text-right font-weight-600">total</th>
                                                    <th class="text-right font-weight-600">$22,010</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div><br/><br/>
                            <ul class="invoice-terms-wrap font-14 list-ul">
                                <li>A buyer must settle his or her account within 30 days of the date listed on the invoice.</li>
                                <li>The conditions under which a seller will complete a sale. Typically, these terms specify the period allowed to a buyer to pay off the amount due.</li>
                            </ul>
                        </section>
                    </div>
                </div>
                <!-- /Row -->
                </form>
                <!-- /Form -->
            </div>
            <!-- /Container -->

           <?php include 'foot.php'; ?>