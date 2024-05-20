<?= $this->include('footers_headers/payroll_table_header') ?>

<link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>"> 
<link rel="stylesheet" href="<?= base_url('template/semantic.min.css') ?>">

<style>

    .pc-container {
      width: 100%;
      padding: 20px;
    }

    .pc-content {
      width: 100%;
    }

    .row {
      display: flex;
      flex-wrap: wrap;
      margin-right: -15px;
      margin-left: -15px;
    }

    .col-md-2 {
      flex: 0 0 25%;
      max-width: 25%;
      padding-right: 15px;
      padding-left: 15px;
    }

    .card-header {
      display: flex;
      justify-content: space-between;
    }

    .card-body {
      padding: 15px;
    }

    .list-unstyled li {
      margin-bottom: 10px;
    }

    .border {
        border: 1px solid #ccc;
        padding: 10px;
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
<div class="preloader">
    <img src="<?= base_url('logindes/images/tamtechlogo.png') ?>" alt="Preloader">
</div>
    <!-- [ Main Content ] start -->
    <section class="pc-container">
    <div class="pc-content">
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- Setting Defaults list start -->
        <div class="col-md-12">
          <div class="card">
            
          <div class="card-header">
            <h3>Agent Payslips</h3>
            <h3><span class="date-range">Payslips from Start Date to End Date</span></h3>
            <div class="col-sm-6 col-xl-3">
                <div class="mb-0">
                    <div class="ui search selection dropdown payslip_dropdown no-border-input">
                        <input type="hidden" name="agent_id" id="agent_id">
                        <i class="dropdown icon"></i>
                        <div class="default text">Select Date</div>
                        <div class="menu">
                            <?php 
                            $unique_combinations = []; // Initialize an array to store unique combinations
                            foreach ($agent_payslips as $new):
                                $combination = $new['startDate'] . '_' . $new['end_date']; // Combine startDate and end_date
                                if (!in_array($combination, $unique_combinations)) { // Check if combination is not already added
                                    array_push($unique_combinations, $combination); // Add combination to unique_combinations array
                            ?>
                                    <div class="item" data-value="<?= $combination; ?>">
                                    <span class="text"><?= date('F j, Y', strtotime($new['startDate'])); ?> to <?= date('F j, Y', strtotime($new['end_date'])); ?></span>
                                    </div>
                            <?php 
                                }
                            endforeach; 
                            ?>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="show_data">Show</button>
                </div>
            </div>
        </div>


                
            
        <div class="card-body">
                        <!-- Container to display dynamic content -->
                <div id="dynamic_content">
                    <!-- Dynamic content will be loaded here -->
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>





   
  
    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('template/semantic.min.js') ?>"></script>

    <script>
    $('.ui.dropdown')
        .dropdown();
  </script>
<script>
    $(document).ready(function () {
        $('#show_data').click(function (e) {
            e.preventDefault();

            var selectedValue = $('.payslip_dropdown .menu .item.active.selected').data('value');
            var dateRange = selectedValue.split('_');
            var startDate = formatDate(dateRange[0]); // Format start date
            var endDate = formatDate(dateRange[1]); // Format end date

            $.ajax({
                type: 'GET',
                url: '<?= base_url('agents/payslips'); ?>',
                data: {
                    startDate: dateRange[0],
                    endDate: dateRange[1]
                },
                success: function (data) {
                    $('#dynamic_content').empty(); // Clear existing content
                    var row = $('<div class="row"></div>'); // Create a new row
                    $.each(data, function(index, item) {
                        var html = '<div class="col-md-2 mb-3 border">'; // Add border class
                        html += '<ul class="list-unstyled">';
                        html += '<li><strong><span style="font-size: 16px;">' + item.agent_name + '</span></strong></li>';
                        if(item.base_pay != 0) html += '<li><strong>Base Pay:</strong> &#8369; ' + item.base_pay + '</li>';
                        if(item.camp_allowance != 0) html += '<li><strong>Campaign Allowance:</strong> &#8369; ' + item.camp_allowance + '</li>';
                        if(item.attendance_bonus != 0) html += '<li><strong>Attendance Bonus:</strong> &#8369; ' + item.attendance_bonus + '</li>';
                        if(item.spiff_incentive != 0) html += '<li><strong>Spiff/Incentives/CSAT:</strong> &#8369; ' + item.spiff_incentive + '</li>';
                        if(item.overtime_pay != 0) html += '<li><strong>Total Overtime Pay:</strong> &#8369; ' + item.overtime_pay + '</li>';
                        if(item.nd_pay != 0) html += '<li><strong>Total Night Shift Differential Pay:</strong> &#8369; ' + item.nd_pay + '</li>';
                        if(item.ndOt_pay != 0) html += '<li><strong>Total Night Shift Differential OT Pay:</strong> &#8369; ' + item.ndOt_pay + '</li>';
                        if(item.other_add != 0) html += '<li ><strong>Others ('+ item.others_add_comment +'):</strong> &#8369; ' + item.other_add + '</li>';
                        
                        if(item.other_addPay_one != 0) html += '<li style="padding-left: 40px;"><strong>('+ item.otherAddComment_one +'):</strong> &#8369; ' + item.other_addPay_one + '</li>';
                        html += '<li><strong>Gross Pay:</strong> &#8369; ' + item.gross_pay + '</li>';;
                        if(item.total_deduction != 0) html += '<li style="font-size: 13px; color: red;"><strong>DEDUCTIONS</strong></li>';
                        if(item.late_deduction != 0) html += '<li><strong>Late Deduction:</strong> <span style="color: red;">&#8369; ' + item.late_deduction + '</span></li>';
                        if(item.undertime_deduction != 0) html += '<li><strong>Undertime Deduction:</strong> <span style="color: red;">&#8369; ' + item.undertime_deduction + '</span></li>';
                        if(item.cash_advance != 0) html += '<li><strong>Cash Advance:</strong> <span style="color: red;">&#8369; ' + item.cash_advance + '</span></li>';
                        if(item.sss_deduction != 0) html += '<li><strong>SSS Deduction:</strong> <span style="color: red;">&#8369; ' + item.sss_deduction + '</span></li>';
                        if(item.sss_loan != 0) html += '<li><strong>SSS Loan:</strong> <span style="color: red;">&#8369; ' + item.sss_loan + '</span></li>';
                        if(item.pag_ibig_deduction != 0) html += '<li><strong>Pag Ibig Deduction:</strong> <span style="color: red;">&#8369; ' + item.pag_ibig_deduction + '</span></li>';
                        if(item.pag_ibig_loan != 0) html += '<li><strong>Pag Ibig Loan:</strong> <span style="color: red;">&#8369; ' + item.pag_ibig_loan + '</span></li>';
                        if(item.philhealth_deduction != 0) html += '<li><strong>PhilHealth Deduction:</strong><span style="color: red;">&#8369; ' + item.philhealth_deduction + '</span> </li>';
                        if(item.house_rent != 0) html += '<li><strong>House Rent:</strong> <span style="color: red;">&#8369; ' + item.house_rent + '</span></li>';
                        if(item.other_deduction != 0) html += '<li><strong>Other Deduction ('+ item.others_deduc_comment +'):</strong> <span style="color: red;">&#8369; ' + item.other_deduction + '</span></li>';
                        
                        if(item.Otherdeduc_one != 0) html += '<li style="padding-left: 40px;"><strong>('+ item.DeducComment_one +'):</strong> <span style="color: red;">&#8369; ' + item.Otherdeduc_one + '</span></li>';
                        
                        if(item.total_deduction != 0) html += '<li><strong>TOTAL DEDUCTION:</strong> <span style="color: red;">&#8369; ' + item.total_deduction + '</span></li>';
                        html += '<li><span style="font-size: 16px;"><strong>Total Net Pay:</strong> &#8369; ' + item.total_net_pay + '</span></li>';
                        html += '</ul></div>';

                        row.append(html); // Append the HTML to the current row

                        if ((index + 1) % 4 === 0 || index === data.length - 1) { // Changed to 4 columns per row
                            $('#dynamic_content').append(row); // Append the row to the dynamic_content div
                            row = $('<div class="row"></div>'); // Create a new row
                        }
                    });

                    $('.date-range').html('Payslips from <span style="color: green;">' + startDate + '</span> to <span style="color: green;">' + endDate + '</span>');

                },
                error: function (xhr, status, error) {
                    console.log(error);
                }
            });
        });
    });


    function formatDate(dateStr) {
        var dateObj = new Date(dateStr);
        var options = { month: 'long', day: 'numeric', year: 'numeric' };
        return dateObj.toLocaleDateString('en-US', options);
    }
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
