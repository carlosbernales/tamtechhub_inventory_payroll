
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

                        <li class="nav-item active">
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
							        <h1>Keyboard</h1>
                                        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addKeyboardModal">+ <i class="fa fa-keyboard"></i></a>

								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="basic-datatables" class="table table-bordered table-head-bg-info table-bordered-bd-success" >
											<thead>
												<tr>
                          <th>Agent ID</th>
                          <th>Equipment ID</th>
                          <th>Status</th>
                          <th>Brand</th>
                          <th>Model</th>
                          <th>Condition</th>
                          <th>Comment</th>
                          <th></th>
												</tr>
											</thead>
											<tbody>
                      <?php foreach ($keyboard as $new): ?>
                    <tr>
                        <td class="keyboard_cell-clickable" style="<?php echo ($new['keyboard_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['agent']; ?></td>
                        <td class="keyboard_cell-clickable" style="<?php echo ($new['keyboard_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['keyboard_equip_id']; ?></td>
                        <td class="keyboard_cell-clickable" style="<?php 
                            if ($new['keyboard_status'] === 'Unserviceable') {
                                echo 'color: black; background-color: #ff9999;';
                            } elseif ($new['keyboard_status'] === 'Unassigned') {
                                echo 'color: white; background-color: gray;';
                            } elseif ($new['keyboard_status'] === 'Assigned') {
                                echo 'color: black; background-color: #32CD32;';
                            }
                        ?>">
                            <?php echo $new['keyboard_status']; ?>
                        </td>
                        <td class="keyboard_cell-clickable" style="<?php echo ($new['keyboard_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['keyboard_brand']; ?></td>
                        <td class="keyboard_cell-clickable" style="<?php echo ($new['keyboard_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['keyboard_model']; ?></td>
                        <td class="keyboard_cell-clickable" style="<?php echo ($new['keyboard_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['keyboard_condition']; ?></td>
                        <td class="keyboard_cell-clickable" style="<?php echo ($new['keyboard_status'] === 'Unserviceable') ? 'background-color: #ff9999;' : ''; ?>"><?php echo $new['keyboard_comment']; ?></td>
                        <td style="width:3%" >
                        <button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>

                            <a href="<?= site_url('delete/keyboard'.$new['id']) ?>" class="fa fa-trash delete" onclick="confirmKeyboardDelete(event)" style="font-size: 2em; color: red;"></a>
                        </td>
                    </tr>

                    <!---//////////////////////////////////////////////////////////////////////////// FIRST MODAL -->

                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Equipment ID:</strong><span style="color: red;"><?php echo $new['keyboard_equip_id']; ?></span> </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('update_keyboard' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                              <?= csrf_field(); ?>

                              <input type="hidden" name="agent" class="keyboard_agent_name_" id="keyboard_agent_name_<?php echo $new['id']; ?>" value="<?php echo $new['agent']; ?>" readonly>
                              <input type="hidden" name="agent_fk_id" class="keyboard_agent_fk_id_" id="keyboard_agent_fk_id_<?php echo $new['id']; ?>" value="<?php echo $new['agent_fk_id']; ?>" readonly>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group mb-2">
                                      <label for="keyboard_agent_dropdown_<?php echo $new['id']; ?>">Agent</label><br>
                                          <div class="ui search selection dropdown keyboard_agent_dropdown" data-id="<?php echo $new['id']; ?>">
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
                                          <div id="keybaord_agent_id_error_<?php echo $new['id']; ?>" class="text-danger"></div>
                                      </div>
                                  </div>
                              

                                  <div class="col-md-6">
                                      <div class="form-group mb-2">
                                      <label>Status</label>
                                          <select class="form-control" id="keyboard_status" name="keyboard_status" onchange="keyboardstatusedit(this)" >
                                              <option value="<?php echo $new['keyboard_status']; ?>"selected disabled><?php echo $new['keyboard_status']; ?></option>
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
                                          <input type="text" class="form-control" id="name" name="keyboard_brand" value="<?php echo $new['keyboard_brand']; ?>" >
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group mb-2">
                                      <label>Model</label>
                                          <input type="text" class="form-control" id="name" name="keyboard_model" value="<?php echo $new['keyboard_model']; ?>" >
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group mb-2">
                                      <label>Condition</label>
                                          <select class="form-control" id="name" name="keyboard_condition" onchange="keyboardcondtionedit(this)" >
                                              <option value="<?php echo $new['keyboard_condition']; ?>"><?php echo $new['keyboard_condition']; ?></option>
                                              <option value="New">New</option>
                                              <option value="Reassigned">Reassigned</option>
                                              <option value="Frequently Used">Frequently Used</option>
                                              <option value="">Others</option>
                                          </select>
                                      </div>
                                  </div>

                                  <div class="col-md-6">
                                      <div class="form-group mb-2">
                                      <label>Comment</label>
                                          <input type="text" class="form-control" id="name" name="keyboard_comment" value="<?php echo $new['keyboard_comment']; ?>">
                                      </div>
                                  </div>
                              </div>

                              <div class="row">
                                  <div class="col-md-12 text-right">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit" id="updatekeyboard_<?php echo $new['id']; ?>" class="btn btn-success" >Save</button>
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



            <!-- ADD Keyboard MODAL -->
            <div class="modal fade" id="addKeyboardModal" tabindex="-1" role="dialog" aria-labelledby="addKeyboardModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addKeyboardModalLabel">Add Keyboard</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form action="<?= site_url('add_keyboard') ?>" method="POST">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="agentID">Equipment ID</label>
                            <input type="text" class="form-control" id="keyboard_equip_id" name="keyboard_equip_id" required>
                            <div id="keyboard_equip_id_error" class="text-danger"></div> <!-- Error message container -->

                        </div>

                        <div class="form-group">
                            <label for="agentName">Brand</label>
                            <input type="text" class="form-control" id="keyboard_brand" name="keyboard_brand">
                        </div>

                        <div class="form-group">
                            <label for="agentID">Model</label>
                            <input type="text" class="form-control" id="keyboard_model" name="keyboard_model">
                        </div>

                        <div class="form-group">
                            <label for="anotherAgentName">Condition</label>
                            <select class="form-control" id="keyboard_condition" name="keyboard_condition" onchange = "AddKeyboardCondition(this)">
                              <option value="New">New</option>
                              <option value="Reassigned">Reassigned</option>
                              <option value="Frequently Used">Frequently Used</option>
                              <option value="">Others</option>
                          </select>
                        </div>

                        <div class="form-group">
                            <label >Comment</label>
                            <input type="text" class="form-control"  name="keyboard_comment" value="No Comment">
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