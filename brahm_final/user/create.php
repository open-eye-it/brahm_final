<?php include('../layout/header.php'); 
$createMsg = '';
if(isset($_POST['usrName']) && isset($_POST['usrLogin']) && isset($_POST['usrPass'])){
	$createRes = $userModel->createUser($_POST['usrName'], $_POST['usrLogin'], $_POST['usrPass']);
	if($createRes == 'success'){
		$createMsg = $createRes;
	}else{
		$createMsg = $createRes;
	}
}
?>
<script>
	let createMsg = "<?php echo $createMsg; ?>";
	if(createMsg === 'success'){
		window.location.href = "<?php echo $base_url; ?>"+"user/list.php";
	}
</script>
					<!--begin::Container-->
					<div class="d-flex flex-row flex-column-fluid container">
						<!--begin::Content Wrapper-->
						<div class="main d-flex flex-column flex-row-fluid">
							<div class="content flex-column-fluid" id="kt_content">
								<!--begin::Dashboard-->
								<div class="card card-custom gutter-b example example-compact">
											<div class="card-header">
												<h3 class="card-title">Create User</h3>
												
											</div>
											<!--begin::Form-->
											<form method="post" action="" id="newUserCreate">
												<div class="card-body">
												<?php if($loginResMsg == 'fail'){ ?>
													<div class="form-group mb-8">
														<div class="alert alert-custom alert-danger" role="alert">  
															<div class="alert-text">Something wrong in user form, please try again.</div>
														</div>
													</div>
												<?php } ?>
													<div class="form-group">
														<label for="usrName">User Name
														<span class="text-danger">*</span></label>
														<input type="text" class="form-control" placeholder="User Name" name="usrName" id="usrName" />
														<span class="form-text text-danger" id="usrNameErr"></span>
													</div>
                                                    <div class="form-group">
														<label for="usrLogin">User Login
														<span class="text-danger">*</span></label>
														<input type="text" class="form-control" placeholder="User Login" name="usrLogin" id="usrLogin" />
														<span class="form-text text-danger" id="usrLoginErr"></span>
													</div>
													<div class="form-group">
														<label for="usrPass">Password
														<span class="text-danger">*</span></label>
														<input type="password" class="form-control" placeholder="Password" name="usrPass" id="usrPass" />
														<span class="form-text text-danger" id="usrPassErr"></span>
													</div>
												</div>
												<div class="card-footer">
													<button type="submit" class="btn btn-primary mr-2" id="createUser">Create</button>
													<a href="<?php echo $base_url; ?>user/list.php" class="btn btn-secondary">Cancel</a>
												</div>
											</form>
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
<script type="text/javascript">
    $('#newUserCreate').on('submit', function(e){
		let form = $(this).parents('form');
        let usrName = $('#usrName').val();
		let usrLogin = $('#usrLogin').val();
		let usrPass = $('#usrPass').val();
		let regex = /^[a-z0-9]+$/;

		
		if(usrName == ''){e.preventDefault();
			$('#usrNameErr').html('Please enter User Name');
			timeOut('usrNameErr', 3000);
		}else if(usrLogin == ''){e.preventDefault();
			$('#usrLoginErr').html('Please enter User Name');
			timeOut('usrLoginErr', 3000);
		}else if(!usrLogin.match(regex)){e.preventDefault();
			$('#usrLoginErr').html('Allowed only lower case letters and numbers');
			timeOut('usrLoginErr', 3000);
		}else if(usrPass == ''){e.preventDefault();
			$('#usrPassErr').html('Please enter password');
			timeOut('usrPassErr', 3000);
		}else{
			form.submit();
		}
    });
</script>