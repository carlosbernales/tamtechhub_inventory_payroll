
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

                        <li class="nav-item active">
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
							    <h1>Simcards</h1>
                                     <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">+ <i class="fas fa-sim-card"></i></a>
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
                                                    <th></th>
												</tr>
											</thead>
											<tbody>
                                            <?php foreach ($simcard as $new): ?>
                                                <tr>
                                                    <td class="sgsimcard_cell-clickable"><?php echo $new['number']; ?></td>
                                                    <td class="sgsimcard_cell-clickable"><?php echo $new['serial_no']; ?></td>
                                                    <td class="sgsimcard_cell-clickable"><?php echo $new['agent']; ?></td>
                                                    <td class="sgsimcard_cell-clickable" style="<?php
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
                                                    <td class="sgsimcard_cell-clickable"><?php echo $new['remarks']; ?></td>
                                                    <td class="sgsimcard_cell-clickable"><?php echo $new['phone_serial_no']; ?></td>
                                                    <td class="sgsimcard_cell-clickable"><?php echo $new['load_expired']; ?></td>
                                                    <td style="width:3%">
                                                    <button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>

                                                        <a href="<?= site_url('delete/SGsimcard'.$new['id']) ?>" class="fa fa-trash delete" onclick="confirmHeadsetDelete(event)" style="font-size: 2em; color: red;"></a>
                                                    </td>
                                                </tr>

                                                <!-- EDIT  MODAL -->
                                                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                              <h4 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Number: <span style="color: red;"><?php echo $new['number']; ?></span></strong></span> </h4>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form action="<?= site_url('update/SGsimcard') ?>" method="POST">

                                                            <input type="hidden" name="id" value="<?php echo $new['id']; ?>" class="form-control" readonly>

                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="form-group mb-2">
                                                                    <label for="edit_sgsimcard_dropdown_<?php echo $new['id']; ?>">Phone Serial Number</label><br>
                                                                    <div class="ui search selection dropdown edit_sgsimcard_dropdown" data-id="<?php echo $new['id']; ?>">
                                                                        <input type="hidden" name="country">
                                                                        <i class="dropdown icon"></i>
                                                                        <div class="default text"><?php echo $new['phone_serial_no']; ?></div>
                                                                        <div class="menu">
                                                                            <div class="item" data-value="0">None</div>
                                                                            <div class="item" data-value="Personal Phone">
                                                                                <span class="text">Personal Phone</span>
                                                                            </div>
                                                                            <?php foreach ($valid_simcard as $simcard): ?>
                                                                                <div class="item" data-value="<?php echo $simcard['id']; ?>">
                                                                                    <span class="text"><?php echo $simcard['phone_equip_id']; ?></span>
                                                                                    <span class="hidden"><?php echo $simcard['phone_agent_name']; ?></span>
                                                                                    <span class="hidden"><?php echo $simcard['agent_fk_id']; ?></span>
                                                                                    <span class="hidden"><?php echo $simcard['id']; ?></span>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group mb-2">
                                                                    <label for="edit_simcard_agentdropdown_<?php echo $new['id']; ?>">Agent Name:</label>
                                                                        <div class="ui search selection dropdown edit_simcard_agentdropdown" data-id="<?php echo $new['id']; ?>">
                                                                            <input type="hidden" name="country">
                                                                            <i class="dropdown icon"></i>
                                                                            <div class="default text"><?php echo $new['agent']; ?></div>
                                                                            <div class="menu">
                                                                                 <div class="item" data-value="Others">Others</div>
                                                                                <?php foreach ($agent as $agent_item): ?>
                                                                                    <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                                                                        <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                                                                        <span class="hidden"><?php echo $agent_item['id']; ?></span>
                                                                                    </div>
                                                                                <?php endforeach; ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <input type="hidden" name="phone_serial_no" id="edit_phone_serial_no_<?php echo $new['id']; ?>" class="form-control" readonly>
                                                            <input type="hidden" name="phone_fk_id" id="edit_phone_fk_id_<?php echo $new['id']; ?>" readonly>
                                                            <input type="hidden" name="agent_fk_id" id="edit_agent_fk_id_<?php echo $new['id']; ?>" readonly>
                                                            
                                                            <div class="form-group">
                                                                <input type="readonly" name="agent" id="edit_agent_<?php echo $new['id']; ?>" class="form-control" readonly>
                                                            </div>

                                                                <div class="form-group">
                                                                    <label>Serial Number (last 4 digit)s</label>
                                                                    <input type="text" class="form-control" id="serial_no" name="serial_no" value="<?php echo $new['serial_no']; ?>" >
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Used in</label>
                                                                    <select class="form-control" id="used_in" name="used_in" onchange="editUsedInSGsimcard(this)" required>
                                                                        <option value="<?php echo $new['used_in']; ?>"><?php echo $new['used_in']; ?></option>
                                                                        <option value="WhatsApp and Simba Voice" style="color: black; background-color: #87CEEB;">WhatsApp and Simba Voice</option>
                                                                        <option value="Simba Voice Only" style="color: black; background-color: #F0E68C;">Simba Voice Only</option>
                                                                        <option value="WhatsApp Only" style="color: black; background-color: #F08080;">WhatsApp Only</option>
                                                                        <option value="Never Use" style="color: black; background-color: #EE82EE;">Never Use</option>
                                                                        <option value="">Others</option>
                                                                    </select>
                                                                </div>


                                                                <div class="form-group">
                                                                    <label>Remarks</label>
                                                                    <input type="text" class="form-control" id="remarks" name="remarks"  value="<?php echo $new['remarks']; ?>">
                                                                </div>

                                                                <div class="form-group">
                                                                    <label>Load Expired </label>
                                                                    <input type="text" class="form-control" id="load_expired" name="load_expired" value="<?php echo $new['load_expired']; ?>">
                                                                </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-success" id="headsetsaveBtn">Save</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Add SG Simcard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= site_url('add/SGsimcard') ?>" method="POST">
                    <div class="modal-body">

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-2">
                        <label for="sgsimcard_dropdown_">Phone Serial Number</label><br>
                        <div class="ui search selection dropdown sgsimcard_dropdown" data-id="">
                            <input type="hidden" name="country">
                            <i class="dropdown icon"></i>
                            <div class="default text">None</div>
                            <div class="menu">
                                <div class="item" data-value="0">None</div>
                                <div class="item" data-value="Personal Phone">
                                    <span class="text">Personal Phone</span>
                                </div>
                                <?php foreach ($valid_simcard as $simcard): ?>
                                    <div class="item" data-value="<?php echo $simcard['id']; ?>">
                                        <span class="text"><?php echo $simcard['phone_equip_id']; ?></span>
                                        <span class="hidden"><?php echo $simcard['phone_agent_name']; ?></span>
                                        <span class="hidden"><?php echo $simcard['agent_fk_id']; ?></span>
                                        <span class="hidden"><?php echo $simcard['id']; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            

                <div class="col-md-6">
                    <div class="form-group mb-2">
                    <label for="simcard_agentdropdown_">Agent Name:</label>
                        <div class="ui search selection dropdown simcard_agentdropdown" data-id="">
                            <input type="hidden" name="country">
                            <i class="dropdown icon"></i>
                            <div class="default text">None</div>
                            <div class="menu">
                                <div class="item" data-value="Others">Others</div>
                                <?php foreach ($agent as $agent_item): ?>
                                    <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                        <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                        <span class="hidden"><?php echo $agent_item['id']; ?></span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    
                  
                    <input type="hidden" name="phone_serial_no" id="phone_serial_no" class="form-control" readonly>
                    <input type="hidden"hidden name="phone_fk_id" id="phone_fk_id" readonly>
                    <input type="hidden" name="agent_fk_id" id="agent_fk_id" readonly>
                   
                    
                    <div class="form-group">
                        <input type="readonly" name="agent" id="agent" class="form-control" readonly>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-2">
                            <label>Number</label>
                                <input type="text" class="form-control" id="number" name="number" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-2">
                            <label>Serial Number (last 4 digit)</label>	
                              <input type="text" class="form-control" id="serial_no" name="serial_no" value="None">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Used in</label>
                        <select class="form-control" id="used_in" name="used_in" onchange="editUsedInSGsimcard(this)"  >
                            <option value="WhatsApp and Simba Voice" style="color: black; background-color: #87CEEB;">WhatsApp and Simba Voice</option>
                            <option value="Simba Voice Only" style="color: black; background-color: #F0E68C;">Simba Voice Only</option>
                            <option value="WhatsApp Only" style="color: black; background-color: #F08080;">WhatsApp Only</option>
                            <option value="Never Use" style="color: black; background-color: #EE82EE;">Never Use</option>
                            <option value="">Others</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Remarks</label>
                        <input type="text" class="form-control" id="remarks" name="remarks" >
                    </div>

                    <div class="form-group">
                        <label>Load Expired </label>
                        <input type="text" class="form-control" id="load_expired" name="load_expired" >
                    </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="headsetsaveBtn">Insert</button>
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