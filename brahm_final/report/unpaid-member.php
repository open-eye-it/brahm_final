<?php include('../layout/header.php');
	$currentYear = date('Y');
	$yearArr = [$currentYear];
	for($i=1; $i<6; $i++){
		$yearArr[] = $currentYear-$i;
	}
	$last6YearList = $reportModel->last6YearList($yearArr);
	$yearsList = [];
	if($last6YearList['status'] == 'success'){
		$yearsList = $last6YearList['data'];
	}
?>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b">
								<div class="rot">
										<div class="col-lg-2 col-md-3 col-sm-6 col-12">
											<div class="form-group">
												<label for="year">Select Year</label>
												<select class="form-control" name="year" id="year">
													<?php if(count($yearsList) > 0){
														foreach($yearsList as $list){ ?>
															<option value="<?php echo $list['year']; ?>"><?php echo $list['yearName']; ?></option>
														<?php }
													} ?>
												</select>
											</div>
											<div><button class="btn btn-primary" onclick="searchMember()">Search</button></div>
										</div>
									</div>
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
function searchMember(){
	let year = $('#year').val();
	window.location.href="<?php echo $base_url; ?>report/unpaid-member-view.php?year="+year;
}
</script>