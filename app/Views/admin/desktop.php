
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

                        <li class="nav-item active">
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
							        <h1>CPU</h1>
                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">+ <i class="fa fa-cogs"></i></a>
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
                                                <th></th>
												</tr>
											</thead>
											<tbody>
                                            <?php foreach ($machine as $new): ?>
                                                <tr>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['station_no']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['static_ip']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['agent']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['equip_id']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php 
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
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['brand']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['model']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['ram_size']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['processor']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['storage_type']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['conditions']; ?></td>
                                                    <td class="cpu-cell-clickable" style="<?php echo ($new['status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['comment']; ?></td>
                                                    <td style="width:3%">
                                                    <button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>

                                                    <a href="<?= site_url('delete_machine'.$new['id']) ?>" class="fa fa-trash delete" onclick="confirmCPUDelete(event)" style="font-size: 2em; color: red;"></a>
                                                    </td>
                                                </tr>

                                                <!-- EDIT  MODAL -->
                                                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                             <h4 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Equipment ID:</strong><span style="color: red;"><?php echo $new['equip_id']; ?></span> </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('machine/update' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                                            <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                                                            
                                                            <?= csrf_field(); ?>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label>Station No.</label>
                                                                        <input type="text" class="form-control" id="name" name="station_no" value="<?php echo $new['station_no']; ?>" >
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label>Static IP</label>
                                                                        <input type="text" class="form-control" id="name" name="static_ip" value="<?php echo $new['static_ip']; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="agent" class="cpu_agent_name_" id="cpu_agent_name_<?php echo $new['id']; ?>" value="<?php echo $new['agent']; ?>" readonly>
                                                            <input type="hidden" name="agent_fk_id" class="cpu_agent_fk_id_" id="cpu_agent_fk_id_<?php echo $new['id']; ?>" value="<?php echo $new['agent_fk_id']; ?>" readonly>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label for="cpu_agent_dropdown_<?php echo $new['id']; ?>">Agent</label><br>
                                                                        <div class="ui search selection dropdown cpu_agent_dropdown" data-id="<?php echo $new['id']; ?>">
                                                                            <input type="hidden" name="country">
                                                                            <i class="dropdown icon"></i>
                                                                            <div class="default text"><?php echo $new['agent']; ?></div>
                                                                            <div class="menu">
                                                                                <div class="item" data-value="0">None</div>
                                                                                <?php foreach ($agent as $agent_item): ?>
                                                                                    <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                                                                        <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                                                                    </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div id="cpu_agent_id_error_<?php echo $new['id']; ?>" class="text-danger"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label>Status</label>
                                                                    <select class="form-control" id="status" name="status" onchange="cpuEditStatus(this)">
                                                                            <option value="<?php echo $new['status']; ?>" selected disabled><?php echo $new['status']; ?></option>
                                                                            <option value="Unserviceable">Unserviceable</option>
                                                                            <option value="">Others</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label>Brand</label>
                                                                        <input type="text" class="form-control" id="name" name="brand" value="<?php echo $new['brand']; ?>" >
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label>Model</label>
                                                                        <input type="text" class="form-control" id="name" name="model" value="<?php echo $new['model']; ?>" >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                        <div class="form-group mb-2">
                                                                        <label>RAM Size</label>
                                                                            <select class="form-control" id="ram" name="ram_size" onchange="cpuEditRam(this)">
                                                                                <option value="<?php echo $new['ram_size']; ?>"><?php echo $new['ram_size']; ?></option>
                                                                                <option value="4GB">4GB</option>
                                                                                <option value="8GB">8GB</option>
                                                                                <option value="12GB">12GB</option>
                                                                                <option value="16GB">16GB</option>
                                                                                <option value="">Others</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group mb-2">
                                                                        <label>Processor</label>
                                                                            <select class="form-control" id="processor" name="processor" onchange="cpuEditProcessor(this)" >
                                                                                <option value="<?php echo $new['processor']; ?>"><?php echo $new['processor']; ?></option>
                                                                                <option value="Core i3">Core i3</option>
                                                                                <option value="Core i5">Core i5</option>
                                                                                <option value="Core i7">Core i7</option>
                                                                                <option value="AMD Ryzen">AMD Ryzen</option>
                                                                                <option value="">Others</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                <div class="col-md-6">
                                                                        <div class="form-group mb-2">
                                                                        <label>Storage Type</label>
                                                                            <select class="form-control" id="storage_type" name="storage_type" onchange = "cpuEditStorage(this)">
                                                                                <option value="<?php echo $new['storage_type']; ?>"><?php echo $new['storage_type']; ?></option>
                                                                                <option value="SSD">SSD</option>
                                                                                <option value="HDD">HDD</option>
                                                                                <option value="SSD and HDD">SSD and HDD</option>
                                                                                <option value="">Others</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                        <label>Condition</label>
                                                                        <select class="form-control" id="conditions" name="conditions" onchange = "cpuEditCondition(this)">
                                                                            <option value="<?php echo $new['conditions']; ?>"><?php echo $new['conditions']; ?></option>
                                                                            <option value="New Model">New Model</option>
                                                                            <option value="Old Model">Old Model</option>
                                                                            <option value="">Others</option>
                                                                        </select>
                                                                    </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="agentID">Comment</label>
                                                                    <input type="text" class="form-control" id="comment" name="comment" value="<?php echo $new['comment']; ?>">
                                                                </div>

                                                            <div class="row">
                                                                <div class="col-md-12 text-right">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" id="updateCPU_<?php echo $new['id']; ?>" class="btn btn-success " >Save</button>
                                                                </div>
                                                            </div>
                                                        </form>

                                                        </div>
                                                    </div>
                                                    </div>
                                                </div>
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



            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add CPU</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="<?= site_url('add_cpu') ?>" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="agentID">Equipment ID</label>
                                    <input type="text" class="form-control" id="cpu_equip_id" name="equip_id" required>
                                    <div id="cpu_equip_id_error" class="text-danger"></div> <!-- Error message container -->
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group mb-2">
                                            <label>Station Number</label>
                                                <input type="text" class="form-control" id="station_no" name="station_no">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>Static IP</label>
                                            <input type="text" class="form-control" id="static_ip" name="static_ip">
                                        </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group mb-2">
                                            <label>Brand</label>
                                                <input type="text" class="form-control" id="brand" name="brand">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>Model</label>
                                            <input type="text" class="form-control" id="model" name="model">
                                        </div>
                                        </div>
                                    </div>

                                <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group mb-2">
                                            <label>Processor</label>
                                                <select class="form-control" id="processor" name="processor" onchange="cpuaddprocessor(this)">
                                                    <option value="Core i3">Core i3</option>
                                                    <option value="Core i5">Core i5</option>
                                                    <option value="Core i7">Core i7</option>
                                                    <option value="AMD Ryzen">AMD Ryzen</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>RAM</label>
                                            <select class="form-control" id="ram_size" name="ram_size" onchange = "cpuaddRam(this)">
                                                <option value="4GB">4GB</option>
                                                <option value="8GB">8GB</option>
                                                <option value="12GB">12GB</option>
                                                <option value="16GB">16GB</option>
                                                <option value="">Others</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                    <div class="col-md-6">
                                            <div class="form-group mb-2">
                                            <label>Storage Type</label>
                                                <select class="form-control" id="storage_type" name="storage_type" onchange="cpuaddstorage(this)">
                                                    <option value="SSD">SSD</option>
                                                    <option value="HDD">HDD</option>
                                                    <option value="SSD and HDD">SSD and HDD</option>
                                                    <option value="">Others</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label>Condition</label>
                                            <select class="form-control" id="conditions" name="conditions" onchange="cpuAddCondition(this)">
                                                <option value="New Model">New Model</option>
                                                <option value="Old Model">Old Model</option>
                                                <option value="">Others</option>
                                            </select>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-success" >Insert</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>





<script src="<?= base_url('template//jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template//system_scripts.js') ?>"></script>
<script src="<?= base_url('template//semantic.min.js') ?>"></script>

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