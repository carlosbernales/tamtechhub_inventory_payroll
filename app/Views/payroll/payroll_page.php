
<!DOCTYPE html>
<html lang="en">
  <!-- [Head] start -->
  <head>
    <title>TAMTECH</title>
    <!-- [Meta] -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="description"
      content="Light Able admin and dashboard template offer a variety of UI elements and pages, ensuring your admin panel is both fast and effective."
    />
    <meta name="author" content="phoenixcoded" />

    <!-- [Favicon] icon -->
    <link rel="icon" href="<?= base_url('logindes/images/tamtechlogo.png') ?>" type="image/x-icon" />

    <!-- [Page specific CSS] start -->
    <!-- data tables css -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/plugins/dataTables.bootstrap5.min.css')?>">
    <!-- [Page specific CSS] end -->
    <!-- [Google Font : Public Sans] icon -->
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- [Tabler Icons] https://tablericons.com -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/tabler-icons.min.css')?>" >
    <!-- [Feather Icons] https://feathericons.com -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/feather.css')?>" >
    <!-- [Font Awesome Icons] https://fontawesome.com/icons -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/fontawesome.css')?>" >
    <!-- [Material Icons] https://fonts.google.com/icons -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/fonts/material.css')?>" >
    <!-- [Template CSS Files] -->
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/style.css')?>" id="main-style-link" >
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/style-preset.css')?>" >
    <link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('template/semantic.min.css') ?>">

  </head>
  <style>
    .hide {
    display: none;
  }
  .green-label {
            color: blue;
            animation: glow 1s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px #00ff00, 0 0 20px #00ff00, 0 0 30px #00ff00;
            }
            to {
                text-shadow: 0 0 20px #00ff00, 0 0 30px #00ff00, 0 0 40px #00ff00;
            }
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
  <!-- [Head] end -->
  <!-- [Body] Start -->
  <div class="preloader">
    <img src="<?= base_url('logindes/images/tamtechlogo.png') ?>" alt="Preloader">
</div>
  <body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">

  <!-- [ Main Content ] start -->
  <div class="">
    <div class="pc-content">
      
    <h1></h1>

      <div class="row">
        <div class="col-sm-12">
          <div class="card">
          <a href="<?php echo base_url('payslip/list'); ?>" class="btn btn-close position-absolute top-0 end-0 m-3"></a>
            <div class="card-body">
              <div class="row g-3">
                <div class="col-sm-6 col-xl-3">
                  <div class="mb-0">
                    <div class="ui search selection dropdown payroll_dropdown no-border-input">
                      <input type="hidden" name="agent_id" id="agent_id">
                        <i class="dropdown icon"></i>
                        <div class="default text">Select Agent</div>
                          <div class="menu">
                            <?php foreach ($agents as $agent): ?>
                                <div class="item" data-value="<?= $agent['agent_id']; ?>">
                                    <span class="text"><?= $agent['agent_name']; ?></span>
                          </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <button class="btn btn-primary" id="calculate_total">Generate</button>
                  </div>
                </div>

                <div class="col-sm-6 col-xl-3">
                    <div class="mb-0">
                        <label class="form-label">Start Date</label>
                        <input type="date" id="start_date" class="form-control" value="<?= session('lastStartDate') ?>">
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="mb-0">
                        <label class="form-label">End Date</label>
                        <input type="date" id="end_date" class="form-control" value="<?= session('lastEndDate') ?>">
                    </div>
                </div>
                
            

            
                <div class="col-12">
                  <h5>Detail</h5>
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th style="background-color: #ADD8E6 ; font-weight: bold;">Daily Rate</th>
                                <th style="background-color: #90EE90; font-weight: bold;">Required Work</th>
                                <th style="background-color: #FFFFE0 ; font-weight: bold;">Actual Work</th>
                                <th style="background-color: #D8BFD8 ; font-weight: bold;">ND</th>
                                <th style="background-color: #FFA07A ; font-weight: bold;">Late</th>
                                <th style="background-color: #FFA500 ; font-weight: bold;">Undertime</th>
                                <th style="background-color: #FFB6C1 ; font-weight: bold;">OT</th>
                                <th style="background-color: #EE82EE ; font-weight: bold;">ND OT</th>
                                <th style="background-color: #E0FFFF ; font-weight: bold;">OT Pay</th>
                                <th style="background-color: #D3D3D3 ; font-weight: bold;">Total Pay</th>
                                <th style="background-color: #20B2AA ; font-weight: bold;">Date</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="attendance_table_body">
                            <!-- Attendance data will be dynamically populated here -->
                        </tbody>
                    </table>
                  </div>
                </div>
                <div class="col-12">
                  <div class="invoice-total ms-auto">
                    <div class="row">


                       



                      <div class="col-6">
                      <form  action="<?= site_url('generate/payslip') ?>" method="POST" enctype="multipart/form-data">

                      <p class="f-w-600 mb-1 text-start" id="basePay_label">Base Pay: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_base_pay" id="input_base_pay" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly >
                      </div>


                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" >Normal Day: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="normal_totalPay_input" id="normal_totalPay_input"  contenteditable="true" style="border: none; background-color: transparent;"readonly>
                      </div>
                      
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="normalDayNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="normalNd_totalPay_input" id="normalNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="normalDayOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="normalOT_totalPay_input" id="normalOT_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="normalDayNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="normalNdOvertime_totalPay_input" id="normalNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>



                      
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="restdayLabel">Rest Day: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RD_totalPay_input" id="RD_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="restdayNDlabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RdNd_totalPay_input" id="RdNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="restdayOtlabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RdOvertime_totalPay_input" id="RdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="restdayNdOtlabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RdNdOvertime_totalPay_input" id="RdNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div>      
                    
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="regularHolLabel">Regular Holiday: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="Rh_totalPay_input" id="Rh_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="regularHolNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhNd_totalPay_input" id="RhNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="regularHolOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhOvertime_totalPay_input" id="RhOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="regularHolNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhNdOvertime_totalPay_input" id="RhNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      
                      
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="regularHolRdLabel">Regular Holiday & Rest Day: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhRd_totalPay_input" id="RhRd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="regularHolRdNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhRdNd_totalPay_input" id="RhRdNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="regularHolRdOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhRdOvertime_totalPay_input" id="RhRdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="regularHolRdNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="RhRdNdOvertime_totalPay_input" id="RhRdNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      
                      
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="SpecialHolLabel">Special Holiday: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="Sp_totalPay_input" id="Sp_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="SpecialHolNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpNd_totalPay_input" id="SpNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="SpecialHolOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpOvertime_totalPay_input" id="SpOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="SpecialHolNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpNdOvertime_totalPay_input" id="SpNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 




                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="SpecialHolRdLabel">Special Holiday & Rest Day: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpRd_totalPay_input" id="SpRd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly> 
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="SpecialHolRdNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpRdNd_totalPay_input" id="SpRdNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="SpecialHolRdOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpRdOvertime_totalPay_input" id="SpRdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="SpecialHolRdNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="SpRdNdOvertime_totalPay_input" id="SpRdNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 




                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="DoubleHolLabel">Double Holiday: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="Db_totalPay_input" id="Db_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="DoubleHolNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbNd_totalPay_input" id="DbNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="DoubleHolOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbOvertime_totalPay_input" id="DbOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="DoubleHolNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbNdOvertime_totalPay_input" id="DbNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 




                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="DoubleHolRdLabel">Double Holiday & Rest Day: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbRd_totalPay_input" id="DbRd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="DoubleHolRdNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbRdNd_totalPay_input" id="DbRdNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="DoubleHolRdOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbRdOvertime_totalPay_input" id="DbRdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="DoubleHolRdNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DbRdNdOvertime_totalPay_input" id="DbRdNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 


                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="doubleSpecialHolLabel">Double Special Holiday: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="Dsh_totalPay_input" id="Dsh_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="doubleSpecialNdHolLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshNd_totalPay_input" id="DshNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="doubleSpecialOtHolLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshOvertime_totalPay_input" id="DshOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                       <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="doubleSpecialNdOtHolLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshNdOvertime_totalPay_input" id="DshNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 





                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="doubleSpecialHolRdLabel">Double Special Holiday & Rest Day: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshRd_totalPay_input" id="DshRd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="doubleSpecialHolRdNdLabel">Night Diff: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshRdNd_totalPay_input" id="DshRdNd_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="doubleSpecialHolOtLabel">OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshRdOvertime_totalPay_input" id="DshRdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="padding-left: 20px;" id="doubleSpecialHolRdNdOtLabel">Night Diff OT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="DshRdNdOvertime_totalPay_input" id="DshRdNdOvertime_totalPay_input" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 


                      <div class="col-6 "> <p class="text-muted mb-1 text-start" id = "paidLeaveLabel">Paid Leave: </p></div>
                      <div class="col-6 "> <p class="f-w-600 mb-1 text-end"><span id="paid_leave">0</span></p></div>

                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="holLeaveLabel">Holiday Leave: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="holidayleavePaid" id="holidayleavePaid" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>


                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 


                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="offRegHolLabel">Off/Regular Holiday: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="regHolPaid" id="regHolPaid" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div>


                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      
                      

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="input_total_ND_payLabel">Total Night Differential Pay: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_total_ND_pay" id="input_total_ND_pay" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 


                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="input_total_overtime_payLabel">Total Overtime Pay: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_total_overtime_pay" id="input_total_overtime_pay" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 


                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="input_total_NDOT_payLabel">Total Night Differential OT Pay: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_total_NDOT_pay" id="input_total_NDOT_pay" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="attendance_bonuslabel">Attendance Bonus: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_bonus" id="input_bonus" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="incentive_label">Spiff/Incentive/CSAT: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_incentives" id="input_incentives" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="campaignAllLabel">Campaign Allowance: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="campAllow_input" id="campAllow_input" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="othersAddPayLabel">Others </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_other_add_pay" id="input_other_add_pay" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      <div class="col-6" style="padding-left: 20px;">
                      <p class="f-w-600 mb-1 text-start" id="specifyLabel">Specify: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_specify" id="input_specify" value="" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="others1AddPayLabel">Others </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_other1_add_pay" id="input_other1_add_pay" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6" style="padding-left: 20px;">
                      <p class="f-w-600 mb-1 text-start" id="specifyLabel1">Specify: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_specify1" id="input_specify1" value="" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="othersHidden">Others Hidden on Pay Slip </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="othersAddHidden" id="othersAddHidden" value="0" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>

                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id ="grossPayLabel">GROSS PAY: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_total_salary_before" id="input_total_salary_before" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly>
                      </div> 
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="color: red;">DEDUCTIONS</p>
                      </div>
                      <div class="col-6">
                      </div> 
                      <div class="col-6"> <p class="text-muted mb-1 text-start">Late and deduction: </p></div>
                      <div class="col-6"> <p class="f-w-600 mb-1 text-end"><span id="total_late_count">0</span></p><p class="f-w-600 mb-1 text-end"><span style="color: red;"><span id="total_late_count_calculated">0</span></span></p></div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      <div class="col-6"> <p class="text-muted mb-1 text-start">Undertime: </p></div>
                      <div class="col-6"> <p class="f-w-600 mb-1 text-end"><span id="total_undertime_count">0</span></p><p class="f-w-600 mb-1 text-end"><span style="color: red;"><span id="total_undertime_calculated">0</span></span></p></div>
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="sss_deductionLabel">SSS Deduction: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end"  name ="input_sss_deduction" id="input_sss_deduction" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;" >
                      </div> 
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="SSSloanLabel">SSS Loan: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="sss_loan" id="sss_loan" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div> 
                     <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="pagibigDeductionLabel">Pag-IBIG Deduction: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_pag_ibig_deduction" id="input_pag_ibig_deduction" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div> 
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="PagibigloanLabel">Pag-ibig Loan: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="pag_ibig_loan" id="pag_ibig_loan" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div> 
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="philhealthDeductionLabel">PhilHealth Deduction: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_philhealth_deduction" id="input_philhealth_deduction" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div> 
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="cashAdvanceLabel">Cash Advance: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="cashAdvanceInput" id="cashAdvanceInput" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div> 
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 

                      
                      
                      <div class="col-6">
                      <input type="hidden" id="input_row_of_attendaceData" name="input_row_of_attendaceData" readonly>
                      <input type="hidden" id="input_row_of_leaveData" name="input_row_of_leaveData" readonly>
                      <input type="hidden" id="input_start_date" name="input_start_date" readonly>
                      <input type="hidden" id="input_end_date" name="input_end_date" readonly>
                      <input type="hidden" id="input_agent_name" name="input_agent_name" readonly>
                      <input type="hidden" id="input_agent_id" name="input_agent_id" readonly>
                      <input type="hidden" id="input_paid_leave" name="input_paid_leave" readonly>
                      <input type="hidden" id="input_total_late_count" name="input_total_late_count" readonly>
                      <input type="hidden" id="input_total_late_count_calculated" name="input_total_late_count_calculated" readonly>
                      <input type="hidden" id="input_total_undertime_calculated" name="input_total_undertime_calculated" readonly>
                      <input type="hidden" id="input_total_undertime_count" name="input_total_undertime_count" readonly>
                      <input type="hidden" id="input_attendanceData" name="input_attendanceData" readonly>
                      <input type="hidden" id="input_leaveData" name="input_leaveData" readonly>
                      <input type="hidden" id="input_user_email" name="input_user_email" readonly>
                      <input type="hidden" id="total_OFF" name="total_OFF" readonly>
                      <input type="hidden" id="total_absent" name="total_absent" readonly>
                      

                          <p class="f-w-600 mb-1 text-start" id="houserentLabel">House Rent </p>
                      </div>
                      
                      
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_house_rent" id="house_rent" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div>
                      
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="otherDeductionLabel">Other Deductions</p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_other_deduction" id="other_deduction" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div>
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      <div class="col-6" style="padding-left: 20px;">
                      <p class="f-w-600 mb-1 text-start" id="specify_deductionLabel">Specify: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="specify_deduction" id="specify_deduction" value="" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="otherDeductionLabelOne">Other Deductions</p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_other_deductionOne" id="input_other_deductionOne" value="0" contenteditable="true" style="border: none; background-color: transparent; color: red;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      <div class="col-6" style="padding-left: 20px;">
                      <p class="f-w-600 mb-1 text-start" id="specifyOneLabel">Specify:</p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="specifyOne_input" id="specifyOne_input" contenteditable="true" style="border: none; background-color: transparent;">
                      </div>
                      
                      <div class="col-12">
                      <hr style="border-top: 2px solid #000; margin: 5px 0;"> <!-- Stronger line with thicker border -->
                      </div> 
                      
                      
                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" style="color: red;" id="totalDeductionLabel">Total Deductions: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_total_deductions" id="input_total_deductions" value="0" contenteditable="true" style="border: none; background-color: transparent;color: red;" readonly>
                      </div> 

                      <div class="col-6">
                      <p class="f-w-600 mb-1 text-start" id="totalPayLabel">TOTAL NET PAY: </p>
                      </div>
                      <div class="col-6">
                      <input type="text" class="f-w-600 mb-1 text-end" name ="input_total_salary_after" id="input_total_salary_after" value="0" contenteditable="true" style="border: none; background-color: transparent;" readonly >
                      </div> 
                    </div>
                  </div>
                </div>
                <div class="col-12">
                  <div class="row align-items-end justify-content-between g-3">
                    <div class="col-sm-auto">
                    </div>
                    <div class="col-sm-auto btn-page">
                      <button type = "submit" class="btn btn-outline-secondary">Generate Payslip</button>
                      </form>
                      <button class="btn btn-primary" id="update-all-button">Update All</button>
                    <p>Please click update all before generate payslip</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- datatable Js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="<?= base_url('payroll_template/tables/assets/js/plugins/dataTables.min.js')?>"></script>
    <script src="<?= base_url('payroll_template/tables/assets/js/plugins/dataTables.bootstrap5.min.j')?>s"></script>
    <script src="<?= base_url('payroll_template/horizontal/assets/js/layout-horizontal.js') ?>"></script>
    <script src="<?= base_url('template/assets/js/core/bootstrap.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/tables/assets/js/plugins/popper.min.js')?>"></script>
    <script src="<?= base_url('payroll_template/tables/assets/js/fonts/custom-font.js')?>"></script>
    <script src="<?= base_url('payroll_template/tables/assets/js/pcoded.js')?>"></script>
    <script src="<?= base_url('payroll_template/tables/assets/js/plugins/feather.min.js')?>"></script>
    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/payroll_scripts.js') ?>"></script>
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
include_once('payroll_template/payroll_scripts.php');
?>

  </body>
</html>


