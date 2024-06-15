<?php
include('common/common.php');
$loginResMsg = '';
if(isset($_POST['username']) && isset($_POST['password'])){
	$LoginRes = $loginModel->Login($_POST['username'], $_POST['password']);
	if($LoginRes == 'success'){
		header('Location: '.$base_url.'dashboard.php');
	}else{
		$loginResMsg = $LoginRes;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="utf-8" />
		<title><?php echo $page_title; ?></title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<link rel="canonical" href="https://keenthemes.com/metronic" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="assets/css/pages/login/classic/login-6.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="assets/media/logos/favicon.ico" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-6 login-signin-on login-signin-on d-flex flex-column-fluid" id="kt_login">
				<div class="d-flex flex-column flex-lg-row flex-row-fluid text-center" style="background-image: url(assets/media/bg/bg-3.jpg);">
					<!--begin:Aside-->
					<div class="d-flex w-100 flex-center p-15">
						<div class="login-wrapper">
							<!--begin:Aside Content-->
							<div class="text-dark-75">
								<a href="#">
									<img src="assets/media/elebs-logo.png" class="max-h-100px" alt="" />
								</a>
								<h1 class="mb-8 mt-22 font-weight-bold text-primary">East London & Essex Brahm Samaj</h1>
								<h2 class="mb-15 text-muted font-weight-bold">Membership Management</h2>
								<a href="#">
									<img src="assets/media/banner.png" class="max-h-100px" alt="" />
								</a>
							</div>
							<!--end:Aside Content-->
						</div>
					</div>
					<!--end:Aside-->
					<!--begin:Divider-->
					<div class="login-divider">
						<div></div>
					</div>
					<!--end:Divider-->
					<!--begin:Content-->
					<div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
						<div class="login-wrapper">
							<!--begin:Sign In Form-->
							<div class="login-signin">
								<div class="text-center mb-10 mb-lg-20">
									<h2 class="font-weight-bold">Sign In</h2>
									<p class="text-muted font-weight-bold">Enter your username and password</p>
								</div>
								<?php if($loginResMsg == 'fail'){ ?>
									<span class="text-danger">Invalid username or password</span>
								<?php } ?>
								<form class="form text-left" id="kt_login_signin_form" method="post" >
									<div class="form-group py-2 m-0">
										<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Username" name="username" autocomplete="off" />
									</div>
									<div class="form-group py-2 border-top m-0">
										<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" />
									</div>
									<div class="text-center mt-15">
										<button id="kt_login_signin_submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9 font-weight-bold" type="submit">Sign In</button>
									</div>
								</form>
							</div>
							<!--end:Sign In Form-->
						</div>
					</div>
					<!--end:Content-->
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1200 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#6993FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#F3F6F9", "dark": "#212121" }, "light": { "white": "#ffffff", "primary": "#E1E9FF", "secondary": "#ECF0F3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#212121", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#ECF0F3", "gray-300": "#E5EAEE", "gray-400": "#D6D6E0", "gray-500": "#B5B5C3", "gray-600": "#80808F", "gray-700": "#464E5F", "gray-800": "#1B283F", "gray-900": "#212121" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="assets/plugins/global/plugins.bundle.js"></script>
		<script src="assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>