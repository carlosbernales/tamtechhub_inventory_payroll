<?= $this->include('footers_headers/payroll_table_header') ?>


<link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>">


<style>

.custom-table tbody tr td {
    height: 25px; 
}
.custom-table thead th {
    height: 25px;
}
.custom-table {
	width: 20%; 
}
</style>

<!-- [ Main Content ] start -->
<section class="pc-container">
  <div class="pc-content">
    <!-- [ Main Content ] start -->
    <div class="row">
      <!-- Setting Defaults table start -->
      <div class="col-sm-12">
        <div class="card-header" style="display: flex; justify-content: space-between;">
          <a href="#" class="btn btn-success " data-toggle="modal" data-target="#myModal" style="margin-right: 10px;">+ <i class="flaticon-users"></i></a>
          <h1><?= $agent['agent_name']; ?></h1>
          <a href="<?= site_url('payroll/agents') ?>" class="btn btn-secondary">Close</a>
        </div>
        <div class="card-body">
          <div class="dt-responsive">
            <table  class="table table-striped table-bordered nowrap">
              <thead>
                <tr>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Status</th>
                  <th>Date of Leave</th>
                  <th>Remarks</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                <?php if (empty($leave)): ?>
                  <tr>
                    <td colspan="6" style="text-align: center; font-weight: bold; font-size: 16px;">No current leave</td>
                  </tr>
                <?php else: ?>
                  <?php foreach ($leave as $new): ?>
                    <tr>
                      <td class="agent-leave-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo date('F j, Y', strtotime($new['start_date'])); ?></td>
                      <td class="agent-leave-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo date('F j, Y', strtotime($new['end_date'])); ?></td>
                      <td class="agent-leave-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" style="<?php 
                        if ($new['status'] === 'Unused') {
                          echo 'color: black; background-color: #F0E68C;';
                        } elseif ($new['status'] === 'Used') {
                          echo 'color: white; background-color: #ff9999;';
                        }
                      ?>">
                        <?php echo $new['status']; ?>
                      </td>
                      <td class="agent-leave-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>">
                        <?php
                          $date_of_leave = $new['date_of_leave'];
                          if (!empty($date_of_leave) && $date_of_leave !== '0000-00-00' && strtotime($date_of_leave) !== false) {
                            echo date('F j, Y', strtotime($date_of_leave));
                          } else {
                            echo 'None';
                          }
                        ?>
                      </td>
                      <td class="agent-leave-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['comment']; ?></td>
                      <td style="width:3%">
                        <button class="btn btn-primary btn-sm hidden" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>
                        <a href="<?= site_url('delete_leave_'.$new['id']) ?>" class="fa fa-trash delete" style="font-size: 2em; color: red;" onclick="confirmAgentDelete(event)"></a>
                      </td>
                    </tr>
                    <!-- EDIT MODAL -->
                    <div class="modal fade" id="editModal-<?php echo $new['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel-<?php echo $new['id']; ?>" aria-hidden="true" data-backdrop="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h4 class="modal-title" id="editModalLabel-<?php echo $new['id']; ?>"><strong>Agent ID:</strong> <span style="color: red;"><?php echo $new['agent_id']; ?></span></h4>
                          </div>
                          <div class="modal-body">
                            <form id="editCategoryForm-<?php echo $new['id']; ?>" action="<?= site_url('update/leave_' . $new['id']) ?>" method="POST" enctype="multipart/form-data">
                              <?= csrf_field(); ?>
                              <input type="hidden" name="id" value="<?php echo $new['id']; ?>">
                              <input type="hidden" name="agent_id" value="<?php echo $new['agent_id']; ?>">

                              <div class="form-group">
                                <label>Date of Leave</label>
                                <input type="date" class="form-control" name="date_of_leave" value = "<?php echo $new['date_of_leave']; ?>"required>
                              </div>
                              <div class="form-group">
                                <label>Remarks</label>
                                <input type="text" class="form-control" name="comment" value="<?php echo $new['comment']; ?>" required>
                              </div>
                              
                              <div class="form-group">
                                <label>Rate</label>
                                <input type="number" class="form-control" name="daily_salary" value="<?= $agent['daily_salary']; ?>" required>
                              </div>
                              <div class="modal-footer">NOTE: When applying for leave, the current daily rate will be set as the rate for this paid leave.
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" id="updateheadset" class="btn btn-success" >Save</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
            <table class="table table-bordered table-head-bg-info table-bordered-bd-info custom-table">
              <thead>
                <tr>
                  <th scope="col" colspan="2">Remaining and used leave</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Number of leave used</strong></td>
                  <td style="color: red; font-weight: bold;"><?php echo $usedCount; ?></td>
                </tr>
                <tr>
                  <td><strong>Remaining leave credits</strong></td>
                  <td style="color: red; font-weight: bold;"><?php echo $unusedCount; ?></td>
                </tr>
              </tbody>
            </table>
            <div style="text-align: right;">
              <a href="<?= site_url('leave/History' . $agent['id']) ?>" class="btn btn-secondary">
                <i class="fas fa-history"></i> History
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- [ Main Content ] end -->
  </div>
</section>






    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                </div>
                <form action="<?= site_url('leave_rows_optional/COunt') ?>" method="POST">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Number of leave</label>
                            <input type="number" class="form-control" name="number_of_leave" required>
                        </div>
						
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="hidden" class="form-control"name="id" value="<?= $agent['id']; ?>">
                            <input type="hidden" class="form-control"name="agent_id" value="<?= $agent['agent_id']; ?>">
                            <input type="date" class="form-control"name="start_date" value="<?= $agent['start_date']; ?>"required>
                            <input type="hidden" class="form-control"name="daily_salary" value="<?= $agent['daily_salary']; ?>"required>
                            <input type="hidden" class="form-control"name="required_work" value="<?= $agent['required_work']; ?>"required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" >Insert</button>
                    </div>
                </form>
            </div>
        </div>


    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/payroll_scripts.js') ?>"></script>






<?php
include_once('payroll_template/payroll_scripts.php');
?>
<?= $this->include('footers_headers/payroll_table_footer') ?>       
