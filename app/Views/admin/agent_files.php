
<?= $this->include('footers_headers/table_header') ?>


<link rel="stylesheet" href="<?= base_url('template/system_scripts.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/userfiles.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/materialdesignicons.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/boxicons.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/all.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('template/ionicons.min.css') ?>">
<style>
    .preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black for the blur effect */
        backdrop-filter: blur(5px); /* CSS blur effect */
        display: none; /* Initially hide the preloader */
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

<script>
    function showLoader() {
        const preloader = document.querySelector('.preloader');
        preloader.style.display = 'flex'; // Show the preloader when the form is submitted
    }
</script>
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
 
            			<li class="nav-item active">
							<a href="<?php echo base_url('agents'); ?>">
								<i class="fa fa-user-secret"></i>
								<p>Agents</p>
								<span class="badge badge-success"></span>
							</a>
						</li>

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



		<div class="main-panel">
			<div class="content">
				<div class="page-inner">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
                                <div class="card-header" style="display: flex; justify-content: space-between;">
                                    <h1><?= $agent['agent_name']; ?></h1>
                                    <a href="<?= site_url('agents') ?>" class="btn btn-secondary">Close</a>
                                </div>
								<div class="card-body">
                                <div class="container flex-grow-1 light-style container-p-y">
                                <div class="container-m-nx container-m-ny bg-lightest mb-3">
                                <hr class="m-0" />
                                <div class="file-manager-actions container-p-x py-2">
                                    <div>
                                        <form id="uploadForm" action="<?= site_url('file/Upload') ?>" method="post" enctype="multipart/form-data" onsubmit="showLoader()">
                                            <div class="preloader">
                                                <img src="<?= base_url('logindes/images/tamtechlogo.png') ?>" alt="Preloader">
                                            </div>
                                        
                                            <input type="file" name="upload_files[]" multiple required>
                                            <?php if (isset($agent['id'])) : ?>
                                                <input type="hidden" name="id" value="<?= $agent['id']; ?>">
                                            <?php endif; ?>
                                            <button type="submit" class="btn btn-primary mr-2">
                                                <i class="fas fa-upload"></i> Upload
                                            </button>
                                            <button id="selectAllButton" type="button" class="btn btn-info mr-2" onclick="selectAllCheckboxes()">Select All</button>
                                            <button id="unselectAllButton" type="button" class="btn btn-warning mr-2" onclick="unselectAllCheckboxes()">Unselect All</button>
                                        </form>
                                    </div>  
                                    <div class="ml-auto">
                                    <button id="deleteButton" type="button" onclick="deleteMultipleFiles(event)" class="btn btn-danger" style="display: none;">Delete Selected Files</button>
                                    </div>
                                    <!-- <div>
                                        <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                            <label class="btn btn-default icon-btn md-btn-flat active"> <input type="radio" name="file-manager-view" value="file-manager-col-view" checked="" /> <span class="ion ion-md-apps"></span> </label>
                                            <label class="btn btn-default icon-btn md-btn-flat"> <input type="radio" name="file-manager-view" value="file-manager-row-view" /> <span class="ion ion-md-menu"></span> </label>
                                        </div>
                                    </div> -->
                                    </div>
                                    <hr class="m-0" />
                                </div>

                                    <div class="file-manager-container file-manager-col-view">
                                    <?php if (empty($files)): ?>
                                        <p>No files yet!</p>
                                    <?php else: ?>
                                    <?php foreach ($files as $file): ?>
                                        <div class="file-item">
                                            <div class="file-item-select-bg bg-primary"></div>
                                            <label class="file-item-checkbox custom-control custom-checkbox">
                                                <input type="checkbox" name="fileIds[]" value="<?= $file['id']; ?>" class="custom-control-input" onchange="toggleDeleteButton()" />
                                                <span class="custom-control-label"></span>
                                            </label>

                                            <?php if (strpos($file['upload_files'], '.jpg') !== false || strpos($file['upload_files'], '.jpeg') !== false || strpos($file['upload_files'], '.png') !== false || strpos($file['upload_files'], '.gif') !== false): ?>
                                                <img src="<?= base_url('userFiles/' . $file['agent_fk_id'] . '/' . $file['upload_files']); ?>" alt="<?= $file['upload_files']; ?>" style="max-width: 100px; max-height: 100px;" data-toggle="modal" data-target="#imageModal<?= $file['id']; ?>">
                                            <?php elseif (strpos($file['upload_files'], '.docx') !== false || strpos($file['upload_files'], '.docx') !== false || strpos($file['upload_files'], '.docx') !== false): ?>
                                                <a href="<?= base_url('userFiles/'. $file['agent_fk_id'] . '/' . $file['upload_files']); ?>" target="_blank" class="file-item-icon far fa-file-word text-primary"></a>
                                            <?php elseif (strpos($file['upload_files'], '.pdf') !== false || strpos($file['upload_files'], '.pdf') !== false || strpos($file['upload_files'], '.pdf') !== false): ?>
                                                <a href="<?= base_url('userFiles/'. $file['agent_fk_id'] . '/' . $file['upload_files']); ?>" target="_blank" class="file-item-icon far fa-file-pdf text-danger"></a>
                                            <?php elseif (strpos($file['upload_files'], '.xls') !== false || strpos($file['upload_files'], '.xlsx') !== false): ?>
                                                <a href="<?= base_url('userFiles/'. $file['agent_fk_id'] . '/' . $file['upload_files']); ?>" target="_blank" class="file-item-icon far fa-file-excel text-success"></a>
                                            <?php else: ?>
                                                <div class="file-item-icon far fa-file text-secondary"></div>
                                            <?php endif; ?>

                                            <div class="file-item-name"><?= $file['upload_files']; ?></div>
                                            <div class="file-item-actions btn-group">
                                                <button type="button" class="btn btn-default btn-sm rounded-pill icon-btn borderless md-btn-flat hide-arrow dropdown-toggle" data-toggle="dropdown"></button>
                                                <div class="dropdown-menu dropdown-menu-right">
                                                    <a href="<?= site_url('deleteFiles_' . $file['id']); ?>" class="dropdown-item delete-file">Delete</a>
                                                    <a href="#" class="dropdown-item rename-file" data-toggle="modal" data-target="#editModal-<?php echo $file['id']; ?>" data-id="<?php echo $file['id']; ?>">Rename</a>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                        <?php endif; ?>

                                        
                                   

                                        <?php foreach ($files as $file): ?>
                                             <div class="modal fade" id="editModal-<?php echo $file['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true" data-backdrop="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h4 class="modal-title" id="editModalLabel-<?php echo $file['id']; ?>"><strong>Rename</strong></h4>

                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form id="editCategoryForm-<?php echo $file['id']; ?>" action="<?= site_url('rename/File-' . $file['id']) ?>" method="POST" enctype="multipart/form-data">
                                                        <?= csrf_field(); ?>
                                                        <input type="hidden" name="id" value="<?php echo $file['id']; ?>">

                                                        <div class="form-group">
                                                            <input type="text" class="form-control" name="upload_files" value="<?php echo $file['upload_files']; ?>">
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-12 text-right">
                                                                <button type="submit" id="updateheadset" class="btn btn-success">Save</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>

                                        <div class="modal fade" id="imageModal<?= $file['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true"  data-backdrop="true"> 
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="imageModalLabel"><?= $file['upload_files']; ?></h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img id="printImage<?= $file['id']; ?>" src="<?= base_url('userFiles/'. $file['agent_fk_id'] . '/'  . $file['upload_files']); ?>" alt="<?= $file['upload_files']; ?>" style="width: 100%;" >
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary" onclick="printImage('printImage<?= $file['id']; ?>')">Print</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
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
                <form action="<?= site_url('add_agent') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="agentName">Agent</label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name" required>
                        </div>
                        <div class="form-group">
                            <label for="agentID">Agent ID</label>
                            <input type="text" class="form-control" id="agentlist_agent_id" name="agent_id" required>
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

<script src="<?= base_url('template/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/system_scripts.js') ?>"></script>

<script>
function toggleDeleteButton() {
    var deleteButton = document.getElementById('deleteButton');
    var checkboxes = document.querySelectorAll('input[name="fileIds[]"]:checked');

    if (checkboxes.length > 0) {
        deleteButton.style.display = 'block';
    } else {
        deleteButton.style.display = 'none';
    }
}

function deleteMultipleFiles(event) {
    event.preventDefault();

    var fileIds = [];
    var checkboxes = document.querySelectorAll('input[name="fileIds[]"]:checked');

    checkboxes.forEach(function (checkbox) {
        fileIds.push(checkbox.value);
    });

    if (fileIds.length === 0) {
        alert('Please select at least one file to delete.');
        return;
    }

    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover the selected files!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete them!',
        cancelButtonText: 'No, keep them'
    }).then((result) => {
        if (result.isConfirmed) {
            var form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= site_url('deleteMultiple/Files'); ?>';

            fileIds.forEach(function (fileId) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'fileIds[]';
                input.value = fileId;
                form.appendChild(input);
            });

            document.body.appendChild(form);
            form.submit();
        }
    });
}

function selectAllCheckboxes() {
    var checkboxes = document.querySelectorAll('input[name="fileIds[]"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = true;
    });
    toggleDeleteButton(); 
}

function unselectAllCheckboxes() {
    var checkboxes = document.querySelectorAll('input[name="fileIds[]"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = false;
    });
    toggleDeleteButton();
}

function printImage(imageId) {
    var imageSrc = document.getElementById(imageId).src;
    var printWindow = window.open(imageSrc, '_blank');
    printWindow.onload = function() {
        printWindow.print();
    };
}

</script>
<?php
include_once('template/system_scripts.php');
?>

<?= $this->include('footers_headers/table_footer') ?>       