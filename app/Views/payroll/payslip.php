<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
    <title>TAMTECH</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <link rel="icon" href="<?= base_url('logindes/images/tamtechlogo.png') ?>" type="image/x-icon" />

    <style>
        /* Base CSS styles DO NOT CHANGE OR REMOVE */
        body {
            margin: 0;
            padding: 0;
            font: 62.5%/1.5 Helvetica, Arial, Verdana, sans-serif;
        }

        ul, ul li, p, div, ol {
            margin: 0;
            padding: 0;
            list-style: none;
        }

        #invoice {
            width: 660px;
            padding: 10px 20px;
            margin: 1em auto;
            clear: both;
            position: relative;
            overflow: hidden;
            background: #fff;
        }

        #invoice.cancelled {
            background: #fff url(/images/cancelled.gif) top left;
        }

        /*Invoice Simple TemplateCreated by Ed Molyneux*/
        /*=========================== TYPOGRAPHY =========================*/
        #invoice {
            font-family: Helvetica, Arial, Verdana, sans-serif !important;
        }

        #invoice h2 {
            margin: 10px 0;
            font-size: 14pt;
        }

        #invoice-amount td,
        th {
            font-size: 9pt;
        }

        #invoice-header #company-address {
            text-align: right;
            font-size: 11pt;
            line-height: 14pt;
        }

        #invoice #client-details,
        #invoice-info p,
        #invoice #invoice-other,
        #invoice #payment-details {
            font-size: 9pt;
            line-height: 12pt;
        }

        #invoice-info h2,
        #invoice-info h3 {
            margin: 0;
            font-weight: normal;
        }

        #invoice-info h2 {
            text-transform: uppercase;
        }

        #invoice-info h3 {
            font-size: 12pt;
        }

        #comments {
            font-weight: bold;
            margin-top: 15px;
            font-size: 10pt;
        }

        /*=========================== LAYOUT =========================*/
        #invoice {
            padding: 0 1cm 1cm 1cm;
        }

        #invoice-header .logo {
            float: left;
        }

        #invoice-header {
            margin-top: 0.3cm;
            border-bottom: 4px solid #000;
            padding-bottom: 10px;
            overflow: hidden;
        }

        #invoice-info {
            margin: 0.7cm 0 20px 0;
            width: 250px;
            float: right;
            text-align: right;
        }

        #client-details {
            margin: 0.7cm 0 20px 2.5cm;
            float: left;
            width: 250px;
        }

        /* Positioned to appear in a standard envelope window when printed */
        #invoice-other {
            text-align: right;
            float: right;
            width: 250px;
        }

        #invoice #payment-details {
            float: left;
            width: 250px;
        }

        #invoice-amount {
            margin: 1em 0;
            clear: both;
        }

        #comments {
            clear: both;
            padding-top: 0.5cm;
        }

        /*=========================== TABLES =========================*/
        #invoice table#invoice-amount {
            border-collapse: collapse;
            width: 100%;
            clear: both;
        }

        #invoice-amount th {
            text-align: left;
            white-space: nowrap;
            padding: 1px 2px 0 5px;
            font-weight: bold;
            background: #FFF;
            border-bottom: solid 1px #444;
        }

        #invoice-amount td.item_r {
            text-align: right;
        }

        #invoice-amount td.total {
            text-align: right;
            font-weight: bold;
        }

        #invoice-amount .index_th {
            width: 5%;
        }

        #invoice-amount .details_th {
            width: 54%;
        }

        #invoice-amount .details_notax_th {
            width: 62%;
        }

        #invoice-amount .quantity_th {
            width: 13%;
        }

        #invoice-amount .subtotal_th {
            width: 15%;
            text-align: right;
        }

        #invoice-amount .unitprice_th {
            width: 10%;
            text-align: right;
        }
    .hide-button {
        display: none;
    }
     .fn {
        font-size: 20px; /* Adjust the size as needed */
        margin-bottom: 10px;
    }
    .org {
        font-size: 20px; /* Adjust the size as needed */
    }
    
    @media print {
      #captureButton {
        display: none;
      }
    }
        
    </style>
     <script src="<?= base_url('payroll_template/dom-to-image.min.js') ?>"></script>
    <!-- Include FileSaver.js library for saving the image -->
    <script src="<?= base_url('payroll_template/FileSaver.min.js') ?>"></script>
</head>
<body>
<div id="invoice">

    <div id="invoice-header">
        <img src="<?= base_url('logindes/images/Untitled.png') ?>" alt="IMG" width="300" height="100" class="logo screen" />

        <div class="vcard" id="company-address">
            <div class="fn org"><strong>PaySlip</strong></div>
            <div class="adr">
                
                <div class="street-address">

                </div>
                <!-- street-address -->
                <div class="locality"></div>
                <div id="company-postcode"><span class="region"></span> <span class="postal-code"></span></div>
            </div>
            <div class="email"></div>
            
        </div>
        
    </div>


    <!-- #invoice-header -->
    <div id="invoice-info">
    <?= $input_start_date ?> to <?= $input_end_date ?>

        <h2>Payslip <strong>No <?= $payslipno ?></strong></h2>
        <h3></h3>
        <p id="payment-terms">Payment Terms of Days</p>
        <p id="payment-terms">Worked Days: <?= $input_row_of_attendaceData ?></p>
        <?php if ($total_absent != 0): ?>
            <p id="payment-terms">Absent: <?= $total_absent ?></p>
        <?php endif; ?>
        <?php if ($total_OFF != 0): ?>
            <p id="payment-terms">OFF: <?= $total_OFF ?></p>
        <?php endif; ?>
        <?php if ($input_row_of_leaveData != 0): ?>
            <p id="payment-terms">Paid Leave: <?= $input_row_of_leaveData ?></p>
        <?php endif; ?>

    </div>
    

    <!-- #invoice-info -->
    <div class="vcard" id="client-details">
        <div class="fn"><?= $input_agent_name ?></div>
        <div class="org"><?= $input_agent_id ?></div>
        <div class="adr">
            <div class="street-address"></div>
            <!-- street-address -->
            <div class="locality"></div>
            <div id="client-postcode"><span class="region"></span> <span class="postal-code"></span></div>
        </div>
    </div>


   

    


    
   <!-- #client-details vcard -->
   <table id="invoice-amount" border="1">
    <thead class="thead-dark">
        <tr>
            <th>Date</th>
            <th>Actual Work</th>
            <th>ND</th>
            <th>Late</th>
            <th>Undertime</th>
            <th>OT</th>
            <th>ND OT</th>
            <th>Day Status</th>
        </tr>
    </thead>
    <tbody>
        <!-- Loop through attendance data -->
        <?php
            // Retrieve the input_attendanceData array from the $data variable passed from the controller
            $input_attendanceData = $input_attendanceData ?? [];
            
            // Sort the input_attendanceData array by date in ascending order
            usort($input_attendanceData, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
            
            // Loop through the sorted input_attendanceData array
            foreach ($input_attendanceData as $item) :
            ?>
            <tr>
                <?php if ($item['status'] === 'OFF') : ?>
                    <td><?= date('F j, Y', strtotime($item['date'])) ?></td>
                    <td colspan="7" style="color: green; font-weight: bold; text-align: center;">OFF</td>
                <?php elseif ($item['status'] === 'Absent') : ?>
                    <td><?= date('F j, Y', strtotime($item['date'])) ?></td>
                    <td colspan="6" style="color: red; font-weight: bold; text-align: center;">Absent (No Pay)</td>
                    <td><?php if ($item['status'] !== 'OFF') echo $item['dropdownValue']; ?></td>
                <?php elseif ($item['status'] === 'Holiday Leave') : ?>
                    <td><?= date('F j, Y', strtotime($item['date'])) ?></td>
                    <td colspan="7" style="color: blue; font-weight: bold; text-align: center;">Holiday Leave (Paid)</td>
                <?php elseif ($item['status'] === 'OFF/Holiday') : ?>
                    <td><?= date('F j, Y', strtotime($item['date'])) ?></td>
                    <td colspan="7" style="color: orange; font-weight: bold; text-align: center;">OFF Regular Holiday(Paid)</td>
                    
                <?php else : ?>
                    <td><?= date('F j, Y', strtotime($item['date'])) ?></td>
                    <td><?= formatTime($item['actual_work']) ?></td>
                    <td><?= formatTime($item['night_diff']) ?></td>
                    <td><?= formatTime($item['late_count']) ?></td>
                    <td><?= formatTime($item['early_out']) ?></td>
                    <td><?= formatTime($item['ovetime']) ?></td>
                    <td><?= formatTime($item['nd_overtime']) ?></td>
                    <td><?php if ($item['status'] !== 'OFF') echo $item['dropdownValue']; ?></td>
                <?php endif; ?>
            </tr>
            <?php endforeach; ?>
        <?php
        // Function to format time in hours and minutes
        function formatTime($time)
        {
            // Convert time to seconds
            $seconds = strtotime($time) - strtotime('TODAY');
            $hours = floor($seconds / 3600); // Get the hours
            $minutes = floor(($seconds % 3600) / 60); // Get the remaining minutes

            // Format the time string
            if ($hours > 0) {
                $formattedTime = $hours . ' hrs';
                if ($minutes > 0) {
                    $formattedTime .= ' & ' . $minutes . ' mins';
                }
            } else {
                $formattedTime = $minutes . ' mins';
            }

            return $formattedTime;
        }
        ?>


    <?php
        $input_leaveData = $input_leaveData ?? [];

        usort($input_leaveData, function ($a, $b) {
            return strtotime($a['date_of_leave']) - strtotime($b['date_of_leave']);
        });

        // Loop through the sorted input_leaveData array
        foreach ($input_leaveData as $item) :
            ?>
            <tr>
                <td><?= date('F j, Y', strtotime($item['date_of_leave'])) ?></td>
                <td colspan="8" style="text-align: center;">Paid Leave</td>
            </tr>
        <?php endforeach; ?>
        <?php
        // Function to format time in hours and minutes
        function leaveformatTime($time)
        {
            // Convert time to seconds
            $seconds = strtotime($time) - strtotime('TODAY');
            $hours = floor($seconds / 3600); // Get the hours
            $minutes = floor(($seconds % 3600) / 60); // Get the remaining minutes

            // Format the time string
            if ($hours > 0) {
                $formattedTime = $hours . ' hrs';
                if ($minutes > 0) {
                    $formattedTime .= ' & ' . $minutes . ' mins';
                }
            } else {
                $formattedTime = $minutes . ' mins';
            }

            return $formattedTime;
        }
        ?>
    </tbody>
</table>



<table id="invoice-amount" >
   
    <tbody>
        
        <?php if ($input_base_pay != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Base Pay</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_base_pay ?></td>
        </tr>
        <?php endif; ?>



        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->

        <?php if ($normal_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Normal Day</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $normal_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($normalNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $normalNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($normalOT_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $normalOT_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($normalNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $normalNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->



        <?php if ($RD_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Rest Day</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $RD_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RdNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RdNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RdNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RdNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>


        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <?php if ($Rh_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Regular Holiday</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $Rh_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RhNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RhNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RhOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RhOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RhNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RhNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>


        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->



        <?php if ($RhRd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Regular Holiday & Rest Day</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $RhRd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RhRdNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RhRdNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RhRdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RhRdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($RhRdNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $RhRdNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->



        <?php if ($Sp_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Special Holiday</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $Sp_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($SpNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $SpNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($SpOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $SpOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($SpNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $SpNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <?php if ($SpRd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Special Holiday & Rest Day</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $SpRd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($SpRdNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $SpRdNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($SpRdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $SpRdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($SpRdNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $SpRdNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <?php if ($Db_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Double Holiday</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $Db_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DbNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DbNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DbOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DbOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DbNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DbNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->



         <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


         <?php if ($DbRd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Double Holiday & Rest Day</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $DbRd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DbRdNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DbRdNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DbRdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DbRdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DbRdNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DbRdNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <?php if ($Dsh_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Double Special Holiday</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $Dsh_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DshNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DshNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DshOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DshOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DshNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DshNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->


        <?php if ($DshRd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Double Special Holiday & Rest Day</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $DshRd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DshRdNd_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DshRdNd_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DshRdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DshRdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($DshRdNdOvertime_totalPay_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">Night Differential Overtime</td>
            <td class="item_r"></td>
            <td style="color: green;" class="item_r">&#8369;<?= $DshRdNdOvertime_totalPay_input ?></td>
        </tr>
        <?php endif; ?>

        <!-- -----------/////////////////////////////////////////////////////////////////////////////////// -->
        
        
        <?php if ($input_total_overtime_pay != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Total Overtime Pay</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_total_overtime_pay ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_total_ND_pay != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Total Night Differential Pay</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_total_ND_pay ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($input_total_NDOT_pay != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Total Night Differential OT Pay</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_total_NDOT_pay ?></td>
        </tr>
        <?php endif; ?>


       







        
        <?php if ($input_bonus != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Attendance Bonus</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_bonus ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($campAllow_input != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Campaign Allowance</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $campAllow_input ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_incentives != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Spiff/Incentive/CSAT</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_incentives ?></td>
        </tr>
        <?php endif; ?>

        

        <?php if ($input_other_add_pay != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Others : (<?= $input_specify ?>)</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_other_add_pay ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($input_other1_add_pay != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">(<?= $input_specify1 ?>)</td>
            <td class="item_r"></td>
            <td style="color: red;" class="item_r">&#8369;<?= $input_other1_add_pay ?></td>
        </tr>
        <?php endif; ?>


        <?php if ($input_paid_leave != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Paid Leave</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_paid_leave ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($holidayleavePaid != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Holiday Leave</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $holidayleavePaid ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($regHolPaid != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Regular Holiday</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $regHolPaid ?></td>
        </tr>
        <?php endif; ?>
        

        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l"> Gross Pay</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_total_salary_before ?></td>
        </tr>
        <!-- Long line added here -->
        
        <?php if ($input_total_deductions != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="color: red;"> DEDUCTIONS</td>
            <td class="item_r"></td>
            <td class="item_r"></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($cashAdvanceInput != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Cash Advance</td>
            <td class="item_r"></td>
            <td  style="color: red;" class="item_r">&#8369;<?= $cashAdvanceInput ?></td>
        </tr>
        <?php endif; ?>


        <?php if ($input_sss_deduction != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">SSS Deduction</td>
            <td class="item_r"></td>
            <td  style="color: red;" class="item_r">&#8369;<?= $input_sss_deduction ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($sss_loan != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">SSS Loan</td>
            <td class="item_r"></td>
            <td  style="color: red;" class="item_r">&#8369;<?= $sss_loan ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_pag_ibig_deduction != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Pag-ibig Deduction</td>
            <td class="item_r"></td>
            <td style="color: red;" class="item_r">&#8369;<?= $input_pag_ibig_deduction ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($pag_ibig_loan != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Pag-ibig Loan</td>
            <td class="item_r"></td>
            <td style="color: red;" class="item_r">&#8369;<?= $pag_ibig_loan ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_philhealth_deduction != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Philhealth Deduction</td>
            <td class="item_r"></td>
            <td style="color: red;" class="item_r">&#8369;<?= $input_philhealth_deduction ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_total_late_count_calculated != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Late Deduction</td>
            <td class="item_r"><?= $input_total_late_count ?></td>
            <td style="color: red;" class="item_r">&#8369;<?= $input_total_late_count_calculated ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_total_undertime_calculated != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Undertime Deduction</td>
            <td class="item_r"><?= $input_total_undertime_count ?></td>
            <td style="color: red;" class="item_r">&#8369;<?= $input_total_undertime_calculated ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_house_rent != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">House Rent</td>
            <td class="item_r"></td>
            <td style="color: red;" class="item_r">&#8369;<?= $input_house_rent ?></td>
        </tr>
        <?php endif; ?>

        <?php if ($input_other_deduction != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l">Others: (<?= $specify_deduction ?>)</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_other_deduction ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($input_other_deductionOne != 0): ?>
        <tr class="item">
            <td class="item_l" width="350px"></td>
            <td class="item_l" style="padding-left: 20px;">(<?= $specifyOne_input ?>)</td>
            <td class="item_r"></td>
            <td class="item_r">&#8369;<?= $input_other_deductionOne ?></td>
        </tr>
        <?php endif; ?>
        
        <?php if ($input_total_deductions != 0): ?>

        <tr id="total_tr">
        <td class="item_l" width="350px"></td>
            <td  style="color: red;" colspan="2" class="total" id="total_currency">
                <span class="currency"> </span> Total Deduction:
            </td>
            <td class="total">&#8369;<?= $input_total_deductions ?></td>
        </tr>
        <?php endif; ?>
        <tr id="total_tr">
        <td class="item_l" width="350px"></td>

            <td colspan="2" class="total" id="total_currency">
                <span class="currency"> </span> TOTAL NET PAY:
            </td>
            <td class="total">&#8369;<?= $input_total_salary_after ?></td>
        </tr>

        
    </tbody>
</table>
    <input type="hidden" id="base_pay" value="<?= $input_base_pay ?>">
    <input type="hidden" id="user_email" value="<?= $input_user_email ?>">
    <input type="hidden" id="agent_name" value="<?= $input_agent_name ?>">
    <input type="hidden" id="payslip_no" value="<?= $payslipno ?>">
    <input type="hidden" id="attendance_bonus" value="<?= $input_bonus ?>">
    <input type="hidden" id="spiff_incentive" value="<?= $input_incentives ?>">
    <input type="hidden" id="overtime_pay" value="<?= $input_total_overtime_pay ?>">
    <input type="hidden" id="nd_pay" value="<?= $input_total_ND_pay ?>">
    
    <input type="hidden" id="ndOt_pay" value="<?= $input_total_NDOT_pay ?>">
    
    <input type="hidden" id="other_add" value="<?= $input_other_add_pay ?>">
    <input type="hidden" id="gross_pay" value="<?= $input_total_salary_before ?>">
    <input type="hidden" id="late_deduction" value="<?= $input_total_late_count_calculated ?>">
    <input type="hidden" id="undertime_deduction" value="<?= $input_total_undertime_calculated ?>">
    <input type="hidden" id="sss_deduction" value="<?= $input_sss_deduction ?>">
    <input type="hidden" id="pag_ibig_deduction" value="<?= $input_pag_ibig_deduction ?>">
    <input type="hidden" id="philhealth_deduction" value="<?= $input_philhealth_deduction ?>">
    <input type="hidden" id="sss_loan" value="<?= $sss_loan ?>">
    <input type="hidden" id="pag_ibig_loan" value="<?= $pag_ibig_loan ?>">
    <input type="hidden" id="house_rent" value="<?= $input_house_rent ?>">
    <input type="hidden" id="other_deduction" value="<?= $input_other_deduction ?>">
    <input type="hidden" id="total_deduction" value="<?= $input_total_deductions ?>">
    <input type="hidden" id="total_net_pay" value="<?= $input_total_salary_after ?>">
    <input type="hidden" id="agent_name" value="<?= $input_agent_name ?>">
    <input type="hidden" id="start_date" value="<?= $start_date ?>">
    <input type="hidden" id="end_date" value="<?= $end_date ?>">
    <input type="hidden" id="others_add_comment" value="<?= $input_specify ?>">
    <input type="hidden" id="others_deduc_comment" value="<?= $specify_deduction ?>">
    
    <input type="hidden" id="cash_advance" value="<?= $cashAdvanceInput ?>">
    <input type="hidden" id="camp_allowance" value="<?= $campAllow_input ?>">
    <input type="hidden" id="other_addPay_one" value="<?= $input_other1_add_pay ?>">
    <input type="hidden" id="otherAddComment_one" value="<?= $input_specify1 ?>">
    <input type="hidden" id="Otherdeduc_one" value="<?= $input_other_deductionOne ?>">
    <input type="hidden" id="DeducComment_one" value="<?= $specifyOne_input ?>">
    <button id="captureButton" onclick="captureAndSave()">Generate Payslip</button>

</div>
   

<script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
<script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>


<script>
     function captureAndSave() {
        const button = document.getElementById('captureButton');
        button.style.display = 'none'; 

        const opt = {
            margin: 0.5,
            filename: 'whole_page.pdf',
            image: { type: 'jpeg', quality: 0.98 },
            html2canvas: { scale: 3, logging: true },
            jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
        };

        html2pdf().set(opt).from(document.body).output('blob').then(function (pdfBlob) {
            // Show generating message
            Swal.fire({
                title: 'Generating Payslip',
                text: 'Please wait...',
                allowOutsideClick: false,
                showConfirmButton: false,
                onBeforeOpen: () => {
                    Swal.showLoading();
                }
            });

            savePdfToServer(pdfBlob);
            button.style.display = 'block'; 
        }).catch(error => {
            console.error('Error generating payslip:', error);
            button.style.display = 'block'; 
        });
    }

    function savePdfToServer(pdfBlob) {
        const formData = new FormData();
        formData.append('pdf', pdfBlob, 'whole_page.pdf'); 
        
        const hiddenInputs = document.querySelectorAll('input[type="hidden"]');
        hiddenInputs.forEach(input => {
            formData.append(input.id, input.value);
        });

        fetch('<?= site_url('uploadPDF') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Payslip generated successfully!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    window.location.href = '<?= site_url('payroll/view') ?>'; 
                });
            } else {
                alert('Failed to generate payslip.');
                console.error('Error:', data.error);
            }
        })
        .catch(error => {
            console.error('Error saving PDF:', error);
        });
    }

</script>







</body>
</html>
