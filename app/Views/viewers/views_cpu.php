
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

                		<li class="nav-item active">
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
                                                <th>Station No.</th>
                                                <th>Static IP</th>
                                                <th>Agent</th>
                                                <th>Equipment ID</th>
                                                <th>Status</th>
                                                <th>Brand</th>
                                                <th>Model</th>
                                                <th>RAM Size</th>
                                                <th>Processor</th>
                                                <th>Storage Type</th>
                                                <th>Condition</th>
                                                <th>Comment</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($cpu_list as $new): ?>
												<tr>
                                                <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['station_no']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['static_ip']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['agent']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['equip_id']; ?></td>
                                                    <td style="<?php 
                                                        if ($new['status'] === 'Unserviceable') {
                                                            echo 'color: black; background-color: #ff9999;';
                                                        } elseif ($new['status'] === 'Unassigned') {
                                                            echo 'color: white; background-color: gray;';
                                                        } elseif ($new['status'] === 'Assigned') {
                                                            echo 'color: black; background-color: #32CD32;';
                                                        }
                                                    ?>">
                                                        <?php echo $new['status']; ?>
                                                    </td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['brand']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['model']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['ram_size']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['processor']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['storage_type']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['conditions']; ?></td>
                                                    <td style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['comment']; ?></td>
												</tr>
												<?php endforeach; ?>
											</tbody>
                                            <tfoot >
                                            <tr>
                                                <td colspan="2">Unassigned CPU: <strong><?php echo $count_unassigned; ?></strong></td>
                                                <td colspan="2">New Model: <strong><?php echo $count_newModel; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">Assigned CPU: <strong><?php echo $count_assigned; ?></strong></td>
                                                <td colspan="2">Old Model: <strong><?php echo $count_oldModel; ?></strong></td>

                                            </tr>
                                            <tr>
                                                <td colspan="2">Unserviceable CPU: <strong><?php echo $count_unserviceable; ?></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3">Assigned CPU (New Model): <strong><?php echo $count_AsignedNewModel; ?></strong></td>
                                            </tr>
                                            <tr>

                                                <td colspan="3">Assigned CPU (Old Model): <strong><?php echo $count_AsignedOldModel; ?></strong></td>
                                            </tr>
                                        </tfoot>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

<?= $this->include('footers_headers/table_footer') ?>       