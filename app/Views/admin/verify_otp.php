
<?= $this->include('footers_headers/table_header') ?>

<link rel="stylesheet" href="<?= base_url('template/system_scripts.css') ?>">

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						
						
            			<li class="nav-item">
							<a href="<?php echo base_url('dashboard'); ?>">
								<i class="fa fa-book"></i>
								<p>Dashboard</p>
								<span class="badge badge-success"></span>
							</a>
						</li>
 
            			<li class="nav-item">
							<a href="<?php echo base_url('agents'); ?>">
								<i class="fa fa-user-secret"></i>
								<p>Agents</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            			<li class="nav-item">
							<a href="<?php echo base_url('machine'); ?>">
								<i class="fa fa-cogs"></i>
								<p>CPU</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            			<li class="nav-item">
							<a href="<?php echo base_url('headset'); ?>">
								<i class="fa fa-headphones"></i>
								<p>Headset</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            			<li class="nav-item">
							<a href="<?php echo base_url('mouse'); ?>">
								<i class="fas fa-mouse"></i>
								<p>Mouse</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            			<li class="nav-item">
							<a href="<?php echo base_url('keyboard'); ?>">
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
										<a href="<?php echo base_url('monitor'); ?>">
											<span class="sub-item">Monitor List</span>
										</a>
									</li>
									<li >
										<a href="<?php echo base_url('agent_monitor'); ?>">
											<span class="sub-item">Agent Monitor</span>
										</a>
									</li>
								</ul>
							</div>
						</li>

            			<li class="nav-item ">
							<a href="<?php echo base_url('phone/list'); ?>">
								<i class="fas fa-phone"></i>
								<p>Phone</p>
								<span class="badge badge-success"></span>
							</a>
						</li>
						
						<li class="nav-item ">
							<a href="<?php echo base_url('fiveGsimcard/list'); ?>">
                            <i class="fas fa-sim-card"></i>
								<p>SG Simcard</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            			<li class="nav-item">
							<a href="<?php echo base_url('laptop/list'); ?>">
								<i class="fas fa-laptop"></i>
								<p>Laptop</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                        
            			<li class="nav-item">
							<a href="<?php echo base_url('webcam/list'); ?>">
								<i class="fas fa-video"></i>
								<p>Webcam</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                        
            			<li class="nav-item">
							<a href="<?php echo base_url('locker/list'); ?>">
								<i class="fa fa-lock locker"></i>
								<p>Locker</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            			<li class="nav-item">
							<a href="<?php echo base_url('accountability_form'); ?>">
								<i class="fas fa-balance-scale"></i>
								<p>Accountability Form</p>
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
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Start Account Login Area -->
                        <div class="account-login section">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                                        <form method="post" action="<?= site_url('verifyOTP') ?>">
                                            <?php $validation =  \Config\Services::validation(); ?>
                                            <?= csrf_field(); ?>
                                            <div class="card-body">
                                                <div class="title text-center">
                                                    <h3>OTP Verification</h3>
                                                </div>
                                                <div class="alert alert-success">
                                                    <p>An OTP will be sent to <span style="color: blue;"><?= $email ?></span> for verification.</p>
                                                </div>
                                                <div class="form-group input-group">
                                                    <input type="text" id="otp" name="otp" class="form-control" required>
                                                    <input type="hidden" name="old_email" value="<?= $old_email ?>">
                                                    <input type="hidden" name="email" value="<?= $email ?>">
                                                </div>
                                                <div>
                                                    <?php if (session()->has('error')) : ?>
                                                        <div class="text-danger text-center"><?= session('error') ?></div>
                                                    <?php endif; ?>
                                                </div>
                                                <br>
                                                <div class="text-center"> <!-- Added a div and applied text-center class -->
                                                    <button class="btn btn-primary" type="submit">Verify OTP</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Account Login Area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/system_scripts.js') ?>"></script>
<script src="<?= base_url('template/semantic.min.js') ?>"></script>


<?php
include_once('template/system_scripts.php');
?>

           


<?= $this->include('footers_headers/table_footer') ?>       