<?php include('../layout/header.php');

$requestErr = '';
$permission = [];
$permissionResMsg = '';
$queryString = $_SERVER['QUERY_STRING'];
if ($queryString != '') {
	$QueryArr = explode('=', $queryString);
	if (count($QueryArr) == 2 && is_numeric($QueryArr[1])) {
		/* $QueryArr[1] = $userid */
		$userPermission = $userModel->userPermission($QueryArr[1]);
		if ($userPermission['status'] == 'success') {
			if (isset($_POST['permissionSend'])) {
				$permissionData = '';
				if ($_POST['permission'] != '') {
					$permissionData = implode(',', $_POST['permission']);
				}
				$createRes = $userModel->updatePermission($permissionData, $QueryArr[1]);
				if ($createRes['status'] == 'success') {
					$permissionResMsg = $createRes['status'];
				} else {
					$permissionResMsg = $createRes['status'];
				}
			}
			$userPermission1 = $userModel->userPermission($QueryArr[1]);
			if ($userPermission1['data']['permission'] != '') {
				$permission = explode(',', $userPermission1['data']['permission']);
			}
		} else {
			$requestErr = 'fail';
		}
	} else {
		$requestErr = 'fail';
	}
} else {
	$requestErr = 'fail';
}
?>
<script>
	let requestErr = "<?php echo $requestErr; ?>";
	if (requestErr === 'fail') {
		window.location.href = "<?php echo $base_url; ?>" + "user/list.php";
	}
</script>
<!--begin::Container-->
<div class="d-flex flex-row flex-column-fluid container">
	<!--begin::Content Wrapper-->
	<div class="main d-flex flex-column flex-row-fluid">
		<div class="content flex-column-fluid" id="kt_content">
			<!--begin::Dashboard-->
			<div class="card card-custom gutter-b example example-compact">
				<div class="card-header flex-wrap py-3">
					<div class="card-title">
						<h3 class="card-label">User Permission</h3>
					</div>
					<div class="card-toolbar">
						<a href="<?php echo $base_url . 'user/list.php'; ?>" class="btn btn-primary"><i class="fa fa-arrow-left text-white"></i> Back</a> &nbsp;
					</div>
				</div>
				<!--begin::Form-->
				<form method="post" action="<?php echo $base_url; ?>user/permission.php?user=<?php echo $QueryArr[1]; ?>" id="newUserCreate">
					<div class="card-body">
						<?php if ($permissionResMsg == 'fail') { ?>
							<div class="form-group mb-8">
								<div class="alert alert-custom alert-danger" role="alert">
									<div class="alert-text">Something wrong in user permission, please try again.</div>
								</div>
							</div>
						<?php } ?>
						<?php if ($permissionResMsg == 'success') { ?>
							<div class="form-group mb-8">
								<div class="alert alert-custom alert-success" role="alert">
									<div class="alert-text">Permission changed sucessfully.</div>
								</div>
							</div>
						<?php } ?>
						<div class="form-group">
							<div class="checkbox-inline">
								<label class="checkbox">
									<input type="checkbox" name="permission[]" id="permission" value="1" <?php echo (in_array(1, $permission)) ? 'checked' : ''; ?> />
									<span></span>Membership Management</label>
								<label class="checkbox">
									<input type="checkbox" name="permission[]" id="permission" value="2" <?php echo (in_array(2, $permission)) ? 'checked' : ''; ?> />
									<span></span>Receipt</label>
								<label class="checkbox">
									<input type="checkbox" name="permission[]" id="permission" value="3" <?php echo (in_array(3, $permission)) ? 'checked' : ''; ?> />
									<span></span>Reports</label>
								<label class="checkbox">
									<input type="checkbox" name="permission[]" id="permission" value="4" <?php echo (in_array(4, $permission)) ? 'checked' : ''; ?> />
									<span></span>Letter Head</label>
								<label class="checkbox">
									<input type="checkbox" name="permission[]" id="permission" value="5" <?php echo (in_array(5, $permission)) ? 'checked' : ''; ?> />
									<span></span>Export </label>
							</div>
						</div>

					</div>
					<div class="card-footer">
						<input type="hidden" name="permissionSend" id="permissionSend" value="permissionSend">
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