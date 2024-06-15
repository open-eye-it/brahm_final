<?php include('../layout/header.php'); 
$query = $_SERVER['QUERY_STRING'];
$data = [];
$member = [];
$errMsg = '';
$RecNo;
if(!empty($query) && $query != ''){
	$query_arr = explode('=', $query);
	$RecNo = $query_arr[1];
	$res = $receiptModel->singleReceipt($RecNo);
	if($res['status'] == 'success'){
		$data = $res['data'];
	}else{
		$errMsg = $res['status'];
	}

	$res1 = $receiptModel->receiptMemberandYear($RecNo);
	if($res1['status'] == 'success'){
		$member = $res1['data'];
	}
}
?>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b example example-compact">
											<div class="card-header flex-wrap py-3">
												<div class="card-title">
													<h3 class="card-label">Receipt Detail</h3>
												</div>
												<div class="card-toolbar">
													<a href="<?php echo $base_url.'receipt/receipt-list.php'; ?>" class="btn btn-primary"><i class="fa fa-arrow-left text-white"></i> Back</a> &nbsp;
													<a href="<?php echo $base_url.'receipt/receipt-edit.php?RecNo='.$RecNo; ?>" class="btn btn-primary"><i class="fa fa-edit text-white"></i> Edit</a>
												</div>
											</div>
											<!--begin::Form-->
											<div class="card-body">
												<?php if($errMsg != ''){ ?>
													<h4>Receipt detail not found</h4>
												<?php } ?>
												<?php if($errMsg == ''){ ?>
												<table class="table table-bordered table-checkable">
													<tr>
														<td><strong>Receipt No.</strong></td>
														<td><?php echo $data['RecNo']; ?></td>
													</tr>
													<tr>
														<td><strong>Receipt Type</strong></td>
														<td><?php echo $data['Type']; ?></td>
													</tr>
													<tr>
														<td><strong>Receipt Date</strong></td>
														<td><?php echo $data['RecDate']; ?></td>
													</tr>
													<tr>
														<td><strong>Amount Received</strong></td>
														<td><?php echo $data['RecAmt']; ?></td>
													</tr>
													<tr>
														<td><strong>Description</strong></td>
														<td><?php echo $data['RecDescription']; ?></td>
													</tr>
													<tr>
														<td><strong>Cash / Cheque</strong></td>
														<td><?php echo $data['Cash_Cheque']; ?></td>
													</tr>
													<tr>
														<td><strong>Cheque Details</strong></td>
														<td>
															Ch No: <?php echo $data['Cheque_Number']; ?>
															Ch Date: <?php echo $data['Cheque_Date']; ?>
															Bank: <?php echo $data['Bank']; ?>
														</td>
													</tr>
													<tr>
														<td><strong>Remarks</strong></td>
														<td><?php echo $data['Remarks']; ?></td>
													</tr>
													<tr>
														<td><strong>Members Applied</td>
														<td>
															<table class="table table-bordered table-checkable">
																<tr>
																	<th>Member No</th>
																	<th>Member Name</th>
																	<th>Year</th>
																</tr>
																<?php if(count($member) > 0){
																	foreach($member as $list){ ?>
																	<tr>
																		<td><?php echo $list['MemNo']; ?></td>
																		<td><?php echo $list['preFix'].' '.$list['SurName'].' '.$list['FirstName'].' '.$list['MiddleName']; ?></td>
																		<td><?php echo $list['yearName']; ?></td>
																	</tr>
																	<?php }
																} ?>
															</table>
														</td>
													</tr>
												</table>
												<?php } ?>
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