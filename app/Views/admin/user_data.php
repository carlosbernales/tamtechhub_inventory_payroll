
<?= $this->include('footers_headers/table_header') ?>
<style>
    .input-checkbox {
    margin-left: 30px; /* Adjust the margin-left as needed */
}
</style>

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
 
						<li class="nav-item  submenu">
							<a data-toggle="collapse" href="#sidebarLayouts">
								<i class="fas fa-th-list"></i>
								<p>Agents</p>
								<span class="caret"></span>
							</a>
							<div class="collapse " id="sidebarLayouts">
								<ul class="nav nav-collapse">
									<?php if(session()->get('isIT')): ?>
										<li>
											<a href="<?php echo base_url('IT_agent/list'); ?>">
												<span class="sub-item">Active Agent</span>
											</a>
										</li>
									<?php elseif(session()->get('isAdmin') || session()->get('isSuperAdmin')): ?>
										<li >
											<a href="<?php echo base_url('agents'); ?>">
												<span class="sub-item">Active Agent</span>
											</a>
										</li>
									<?php endif; ?>

									<?php if(session()->get('isIT')): ?>
										<li >
											<a href="<?php echo base_url('dashboard'); ?>">
												<span class="sub-item">Resigned/Terminated</span>
											</a>
										</li>
									<?php elseif(session()->get('isAdmin') || session()->get('isSuperAdmin')): ?>
										<li >
											<a href="<?php echo base_url('resigned/agents'); ?>">
												<span class="sub-item">Resigned/Terminated</span>
											</a>
										</li>
									<?php endif; ?>
								</ul>
							</div>
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
              <section style="background-color: #00FF7F;">
                <div class="container py-5">
                  <div class="row">
                    <div class="col-lg-4">
                    <?php if (session()->has('success')) : ?>
                      <div class="alert alert-success"><?= session('success') ?></div>
                    <?php endif; ?>

                    <?php if (session()->has('error')) : ?>
                      <div class="alert alert-danger"><?= session('error') ?></div>
                    <?php endif; ?>
                    <div class="card mb-4">
                    <div class="card-body text-center">
                      <a href="#" data-toggle="modal" data-target="#profile_image">
                        <?php if(isset($userData['profile_image']) && !empty($userData['profile_image'])): ?>
                          <img src="<?= base_url("image/profile_imageUpload/".$userData['profile_image']); ?>"  alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <?php else: ?>
                          <img src="<?= base_url('template/assets/img/no_dp.jpg') ?>"  alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                        <?php endif; ?>
                      </a>
                      <h5 class="my-3"><?= isset($userData['firstname']) ? $userData['firstname'] : '' ?> <?= isset($userData['lastname']) ? $userData['lastname'] : '' ?></h5>
                  </div>
                  </div>

                      <!-- <div class="card mb-4 mb-lg-0">
                        <div class="card-body p-0">
                          <ul class="list-group list-group-flush rounded-3">
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                              <i class="fas fa-globe fa-lg text-warning"></i>
                              <p class="mb-0">https://mdbootstrap.com</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                              <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                              <p class="mb-0">mdbootstrap</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                              <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                              <p class="mb-0">@mdbootstrap</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                              <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                              <p class="mb-0">mdbootstrap</p>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                              <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                              <p class="mb-0">mdbootstrap</p>
                            </li>
                          </ul>
                        </div>
                      </div> -->
                    </div>
                    <div class="col-lg-8">
                      <div class="card mb-4">
                        <div class="card-body">
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0"><strong>Full Name</strong></p>
                            </div>
                            <div class="col-sm-9">
                            <span class="field-value">
                              <?= isset($userData['firstname']) ? $userData['firstname'] : '' ?> <?= isset($userData['lastname']) ? $userData['lastname'] : '' ?>
                            <a class="edit-icon" data-toggle="modal" data-target="#fullnameModel">
                                <span class="fa fa-edit" style="font-size: 18px; font-weight: bold; color: red; cursor: pointer;"></span>
                              </a>
                            </span>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0"><strong>Username</strong></p>
                            </div>
                            <div class="col-sm-9">
                            <span class="field-value">
                              <?= isset($userData['username']) ? $userData['username'] : '' ?>
                            <a class="edit-icon" data-toggle="modal" data-target="#usernameModal">
                                <span class="fa fa-edit" style="font-size: 18px; font-weight: bold; color: red; cursor: pointer;"></span>
                              </a>
                            </span>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0"><strong>Email</strong></p>
                            </div>
                            <div class="col-sm-9">
                            <span class="field-value">
                              <?= isset($userData['email']) ? $userData['email'] : '' ?>
                              <a class="edit-icon" data-toggle="modal" data-target="#emailModal">
                                <span class="fa fa-edit" style="font-size:18px; font-weight: bold; color: red; cursor: pointer;"></span>
                              </a>
                            </span>
                            </div>
                          </div>
                          <hr>
                          <div class="row">
                            <div class="col-sm-3">
                              <p class="mb-0"><strong>Password</strong></p>
                            </div>
                            <div class="col-sm-9">
                            <a class="edit-icon" data-toggle="modal" data-target="#passwordModal">
                              <span class="fa fa-edit" style="font-size: 18px; font-weight: bold; color: red; cursor: pointer;"></span>
                            </a>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- <div class="row">
                        <div class="col-md-6">
                          <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                              <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                              </p>
                              <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                              <div class="progress rounded mb-2" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="card mb-4 mb-md-0">
                            <div class="card-body">
                              <p class="mb-4"><span class="text-primary font-italic me-1">assigment</span> Project Status
                              </p>
                              <p class="mb-1" style="font-size: .77rem;">Web Design</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">Website Markup</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 72%" aria-valuenow="72"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">One Page</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 89%" aria-valuenow="89"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">Mobile Template</p>
                              <div class="progress rounded" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 55%" aria-valuenow="55"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                              <p class="mt-4 mb-1" style="font-size: .77rem;">Backend API</p>
                              <div class="progress rounded mb-2" style="height: 5px;">
                                <div class="progress-bar" role="progressbar" style="width: 66%" aria-valuenow="66"
                                  aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div> -->

                      <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="<?= site_url('profilePassword/update') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group mb-2">
                                <input type="password" id="password" name="password" class="form-control" required placeholder="Enter your new password">
                                <div id="password_error" class="text-danger"></div> <!-- Error message container -->
                                  <input name="id" type="hidden"  value="<?= isset($userData['id']) ? $userData['id'] : '' ?>">
                                </div>
                              </div>

                              <div class="col-md-12">
                                <div class="form-group mb-2">
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required placeholder="Confirm your password">
                                <div id="confirm_password_error" class="text-danger"></div> <!-- Error message container -->
                                </div>
                              </div>

                              <div class="form-group">
                                <input type="checkbox" class="input-checkbox" id="show_password_checkbox">
                                <label for="show_password_checkbox" class="input-label">Show Password</label>
                            </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary px-4 float-right">Save</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                
                


                    <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="<?= site_url('profilEmail/update') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <input type="email" id ="email_profile" name="email" class="form-control" required placeholder="Enter your new email">
                                    <input name="id" type="hidden"  value="<?= isset($userData['id']) ? $userData['id'] : '' ?>">
                                    <input name="old_email" type="hidden"  value="<?= isset($userData['email']) ? $userData['email'] : '' ?>">

                                    <div id="email_profile_error" class="text-danger"></div> <!-- Error message container -->
                                </div>
                              </div>
                            </div>
                            <hr>
                            <button type="submit" id = "email_profile_btn" class="btn btn-primary px-4 float-right">Save</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    

                    <div class="modal fade" id="fullnameModel" tabindex="-1" role="dialog" aria-labelledby="fullnameModelLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="<?= site_url('profilfullname/update') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <input type="text" value="<?= isset($userData['firstname']) ? $userData['firstname'] : '' ?>" name="firstname" class="form-control" required placeholder="Firstname" >
                                    <input type="text" value="<?= isset($userData['lastname']) ? $userData['lastname'] : '' ?>" name="lastname" class="form-control" required placeholder="Lastname" >
                                </div>
                              </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary px-4 float-right">Save</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="modal fade" id="profile_image" tabindex="-1" role="dialog" aria-labelledby="profile_imageLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="<?= site_url('profileImage/update') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group mb-2">
                                    <input type="file"  name="profile_image" class="form-control" required placeholder="Firstname" >
                                    <input name="id" type="hidden"  value="<?= isset($userData['id']) ? $userData['id'] : '' ?>">
                                </div>
                              </div>
                            </div>
                            <hr>
                            <button type="submit" class="btn btn-primary px-4 float-right">Save</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>

                    


                    



                    <div class="modal fade" id="usernameModal" tabindex="-1" role="dialog" aria-labelledby="usernameModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form action="<?= site_url('profilUsername/update') ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field(); ?>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="form-group mb-2">
                                  <input type="text" id="username_profile"name="username" class="form-control" required placeholder="Enter your new username">
                                  <input name="id" type="hidden"  value="<?= isset($userData['id']) ? $userData['id'] : '' ?>">
                                  <div id="username_profile_error" class="text-danger"></div> 
                                </div>
                              </div>
                            </div>
                            <hr>
                            <button type="submit" id = "username_profile_btn" class="btn btn-primary px-4 float-right">Save</button>
                          </form>
                          </div>
                        </div>
                      </div>
                    </div>
                    </div>
                  </div>
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

<script>

const showPasswordCheckbox = document.getElementById('show_password_checkbox');
        const passwordInput = document.getElementById('password');
        const confirmPassInput = document.getElementById('confirm_password');

        showPasswordCheckbox.addEventListener('change', () => {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
                confirmPassInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirmPassInput.type = 'password';
            }
        });
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>

           


<?= $this->include('footers_headers/table_footer') ?>       