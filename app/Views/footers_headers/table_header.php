<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>TAMTECH</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link rel="icon" href="<?= base_url('logindes/images/tamtechlogo.png') ?>" type="image/x-icon"/>
	
	<!-- Fonts and icons -->
	<script src="<?= base_url('template/assets/js/plugin/webfont/webfont.min.js') ?>"></script>
	<link rel="stylesheet" href="<?= base_url('template/semantic.min.css') ?>">
	<script>
		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['<?= base_url('template/assets/css/fonts.min.css') ?>']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="<?= base_url('template/assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('template/assets/css/atlantis.min.css') ?>">
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="<?= base_url('template/assets/css/demo.css') ?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

</head>
<body>
	<div class="wrapper sidebar_minimize">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header" data-background-color="white">
				
				<a href="" class="logo">
					<img src="<?= base_url('template/accountability_header.png') ?>" alt="navbar brand" class="navbar-brand" style="width: 170px; height: 40px;">
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
				
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown hidden-caret">
							<a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-bell"></i>
								<span class="notification">4</span>
							</a>
							<ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
								<li>
									<div class="dropdown-title">You have 4 new notification</div>
								</li>
								<li>
								


								</li>
								<li>
									<a class="see-all" href="javascript:void(0);">See all notifications<i class="fa fa-angle-right"></i> </a>
								</li>
							</ul>
						</li>


						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<?php if(isset($userData['profile_image']) && !empty($userData['profile_image'])): ?>
										<img src="<?= base_url("image/profile_imageUpload/".$userData['profile_image']); ?>" alt="..." class="avatar-img rounded-circle">
									<?php else: ?>
										<img src="<?= base_url('template/assets/img/no_dp.jpg') ?>" alt="..." class="avatar-img rounded-circle">
									<?php endif; ?>
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
										
										<div class="avatar-lg">
											<?php if(isset($userData['profile_image']) && !empty($userData['profile_image'])): ?>
												<img src="<?= base_url("image/profile_imageUpload/".$userData['profile_image']); ?>" alt="image profile" class="avatar-img rounded">
											<?php else: ?>
												<img src="<?= base_url('template/assets/img/no_dp.jpg') ?>" alt="image profile" class="avatar-img rounded">
											<?php endif; ?>
										</div>

											<div class="u-text">
												<h4><?= isset($userData['firstname']) ? $userData['firstname'] : '' ?> <?= isset($userData['lastname']) ? $userData['lastname'] : '' ?></h4>
												<a href="<?= base_url('users/data') ?>" class="btn btn-xs btn-secondary btn-sm">View Profile</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url('users/list') ?>">Users</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>