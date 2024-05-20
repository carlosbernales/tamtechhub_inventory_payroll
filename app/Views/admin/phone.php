
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

            <li class="nav-item active">
							<a href="<?php echo base_url('phone/list'); ?>">
								<i class="fas fa-phone"></i>
								<p>Phone</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

            <li class="nav-item">
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
							    <h1>Phones</h1>
                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addPhoneModal">+ <i class="fas fa-phone"></i></a>
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
                        <th colspan="3">Whats App Account 1</th>
                        <th colspan="3">Whats App Account 2</th>
                        <th colspan="3">Whats App Account 3</th>
                        <th></th>
												</tr>
											</thead>
											
											<tbody>
                      <?php foreach ($phone as $new): ?>
                    <tr>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-1"><?php echo $new['phone_agent_name']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-1"><?php echo $new['phone_equip_id']; ?></td>
                      <td class="phone-cell-clickable" data-target="#editModal-<?php echo $new['id']; ?>-1" style="<?php 
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
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-1"><?php echo $new['phone_brand']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-1"><?php echo $new['phone_model']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-1"><?php echo $new['phone_condition']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;"  data-target="#editModal-<?php echo $new['id']; ?>-1"><?php echo $new['phone_comment']; ?></td>


                      <!-- Second set of columns -->
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-2"><?php echo $new['phone_number_one']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-2"><?php echo $new['whatsapp_acc_one']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;"  data-target="#editModal-<?php echo $new['id']; ?>-2"><?php echo $new['whatsapp_acc_one_cond']; ?></td>

                      <!-- Third set of columns -->
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-3"><?php echo $new['phone_number_two']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-3"><?php echo $new['whatsapp_acc_two']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;"  data-target="#editModal-<?php echo $new['id']; ?>-3"><?php echo $new['whatsapp_acc_two_cond']; ?></td>

                      <!-- Fourth set of columns -->
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-4"><?php echo $new['phone_number_three']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" data-target="#editModal-<?php echo $new['id']; ?>-4"><?php echo $new['whatsapp_acc_three']; ?></td>
                      <td class="phone-cell-clickable" style="<?php echo ($new['phone_status'] === 'Unserviceable' || $new['phone_status'] === 'Missing' || $new['phone_condition'] === 'Non working') ? 'background-color: #ff9999;' : ''; ?>" style="border-right: 2px solid green;"  data-target="#editModal-<?php echo $new['id']; ?>-4"><?php echo $new['whatsapp_acc_three_cond']; ?></td>


                        <td style="width:3%">
                        <button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>
                        <a href="<?= site_url('delete/phone'.$new['id']) ?>" class="fa fa-trash delete" onclick="confirmPhoneDelete(event)" style="font-size: 2em; color: red;"></a>
                        </td>
                    </tr>

                    <!---//////////////////////////////////////////////////////////////////////////// FIRST MODAL -->

                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>-1" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Equipment ID: <span style="color: red;"><?php echo $new['phone_equip_id']; ?></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('phone_update/first' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                              <?= csrf_field(); ?>

                              <input type="hidden" name="phone_agent_name" class="phone_agent_name_" id="phone_agent_name_<?php echo $new['id']; ?>" value="<?php echo $new['phone_agent_name']; ?>" readonly>
                              <input type="hidden" name="agent_fk_id" class="phone_agent_fk_id_" id="phone_agent_fk_id_<?php echo $new['id']; ?>" value="<?php echo $new['agent_fk_id']; ?>" readonly>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group mb-2">
                                      <label for="phone_agent_dropdown_<?php echo $new['id']; ?>">Agent</label><br>
                                          <div class="ui search selection dropdown phone_agent_dropdown" data-id="<?php echo $new['id']; ?>">
                                              <input type="hidden" name="country">
                                              <i class="dropdown icon"></i>
                                              <div class="default text"><?php echo $new['phone_agent_name']; ?></div>
                                              <div class="menu">
                                                  <div class="item" data-value="0">None</div>
                                                  <?php foreach ($agent as $agent_item): ?>
                                                      <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                                          <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                                      </div>
                                                  <?php endforeach; ?>
                                              </div>
                                          </div>
                                          <div id="phone_agent_id_error_<?php echo $new['id']; ?>" class="text-danger"></div>
                                      </div>
                                  </div>


                                <div class="col-md-6">
                                  <div class="form-group mb-2">
                                    <label>Status</label>
                                    <select class="form-control" id="phone_status" name="phone_status" onchange="editPhoneStatus(this)" >
                                      <option value="<?php echo $new['phone_status']; ?>"selected disabled><?php echo $new['phone_status']; ?></option>
                                      <option value="Unserviceable">Unserviceable</option>
                                      <option value="Missing">Missing</option>

                                      <option value="">Others</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group mb-2">
                                    <label>Brand</label>
                                    <input type="text" class="form-control" id="name" name="phone_brand" value="<?php echo $new['phone_brand']; ?>" >
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group mb-2">
                                    <label>Model</label>
                                    <input type="text" class="form-control" id="name" name="phone_model" value="<?php echo $new['phone_model']; ?>" >
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group mb-2">
                                    <label>Condition</label>
                                    <select class="form-control" id="name" name="phone_condition" onchange="editConditionPhone(this)" >
                                      <option value="<?php echo $new['phone_condition']; ?>"><?php echo $new['phone_condition']; ?></option>
                                      <option value="Working">Working</option>
                                      <option value="Non working">Non working</option>
                                      <option value="">Others</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group mb-2">
                                    <label>Comment</label>
                                    <input type="text" class="form-control" id="name" name="phone_comment" value="<?php echo $new['phone_comment']; ?>">
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-12 text-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" id="updatephone_<?php echo $new['id']; ?>" class="btn btn-success">Save</button>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>





                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>-2" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>First Phone: <span style="color: red;"><?php echo $new['phone_equip_id']; ?></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('update_phone_one/first' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                  <label for="agentName">Number</label>
                                  <input type="text" class="form-control" id="phone_number_one" name="phone_number_one" value="<?php echo $new['phone_number_one']; ?>" >
                                </div>

                                <div class="form-group">
                                  <label for="agentName">WhatsApp Account</label>
                                  <input type="text" class="form-control" id="whatsapp_acc_one" name="whatsapp_acc_one" value="<?php echo $new['whatsapp_acc_one']; ?>" >
                                </div>

                                <div class="form-group">
                                  <label for="agentName">Account Condition</label>
                                  <select class="form-control" id="name" name="whatsapp_acc_one_cond" onchange="editphoneConditionOne(this)" >
                                      <option value="<?php echo $new['whatsapp_acc_one_cond']; ?>"><?php echo $new['whatsapp_acc_one_cond']; ?></option>
                                      <option value="Free to use">Free to use</option>
                                      <option value="Use in current campaign">Use in current campaign</option>
                                      <option value="">Others</option>
                                  </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit"  class="btn btn-success" >Save</button>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>




                    
                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>-3" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Second Phone: <span style="color: red;"><?php echo $new['phone_equip_id']; ?></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('update_phone_two/two' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                                <?= csrf_field(); ?>

                                <div class="form-group">
                                  <label for="agentName">Number</label>
                                  <input type="text" class="form-control" id="phone_number_two" name="phone_number_two" value="<?php echo $new['phone_number_two']; ?>">
                                </div>

                                <div class="form-group">
                                  <label for="agentName">WhatsApp Account</label>
                                  <input type="text" class="form-control" id="whatsapp_acc_two" name="whatsapp_acc_two" value="<?php echo $new['whatsapp_acc_two']; ?>">
                                </div>

                                <div class="form-group">
                                  <label for="agentName">Account Condition</label>
                                  <select class="form-control" id="name" name="whatsapp_acc_two_cond" onchange="editphoneConditionTwo(this)" >
                                      <option value="<?php echo $new['whatsapp_acc_two_cond']; ?>"><?php echo $new['whatsapp_acc_two_cond']; ?></option>
                                      <option value="Free to use">Free to use</option>
                                      <option value="Use in current campaign">Use in current campaign</option>
                                      <option value="">Others</option>
                                  </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit"  class="btn btn-success" >Save</button>
                                    </div>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>  
                    
                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>-4" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Third Phone: <span style="color: red;"><?php echo $new['phone_equip_id']; ?></span></strong></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('update_phone_three/three' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                              <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                              <?= csrf_field(); ?>

                              <div class="form-group">
                                <label for="agentName">Number</label>
                                <input type="text" class="form-control" id="phone_number_three" name="phone_number_three" value="<?php echo $new['phone_number_three']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="agentName">WhatsApp Account</label>
                                <input type="text" class="form-control" id="whatsapp_acc_three" name="whatsapp_acc_three" value="<?php echo $new['whatsapp_acc_three']; ?>">
                              </div>

                              <div class="form-group">
                                <label for="agentName">Account Condition</label>
                                <select class="form-control" id="name" name="whatsapp_acc_three_cond" onchange="editphoneConditionThree(this)" >
                                    <option value="<?php echo $new['whatsapp_acc_three_cond']; ?>"><?php echo $new['whatsapp_acc_three_cond']; ?></option>
                                    <option value="Free to use">Free to use</option>
                                    <option value="Use in current campaign">Use in current campaign</option>
                                    <option value="">Others</option>
                                </select>
                              </div>

                              <div class="row">
                                  <div class="col-md-12 text-right">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      <button type="submit"  class="btn btn-success" >Save</button>
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
      
<!-- ADD Phone MODAL -->
<div class="modal fade" id="addPhoneModal" tabindex="-1" role="dialog" aria-labelledby="addPhoneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPhoneModalLabel">Add Phone</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= site_url('add/phone') ?>" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <label for="agentName">Equipment ID</label>
            <input type="text" class="form-control" id="phone_equip_id" name="phone_equip_id" required>
            <div id="phone_equip_id_error" class="text-danger"></div> <!-- Error message container -->

          </div>

          <div class="form-group">
            <label for="agentName">Brand</label>
            <input type="text" class="form-control" id="phone_brand" name="phone_brand">
          </div>

          <div class="form-group">
            <label for="agentID">Model</label>
            <input type="text" class="form-control" id="phone_model" name="phone_model">
          </div>

          <div class="form-group">
            <label for="anotherAgentName">Condition</label>
            <select class="form-control" id="phone_condition" name="phone_condition" onchange="addPhoneCondition(this)">
              <option value="Working">Working</option>
              <option value="Non Working">Non Working</option>
              <option value="">Others</option>
            </select>
          </div>

          <div class="form-group">
            <label>Comment</label>
            <input type="text" class="form-control" name="phone_comment" value ="No Comment">
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