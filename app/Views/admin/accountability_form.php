<?= $this->include('footers_headers/table_header') ?>
<link rel="stylesheet" href="<?= base_url('template/accountability_form.css') ?>">
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

                        <li class="nav-item active">
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
                <div style="text-align: center;">
                    <img class="header-image" src="<?= base_url('template/accountability_header.png') ?>" alt="Header Image" style="width: 500px; height: 80px;">
                    <br>
                    <div style="text-align: center;">
                        <h1 style="font-size: 30px;">Computer Equipment Accountability Form</h1>
                    </div>
                    <br>
                </div>

                <div class="row mb-3">
                <div class="col">
                <div class="d-flex align-items-center">
                    <label for="agent_id_input" class="yellow-green-label custom-label-width">AGENT NAME</label>
                    <div class="ui search selection dropdown accountability_agent_dropdown no-border-input">
                        <input type="hidden" name="country" id="country">
                        <i class="dropdown icon"></i>
                        <div class="default text">None</div>
                        <div class="menu">
                            <?php foreach ($agent as $agent_item): ?>
                                <div class="item" data-value="<?php echo $agent_item['id']; ?>">
                                    <span class="text"><?php echo $agent_item['agent_name']; ?></span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
                    <div class="col">
                        <div class="input-group">
                            <label for="agent_id_input" class="yellow-green-label">AGENT ID</label>
                            <input type="text" class="form-control no-border-input agent_id_input" id="agent_id_input" readonly>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group">
                            <label for="campaign_input" class="yellow-green-label">CAMPAIGN</label>
                            <input type="text" class="form-control no-border-input campaign_input" id="campaign_input" readonly>
                        </div>
                    </div>
                </div>

            

                    <div class="row">
                        <div class="col-md-4">
                        <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Mouse</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="mouse_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="mouse_equipment_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="mouse_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="mouse_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="mouse_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="mouse_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-md-4">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Keyboard</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="keyboard_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="keyboard_equipment_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="keyboard_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="keyboard_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="keyboard_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="keyboard_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Headset</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="headset_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="headset_equipment_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="headset_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="headset_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="headset_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="headset_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- Second Row -->
                        <div class="col-md-4">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">CPU</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="cpu_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="cpu_equipment_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="cpu_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="cpu_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>RAM Size</td>
                                        <td class="cpu_ram_size_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Processor</td>
                                        <td class="cpu_processor_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Storage Type</td>
                                        <td class="cpu_storage_type_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="cpu_conditions_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="cpu_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Webcam</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="webcam_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="webcam_equip_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="webcam_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="webcam_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="webcam_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="webcam_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Locker</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="locker_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Tool ID</td>
                                        <td class="locker_locker_tool_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="locker_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="locker_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">First Monitor</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="monitor_one_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="monitor_one_equip_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="monitor_one_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="monitor_one_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="monitor_one_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="monitor_one_comment_cell"></td>
                                    </tr>
                                    <thead>
                                    <tr>
                                        <th scope="col">Second Monitor</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="monitor_two_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="monitor_two_equip_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="monitor_two_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="monitor_two_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="monitor_two_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="monitor_two_comment_cell"></td>
                                    </tr>
                                    </tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Laptop</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="laptop_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="laptop_laptop_equip_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="laptop_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="laptop_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>RAM Size</td>
                                        <td class="laptop_ram_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Processor</td>
                                        <td class="laptop_processor_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Storage Type</td>
                                        <td class="laptop_storage_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="laptop_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="laptop_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>

                            <table class="table table-bordered table-head-bg-info table-bordered-bd-info">
                                <thead>
                                    <tr>
                                        <th scope="col">Phone</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Status</td>
                                        <td class="phone_status_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Equipment ID</td>
                                        <td class="phone_equip_id_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Brand</td>
                                        <td class="phone_brand_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Model</td>
                                        <td class="phone_model_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Condition</td>
                                        <td class="phone_condition_cell"></td>
                                    </tr>
                                    <tr>
                                        <td>Comment</td>
                                        <td class="phone_comment_cell"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div style="text-align: center;">
                        <button id="printButton" class="fa fa-print btn btn-success"></button>
                    </div>

                    <div class="bordered-agreement-section" style="display: none; border-top: 2px solid black; padding-top: 10px;">
                        <div class="print-only-agreement" style="text-align: center; font-size: 20px; color: red; font-weight: bold;">
                            AGREEMENT (Accountability)
                        </div>
                        <div class="print-only-agreement-text" style="font-size: 14px; color: #333333; margin-top: 10px; text-align: justify; text-indent: 20px;">
                            Tamaraw Technohub Inc., provides you with the equipment to enable you to obtain above average performance levels. The Agreement covers the issue, usage and return of all the equipment assigned to you. You are responsible for the condition and custody of the equipment specified below. Please note the quantity, description and SERIAL NUMBER. This equipment will be recorded and tracked as your responsibility. A copy of this agreement will be placed in your 201 file.
                            For clearance purposes, kindly surrender this form together with the equipment/s listed below having the correct serial number/s to the Admin Department. If the form is lost, inform Admin as soon as possible to furnish you with another copy.
                            <br>The following are terms of the equipment issuance:
                            <br>1. It is the primary responsibility of the user to keep all equipment assigned to him/her in a clean and operational condition at all times.
                            <br>2. Damaged equipment due to normal usage will be replaced at no cost to the user.
                            <br>3. Borrowing and lending of the equipment are not allowed.
                            <br>4. Damaged due to misuse, abuse and loss of equipment will result in a full payroll deduction for the replacement of the cost of the equipment amounting to (price of equipment)
                            <br>5. Returned equipment should be in usable, clean condition and should only show marks of normal usage and wear and tear.
                        </div>
                    </div>
                    <br>
                    <div class="print-only-agreement" style="display: none; margin-top: 20px; text-align: center; margin-left: 100px; margin-right: 100px;">
                        <div style="display: flex; justify-content: space-between;">
                            <div style="text-align: center;">
                                Conforme:<br><br><strong></strong><br><span style="border-top: 1px solid black;">Signature over printed name</span>
                            </div>
                            <div style="text-align: center;">
                                Verified by:<br><br><strong></strong><br><span style="border-top: 1px solid black;">Signature over printed name</span>
                            </div>
                        </div>
                    </div>
                    <div class="print-only-agreement" style="display: none;text-align: center; margin-top: 20px;">
                        Approved by:<br><br>
                        <strong></strong> <br><span style="border-top: 1px solid black;">Signature over printed name</span>
                    </div>
                </div>
            </div>
        </div>
        


        
<script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/system_scripts.js') ?>"></script>

<!--   Core JS Files   -->
<script src="<?= base_url('template/assets/js/core/jquery.3.2.1.min.js') ?>"></script>
<script src="<?= base_url('template/assets/js/core/popper.min.js') ?>"></script>
<script src="<?= base_url('template/assets/js/core/bootstrap.min.js') ?>"></script>
<!-- jQuery UI -->
<script src="<?= base_url('template/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') ?>"></script>
<script src="<?= base_url('template/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') ?>"></script>

<!-- jQuery Scrollbar -->
<script src="<?= base_url('template/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') ?>"></script>
<!-- Datatables -->
<script src="<?= base_url('template/assets/js/plugin/datatables/datatables.min.js') ?>"></script>
<!-- Atlantis JS -->
<script src="<?= base_url('template/assets/js/atlantis.min.js') ?>"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="<?= base_url('template/assets/js/setting-demo2.js') ?>"></script>
<script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>
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

</body>
</html>