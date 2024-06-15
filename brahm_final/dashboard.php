<?php include('layout/header.php'); 
$memberShow=false;
$memberData = [];
if(isset($_POST['search_name'])){
	$list = $membershipModel->SearchMember($_POST['search_name']);
	if($list['status'] == 'success'){
		$memberData = $list['data'];
		$memberShow = true;
	}
}
?>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="row">
									<div class="col-12">
										<h1 class="bg-primary p-5 text-white">Welcome, <?php echo $_SESSION['username']; ?></h1>
									</div>
								</div>
								<?php if(isset($_SESSION) && (in_array(1, $_SESSION['permission']) || $_SESSION['admin_type'] == 1)){ ?>
								<div class="row mt-4">
									<div class="col-12">
										<form action="" method="POST" id="searchMember">
											<div class="form-group">
												<label for="">Search Member Name</label>
												<input type="text" class="form-control" name="search_name" id="search_name">
												<span class="form-text text-danger" id="search_nameErr"></span>
											</div>
											<button type="submit" class="btn btn-primary">Search</button>
										</form>
									</div>
								</div>
								<?php } ?>
								<?php if($memberShow === true){ ?>
								<div class="row">
									<div class="col-12">
										<table class="table">
											<tr>
												<th>ID</th>
												<th>Member ID</th>
												<th>Family ID</th>
												<th>Name</th>
												<th>Relation</th>
												<th>Address</th>
												<th>Action</th>
											</tr>
											<?php if(count($memberData) > 0){ $i=1;
												foreach($memberData as $list){ ?>
													<tr>
														<td><?php echo $i; ?></td>
														<td><?php echo $list['memberid']; ?></td>
														<td><?php echo $list['familyid1']; ?></td>
														<td><?php echo $list['preFix'].' '.$list['SurName'].' '.$list['FirstName'].' '.$list['MiddleName']; ?></td>
														<td><?php echo $list['Relation']; ?></td>
														<td><?php echo $list['add1'].' '.$list['add2'].' '.$list['add3'].' '.$list['add4']; ?></td>
														<td>
															<a href="<?php echo $base_url; ?>membership/member-list.php?family=<?php echo $list['familyid1']; ?>" title="View Member" class="btn btn-info btn-sm btn-clean btn-icon mr-2">
																<i class="fa fa-eye"></i>
															</a>
														</td>
													</tr>
												<?php $i++; }
											} ?>
										</table>
									</div>
								</div>
								<?php } ?>
								<!--end::Dashboard-->
							</div>
							<!--end::Content-->
						</div>
						<!--begin::Content Wrapper-->
					</div>
					<!--end::Container-->
<?php include('layout/footer.php'); ?>
<script>
	$('#searchMember').on('submit', function(e){
		let form = $(this).parents('form');
        let search_name = $('#search_name').val();
		
		if(search_name == ''){e.preventDefault();
			$('#search_nameErr').html('Please enter member name');
			timeOut('search_nameErr', 3000);
            scrollTop('search_name');
		}else{
			form.submit();
		}
    });
</script>