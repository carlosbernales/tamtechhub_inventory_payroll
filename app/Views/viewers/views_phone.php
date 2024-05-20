
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

                		<li class="nav-item active">
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
                                                    <th>Agent</th>
                                                    <th>Equipment ID</th>
                                                    <th>Status</th>
                                                    <th>Brand</th>
                                                    <th>Model</th>
                                                    <th>Condition</th>
                                                    <th style="border-right: 2px solid green;">Comment</th>
                                                    <th>Number</th>
                                                    <th>WhatsApp Account 1</th>
                                                    <th style="border-right: 2px solid green;">Condition</th>
                                                    <th>Number</th>
                                                    <th>WhatsApp Account 2</th>
                                                    <th style="border-right: 2px solid green;">Condition</th>
                                                    <th>Number</th>
                                                    <th>WhatsApp Account 3</th>
                                                    <th style="border-right: 2px solid green;" >Condition</th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($phone_list as $new): ?>
												<tr>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_agent_name']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_equip_id']; ?></td>
                                                    <td style="<?php 
                                                            if ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') {
                                                                echo 'color: black; background-color: #ff9999;';
                                                            } elseif ($new['phone_status'] === 'Unassigned') {
                                                                echo 'color: white; background-color: gray;';
                                                            } elseif ($new['phone_status'] === 'Assigned') {
                                                                echo 'color: black; background-color: #32CD32;';
                                                            }
                                                        ?>">
                                                            <?php echo $new['phone_status']; ?>
                                                        </td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_brand']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_model']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_condition']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;" ><?php echo $new['phone_comment']; ?></td>


                                                    <!-- Second set of columns -->
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_number_one']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['whatsapp_acc_one']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;" ><?php echo $new['whatsapp_acc_one_cond']; ?></td>

                                                    <!-- Third set of columns -->
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_number_two']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['whatsapp_acc_two']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;" ><?php echo $new['whatsapp_acc_two_cond']; ?></td>

                                                    <!-- Fourth set of columns -->
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['phone_number_three']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['whatsapp_acc_three']; ?></td>
                                                    <td style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;" ><?php echo $new['whatsapp_acc_three_cond']; ?></td>
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