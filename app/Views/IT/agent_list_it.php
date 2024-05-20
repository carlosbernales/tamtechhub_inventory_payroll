
<?= $this->include('footers_headers/table_header') ?>

<link rel="stylesheet" href="<?= base_url('template/system_scripts.css') ?>">
<style>     
   .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black for the blur effect */
        backdrop-filter: blur(5px); /* CSS blur effect */
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }

    .preloader img {
        width: 100px; /* Adjust as needed */
        height: 100px; /* Adjust as needed */
        border-radius: 20%; /* Make the image round */
        padding: 10px; /* Increase padding for larger white background */
        background-color: white; /* Set background color to white */
        animation: bounceRotate 1s ease-in-out infinite alternate; /* Bouncing and rotating animation */
    }

    @keyframes bounceRotate {
        0% {
            transform: translateY(0) rotate(0deg);
        }
        100% {
            transform: translateY(-10px) rotate(360deg);
        }
    }
</style>
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

						<?php if (session()->get('isIT')): ?>
                            <li class="nav-item active">
                                <a href="<?php echo base_url('IT_agent/list'); ?>">
                                    <i class="fa fa-users"></i>
                                    <p>Agents</p>
                                    <span class="badge badge-success"></span>
                                </a>
                            </li>
                        <?php elseif (session()->get('isAdmin') || session()->get('isSuperAdmin')): ?>
                            <li class="nav-item active">
                                <a href="<?php echo base_url('agents'); ?>">
                                    <i class="fa fa-users"></i>
                                    <p>Agents</p>
                                    <span class="badge badge-success"></span>
                                </a>
                            </li>
                        <?php endif; ?>


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


		
    <div class="preloader">
        <img src="<?= base_url('logindes/images/tamtechlogo.png') ?>" alt="Preloader">
    </div>


		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
							<div class="card-header" style="display: flex; justify-content: space-between;">
									<a href="#" class="btn btn-success " data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">+ <i class="flaticon-users"></i></a>
                                </div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="table table-bordered table-head-bg-info table-bordered-bd-success" >
											<thead>
												<tr>
													<th>Agent</th>
													<th>Agent ID</th>
													<th>Campaign</th>
													<th></th>
												</tr>
											</thead>
											<tbody>
											<?php foreach ($agent_list as $new): ?>
												<tr>
													<td class="agent-list-IT-cell-clickable"><?php echo $new['agent_name']; ?></td>
													<td class="agent-list-IT-cell-clickable"><?php echo $new['agent_id']; ?></td>
													<td class="agent-list-IT-cell-clickable"><?php echo $new['campaign']; ?></td>
													<td style="width:3%">
													<button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>
													<a href="<?= site_url('delete_agents'.$new['id']) ?>" class="fa fa-trash delete" style="font-size: 2em; color: red;" onclick="confirmAgentDelete(event)"></a>
													</td>
												</tr>

												<!-- EDIT  MODAL -->
													<div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
														<div class="modal-dialog modal-dialog-centered" role="document">
														<div class="modal-content">
															<div class="modal-header">
															<h4 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Agent ID:</strong> <span style="color: red;"><?php echo $new['agent_id']; ?></span></h4>

															<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
															</div>
															<div class="modal-body">
															<form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('IT/agents_update' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
															<?= csrf_field(); ?>
															<input type="hidden" name="id" value="<?php echo $new['id']; ?>">


															<div class="form-group">
																<label>Agent ID</label>
																<input type="text" class="form-control"  name="agent_id" value="<?php echo $new['agent_id']; ?>">
																<input type="hidden" class="form-control" name="agent_old" value="<?php echo $new['agent_id']; ?>">
															</div>

															<div class="form-group">
																<label>Agent</label>
																<input type="text" class="form-control" id="agent_name" name="agent_name" value="<?php echo $new['agent_name']; ?>">
															</div>

															<div class="form-group">
																<label>Campaign</label>
																<input type="text" class="form-control" id="campaign" name="campaign" value="<?php echo $new['campaign']; ?>">
															</div>

															<div class="row">
																<div class="col-md-12 text-right">
																	<button type="submit" id="updateheadset" class="btn btn-success" >Save</button>
																</div>
															</div>
														</form>
														</div>
													</div>
													</div>
												</div>
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



      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Agent</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= site_url('IT/add_agent') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="agentName">Agent</label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name" required>
                        </div>
                        <div class="form-group">
                            <label for="agentID">Agent ID</label>
                            <input type="text" class="form-control" id="agentlist_agent_id" name="agent_id">
                            <div id="agentlist_agent_id_error" class="text-danger"></div> <!-- Error message container -->
                        </div>

                        <div class="form-group">
                            <label for="anotherAgentName">Campaign</label>
                            <input type="text" class="form-control" id="campaign" name="campaign" >
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="agentlist_updateBtn">Insert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/system_scripts.js') ?>"></script>

<script>
window.addEventListener('load', () => {
    const preloader = document.querySelector('.preloader');
    preloader.style.display = 'none';
});
</script>
 
<?php
include_once('template/system_scripts.php');
?>

<?= $this->include('footers_headers/table_footer') ?>       