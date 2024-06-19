<?php
$base_url = "http://" . $_SERVER['SERVER_NAME'] . '/brahm_final/';
$document_url = $_SERVER['DOCUMENT_ROOT'] . '/brahm_final/';
$common_path = $document_url . 'common/common.php';
include($common_path);

$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);
$seg1 = $uri_segments[2];
$seg2 = $uri_segments[3];

/* Only super admin can access user module */
$userModuleRedirect = '';
if ($seg1 === 'user') {
	if (isset($_SESSION) && $_SESSION['admin_type'] != 1) {
		$userModuleRedirect = 'redirect';
	}
}
if ($seg1 === 'membership' && isset($_SESSION) && !in_array(1, $_SESSION['permission']) && $_SESSION['admin_type'] != 1) {
	$userModuleRedirect = 'redirect';
}
if ($seg1 === 'receipt' && isset($_SESSION) && !in_array(2, $_SESSION['permission']) && $_SESSION['admin_type'] != 1) {
	$userModuleRedirect = 'redirect';
}
if ($seg1 === 'report' && isset($_SESSION) && !in_array(3, $_SESSION['permission']) && $_SESSION['admin_type'] != 1) {
	$userModuleRedirect = 'redirect';
}
if ($seg1 === 'letter' && isset($_SESSION) && !in_array(4, $_SESSION['permission']) && $_SESSION['admin_type'] != 1) {
	$userModuleRedirect = 'redirect';
}
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->

<head>
	<base href="">
	<meta charset="utf-8" />
	<title><?php echo $page_title; ?></title>
	<base href="<?php echo $base_url; ?>">
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link rel="canonical" href="https://keenthemes.com/metronic" />
	<!--begin::Fonts-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
	<!--end::Fonts-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="<?php echo $base_url; ?>assets/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Page Vendors Styles(used by this page)-->
	<link href="<?php echo $base_url; ?>assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Page Vendors Styles-->
	<!--begin::Global Theme Styles(used by all pages)-->
	<link href="<?php echo $base_url; ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo $base_url; ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
	<!--end::Global Theme Styles-->
	<!--begin::Layout Themes(used by all pages)-->
	<!--end::Layout Themes-->
	<link rel="shortcut icon" href="<?php echo $base_url; ?>assets/media/logos/favicon.ico" />
	<script>
		let userModuleRedirect = "<?php echo $userModuleRedirect ?>";
		if (userModuleRedirect !== '') {
			window.location.href = "<?php echo $base_url; ?>" + "dashboard.php";
		}
	</script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed page-loading">
	<!--begin::Main-->
	<div class="d-flex flex-column flex-root">
		<!--begin::Page-->
		<div class="d-flex flex-row flex-column-fluid page">
			<!--begin::Wrapper-->
			<div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
				<!--begin::Header Mobile-->
				<div id="kt_header_mobile" class="header-mobile header-mobile-fixed">
					<!--begin::Logo-->
					<a href="index.html">
						<!-- <img alt="Logo" src="assets/media/logos/logo-letter-12.png" class="max-h-30px" /> -->
						<h1>East London & Essex Brahm Samaj</h1>
					</a>
					<!--end::Logo-->
					<!--begin::Toolbar-->
					<div class="d-flex align-items-center">
						<button class="btn p-0 burger-icon burger-icon-left" id="kt_header_mobile_toggle">
							<span></span>
						</button>
						<button class="btn btn-icon p-0 ml-4" id="kt_header_mobile_topbar_toggle">
							<span class="svg-icon svg-icon-xxl">
								<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
								<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
									<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
										<polygon points="0 0 24 0 24 24 0 24" />
										<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
										<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
									</g>
								</svg>
								<!--end::Svg Icon-->
							</span>
						</button>
					</div>
					<!--end::Toolbar-->
				</div>
				<!--end::Header Mobile-->
				<!--begin::Header-->
				<div id="kt_header" class="header flex-column header-fixed">
					<!--begin::Top-->
					<div class="header-top">
						<!--begin::Container-->
						<div class="container">
							<!--begin::Left-->
							<div class="d-none d-lg-flex align-items-center mr-3">
								<!--begin::Logo-->
								<a href="index.html" class="mr-20">
									<img alt="Logo" src="<?php echo $base_url; ?>assets/media/elebs-logo.png" class="max-h-80px" />
									<!-- <h1>East London & Essex Brahm Samaj</h1> -->
								</a>
								<!--end::Logo-->
							</div>
							<!--end::Left-->
							<!--begin::Topbar-->
							<div class="topbar topbar-top" id="kt_header_topbar">
								<!--begin::User-->
								<div class="topbar-item">
									<div class="btn btn-icon btn-secondary" id="kt_quick_user_toggle">
										<span class="svg-icon svg-icon-lg">
											<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
											<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<polygon points="0 0 24 0 24 24 0 24" />
													<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
													<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
												</g>
											</svg>
											<!--end::Svg Icon-->
										</span>
									</div>
								</div>
								<!--end::User-->
							</div>
							<!--end::Topbar-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Top-->
					<!--begin::Bottom-->
					<div class="header-bottom" id="kt_header_bottom">
						<!--begin::Container-->
						<div class="container d-flex flex-column">
							<!--begin::Tab Navs(for desktop mode)-->
							<ul class="header-tabs nav flex-column-auto" role="tablist">
								<!--begin::Item-->
								<li class="nav-item">
									<a href="#" class="nav-link <?php echo ($seg1 == 'dashboard.php') ? 'active' : ''; ?>" data-toggle="tab" data-target="#kt_header_tab_1" role="tab">
										<span class="nav-title text-uppercase">Home</span>
									</a>
								</li>
								<!--end::Item-->
								<!--begin::Item-->
								<?php if ($_SESSION['admin_type'] == '1') { ?>
									<li class="nav-item">
										<a href="#" class="nav-link <?php echo ($seg1 == 'user') ? 'active' : ''; ?>" data-toggle="tab" data-target="#kt_header_tab_2" role="tab">
											<span class="nav-title text-uppercase">Users</span>
										</a>
									</li>
								<?php } ?>
								<!--end::Item-->
								<!--begin::Item-->
								<?php if (in_array(1, $_SESSION['permission']) || $_SESSION['admin_type'] == 1) { ?>
									<li class="nav-item">
										<a href="#" class="nav-link <?php echo ($seg1 == 'membership') ? 'active' : ''; ?>" data-toggle="tab" data-target="#kt_header_tab_3" role="tab">
											<span class="nav-title text-uppercase">Membership Management</span>
										</a>
									</li>
								<?php } ?>
								<!--end::Item-->
								<!--begin::Item-->
								<li class="nav-item">
									<?php if (in_array(2, $_SESSION['permission']) || $_SESSION['admin_type'] == 1) { ?>
										<a href="#" class="nav-link <?php echo ($seg1 == 'receipt') ? 'active' : ''; ?>" data-toggle="tab" data-target="#kt_header_tab_4" role="tab">
											<span class="nav-title text-uppercase">Receipt</span>
										</a>
								</li>
							<?php } ?>
							<!--end::Item-->
							<!--begin::Item-->
							<?php if (in_array(3, $_SESSION['permission']) || $_SESSION['admin_type'] == 1) { ?>
								<li class="nav-item">
									<a href="#" class="nav-link <?php echo ($seg1 == 'report') ? 'active' : ''; ?>" data-toggle="tab" data-target="#kt_header_tab_5" role="tab">
										<span class="nav-title text-uppercase">Reports</span>
									</a>
								</li>
							<?php } ?>
							<!--end::Item-->
							<!--begin::Item-->
							<?php if (in_array(4, $_SESSION['permission']) || $_SESSION['admin_type'] == 1) { ?>
								<li class="nav-item">
									<a href="#" class="nav-link <?php echo ($seg1 == 'letter') ? 'active' : ''; ?>" data-toggle="tab" data-target="#kt_header_tab_6" role="tab">
										<span class="nav-title text-uppercase">Letter Head</span>
									</a>
								</li>
							<?php } ?>
							<!--end::Item-->
							</ul>
							<!--begin::Tab Navs-->
							<!--begin::Header Menu Wrapper-->
							<div class="header-navs header-navs-left flex-column-fluid" id="kt_header_navs">
								<!--begin::Tab Content-->
								<div class="tab-content">
									<!--begin::Tab Pane-->
									<div class="tab-pane <?php echo ($seg1 == 'dashboard.php') ? 'show active' : ''; ?>" id="kt_header_tab_1">
										<!--begin::Menu-->
										<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
											<!--begin::Nav-->
											<ul class="menu-nav">
												<li class="menu-item <?php echo ($seg1 == 'dashboard.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>dashboard.php" class="menu-link">
														<span class="menu-text">Dashboard</span>
													</a>
												</li>
											</ul>
											<!--end::Nav-->
										</div>
										<!--end::Menu-->
									</div>
									<!--End::Tab Pane-->
									<!--begin::Tab Pane-->
									<div class="tab-pane justify-content-between px-4 px-lg-0 <?php echo ($seg1 == 'user') ? 'show active' : ''; ?>" id="kt_header_tab_2">
										<!--begin::Menu-->
										<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
											<!--begin::Nav-->
											<ul class="menu-nav">
												<li class="menu-item <?php echo ($seg1 == 'user' && $seg2 == 'list.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>user/list.php" class="menu-link">
														<span class="menu-text">List</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'user' && $seg2 == 'create.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>user/create.php" class="menu-link">
														<span class="menu-text">Create</span>
													</a>
												</li>
											</ul>
											<!--end::Nav-->
										</div>
										<!--end::Menu-->
									</div>
									<!--End::Tab Pane-->
									<!--begin::Tab Pane-->
									<div class="tab-pane justify-content-between px-4 px-lg-0 <?php echo ($seg1 == 'membership') ? 'show active' : ''; ?>" id="kt_header_tab_3">
										<!--begin::Menu-->
										<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
											<!--begin::Nav-->
											<ul class="menu-nav">
												<li class="menu-item <?php echo ($seg1 == 'membership' && $seg2 == 'list.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>membership/list.php" class="menu-link">
														<span class="menu-text">List</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'membership' && $seg2 == 'create.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>membership/create.php" class="menu-link">
														<span class="menu-text">Create</span>
													</a>
												</li>
											</ul>
											<!--end::Nav-->
										</div>
										<!--end::Menu-->
									</div>
									<!--End::Tab Pane-->
									<!--begin::Tab Pane-->
									<div class="tab-pane justify-content-between px-4 px-lg-0 <?php echo ($seg1 == 'receipt') ? 'show active' : ''; ?>" id="kt_header_tab_4">
										<!--begin::Menu-->
										<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
											<!--begin::Nav-->
											<ul class="menu-nav">
												<li class="menu-item <?php echo ($seg1 == 'receipt' && $seg2 == 'receipt-list.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>receipt/receipt-list.php" class="menu-link">
														<span class="menu-text">List</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'receipt' && $seg2 == 'receipt-create.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>receipt/receipt-create.php" class="menu-link">
														<span class="menu-text">Create</span>
													</a>
												</li>
											</ul>
											<!--end::Nav-->
										</div>
										<!--end::Menu-->
									</div>
									<!--End::Tab Pane-->
									<!--begin::Tab Pane-->
									<div class="tab-pane justify-content-between px-4 px-lg-0 <?php echo ($seg1 == 'report') ? 'show active' : ''; ?>" id="kt_header_tab_5">
										<!--begin::Menu-->
										<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
											<!--begin::Nav-->
											<ul class="menu-nav">
												<li class="menu-item <?php echo ($seg1 == 'report' && ($seg2 == 'paid-member.php' || $seg2 == 'paid-member-view.php')) ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>report/paid-member.php" class="menu-link">
														<span class="menu-text">Paid Members</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'report' && $seg2 == 'lifetime-member.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>report/lifetime-member.php" class="menu-link">
														<span class="menu-text">Lifetime Members</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'report' && ($seg2 == 'unpaid-member.php' || $seg2 == 'unpaid-member-view.php')) ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>report/unpaid-member.php" class="menu-link">
														<span class="menu-text">Unpaid Members</span>
													</a>
												</li>
											</ul>
											<!--end::Nav-->
										</div>
										<!--end::Menu-->
									</div>
									<!--End::Tab Pane-->
									<!--begin::Tab Pane-->
									<div class="tab-pane justify-content-between px-4 px-lg-0 <?php echo ($seg1 == 'letter') ? 'show active' : ''; ?>" id="kt_header_tab_6">
										<!--begin::Menu-->
										<div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
											<!--begin::Nav-->
											<ul class="menu-nav">
												<li class="menu-item <?php echo ($seg1 == 'letter' && $seg2 == 'letter-all-member.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>letter/letter-all-member.php" class="menu-link">
														<span class="menu-text">All Members</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'letter' && $seg2 == 'letter-paid-member.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>letter/letter-paid-member.php" class="menu-link">
														<span class="menu-text">Paid Members</span>
													</a>
												</li>
												<li class="menu-item <?php echo ($seg1 == 'letter' && $seg2 == 'letter-unpaid-member.php') ? 'menu-item-active' : ''; ?>" aria-haspopup="true">
													<a href="<?php echo $base_url; ?>letter/letter-unpaid-member.php" class="menu-link">
														<span class="menu-text">Unpaid Members</span>
													</a>
												</li>
											</ul>
											<!--end::Nav-->
										</div>
										<!--end::Menu-->
									</div>
									<!--End::Tab Pane-->
								</div>
								<!--end::Tab Content-->
							</div>
							<!--end::Header Menu Wrapper-->
						</div>
						<!--end::Container-->
					</div>
					<!--end::Bottom-->
				</div>
				<!--end::Header-->
				<div class="d-flex flex-row flex-column-fluid container">
					<img src="<?php echo $base_url; ?>assets/media/banner.png" class="w-100" alt="" />
				</div>