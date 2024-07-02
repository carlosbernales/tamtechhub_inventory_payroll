<?= $this->include('footers_headers/payroll_table_header') ?>

<style>
    #setting-default th,
    #setting-default td {
        padding: 5px; /* Adjust this value to change the cell padding */
        font-size: 16px; /* Adjust this value to change the font size */
    }
     
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
<link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>">

    <div class="preloader">
        <img src="<?= base_url('logindes/images/tamtechlogo.png') ?>" alt="Preloader">
    </div>
    <!-- [ Main Content ] start -->
    <section class="pc-container">
      <div class="pc-content">
        
        <!-- [ Main Content ] start -->
        <div class="row">
          <!-- Setting Defaults table start -->
          <div class="col-sm-12">
              <div class="card-header" style="display: flex; justify-content: space-between;">
                    <a href="#" class="btn btn-success " data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">+ <i class="fas fa-user"></i></a>
                    <a  class="btn btn-success" id="addLeaveBtn" style="margin-right: 10px;"> <i class="">Generate leave</i></a>
                    
                    <button id="pagIbigButton" style="display: none;" class="btn btn-success dropdown-toggle" type="button" data-bs-toggle="dropdown"
                      aria-expanded="false">Edit Multiple</button>
                    <ul class="dropdown-menu">
                    <li><a class="dropdown-item" data-toggle="modal" data-target="#dailySalaryModal">Daily Salary</a></li>
                    <li><a class="dropdown-item"  data-toggle="modal" data-target="#pagIbigModal">Pag Ibig</a></li>
                    <li><a class="dropdown-item" data-toggle="modal" data-target="#sssModal">SSS</a></li>
                    <li><a class="dropdown-item" data-toggle="modal" data-target="#philHealthModal">PhilHealth</a></li>
                    <li><a class="dropdown-item" data-toggle="modal" data-target="#houseRentModal">House Rent</a></li>
                    <li><a class="dropdown-item" data-toggle="modal" data-target="#requiredWorkModal">Required Work</a></li>


                    </ul>
              </div>


              
              <div class="card-body">
                <div class="dt-responsive">
                  <table id="setting-default" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <p></p>
                                <input type="checkbox" id="selectAllCheckbox"><label for="selectAllCheckbox">Select All </label><p id="selectedCount" style="display: none">0 selected</p>
                                <th></th>
                                <th><small>Agent</small></th>
                                <th><small>Agent ID</small></th>
                                <th><small>Campaign</small></th>
                                <th><small>Email</small></th>
                                <th style="width:8%"><small>Attendance</small></th>
                                <th><small>Leave</small></th>
                                <th style="width:8%"><small>Daily Salary</small></th>
                                <th><small>Required Work</small></th>
                                <th></th>
                                <th><small>Details</small></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($agent_list as $new): ?>
                            <tr>
                                <td>
                                <input type="checkbox" class="agentCheckbox" name="selected_agents[]" value="<?= $new['id'] ?>">
                                </td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['agent_name']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['agent_id']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['campaign']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['user_email']; ?></td>
                                <td style="width:8%">
                                    <a href="<?= site_url('attendance/calendar/'.$new['agent_id']) ?>"><i class="fas fa-calendar-alt"> </i> View</a>
                                </td>
                                <td ><a href="<?= site_url('leave/View_' . $new['id']); ?>"></i> View</a></td>
                                <td style="width:8%" class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>">&#8369;<?php echo $new['daily_salary']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>">
                                    <?php
                                    $time_parts = explode(':', $new['required_work']);
                                    $hours = intval($time_parts[0]);
                                    $minutes = intval($time_parts[1]);
                                    
                                    if ($hours > 0) {
                                        echo $hours . ' hrs';
                                        if ($minutes > 0) {
                                            echo ' and ' . $minutes . ' mins';
                                        }
                                    } else {
                                        echo $minutes . ' mins';
                                    }
                                    ?>
                                </td>
                                <td style="width:12%">
									<a href="" data-toggle="modal" data-target="#editresignedModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>" style="color: green;">Resigned</a> <strong>|</strong>

									<a href="" data-toggle="modal" data-target="#editTerminatedModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>" style="color: red;">Terminated</a>

								</td>
								
								 <td ><a href="#" data-toggle="modal" data-target="#resignedModal-<?= $new['agent_id'] ?>" data-id="<?php echo $new['agent_id']; ?>">View</a></td>

                                <td style="width:3%">
                                <button class="btn btn-primary btn-sm hidden " data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>
                                <a href="<?= site_url('payrollDelete/agents/'.$new['id']) ?>" class="fa fa-trash delete" style="font-size: 2em; color: red;" onclick="confirmAgentDelete(event)"></a>
                                </td>
                            </tr>
                            
                            
                            <div class="modal fade" id="resignedModal-<?= $new['agent_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="resignedModalLabel-<?= $new['agent_id'] ?>" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="resignedModalLabel-<?= $new['agent_id'] ?>">Resignation/Termination Details</h5>
                                            
                                        </div>
                                        <div class="modal-body">
                                            <?php foreach ($resignedDetails[$new['id']] as $index => $detail): ?>
                                                <div style="border-bottom: 1px solid #007bff; margin-bottom: 1rem;">
                                                    <p><strong>Status:</strong> <?= $detail['status'] ?></p>
                                                    <p><strong>Comment:</strong> <?= $detail['comment'] ?></p>
                                                    <p><strong>Date:</strong> <?= date('F j, Y', strtotime($detail['date'])) ?></p>

                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <!-- RESIGNED  MODAL -->
                             <div class="modal fade" id="editresignedModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editresignedModalLabel-<?php echo $new['id']; ?>" aria-hidden="true" data-backdrop="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title" id="editresignedModalLabel-<?php echo $new['id']; ?>"><strong><span style="color: red;"><?php echo $new['agent_name']; ?></strong> </h4>

                                        </div>
                                        <div class="modal-body">
                                        <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('resigned/update' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo $new['id']; ?>">

                                        <div class="form-group">
                                            <label>Resignation Comment</label>
                                            <input type="text" class="form-control" id="comment" name="comment" value="<?php echo $new['comment']; ?>"required>
                                            <input type="hidden" class="form-control" id="status" name="status" value="Resigned">
                                            <input type="hidden" class="form-control" id="agent_id" name="agent_id" value="<?php echo $new['agent_id']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Resignation Date</label>
                                            <input type="date" class="form-control" id="date" name="date" required>
                                            
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="updateheadset" class="btn btn-success" >Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>
                            
                            <!-- TERMINATED  MODAL -->
                             <div class="modal fade" id="editTerminatedModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editterminatedModalLabel-<?php echo $new['id']; ?>" aria-hidden="true" data-backdrop="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title" id="editterminatedModalLabel-<?php echo $new['id']; ?>"><strong><span style="color: red;"><?php echo $new['agent_name']; ?></strong> </h4>

                                        </div>
                                        <div class="modal-body">
                                        <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('resigned/update' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo $new['id']; ?>">

                                        <div class="form-group">
                                            <label>Termination Comment</label>
                                            <input type="text" class="form-control" id="comment" name="comment" value="<?php echo $new['comment']; ?>" required>
                                            <input type="hidden" class="form-control" id="status" name="status" value="Terminated">
                                            <input type="hidden" class="form-control" id="agent_id" name="agent_id" value="<?php echo $new['agent_id']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Termination Date</label>
                                            <input type="date" class="form-control" id="date" name="date" required>
                                            
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="updateheadset" class="btn btn-success" >Submit</button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- EDIT  MODAL -->
                            <div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?php echo $new['id']; ?>" aria-hidden="true" data-backdrop="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                        <h4 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Agent ID:</strong> <span style="color: red;"><?php echo $new['agent_id']; ?></span></h4>

                                        </div>
                                        <div class="modal-body">
                                        <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('payrollAgents/update/' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="id" value="<?php echo $new['id']; ?>">

                                        <div class="form-group">
                                            <label>Agent</label>
                                            <input type="text" class="form-control" id="agent_name" name="agent_name" value="<?php echo $new['agent_name']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Campaign</label>
                                            <input type="text" class="form-control" id="campaign" name="campaign" value="<?php echo $new['campaign']; ?>">
                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control" id="user_email" name="user_email" value="<?php echo $new['user_email']; ?>">
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Agent ID</label>
                                                    <input type="text" class="form-control" id="agent_id_<?php echo $new['id']; ?>" name="agent_id" value="<?php echo $new['agent_id']; ?>">
                                                    <input type="hidden" class="form-control" name="agent_old" value="<?php echo $new['agent_id']; ?>">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>House Rent</label>
                                                    <input type="number" class="form-control" id="house_rent" name="house_rent" value="<?php echo $new['house_rent']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Hours of Work</label>
                                                    <input type="text" class="form-control" id="required_work" name="required_work" value="<?php echo $new['required_work']; ?>" placeholder="eg: 08:00 as 8 hours">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Start Date</label>
                                                    <input type="date" class="form-control" id="start_date" name="start_date" value="<?php echo $new['start_date']; ?>">
                                                </div>
                                            </div>
                                        </div>
                                         

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Daily Salary</label>
                                                    <input type="number" class="form-control" id="daily_salary" name="daily_salary" value="<?php echo $new['daily_salary']; ?>" step="0.01">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>SSS</label>
                                                    <input type="number" class="form-control" id="SSS" name="SSS" value="<?php echo $new['SSS']; ?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pag Ibig</label>
                                                    <input type="number" class="form-control" id="pag_ibig" name="pag_ibig" value="<?php echo $new['pag_ibig']; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                <label>Phil Health</label>
                                                    <input type="number" class="form-control" id="philhealth" name="philhealth" value="<?php echo $new['philhealth']; ?>">
                                                </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" id="updateheadset" class="btn btn-success" >Save</button>
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
        <!-- [ Main Content ] end -->
      </div>
      
    </section>

<div class="modal fade" id="pagIbigModal" tabindex="-1" role="dialog" aria-labelledby="pagIbigModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="pagIbigModalLabel">New pag-ibig for selected agents</h4>
            </div>
            <div class="modal-body">
                <form id="updatePagIbigForm" action="<?= site_url('updateselected/PagIbig') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selectedAgentsInput" name="selected_agents">
                    <div class="form-group">
                        <label for="pagIbigInput">Pag Ibig Value</label>
                        <input type="number" class="form-control" id="pagIbigInput" name="pag_ibig_value" placeholder="Input a value" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="dailySalaryModal" tabindex="-1" role="dialog" aria-labelledby="dailySalaryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="dailySalaryModalLabel">New daily salary for selected agents</h4>
            </div>
            <div class="modal-body">
                <form id="updateDailySalaryForm" action="<?= site_url('updateselected/DailySalary') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selectedAgentsInputDaily" name="selected_agents">
                    <div class="form-group">
                        <input type="number" class="form-control" id="dailySalaryInput" name="daily_salary_value" placeholder="Input a value" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>




<div class="modal fade" id="sssModal" tabindex="-1" role="dialog" aria-labelledby="sssModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="sssModalLabel">New SSS for selected agents</h4>
            </div>
            <div class="modal-body">
                <form id="updateDailySalaryForm" action="<?= site_url('update/SSS') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selectedAgentsInputSSS" name="selected_agents">
                    <div class="form-group">
                        <input type="number" class="form-control" id="SSSInput" name="SSS_value" placeholder="Input a value" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="philHealthModal" tabindex="-1" role="dialog" aria-labelledby="philHealthModalLabel" aria-hidden="true" required/>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="philHealthModalLabel">New philHealth for selected agents</h4>
            </div>
            <div class="modal-body">
                <form id="updateDailySalaryForm" action="<?= site_url('update/philhealth') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selectedAgentsInputPhilHealth" name="selected_agents">
                    <div class="form-group">
                        <input type="number" class="form-control" id="PhilhealthInput" name="philhealth_value" placeholder="Input a value" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="houseRentModal" tabindex="-1" role="dialog" aria-labelledby="houseRentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="houseRentModalLabel">New house rent for selected agents</h4>
            </div>
            <div class="modal-body">
                <form id="updateDailySalaryForm" action="<?= site_url('update/houserent') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selectedAgentsInputHouseRent" name="selected_agents">
                    <div class="form-group">
                        <input type="number" class="form-control" id="HouseRentInput" name="houserent_value" placeholder="Input a value" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="requiredWorkModal" tabindex="-1" role="dialog" aria-labelledby="requiredWorkModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="requiredWorkModalLabel">New required work for selected agents</h4>
            </div>
            <div class="modal-body">
                <form id="updateDailySalaryForm" action="<?= site_url('update/requiredWork') ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" id="selectedAgentsInputRequiredWork" name="selected_agents">
                    <div class="form-group">
                        <label for="requiredWorkInput">Required Work</label>
                        <input type="text" class="form-control" id="requiredWorkInput" name="requiredWork_value" placeholder="eg: 8:00 for 8 hrs" required/>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Save</button>
            </div>
            </form>
        </div>
    </div>
</div>









<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Agent</h5>
                </div>
                <form action="<?= site_url('payroll/addagent') ?>" method="POST">
                    <div class="modal-body">


                    <div class="form-group">
                            <label>Agent</label>
                            <input type="text" class="form-control" id="agent_name" name="agent_name" required/>
                        </div>

                        <div class="form-group">
                            <label>Campaign</label>
                            <input type="text" class="form-control" id="campaign" name="campaign" required/ >
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" id="user_email" name="user_email" required/>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Agent ID</label>
                                    <input type="text" class="form-control" id="agentlist_agent_id" name="agent_id" required/>
                                    <div id="agentlist_agent_id_error" class="text-danger"></div> <!-- Error message container -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>House Rent</label>
                                    <input type="number" class="form-control" id="house_rent" name="house_rent" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Hours of Work</label>
                                    <input type="text" class="form-control" id="required_work" name="required_work"  placeholder="eg: 08:00 as 8 hours" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" >
                                </div>
                            </div>
                        </div>
                            

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Daily Salary</label>
                                    <input type="number" class="form-control" id="daily_salary" name="daily_salary" required/>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>SSS</label>
                                    <input type="number" class="form-control" id="SSS" name="SSS" >
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Pag Ibig</label>
                                    <input type="number" class="form-control" id="pag_ibig" name="pag_ibig">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                <label>Phil Health</label>
                                    <input type="number" class="form-control" id="philhealth" name="philhealth" >
                                </div>
                                </div>
                            </div>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="agentlist_updateBtn">Insert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>






    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/payroll_scripts.js') ?>"></script>
    <script src="<?= base_url('template/semantic.min.js') ?>"></script>
    <script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>


<script>

document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const agentCheckboxes = document.querySelectorAll('.agentCheckbox');
    const selectedCount = document.getElementById('selectedCount');

    selectAllCheckbox.addEventListener('change', function() {
      agentCheckboxes.forEach(function(checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
      });
      updateSelectedCount();
    });

    document.addEventListener('change', function(event) {
      if (event.target.classList.contains('agentCheckbox')) {
        updateSelectAllCheckbox();
        updateSelectedCount();
      }
    });

    function updateSelectAllCheckbox() {
      let checkedCount = document.querySelectorAll('.agentCheckbox:checked').length;
      selectAllCheckbox.checked = checkedCount === agentCheckboxes.length;
    }

    function updateSelectedCount() {
      let checkedCount = document.querySelectorAll('.agentCheckbox:checked').length;
      selectedCount.textContent = checkedCount + ' selected';
      selectedCount.style.display = checkedCount === 0 ? 'none' : 'block'; // Hide if 0 selected
    }
  });



function confirmAgentDelete(event) {
    event.preventDefault(); 
    Swal.fire({
        title: "Are you sure?",
        text: "Once deleted, it cannot be undone!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#9ACD32",
        confirmButtonText: "Yes",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = event.target.href;
        }
    });
}

  document.addEventListener("DOMContentLoaded", function() {
    var agentIdInput = document.getElementById("agentlist_agent_id");

    agentIdInput.addEventListener("input", function(event) {
        var inputValue = event.target.value;
        var newValue = inputValue.replace(/\s/g, ''); // Remove spaces

        if (inputValue !== newValue) {
            event.target.value = newValue;
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Get all input elements whose IDs follow the pattern "agent_id_<id>"
    var agentIdInputs = document.querySelectorAll('input[id^="agent_id_"]');

    // Iterate over each input field and attach the input event listener
    agentIdInputs.forEach(function(agentIdInput) {
        agentIdInput.addEventListener("input", function(event) {
            var inputValue = event.target.value;
            var newValue = inputValue.replace(/\s/g, ''); // Remove spaces

            if (inputValue !== newValue) {
                event.target.value = newValue;
            }
        });
    });
});

$(document).ready(function() {
    $('#agentlist_agent_id').on('input', function() {
        var agent_id = $(this).val();
        $.ajax({
            url: '<?= site_url('check_agent_id') ?>',
            method: 'POST',
            data: { agent_id: agent_id },
            success: function(response) {
                if (response.exists) {
                    $('#agentlist_agent_id_error').text('Agent ID already exists.');
                    $('#agentlist_updateBtn').prop('disabled', true);
                } else {
                    $('#agentlist_agent_id_error').text('');
                    $('#agentlist_updateBtn').prop('disabled', false);
                }
            }
        });
    });
});


    $(document).ready(function() {
        // Select All checkbox functionality
        $('#selectAllCheckbox').change(function() {
            $('.agentCheckbox').prop('checked', $(this).prop('checked'));
            togglePagIbigButton();
        });

        $('.agentCheckbox').change(function() {
            togglePagIbigButton();
        });

        $('#pagIbigModal').on('show.bs.modal', function(event) {
            var selectedAgents = [];
            $('.agentCheckbox:checked').each(function() {
                selectedAgents.push($(this).val());
            });
            $('#selectedAgentsInput').val(JSON.stringify(selectedAgents)); // Convert array to JSON string
        });

        $('#dailySalaryModal').on('show.bs.modal', function(event) {
            var selectedAgentsDaily = [];
            $('.agentCheckbox:checked').each(function() {
                selectedAgentsDaily.push($(this).val());
            });
            $('#selectedAgentsInputDaily').val(JSON.stringify(selectedAgentsDaily)); // Convert array to JSON string
        });

        $('#sssModal').on('show.bs.modal', function(event) {
            var selectedAgentsSSS = [];
            $('.agentCheckbox:checked').each(function() {
                selectedAgentsSSS.push($(this).val());
            });
            $('#selectedAgentsInputSSS').val(JSON.stringify(selectedAgentsSSS)); // Convert array to JSON string
        });

        $('#philHealthModal').on('show.bs.modal', function(event) {
            var selectedAgentsPhilHealth = [];
            $('.agentCheckbox:checked').each(function() {
                selectedAgentsPhilHealth.push($(this).val());
            });
            $('#selectedAgentsInputPhilHealth').val(JSON.stringify(selectedAgentsPhilHealth)); // Convert array to JSON string
        });

        $('#houseRentModal').on('show.bs.modal', function(event) {
            var selectedAgentsHouseRent = [];
            $('.agentCheckbox:checked').each(function() {
                selectedAgentsHouseRent.push($(this).val());
            });
            $('#selectedAgentsInputHouseRent').val(JSON.stringify(selectedAgentsHouseRent)); // Convert array to JSON string
        });
        
        $('#requiredWorkModal').on('show.bs.modal', function(event) {
            var selectedAgentsRequiredWork = [];
            $('.agentCheckbox:checked').each(function() {
                selectedAgentsRequiredWork.push($(this).val());
            });
            $('#selectedAgentsInputRequiredWork').val(JSON.stringify(selectedAgentsRequiredWork)); // Convert array to JSON string
        });

        function togglePagIbigButton() {
            if ($('.agentCheckbox:checked').length > 0) {
                $('#pagIbigButton').show();
            } else {
                $('#pagIbigButton').hide();
            }
        }
    });

    


document.getElementById('addLeaveBtn').addEventListener('click', function () {
    // Show "Please wait" SweetAlert
    Swal.fire({
        title: 'Please wait',
        text: 'Generating...',
        icon: 'info',
        allowOutsideClick: false,
        showConfirmButton: false,
        onBeforeOpen: () => {
            Swal.showLoading();
        },
    });

    // AJAX request to insert rows
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '<?= base_url('add_leave/rows') ?>', true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4) {
            Swal.close(); // Close "Please wait" SweetAlert
            if (xhr.status == 200) {
                // Handle the response here
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    Swal.fire({
                        title: 'Success',
                        text: response.message,
                        icon: 'success',
                    }).then(function () {
                        // Reload the page
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: 'Failed to insert rows',
                        icon: 'error',
                    });
                }
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to insert rows (HTTP Error ' + xhr.status + ')',
                    icon: 'error',
                });
            }
        }
    };
    xhr.send();
});



</script>

<script>
window.addEventListener('load', () => {
        const preloader = document.querySelector('.preloader');
        preloader.style.display = 'none';
    });
</script>




<?php
include_once('payroll_template/payroll_scripts.php');
?>
<?= $this->include('footers_headers/payroll_table_footer') ?>       
