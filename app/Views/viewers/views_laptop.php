
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

						<li class="nav-item ">
							<a href="<?php echo base_url('sgsimcard/viewers'); ?>">
                            <i class="fas fa-sim-card"></i>
								<p>SG Simcard</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

                		<li class="nav-item active">
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
                                                    <th>Agent</th>
                                                    <th>Equipment ID</th>
                                                    <th>Status</th>
                                                    <th>Brand</th>
                                                    <th>Model</th>
                                                    <th>RAM</th>
                                                    <th>Processor</th>
                                                    <th>Storage</th>
                                                    <th>Condition</th>
                                                    <th>Comment</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($laptop_list as $new): ?>
												<tr>
                                                <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_agent']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_equip_id']; ?></td>
                                                    <td style="<?php 
                                                        if ($new['laptop_status'] === 'Unserviceable') {
                                                            echo 'color: black; background-color: #ff9999;';
                                                        } elseif ($new['laptop_status'] === 'Unassigned') {
                                                            echo 'color: white; background-color: gray;';
                                                        } elseif ($new['laptop_status'] === 'Assigned') {
                                                            echo 'color: black; background-color: #32CD32;';
                                                        }
                                                    ?>">
                                                        <?php echo $new['laptop_status']; ?>
                                                    </td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_brand']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_model']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_ram']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_processor']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_storage']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_condition']; ?></td>
                                                    <td style="<?php echo ($new['laptop_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['laptop_comment']; ?></td>
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