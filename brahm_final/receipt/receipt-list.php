<?php include('../layout/header.php'); ?>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title">Search Receipt</h3>
											</div>
											<!--begin::Form-->
											
												<div class="card-body">
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                            <div class="form-group">
                                                                <label for="RecNo">Receipt No
                                                                <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" placeholder="Receipt No" name="RecNo" id="RecNo" />
                                                                <span class="form-text text-danger" id="RecNoErr"></span>
                                                            </div>
                                                        </div>
                                                    </div>
												</div>
												<div class="card-footer">
													<button class="btn btn-primary mr-2" id="createUser" onclick="searchReceipt()">Search</button>
												</div>
											
											<!--end::Form-->
										</div>
								<!--end::Dashboard-->
							</div>
							<!--end::Content-->
						</div>
						<!--begin::Content Wrapper-->
					</div>
					<!--end::Container-->
<?php include('../layout/footer.php'); ?>
<script>
    function searchReceipt(){
        let RecNo = $('#RecNo').val();
        if(RecNo == ''){
            $('#RecNoErr').html('Please enter receipt no');
            timeOut('RecNoErr', 3000);
            scrollTop('RecNoErr');
        }else{
            window.location.href="<?php echo $base_url; ?>receipt/receipt-single.php?RecNo="+RecNo;
        }   
    }
</script>