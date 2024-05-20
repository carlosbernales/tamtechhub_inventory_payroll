
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
                            <li class="nav-item">
                                <a href="<?php echo base_url('IT_agent/list'); ?>">
                                    <i class="fa fa-users"></i>
                                    <p>Agents</p>
                                    <span class="badge badge-success"></span>
                                </a>
                            </li>
                        <?php elseif (session()->get('isAdmin') || session()->get('isSuperAdmin')): ?>
                            <li class="nav-item">
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


                        <li class="nav-item active submenu">
							<a data-toggle="collapse" href="#tables">
								<i class="fas fa-desktop"></i>
								<p>Monitor</p>
								<span class="caret"></span>
							</a>
							<div class="collapse show " id="tables">
								<ul class="nav nav-collapse">
									<li  >
										<a href="<?php echo base_url('monitor'); ?>">
											<span class="sub-item">Monitor List</span>
										</a>
									</li>
									<li class="active">
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
								<div class="card-header">
                                 <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">+ Agent</a>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="table table-bordered table-head-bg-info table-bordered-bd-success" >
											<thead>
												<tr>
                                                <th>Agent</th>
                                                <th>First Monitor</th>
                                                <th>Second Monitor</th>
                                                <th></th>
												</tr>
											</thead>
											<tbody>
                                            <?php foreach ($agent_monitor as $new): ?>
                                                <tr>
                                                    <td class="agent-monitor-cell-clickable"><?php echo $new['agent']; ?></td>
                                                    <td class="agent-monitor-cell-clickable" style="<?php echo ($new['monitor_one'] === 'None') ? 'color: white; background-color: gray;' : ''; ?>"><?php echo $new['monitor_one']; ?></td>
                                                    <td class="agent-monitor-cell-clickable" style="<?php echo ($new['monitor_two'] === 'None') ? 'color: white; background-color: gray;' : ''; ?>"><?php echo $new['monitor_two']; ?></td>
                                                    <td style="width:3%">
                                                    <button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>
                                                    
                                                    </td>
                                                </tr>

                                                <!-- EDIT  MODAL -->
                                                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('monitor_agent/update' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                                            <?= csrf_field(); ?>
                                                            <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                                                            <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label for="agent_monitor_agent_edit_dropdown_<?php echo $new['id']; ?>">Agent</label><br>
                                                                        <div class="ui search selection dropdown agent_monitor_agent_edit_dropdown" data-id="<?php echo $new['id']; ?>">
                                                                            <input type="hidden" name="country">
                                                                            <i class="dropdown icon"></i>
                                                                            <div class="default text"><?php echo $new['agent']; ?></div>
                                                                            <div class="menu">
                                                                                <div class="item" data-value="0">None</div>
                                                                                <?php foreach ($agent as $agent_item): ?>
                                                                                    <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                                                                        <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                                                                        <span class="hidden"><?php echo $agent_item['id']; ?></span>
                                                                                    </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <input type="hidden" name="agent" id="monitor_agent_edit_agent_name_<?php echo $new['id']; ?>" class="form-control" readonly>
                                                                    <input type="hidden" name="agent_fk_id" id="monitor_agent_edit_agent_fk_id_<?php echo $new['id']; ?>" value ="<?php echo $new['agent_fk_id']; ?>"class="form-control" readonly>
                                                                    <input type="hidden" class="form-control" name="agent_fk_id_old" value="<?php echo $new['agent_fk_id']; ?>" readonly>
                                                                </div>
                                                                
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label for="edit_firstmonitor_dropdown_<?php echo $new['id']; ?>">First Monitor</label>
                                                                        <div class="ui search selection dropdown edit_firstmonitor_dropdown" data-id="<?php echo $new['id']; ?>">
                                                                            <input type="hidden" name="country">
                                                                            <i class="dropdown icon"></i>
                                                                            <div class="default text"><?php echo $new['monitor_one']; ?></div>
                                                                            <div class="menu">
                                                                                <div class="item" data-value="0">None</div>
                                                                                <?php foreach ($monitor as $monitors): ?>
                                                                                    <div class="item" data-value="<?php echo $monitors['id']; ?>">
                                                                                        <span class="text"><?php echo $monitors['monitor_equip_id']; ?></span>
                                                                                        <span class="hidden"><?php echo $monitors['id']; ?></span>
                                                                                    </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div id="edit_first_monitor_error_<?php echo $new['id']; ?>" class="text-danger"></div>
                                                                    </div>
                                                                    <input type="hidden" id="edit_monitor_one_<?php echo $new['id']; ?>" class="form-control " name="monitor_one" value="" readonly>
                                                                    <input type="hidden" id="edit_monitor_one_fk_<?php echo $new['id']; ?>" class="form-control " name="monitor_one_fk" value="<?php echo $new['monitor_one_fk']; ?>" readonly>
                                                                    <input type="hidden" id="monitor_one_fk_change" class="form-control monitor_one_fk_change" name="monitor_one_fk_change" value="<?php echo $new['monitor_one_fk']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label for="edit_second_monitor_dropdown_<?php echo $new['id']; ?>">Second Monitor</label><br>
                                                                    <div class="ui search selection dropdown edit_second_monitor_dropdown" data-id="<?php echo $new['id']; ?>">
                                                                        <input type="hidden" name="country">
                                                                        <i class="dropdown icon"></i>
                                                                        <div class="default text"><?php echo $new['monitor_two']; ?></div>
                                                                        <div class="menu">
                                                                            <div class="item" data-value="0">None</div>
                                                                            <?php foreach ($monitor as $monitors): ?>
                                                                                <div class="item" data-value="<?php echo $monitors['id']; ?>">
                                                                                    <span class="text"><?php echo $monitors['monitor_equip_id']; ?></span>
                                                                                    <span class="hidden"><?php echo $monitors['id']; ?></span>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                    <div id="edit_second_monitor_error_<?php echo $new['id']; ?>" class="text-danger"></div>
                                                                    </div>
                                                                    <input type="hidden" id="edit_monitor_two_<?php echo $new['id']; ?>" class="form-control " name="monitor_two" value="" readonly>
                                                                    <input type="hidden" id="edit_monitor_two_fk_<?php echo $new['id']; ?>" class="form-control " name="monitor_two_fk" value="<?php echo $new['monitor_two_fk']; ?>" readonly>
                                                                    <input type="hidden" id="monitor_two_fk_change" class="form-control monitor_two_fk_change" name="monitor_two_fk_change" value="<?php echo $new['monitor_two_fk']; ?>" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" id="updateagent_monitor_<?php echo $new['id']; ?>" class="btn btn-success">Save</button>
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
                            <h5 class="modal-title" id="exampleModalLabel">Add Agent Monitor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= site_url('addagent_monitor') ?>" method="POST">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="monitor_agentadd_dropdown_">Agent</label><br>
                                            <div class="ui search selection dropdown monitor_agentadd_dropdown" >
                                                <input type="hidden" name="country">
                                                <i class="dropdown icon"></i>
                                                <div class="default text">None</div>
                                                <div class="menu">
                                                    <?php foreach ($agent as $agent_item): ?>
                                                        <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                                            <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                                            <span class="hidden"><?php echo $agent_item['id']; ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" class="form-control" id="monitor_agent_add_agent_name" name="agent" readonly>
                                        <input type="hidden" class="form-control" id="monitor_agent_add_agent_fk_id" name="agent_fk_id" readonly>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="firstmonitor_dropdown_">First Monitor</label>
                                            <div class="ui search selection dropdown firstmonitor_dropdown" data-id="">
                                                <input type="hidden" name="country">
                                                <i class="dropdown icon"></i>
                                                <div class="default text">None</div>
                                                <div class="menu">
                                                    <div class="item" data-value="0">None</div>
                                                    <?php foreach ($monitor as $monitors): ?>
                                                        <div class="item" data-value="<?php echo $monitors['id']; ?>">
                                                            <span class="text"><?php echo $monitors['monitor_equip_id']; ?></span>
                                                            <span class="hidden"><?php echo $monitors['id']; ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div id="first_monitor_error" class="text-danger"></div> 
                                        </div>
                                        <input type="hidden" id="addmonitor_one" class="form-control" name="monitor_one" readonly>
                                        <input type="hidden" id="addmonitor_one_fk" class="form-control" name="monitor_one_fk" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label for="second_monitor_dropdown_">Second Monitor</label>
                                            <div class="ui search selection dropdown second_monitor_dropdown" data-id="">
                                                <input type="hidden" name="country">
                                                <i class="dropdown icon"></i>
                                                <div class="default text">None</div>
                                                <div class="menu">
                                                    <div class="item" data-value="0">None</div>
                                                    <?php foreach ($monitor as $monitors): ?>
                                                        <div class="item" data-value="<?php echo $monitors['id']; ?>">
                                                            <span class="text"><?php echo $monitors['monitor_equip_id']; ?></span>
                                                            <span class="hidden"><?php echo $monitors['id']; ?></span>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                             <div id="second_monitor_error" class="text-danger"></div> 
                                        </div>
                                        <input type="hidden" id="addmonitor_two" class="form-control" name="monitor_two" readonly>
                                        <input type="hidden" id="addmonitor_two_fk" class="form-control" name="monitor_two_fk" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" id="addagent_monitor">Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





<script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/system_scripts.js') ?>"></script>
<script src="<?= base_url('template/semantic.min.js') ?>"></script>

<script>
    $('.ui.dropdown')
        .dropdown();
</script>

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