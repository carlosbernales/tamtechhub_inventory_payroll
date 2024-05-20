
<?= $this->include('footers_headers/table_header') ?>

<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						
						
            		<li class="nav-item active">
							<a href="<?php echo base_url('dashboard/viewers'); ?>">
								<i class="fa fa-book"></i>
								<p>Dashboard</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item">
							<a href="<?php echo base_url('agent/viewers'); ?>">
								<i class="fa fa-user-secret"></i>
								<p>Agents</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item">
							<a href="<?php echo base_url('cpu/viewers'); ?>">
								<i class="fa fa-cogs"></i>
								<p>CPU</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item">
							<a href="<?php echo base_url('headset/viewers'); ?>">
								<i class="fa fa-headphones"></i>
								<p>Headset</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item">
							<a href="<?php echo base_url('mouse/viewers'); ?>">
								<i class="fa fa-mouse-pointer"></i>
								<p>Mouse</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item">
							<a href="<?php echo base_url('keyboard/viewers'); ?>">
								<i class="fa fa-keyboard"></i>
								<p>Keyboard</p>
								<span class="badge badge-success"></span>
							</a>
						</li>


                		<li class="nav-item submenu">
							<a data-toggle="collapse" href="#tables">
								<i class="fas fa-desktop"></i>
								<p>Monitor</p>
								<span class="caret"></span>
							</a>
							<div class="collapse " id="tables">
								<ul class="nav nav-collapse">
									<li >
										<a href="<?php echo base_url('monitor/viewers'); ?>">
											<span class="sub-item">Monitor List</span>
										</a>
									</li>
									<li >
										<a href="<?php echo base_url('agentmonitor/viewers'); ?>">
											<span class="sub-item">Agent Monitor</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

                		<li class="nav-item ">
							<a href="<?php echo base_url('phone/viewers'); ?>">
								<i class="fas fa-phone"></i>
								<p>Phone</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

						<li class="nav-item ">
							<a href="<?php echo base_url('sgsimcard/viewers'); ?>">
                            <i class="fas fa-sim-card"></i>
								<p>SG Simcard</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item">
							<a href="<?php echo base_url('laptop/viewers'); ?>">
								<i class="fas fa-laptop"></i>
								<p>Laptop</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                        
                		<li class="nav-item">
							<a href="<?php echo base_url('webcam/viewers'); ?>">
								<i class="fas fa-video"></i>
								<p>Webcam</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                        
                		<li class="nav-item">
							<a href="<?php echo base_url('locker/viewers'); ?>">
								<i class="fa fa-lock locker"></i>
								<p>Locker</p>
								<span class="badge badge-success"></span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>









    


		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<!-- Card -->
					<h4 class="page-title">Dashboard</h4>
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-primary card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="flaticon-users"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Agents</p>
												<h4 class="card-title"><?php echo $count_agents; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-info card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-cogs"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">CPU's</p>
												<h4 class="card-title"><?php echo $count_cpu; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-success card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-headphones"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Headset</p>
												<h4 class="card-title"><?php echo $count_headset; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-secondary card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-mouse-pointer"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Mouse</p>
												<h4 class="card-title"><?php echo $count_mouse; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Color -->
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fa fa-keyboard text-warning"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Keyboard</p>
												<h4 class="card-title"><?php echo $count_keyboard; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-desktop text-success"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Monitor</p>
												<h4 class="card-title"><?php echo $count_monitor; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-phone text-danger"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Phone</p>
												<h4 class="card-title"><?php echo $count_phone; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row">
										<div class="col-5">
											<div class="icon-big text-center">
												<i class="fas fa-laptop text-primary"></i>
											</div>
										</div>
										<div class="col-7 col-stats">
											<div class="numbers">
												<p class="card-category">Laptop</p>
												<h4 class="card-title"><?php echo $count_phone; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Card With Icon States Background -->
					<div class="row">
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body ">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-primary bubble-shadow-small">
												<i class="fas fa-video"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Webcam</p>
												<h4 class="card-title"><?php echo $count_webcam; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-info bubble-shadow-small">
												<i class="fa fa-lock locker"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Locker</p>
												<h4 class="card-title"><?php echo $count_locker; ?></h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-success bubble-shadow-small">
												<i class="flaticon-graph"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Sales</p>
												<h4 class="card-title">$ 1,345</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
						<!-- <div class="col-sm-6 col-md-3">
							<div class="card card-stats card-round">
								<div class="card-body">
									<div class="row align-items-center">
										<div class="col-icon">
											<div class="icon-big text-center icon-secondary bubble-shadow-small">
												<i class="flaticon-success"></i>
											</div>
										</div>
										<div class="col col-stats ml-3 ml-sm-0">
											<div class="numbers">
												<p class="card-category">Order</p>
												<h4 class="card-title">576</h4>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			</div>
			<?= $this->include('footers_headers/table_footer') ?>       
