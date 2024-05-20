
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
								<div class="card-header">
								<strong style="color: red; ">NOTE: Changing user roles means giving them access to modify system data.
									<br>Superadmin: Full access to the system.
									<br>Admin: Same access as Superadmin, but cannot change user roles.
									<br>IT: Cannot change user roles, cannot view agents' files and cannot access payroll.
									<br>Viewers: Cannot view confidential files, payroll and can only view, not modify.</strong>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="table table-bordered table-head-bg-info table-bordered-bd-success" >
											<thead>
												<tr>
													<th>Firstname</th>
													<th>Lastname</th>
													<th>Username</th>
													<th>Email</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($users as $new): ?>
												<tr>
													<td><?php echo $new['firstname']; ?></td>
													<td><?php echo $new['lastname']; ?></td>
													<td><?php echo $new['username']; ?></td>
													<td><?php echo $new['email']; ?></td>
													<td style ="width:6%">
													<form id="statusForm" method="post" action="<?= base_url('user/update/' . $new['id']) ?>">
													<input type="hidden" name="email" value="<?= $new['email']; ?>" class="form-control">
													<input type="hidden" name="username" value="<?= $new['username']; ?>" class="form-control">
													<input type="hidden" name="id" value="<?= $new['id']; ?>" class="form-control">
													
													<div class="dropdown">
														<button class="btn btn-primary btn-sm  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fas fa-cogs"></i> <?= $new['role']; ?>
														</button>
														<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
															<button class="dropdown-item" type="submit" name="role" value="Admin">Admin</button>
															<button class="dropdown-item" type="submit" name="role" value="Viewers">Viewers</button>
															<button class="dropdown-item" type="submit" name="role" value="Superadmin">Superadmin</button>
															<button class="dropdown-item" type="submit" name="role" value="IT">IT</button>
														</div>
													</div>
												</form>


                                                        </td>
												    </tr>
												<?php endforeach; ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
            <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
            <script src="<?= base_url('template/system_scripts.js') ?>"></script>

            



<?= $this->include('footers_headers/table_footer') ?>       