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
        <div class="col-md-12">
            <?php if (empty($leaveByYear)): ?>
                <div class="card">
                    <div class="card-body">
                        <p>No leave history available.</p>
                        <h1><?= !empty($agent['agent_name']) ? $agent['agent_name'] : 'Agent Name Not Available' ?></h1>
                        <a href="<?= site_url('leave/View_' . $agent['id']) ?>" class="btn btn-secondary">Close</a>
                    </div>
                </div>
            <?php else: ?>
                <div class="card">
                    <div class="card-header" style="display: flex; justify-content: space-between;">
                        <h1><?= !empty($agent['agent_name']) ? $agent['agent_name'] : 'Agent Name Not Available' ?></h1>
                        <a href="javascript:history.back()" class="btn btn-secondary">Close</a>
                    </div>
                    <div class="card-body">
                        <?php $count = 0; ?>
                        <?php foreach ($leaveByYear as $year => $leave): ?>
                            <?php
                            $usedCount = 0;
                            $unusedCount = 0;
                            foreach ($leave as $new) {
                                if ($new['status'] == 'Used') {
                                    $usedCount++;
                                } else {
                                    $unusedCount++;
                                }
                            }
                            ?>
                            <?php if ($count % 2 === 0): ?>
                                <div class="row">
                            <?php endif; ?>
                            <div class="col-md-6 <?php echo $count % 2 === 0 ? 'pl-md-2' : 'pr-md-2'; ?>">
                                <h3 style="text-align: center; font-weight: bold; font-size: 20px;"><?= $year ?></h3>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-head-bg-info table-bordered-bd-info custom-table">
                                        <thead>
                                            <tr>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Status</th>
                                                <th>Date of Leave</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($leave as $new): ?>
                                                <tr>
                                                    <td><?= date('F j, Y', strtotime($new['start_date'])) ?></td>
                                                    <td><?= date('F j, Y', strtotime($new['end_date'])) ?></td>
                                                    <td class="agent-leave-cell-clickable"><?php echo $new['status']; ?></td>
                                                    <td class="agent-leave-cell-clickable">
                                                        <?php
                                                        $date_of_leave = $new['date_of_leave'];
                                                        if (!empty($date_of_leave) && $date_of_leave !== '0000-00-00' && strtotime($date_of_leave) !== false) {
                                                            echo date('F j, Y', strtotime($date_of_leave));
                                                        } else {
                                                            echo 'None';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td class="agent-leave-cell-clickable"><?php echo $new['comment']; ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <strong>Number of leave used: <span style="color: red;"><?= $usedCount ?></span></strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                <strong>Remaining leave credits: <span style="color: red;"><?= $unusedCount ?></span></strong>
                                            </td>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                            <?php if ($count % 2 === 1 || $count === count($leaveByYear) - 1): ?>
                                </div>
                            <?php endif; ?>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- [ Main Content ] end -->
  </div>
</section>






    


    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/payroll_scripts.js') ?>"></script>






<?php
include_once('payroll_template/payroll_scripts.php');
?>
<?= $this->include('footers_headers/payroll_table_footer') ?>       
