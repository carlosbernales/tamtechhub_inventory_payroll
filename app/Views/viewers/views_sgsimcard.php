
<?= $this->include('footers_headers/table_header') ?>

<link rel="stylesheet" href="<?= base_url('template/system_scripts.css') ?>">

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">
						
						
					<li class="nav-item">
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

						<li class="nav-item active">
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
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="table table-bordered table-head-bg-info table-bordered-bd-success" >
											<thead>
												<tr>
                                                    <th>Number</th>
                                                    <th>Serial Number (last 4 digit)</th>
                                                    <th>User</th>
                                                    <th>Used in</th>
                                                    <th>Remarks</th>
                                                    <th>Phone Serial Number</th>
                                                    <th>Load Expired </th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($sgsimcard_list as $new): ?>
												<tr>
                                                <td><?php echo $new['number']; ?></td>
                                                    <td><?php echo $new['serial_no']; ?></td>
                                                    <td><?php echo $new['agent']; ?></td>
                                                    <td style="<?php
                                                        if ($new['used_in'] === 'WhatsApp and Simba Voice') {
                                                            echo 'background-color: #87CEEB;';
                                                        } elseif ($new['used_in'] === 'Simba Voice Only') {
                                                            echo 'background-color: #F0E68C;';
                                                        } elseif ($new['used_in'] === 'WhatsApp Only') {
                                                            echo 'background-color: #F08080;';
                                                        } elseif ($new['used_in'] === 'Never Use') {
                                                            echo 'background-color: #EE82EE;';
                                                        }
                                                    ?>"><?php echo $new['used_in']; ?></td>

                                                    <td><?php echo $new['remarks']; ?></td>
                                                    <td><?php echo $new['phone_serial_no']; ?></td>
                                                    <td><?php echo $new['load_expired']; ?></td>
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

<?= $this->include('footers_headers/table_footer') ?>       