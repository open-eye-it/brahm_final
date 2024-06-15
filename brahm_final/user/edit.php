<?php include('../layout/header.php'); 
$uri = $_SERVER['QUERY_STRING'];
$uri_arr = explode('=', $uri);
$redirect = '';
$data = [];
$usrId;
/* Check User */
if(count($uri_arr) > 1){
    if($uri_arr[0] == 'user'){
        $usrId = $uri_arr[1];
        $res = $userModel->singleUser($usrId);
        if($res['status'] == 'success'){
            $data = $res['data'];
        }else{
            $redirect = 'confirm';    
        }
    }else{
        $redirect = 'confirm';
    }
}else{
    $redirect = 'confirm';
}

/* User Updae */
$msgErr='';
if(isset($_POST['usrName']) && isset($_POST['usrLogin'])){
	$createRes = $userModel->updateUser($_POST['usrName'], $_POST['usrLogin'], $usrId);
	if($createRes['status'] == 'success'){
		$redirect = 'confirm';
	}else{
		$msgErr = $createRes['msg'];
	}
}
?>
<script>
	let createMsg = "<?php echo $redirect; ?>";
	if(createMsg === 'confirm'){
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
												<h3 class="card-title">Update User</h3>
												
											</div>
											<!--begin::Form-->
											<form method="post" action="" id="newUserUpdate">
												<div class="card-body">
												<?php if($msgErr != ''){ ?>
													<div class="form-group mb-8">
														<div class="alert alert-custom alert-danger" role="alert">  
															<div class="alert-text"><?php echo $msgErr; ?></div>
														</div>
													</div>
												<?php } ?>
													<div class="form-group">
														<label for="usrName">User Name
														<span class="text-danger">*</span></label>
														<input type="text" class="form-control" placeholder="User Name" name="usrName" id="usrName" value="<?php echo $data['usrName']; ?>" />
														<span class="form-text text-danger" id="usrNameErr"></span>
													</div>
                                                    <div class="form-group">
														<label for="usrLogin">User Login
														<span class="text-danger">*</span></label>
														<input type="text" class="form-control" placeholder="User Login" name="usrLogin" id="usrLogin" value="<?php echo $data['usrLogin']; ?>" />
														<span class="form-text text-danger" id="usrLoginErr"></span>
													</div>
												</div>
												<div class="card-footer">
													<button type="submit" class="btn btn-primary mr-2" id="createUser">Update</button>
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
    $('#newUserUpdate').on('submit', function(e){
		let form = $(this).parents('form');
        let usrName = $('#usrName').val();
		let usrLogin = $('#usrLogin').val();
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
		}else{
			form.submit();
		}
    });
</script>