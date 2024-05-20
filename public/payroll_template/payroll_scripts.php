<script>
    document.getElementById('calculate_total').addEventListener('click', function() {
        var startDate = document.getElementById('start_date').value;
        var endDate = document.getElementById('end_date').value;

        var xhr = new XMLHttpRequest();
        xhr.open('POST', '<?= site_url('save/Dates') ?>');
        xhr.setRequestHeader('Content-Type', 'application/json');
        xhr.onload = function() {
            if (xhr.status === 200) {
            } else {
            }
        };
        xhr.send(JSON.stringify({ startDate: startDate, endDate: endDate }));
    });
    
    
    $(document).ready(function () {
        $('#calculate_total').click(function () {

            var defaultMultiplier = 1; // Default multiplier if no input or invalid input is provided

            var customMultipliers = confirm("Do you want to adjust all multipliers?");
            if (!customMultipliers) {
                var totalWorkpayMultiplier = defaultMultiplier;
                var nightDiffsMultiplier = defaultMultiplier;
                var overtimePayMultiplier = defaultMultiplier;
                var NDovertimePay1Multiplier = defaultMultiplier;
            } else {
                var totalWorkpayMultiplier = parseFloat(prompt("Adjust multiplier for Normal Day rate (default is 1):")) || defaultMultiplier;
                var nightDiffsMultiplier = parseFloat(prompt("Adjust multiplier for night diff (default is 1):")) || defaultMultiplier;
                var overtimePayMultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1):")) || defaultMultiplier;
                var NDovertimePay1Multiplier = parseFloat(prompt("Adjust multiplier for night diff OT (default is 1):")) || defaultMultiplier;
            }
        

            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();
            var agentId = $('#agent_id').val();
            var attendanceData = [];
            $('#input_bonus').val('0');
            $('#input_incentives').val('0');
            $('#other_deduction').val('0');
            $('#input_other_add_pay').val('0');
            $('#withholdingtax').val('0');
            $('#input_specify').val('');
            $('#specify_deduction').val('');
            $('#sss_loan').val('0');
            $('#pag_ibig_loan').val('0');
            $('#campAllow_input').val('0');
            $('#cashAdvanceInput').val('0');
            $('#input_other1_add_pay').val('0');
            $('#input_other_deductionOne').val('0');
            
            $('#specifyOne_input').val('');
            $('#input_specify1').val('');
            $('#othersAddHidden').val('0');
            

            if (!startDate || !endDate) {
                alert("Please select start date and end date.");
                return;
            }
            var startDateObj = new Date(startDate);
            var endDateObj = new Date(endDate);
            if (isNaN(startDateObj.getTime()) || isNaN(endDateObj.getTime())) {
                alert("Please select valid dates.");
                return; 
            }
            var currentDate = new Date();
            if (startDateObj.getTime() > currentDate.getTime()) {
                alert("Start date cannot be in the future.");
                return; 
            }
            if (endDateObj.getTime() > currentDate.getTime()) {
                alert("End date cannot be in the future.");
                return; 
            }
            
            if (startDate && endDate && agentId) {
                $.ajax({
                    url: '<?= base_url('calculateTotalSalary'); ?>',
                    type: 'POST',
                    data: {
                        agent_id: agentId,
                        start_date: startDate,
                        end_date: endDate
                    },
                    success: function (response) {
                        var totalAttendanceRows = response.attendanceData.length;
                        $('#attendance_table_body').empty(); // Clear existing table data
                        
                        // Initialize total salary before as 0
                        var totalSalaryBefore = 0;
                        var totalSalary = 0;

                        var totalLateCountHours = 0;
                        var totalLateCountMinutes = 0;

                        var totalundertimeCountHours = 0;
                        var totalundertimeCountMinutes = 0;

                        var totalOvertimePay = 0;
                        var nightDiffsPay = 0;
                        var basePay = 0;
                        
                        var totalAbsent = 0;
                        var totalOFF = 0;

                        var totalOFFHol = 0;

                        var HolLeave = 0;

                        $.each(response.attendanceData, function (index, attendance) {
                            
                            var row = $('<tr>');
                            var originalDailySalary = parseFloat(attendance.daily_salary); // Convert to float
                            row.append('<td style="font-weight: bold;" data-original-salary="' + originalDailySalary.toFixed(2) + '">₱' + originalDailySalary.toFixed(2) + '</td>');
                            
                            // required work hours per day
                            var totalWork = attendance.required_work; // Get the nd_overtime value
                            var totalWorkTimeParts = totalWork.split(":");
                            var totalWorktimehours = parseInt(totalWorkTimeParts[0]);
                            var totalWorkmins = parseInt(totalWorkTimeParts[1]);
                            var Worktotalmins = totalWorktimehours * 60 + totalWorkmins;
                            var totalWorkresult = Worktotalmins / 60;
                            row.append('<td style="display: none;"  data-original-total-workinghours="' + totalWorkresult.toFixed(2) + '">' + totalWorkresult.toFixed(2) + '</td>'); 

                            var totalWork = attendance.required_work; // Get the nd_overtime value
                            var totalWorkTimeParts = totalWork.split(":");
                            var totalWorktimehours = parseInt(totalWorkTimeParts[0]);
                            var totalWorkmins = parseInt(totalWorkTimeParts[1]);
                            var Worktotalmins = totalWorktimehours * 60 + totalWorkmins;

                            var displayText = '';
                            if (totalWorktimehours !== 0) {displayText += totalWorktimehours + ' hrs ';}
                            if (totalWorkmins !== 0) {displayText += totalWorkmins + ' mins';}
                            if (totalWorktimehours === 0 && totalWorkmins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            // required work hours per day

                            //actual work per day
                            var actualWork = attendance.actual_work; // Get the nd_overtime value
                            var actualWorkTimeParts = actualWork.split(":");
                            var actualWorkWorktimehours = parseInt(actualWorkTimeParts[0]);
                            var ActualWorkmins = parseInt(actualWorkTimeParts[1]);
                            var Acturalworktotalmins = actualWorkWorktimehours * 60 + ActualWorkmins;
                            var actualWorkresult = Acturalworktotalmins / 60;
                            row.append('<td style="display: none;" data-original-total-requiredHours="' + actualWorkresult.toFixed(2) + '">' + actualWorkresult.toFixed(2) + '</td>'); 

                            var actualWork = attendance.actual_work; // Get the nd_overtime value
                            var actualWorkTimeParts = actualWork.split(":");
                            var actualWorkWorktimehours = parseInt(actualWorkTimeParts[0]);
                            var ActualWorkmins = parseInt(actualWorkTimeParts[1]);
                            var Acturalworktotalmins = actualWorkWorktimehours * 60 + ActualWorkmins;

                            var displayText = '';
                            if (actualWorkWorktimehours !== 0) {displayText += actualWorkWorktimehours + ' hrs ';}
                            if (ActualWorkmins !== 0) {displayText += ActualWorkmins + ' mins';}
                            if (actualWorkWorktimehours === 0 && ActualWorkmins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            //actual work per day
                            
                            //ND computation
                            var nightDiff = attendance.night_diff; // Get the nd_overtime value
                            var NDTimeParts = nightDiff.split(":");
                            var NDtimehours = parseInt(NDTimeParts[0]);
                            var NDmins = parseInt(NDTimeParts[1]);
                            var NDtotalmins = NDtimehours * 60 + NDmins;
                            var NDresult = NDtotalmins / 60;
                            row.append('<td style="display: none;" data-original-total-NDcount="' + NDresult.toFixed(2) + '">' + NDresult.toFixed(2) + '</td>'); 

                            var nightDiff = attendance.night_diff; // Get the nd_overtime value
                            var NDTimeParts = nightDiff.split(":");
                            var NDtimehours = parseInt(NDTimeParts[0]);
                            var NDmins = parseInt(NDTimeParts[1]);
                            var NDtotalmins = NDtimehours * 60 + NDmins;

                            var displayText = '';
                            if (NDtimehours !== 0) {displayText += NDtimehours + ' hrs ';}
                            if (NDmins !== 0) {displayText += NDmins + ' mins';}
                            if (NDtimehours === 0 && NDmins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            //ND computation

                            //late count computation
                            var lateCount = attendance.late_count; // Get the nd_overtime value
                            var lateCountTimeParts = lateCount.split(":");
                            var lateCounttimehours = parseInt(lateCountTimeParts[0]);
                            var lateCOuntmins = parseInt(lateCountTimeParts[1]);
                            var lateCounttotalmins = lateCounttimehours * 60 + lateCOuntmins;

                            var displayText = '';
                            if (lateCounttimehours !== 0) {displayText += lateCounttimehours + ' hrs '; }
                            if (lateCOuntmins !== 0) {displayText += lateCOuntmins + ' mins';}
                            if (lateCounttimehours === 0 && lateCOuntmins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            //late count computation

                            //early out computation
                            var earlyout = attendance.early_out; // Get the nd_overtime value
                            var earlyOutTimeParts = earlyout.split(":");
                            var earlyOuttimehours = parseInt(earlyOutTimeParts[0]);
                            var earlyOutmins = parseInt(earlyOutTimeParts[1]);
                            var earlyOuttotalmins = earlyOuttimehours * 60 + earlyOutmins;

                            var displayText = '';
                            if (earlyOuttimehours !== 0) {displayText += earlyOuttimehours + ' hrs ';}
                            if (earlyOutmins !== 0) {displayText += earlyOutmins + ' mins';}
                            if (earlyOuttimehours === 0 && earlyOutmins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            //early out computation

                            //overtime computation
                            var Overtime = attendance.ovetime; // Get the nd_overtime value
                            var overtimeParts = Overtime.split(":");
                            var overtimehours = parseInt(overtimeParts[0]);
                            var overtimemins = parseInt(overtimeParts[1]);
                            var overtimetotalmins = overtimehours * 60 + overtimemins;
                            var overtimeresult = overtimetotalmins / 60;
                            row.append('<td style="display: none;" data-original-total-overtime="' + overtimeresult.toFixed(2) + '">' + overtimeresult.toFixed(2) + '</td>');
                            
                            var Overtime = attendance.ovetime; // Get the nd_overtime value
                            var overtimeParts = Overtime.split(":");
                            var overtimehours = parseInt(overtimeParts[0]);
                            var overtimemins = parseInt(overtimeParts[1]);
                            var overtimetotalmins = overtimehours * 60 + overtimemins;

                            var displayText = '';
                            if (overtimehours !== 0) {displayText += overtimehours + ' hrs ';}
                            if (overtimemins !== 0) {displayText += overtimemins + ' mins';}
                            if (overtimehours === 0 && overtimemins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            //ovetime comptation

                            //Night diff overtime computation
                            var ndOvertime = attendance.nd_overtime; // Get the nd_overtime value
                            var NDovertimeParts = ndOvertime.split(":");
                            var ndovertimehours = parseInt(NDovertimeParts[0]);
                            var ndovertimemins = parseInt(NDovertimeParts[1]);
                            var ndovertimetotalmins = ndovertimehours * 60 + ndovertimemins;
                            var ndovertimeresult = ndovertimetotalmins / 60;
                            row.append('<td style="display: none;" data-original-total-NDovertime="' + ndovertimeresult.toFixed(2) + '">' + ndovertimeresult.toFixed(2) + '</td>');
                            
                            var ndOvertime = attendance.nd_overtime; // Get the nd_overtime value
                            var NDovertimeParts = ndOvertime.split(":");
                            var ndovertimehours = parseInt(NDovertimeParts[0]);
                            var ndovertimemins = parseInt(NDovertimeParts[1]);
                            var ndovertimetotalmins = ndovertimehours * 60 + ndovertimemins;

                            var displayText = '';
                            if (ndovertimehours !== 0) {displayText += ndovertimehours + ' hrs ';}
                            if (ndovertimemins !== 0) {displayText += ndovertimemins + ' mins';}
                            if (ndovertimehours === 0 && ndovertimemins === 0) { displayText = '0';}
                            row.append('<td style="font-weight: bold;">' + displayText + '</td>');
                            //Night diff overtime computation


                            var dailySalary = parseFloat(attendance.daily_salary);
                            var salaryDivideWorkhours = dailySalary / totalWorkresult;

                            //bayad sa ipinasok na oras
                            var totalWorkpay= salaryDivideWorkhours * totalWorkpayMultiplier * actualWorkresult;
                            //bayad sa night diff
                            var nightDiffs = salaryDivideWorkhours * nightDiffsMultiplier * 0.1 * NDresult;
                            //bayad sa overtime
                            var overtimePay = salaryDivideWorkhours * overtimePayMultiplier * 1.25 *  overtimeresult;
                            //bayad sa overtime na night shiff
                            var NDovertimePay1 = salaryDivideWorkhours * NDovertimePay1Multiplier * 1.3 * 0.1 * ndovertimeresult;
                            //total ng overtime pay
                            var totalngovertimePay = NDovertimePay1 + overtimePay ;
                            //total salary
                            var totalPay = totalWorkpay + nightDiffs + totalngovertimePay;

                            row.append('<td style="font-weight: bold;" data-original-overtime-pay="' + totalngovertimePay.toFixed(2) + '">' + totalngovertimePay.toFixed(2) + '</td>');
                            row.append('<td style="font-weight: bold;" data-original-total-pay="' + totalPay.toFixed(2) + '">' + totalPay.toFixed(2) + '</td>');
                            row.append('<td style="font-weight: bold;">' + attendance.date + '</td>'); // Append date

                            var dropdown = $('<select class="form-select small-dropdown"></select>'); // Adding the class "small-dropdown"
                            dropdown.append('<option value="Normal">Default</option>');
                            dropdown.append('<option value="Normal Day">Normal Day</option>');
                            dropdown.append('<option value="Rest Day">Rest Day</option>');
                            dropdown.append('<option value="Regular Holiday">Regular Holiday</option>');
                            dropdown.append('<option value="Regular Holiday + Rest Day">Regular Holiday + Rest Day</option>');
                            dropdown.append('<option value="Special (non-working) Holiday">Special (non-working) Holiday</option>');
                            dropdown.append('<option value="Special (non-working) Holiday + Rest Day">Special (non-working) Holiday + Rest Day</option>');
                            dropdown.append('<option value="Double Holiday">Double Holiday</option>');
                            dropdown.append('<option value="Double Holiday + Rest Day">Double Holiday + Rest Day</option>');
                            dropdown.append('<option value="Double Special Holiday">Double Special Holiday</option>');
                            dropdown.append('<option value="Double Special Holiday + Rest Day">Double Special Holiday + Rest Day</option>');
                            dropdown.append('<option value="Regular/Special Holiday">Regular/Special Holiday (No Pay)</option>');
                            dropdown.append('<option value="Holiday Leave">Holiday Leave</option>');
                            dropdown.append('<option value="OFF/Regular Holiday">OFF/Regular Holiday</option>');

                            row.append($('<td>').append(dropdown));

                            row.append('<td style="display: none;">' + attendance.status + '</td>'); // Append date

                            var dailySalary = parseFloat(attendance.daily_salary);
                            var salaryDivideWorkhours = dailySalary / totalWorkresult;

                            //bayad sa ipinasok na oras
                            var totalWorkpay= salaryDivideWorkhours * actualWorkresult;
                            //bayad sa night diff
                            var nightDiffs = salaryDivideWorkhours * 0.1 * NDresult;

                            row.append('<td style="display: none;" data-original-ND-pay="' + nightDiffs.toFixed(2) + '">' + nightDiffs.toFixed(2) + '</td>');

                           
                            row.append('<td>' + attendance.day_status + '</td>'); 
                            
                            row.append('<td style="display: none;">' + attendance.status + '</td>');

                            //REST DAY ROWS
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Regular Holiday Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Regular Holiday + rest day Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Special Holiday Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Special Holiday + Restday Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Double HOliday Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Double HOliday + Rest dAy Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Double Special Holiday Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //Double Special Holiday + restday Rows
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            row.append('<td style="display: none;">' + '0' + '</td>'); 

                            //holiday leave
                            row.append('<td style="display: none;">' + '0' + '</td>'); 
                            //OFF Regular holiday
                            row.append('<td style="display: none;">' + '0' + '</td>');
                            

                            var dailySalary = parseFloat(attendance.daily_salary);
                            var salaryDivideWorkhours = dailySalary / totalWorkresult;

                            var basePays= salaryDivideWorkhours * actualWorkresult;

                            //bayad sa ipinasok na oras
                            var totalWorkpay= salaryDivideWorkhours * totalWorkpayMultiplier * actualWorkresult;
                            //bayad sa night diff
                            var nightDiffs = salaryDivideWorkhours * nightDiffsMultiplier * 0.1 * NDresult;
                            //bayad sa overtime
                            var overtimePay = salaryDivideWorkhours * overtimePayMultiplier * 1.25 *  overtimeresult;
                            //bayad sa overtime na night shiff
                            var NDovertimePay1 = salaryDivideWorkhours * NDovertimePay1Multiplier * 1.25 * 0.1 * ndovertimeresult;
                            
                            //total ng overtime pay
                            var totalngovertimePay = NDovertimePay1 + overtimePay ;
                            //total salary
                            var totalPay = totalWorkpay + nightDiffs + totalngovertimePay;

                            var normalPay = salaryDivideWorkhours * actualWorkresult;
                            var normaltotalPay = totalWorkpay - normalPay;

                            row.append('<td style="display: none;" data-original-normalDayNd-pay="' + nightDiffs.toFixed(2) + '">' + nightDiffs.toFixed(2) + '</td>');
                            row.append('<td style="display: none;" data-original-normalDayoT-pay="' + overtimePay.toFixed(2) + '">' + overtimePay.toFixed(2) + '</td>');
                            row.append('<td style="display: none;" data-original-normalDayOtNd-pay="' + NDovertimePay1.toFixed(2) + '">' + NDovertimePay1.toFixed(2) + '</td>');
                            row.append('<td style="display: none;" data-original-normalDay-pay="' + normaltotalPay.toFixed(2) + '">' + normaltotalPay.toFixed(2) + '</td>');

                            if (attendance.status === 'Absent') {
                                totalAbsent++;
                            } else if (attendance.status === 'OFF') {
                                totalOFF++;
                            } else if (attendance.status === 'OFF/Holiday') {
                                totalOFFHol++;
                            } else if (attendance.status === 'Holiday Leave') {
                                HolLeave++;
                            }

                            
                            $('#attendance_table_body').append(row); // Append row to table
                            totalSalaryBefore += totalPay;

                            totalOvertimePay += totalngovertimePay;

                            nightDiffsPay += nightDiffs;
                            basePay += basePays;

                            //Late count computation
                            originalDailySalary = parseFloat(attendance.daily_salary); // Convert to float

                            
                            var lateCountTimeParts = attendance.late_count.split(":");
                            var lateCountHours = parseInt(lateCountTimeParts[0]);
                            var lateCountMinutes = parseInt(lateCountTimeParts[1]);

                            totalLateCountHours += lateCountHours;
                            totalLateCountMinutes += lateCountMinutes;

                            if (totalLateCountMinutes >= 60) {
                                totalLateCountHours += Math.floor(totalLateCountMinutes / 60);
                                totalLateCountMinutes = totalLateCountMinutes % 60;
                            }

                            //undertime computation
                            var earlyOutTimeParts = attendance.early_out.split(":");
                            var undertimeCountHours = parseInt(earlyOutTimeParts[0]);
                            var undertimeCountMinutes = parseInt(earlyOutTimeParts[1]);

                            totalundertimeCountHours += undertimeCountHours;
                            totalundertimeCountMinutes += undertimeCountMinutes;

                            if (totalundertimeCountMinutes >= 60) {
                                totalundertimeCountHours += Math.floor(totalundertimeCountMinutes / 60);
                                totalundertimeCountMinutes = totalundertimeCountMinutes % 60;
                            }

                            attendance.totalngovertimePay = totalngovertimePay.toFixed(2);
                            attendance.totalPay = totalPay.toFixed(2);

                        });

                        $.ajax({
                            url: '<?= base_url('fetchLeaveData'); ?>',
                            type: 'POST',
                            data: {
                                agent_id: agentId,
                                start_date: startDate,
                                end_date: endDate
                            },
                            success: function (leaveResponse) {
                                var totalLeaveRows = leaveResponse.leaveData.length;
                                var totalSalary = 0; // Initialize total salary variable
                                $.each(leaveResponse.leaveData, function (index, leave) {
                                    var leaveRow = $('<tr>');
                                    var leavedaySalary = parseFloat(leave.daily_salary);
                                    leaveRow.append('<td data-original-leave-salary="' + leavedaySalary.toFixed(2) + '">' + leavedaySalary.toFixed(2) + '</td>');

                                    var dailySalaryFloat = parseFloat(leave.daily_salary);

                                    totalSalary += dailySalaryFloat; // Add daily salary to total

                                    var requiredWork = leave.required_work.split(':');
                                    var hours = parseInt(requiredWork[0]);
                                    var minutes = parseInt(requiredWork[1]);
                                    var formattedTime = hours + ' hrs';
                                    if (minutes > 0) {
                                        formattedTime += ' ' + minutes + ' mins';
                                    }
                                    leaveRow.append('<td>' + formattedTime + '</td>');

                                    var leaverequiredWork = leave.required_work; // Get the nd_overtime value
                                    var leaveTimeParts = leaverequiredWork.split(":");
                                    var leavetimeHours = parseInt(leaveTimeParts[0]);
                                    var leaveMins = parseInt(leaveTimeParts[1]);
                                    var leaveTotalMins = leavetimeHours * 60 + leaveMins;
                                    var leavetotal = leaveTotalMins / 60;
                                    leaveRow.append('<td style="display: none;" data-original-total-leaverequiredwork="' + leavetotal.toFixed(2) + '">' + leavetotal.toFixed(2) + '</td>'); 

                                    leaveRow.append('<td>' + '0' + '</td>');
                                    leaveRow.append('<td>' + '0' + '</td>');
                                    leaveRow.append('<td>' + '0' + '</td>');
                                    leaveRow.append('<td>' + '0' + '</td>');
                                    leaveRow.append('<td>' + '0' + '</td>');
                                    leaveRow.append('<td>' + '0' + '</td>');
                                    leaveRow.append('<td>' + '0' + '</td>');

                                    leaveRow.append('<td style="display: none;">' + '0' + '</td>');
                                    leaveRow.append('<td style="display: none;">' + '0' + '</td>');
                                    leaveRow.append('<td style="display: none;">' + '0' + '</td>');
                                    leaveRow.append('<td style="display: none;">' + '0' + '</td>');


                                    var leavedaySalary = parseFloat(leave.daily_salary);
                                    leaveRow.append('<td data-original-total-leavepay="' + leavedaySalary.toFixed(2) + '">' + leavedaySalary.toFixed(2) + '</td>'); 

                                    leaveRow.append('<td>' + leave.date_of_leave + '</td>');
                                    var dropdown = $('<select class="form-select small-dropdown"></select>'); // Adding the class "small-dropdown"
                                    dropdown.append('<option value="Paid Leave">Paid Leave</option>');
                                    // dropdown.append('<option value="Condition Meet">Condition Meet</option>');

                                    leaveRow.append($('<td>').append(dropdown));
                                    leaveRow.append('<td style="display: none;">' + '0.00' + '</td>');


                                    $('#attendance_table_body').append(leaveRow);
                                });

                                var requiredWork = parseFloat(response.required_work);
                                var dailySalary = parseFloat(response.daily_salary);
                                var rateperhour = dailySalary / requiredWork;

                                var totalLateMIns = totalLateCountHours * 60 + totalLateCountMinutes;
                                var totalCountLate = totalLateMIns / 60;

                                var latededuction = rateperhour * totalCountLate;

                                var totalUndertimeMins = totalundertimeCountHours * 60 + totalundertimeCountMinutes;
                                var totalCountUndertime = totalUndertimeMins / 60;

                                var undertimeDeduction = rateperhour * totalCountUndertime;

                                var totalsalarybeforeALL = totalSalaryBefore + totalSalary;
                                
                                var totalBasePay = basePay;
                                
                                var totalWorkDays = totalAttendanceRows -totalAbsent - totalOFF - totalOFFHol - HolLeave;

                                var totalofOFF = totalOFF + totalOFFHol;

                                var totalofLeave = totalLeaveRows + HolLeave;

                                
                                 
                                $('#input_base_pay').val(totalBasePay.toFixed(2));


                                $('#paid_leave').text(totalSalary.toFixed(2)); 
                                $('#total_late_count').text(totalLateCountHours + ' hrs ' + totalLateCountMinutes + ' mins');
                                $('#total_late_count_calculated').text(latededuction.toFixed(2)); 
                                $('#total_undertime_calculated').text(undertimeDeduction.toFixed(2)); 
                                $('#total_undertime_count').text(totalundertimeCountHours + ' hrs ' + totalundertimeCountMinutes + ' mins');

                                $('#input_row_of_attendaceData').val(totalWorkDays);
                                $('#input_row_of_leaveData').val(totalofLeave);
                                
                                $('#total_OFF').val(totalofOFF);
                                $('#total_absent').val(totalAbsent);
                                
                                $('#input_total_ND_pay').val(nightDiffsPay.toFixed(2));
                                $('#input_total_overtime_pay').val(totalOvertimePay.toFixed(2));
                                $('#input_agent_name').val(response.agent_name);
                                $('#input_user_email').val(response.user_email);
                                $('#input_agent_id').val(agentId);
                                $('#input_start_date').val(startDate);
                                $('#input_end_date').val(endDate);
                                $('#input_paid_leave').val(totalSalary.toFixed(2)); 
                                $('#input_total_salary_before').val(totalsalarybeforeALL.toFixed(2)); 
                                $('#input_sss_deduction').val(response.SSS);
                                $('#input_pag_ibig_deduction').val(response.pag_ibig);
                                $('#input_philhealth_deduction').val(response.philhealth);
                                $('#house_rent').val(response.house_rent);
                                $('#input_total_late_count').val(totalLateCountHours + ' hrs ' + totalLateCountMinutes + ' mins');
                                $('#input_total_late_count_calculated').val(latededuction.toFixed(2)); 
                                $('#input_total_undertime_calculated').val(undertimeDeduction.toFixed(2)); 
                                $('#input_total_undertime_count').val(totalundertimeCountHours + ' hrs ' + totalundertimeCountMinutes + ' mins');

                                var sssDeduction = parseFloat(response.SSS);
                                var pagIbigDeduction = parseFloat(response.pag_ibig);
                                var philhealthDeduction = parseFloat(response.philhealth);
                                var house_rent = parseFloat(response.house_rent);

                                var totalDeductions = sssDeduction + pagIbigDeduction + philhealthDeduction + latededuction + undertimeDeduction + house_rent;
                                var totalSalaryAfter = totalsalarybeforeALL - totalDeductions;

                                $('#input_total_salary_after').val(totalSalaryAfter.toFixed(2));
                                $('#input_total_deductions').val(totalDeductions.toFixed(2));

                                $('#input_attendanceData').val(JSON.stringify(response.attendanceData));
                                $('#input_leaveData').val(JSON.stringify(leaveResponse.leaveData));
                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            } else {
                console.log("Please select both start date, end date, and agent.");
            }
        });


        
        // Event listener for dropdown change
        $('#attendance_table_body').on('change', 'select', function() {
            var row = $(this).closest('tr');
            var dropdownValue = $(this).val();

            if (dropdownValue === "Normal") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                row.find('td:eq(0)').text('₱'+ originalDailySalary.toFixed(2));

                var originalNDPayAttr = row.find('td:eq(18)').attr('data-original-ND-pay');
                row.find('td:eq(18)').text(originalNDPayAttr);

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var salaryDivideWorkhours = originalDailySalary / requiredWork;

                var hourlyrate = originalDailySalary / requiredWork;

                var HolLeave = hourlyrate * 1 *  actualWork;
                var HolLeaveND = hourlyrate * 1 * 0.1 * NightDiff ;
                var HolLeaveOT = hourlyrate * 1 * 1.25 * overtime ;
                var HolLeaveNDOT = hourlyrate * 1 * 1.25 * 0.1 * NDovertime ;

                var originalovertimepay = HolLeaveOT + HolLeaveNDOT;
                var originalTotalPay = originalovertimepay + HolLeave + HolLeaveND;

                var normalPay = hourlyrate * actualWork;
                var normaltotalPay = HolLeave - normalPay;

                if (!isNaN(originalovertimepay) || !isNaN(originalTotalPay)) {
                
                    row.find('td:eq(13)').text(originalovertimepay.toFixed(2));
                    row.find('td:eq(14)').text(originalTotalPay.toFixed(2));

                    row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                    row.find('td:eq(59)').text(HolLeaveND.toFixed(2));
                    row.find('td:eq(60)').text(HolLeaveOT.toFixed(2));
                    row.find('td:eq(61)').text(HolLeaveNDOT.toFixed(2));
                    row.find('td:eq(62)').text(normaltotalPay.toFixed(2));



                    attendance.totalngovertimePay = originalovertimepay.toFixed(2);
                    attendance.totalPay = originalTotalPay.toFixed(2);
                    attendance.dropdownValue = dropdownValue;
                }

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Paid Leave") {
                var originalDailySalaryleave = parseFloat(row.find('td:eq(0)').data('original-leave-salary'));

                row.find('td:eq(0)').text('₱'+ originalDailySalaryleave.toFixed(2));
                row.find('td:eq(18)').text(0);

            } else if (dropdownValue === "Normal Day") {

                var skipMultiplier = !confirm("Adjust the normal day multipliers?");
                var NormalDaymultiplier = 1; // Default value for Rest Day multiplier
                var normalDaynightDiffMultiplier = 1; // Default value for Rest Day Night Diff multiplier
                var NormalDayoTmultiplier = 1; // Default value for Rest Day OT multiplier
                var NormdalDayNdOtMultiplier = 1; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    NormalDaymultiplier = parseFloat(prompt("Adjust multiplier for Normal Day rate (default is 1):")) || 1;
                    normalDaynightDiffMultiplier = parseFloat(prompt("Adjust multiplier for night diff (default is 1):")) || 1;
                    NormalDayoTmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1):")) || 1;
                    NormdalDayNdOtMultiplier = parseFloat(prompt("Adjust multiplier for night diff OT (default is 1):")) || 1;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var salaryDivideWorkhours = originalDailySalary / requiredWork;

                var hourlyrate = originalDailySalary / requiredWork;

                var HolLeave = hourlyrate * NormalDaymultiplier *  actualWork;
                var HolLeaveND = hourlyrate * normalDaynightDiffMultiplier * 0.1 * NightDiff ;
                var HolLeaveOT = hourlyrate * NormalDayoTmultiplier * 1.25 * overtime ;
                var HolLeaveNDOT = hourlyrate * NormdalDayNdOtMultiplier * 1.3 * 0.1 * NDovertime ;

                var originalovertimepay = HolLeaveOT + HolLeaveNDOT;
                var originalTotalPay = originalovertimepay + HolLeave + HolLeaveND;

                var normalPay = hourlyrate * actualWork;
                var normaltotalPay = HolLeave - normalPay;

                if (!isNaN(originalovertimepay) || !isNaN(originalTotalPay)) {
                
                    row.find('td:eq(13)').text(originalovertimepay.toFixed(2));
                    row.find('td:eq(14)').text(originalTotalPay.toFixed(2));

                    row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                    row.find('td:eq(59)').text(HolLeaveND.toFixed(2));
                    row.find('td:eq(60)').text(HolLeaveOT.toFixed(2));
                    row.find('td:eq(61)').text(HolLeaveNDOT.toFixed(2));
                    row.find('td:eq(62)').text(normaltotalPay.toFixed(2));



                    attendance.totalngovertimePay = originalovertimepay.toFixed(2);
                    attendance.totalPay = originalTotalPay.toFixed(2);
                    attendance.dropdownValue = dropdownValue;
                }

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Rest Day") {

                var skipMultiplier = !confirm("Adjust the rest day multipliers?");
                var RestDaymultiplier = 1.3; // Default value for Rest Day multiplier
                var RestDaynightDiffMultiplier = 1.3; // Default value for Rest Day Night Diff multiplier
                var RestDayoTmultiplier = 1.3; // Default value for Rest Day OT multiplier
                var RestDayNdOtMultiplier = 1.3; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    RestDaymultiplier = parseFloat(prompt("Adjust multiplier for Rest Day rate (default is 1.3):")) || 1.3;
                    RestDaynightDiffMultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 1.3):")) || 1.3;
                    RestDayoTmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1.3):")) || 1.3;
                    RestDayNdOtMultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 1.3):")) || 1.3;
                }


                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var salaryDivideWorkhours = originalDailySalary / requiredWork;

                var restdaysalary = salaryDivideWorkhours * RestDaymultiplier * actualWork;
                //night diff rest day = 1.3 x 1.1 = 1.43 or 143%
                var NDrestday = salaryDivideWorkhours * RestDaynightDiffMultiplier * 0.1 * NightDiff;
                //rest day overtimepay = 1.3 x 1.3 = 1.69 or 169%
                var overtimerestday = salaryDivideWorkhours * RestDayoTmultiplier * 1.3 * overtime;
                //rest day nd overtime pay = 1.3 x 1.1 x 1.3 = 1.859 or 185.9%
                var NDovertimerestday = salaryDivideWorkhours * RestDayNdOtMultiplier * 0.1 * 1.3 * NDovertime;
                //total overtime pay
                var RDovertimepaytotal = overtimerestday + NDovertimerestday ;
                //total pay rest day
                var totalPay = restdaysalary + NDrestday + RDovertimepaytotal ;

                var RDnormalPay = salaryDivideWorkhours * actualWork;
                var RDnormaltotalPay = restdaysalary - RDnormalPay;

                row.find('td:eq(21)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(22)').text(NDrestday.toFixed(2));
                row.find('td:eq(23)').text(overtimerestday.toFixed(2));
                row.find('td:eq(24)').text(NDovertimerestday.toFixed(2));

                // Update cells with calculated values

                row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');



                row.find('td:eq(18)').text(NDrestday.toFixed(2));
                row.find('td:eq(0)').text('₱'+ restdaysalary.toFixed(2));
                row.find('td:eq(13)').text( RDovertimepaytotal.toFixed(2));
                row.find('td:eq(14)').text( totalPay.toFixed(2));
                attendance.totalngovertimePay = RDovertimepaytotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));


            } else if (dropdownValue === "Regular Holiday") {

                var skipMultiplier = !confirm("Adjust the Regular Holiday multipliers?");
                var regularHolmultiplier = 2; // Default value for Rest Day multiplier
                var RegularHolDiffMultiplier = 2; // Default value for Rest Day Night Diff multiplier
                var RegHolOTmultiplier = 2; // Default value for Rest Day OT multiplier
                var RegHolNdOtMultiplier = 2; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    regularHolmultiplier = parseFloat(prompt("Adjust multiplier for Regular Holiday rate (default is 2):")) || 2;
                    RegularHolDiffMultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 2):")) || 2;
                    RegHolOTmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 2):")) || 2;
                    RegHolNdOtMultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 2):")) || 2;
                }
                // Prompt for multiplier input
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //regular holiday salary = 2 or 200%
                var regularholiday = hourlyrate * regularHolmultiplier *  actualWork;
                //night diff regular holiday = 2 x 1.1 = 2.2 or 220%
                var NDregularholiday = hourlyrate * RegularHolDiffMultiplier * 0.1 * NightDiff ;
                //regular holiday overtimepay = 2 x 1.3 = 2.6 or 260%
                var overtimeRegularHoliday = hourlyrate * RegHolOTmultiplier * 1.3 * overtime ;
                //regular holiday nd overtime pay = 2 x 1.1 x 1.3 = 2.86 or 286%
                var NDovertimeRegularHoliday = hourlyrate * RegHolNdOtMultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var RHovertimepaytotal = overtimeRegularHoliday + NDovertimeRegularHoliday ;
                //total pay regular holiday
                var totalPay = regularholiday + NDregularholiday + RHovertimepaytotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = regularholiday - RDnormalPay;

                row.find('td:eq(25)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(26)').text(NDregularholiday.toFixed(2));
                row.find('td:eq(27)').text(overtimeRegularHoliday.toFixed(2));
                row.find('td:eq(28)').text(NDovertimeRegularHoliday.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(NDregularholiday.toFixed(2));
                row.find('td:eq(0)').text('₱'+ regularholiday.toFixed(2));
                row.find('td:eq(13)').text( RHovertimepaytotal.toFixed(2));
                row.find('td:eq(14)').text( totalPay.toFixed(2));
                attendance.totalngovertimePay = RHovertimepaytotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));
                
            } else if (dropdownValue === "Regular Holiday + Rest Day") {
                // Prompt for multiplier input

                var skipMultiplier = !confirm("Adjust the Regular Holiday & Rest Day multipliers?");
                var regularHolRdmultiplier = 2.6; // Default value for Rest Day multiplier
                var RegularHolRdDiffMultiplier = 2.6; // Default value for Rest Day Night Diff multiplier
                var RegHolRRdOTmultiplier = 2.6; // Default value for Rest Day OT multiplier
                var RegHolNdOtRdMultiplier = 2.6; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    regularHolRdmultiplier = parseFloat(prompt("Adjust multiplier for Regular Holiday & Rest Day rate (default is 2.6):")) || 2.6;
                    RegularHolRdDiffMultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 2.6):")) || 2.6;
                    RegHolRRdOTmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 2.6):")) || 2.6;
                    RegHolNdOtRdMultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 2.6):")) || 2.6;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //regular holiday rest day salary = 2.6 or 260%
                var regularholidayRD = hourlyrate * regularHolRdmultiplier *  actualWork;
                //night diff regular holiday = 2.6 x 1.1 = 2.86 or 286%
                var NDregularholidayRD = hourlyrate * RegularHolRdDiffMultiplier * 0.1 * NightDiff ;
                //regular holiday restday overtimepay = 2.6 x 1.3 = 3.38 or 338% 
                var overtimeRegularHolidayRD = hourlyrate * RegHolRRdOTmultiplier * 1.3 * overtime ;
                //regular holiday nd RD overtime pay = 
                var NDovertimeRegularHolidayRD = hourlyrate * RegHolNdOtRdMultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var RHovertimepaytotalRD = overtimeRegularHolidayRD + NDovertimeRegularHolidayRD ;
                //total pay regular holiday
                var totalPay = regularholidayRD + NDregularholidayRD + RHovertimepaytotalRD ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = regularholidayRD - RDnormalPay;

                row.find('td:eq(29)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(30)').text(NDregularholidayRD.toFixed(2));
                row.find('td:eq(31)').text(overtimeRegularHolidayRD.toFixed(2));
                row.find('td:eq(32)').text(NDovertimeRegularHolidayRD.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(NDregularholidayRD.toFixed(2));
                row.find('td:eq(0)').text('₱'+ regularholidayRD.toFixed(2));
                row.find('td:eq(13)').text( RHovertimepaytotalRD.toFixed(2));
                row.find('td:eq(14)').text( totalPay.toFixed(2));
                attendance.totalngovertimePay = RHovertimepaytotalRD.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Special (non-working) Holiday") {

                var skipMultiplier = !confirm("Adjust the Special Holiday multipliers?");
                var SpHolmultiplier = 1.3; // Default value for Rest Day multiplier
                var SpHolNdmultiplier = 1.3; // Default value for Rest Day Night Diff multiplier
                var SpHolOtmultiplier = 1.3; // Default value for Rest Day OT multiplier
                var SpHolNdOtmultiplier = 1.3; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    SpHolmultiplier = parseFloat(prompt("Adjust multiplier for Special Holiday rate (default is 1.3):")) || 1.3;
                    SpHolNdmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 1.3):")) || 1.3;
                    SpHolOtmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1.3):")) || 1.3;
                    SpHolNdOtmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 1.3):")) || 1.3;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //non special holiday salary = 1.3 or 130%
                var nonSpecialholiday = hourlyrate * SpHolmultiplier *  actualWork;
                //night diff non special holiday = 1.3 x 1.1 = 1.43 or 143%
                var NDnonSpecial = hourlyrate * SpHolNdmultiplier * 0.1 * NightDiff ;
                //non special holiday overtimepay = 1.3 x 1.3 = 1.69 or 169%
                var overtimenonspecial = hourlyrate * SpHolOtmultiplier * 1.3 * overtime ;
                //non special nd overtime pay = 1.3 x 1.1 x 1.3 = 1.859 or 185.9%
                var NDovertimeNonSpecialR = hourlyrate * SpHolNdOtmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var NonSpecialovertimepaytotal = overtimenonspecial + NDovertimeNonSpecialR ;
                //total pay non special holiday
                var totalPay = nonSpecialholiday + NDnonSpecial + NonSpecialovertimepaytotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = nonSpecialholiday - RDnormalPay;

                row.find('td:eq(33)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(34)').text(NDnonSpecial.toFixed(2));
                row.find('td:eq(35)').text(overtimenonspecial.toFixed(2));
                row.find('td:eq(36)').text(NDovertimeNonSpecialR.toFixed(2));


                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(NDnonSpecial.toFixed(2));
                row.find('td:eq(0)').text('₱'+ nonSpecialholiday.toFixed(2));
                row.find('td:eq(13)').text( NonSpecialovertimepaytotal.toFixed(2));
                row.find('td:eq(14)').text( totalPay.toFixed(2));
                attendance.totalngovertimePay = NonSpecialovertimepaytotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;


                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Special (non-working) Holiday + Rest Day") {

                var skipMultiplier = !confirm("Adjust the Special Holiday & Rest Day multipliers?");
                var SpHolRdmultiplier = 1.5; // Default value for Rest Day multiplier
                var SpHolRdNdmultiplier = 1.5; // Default value for Rest Day Night Diff multiplier
                var SpHolRdOtmultiplier = 1.5; // Default value for Rest Day OT multiplier
                var SpHolRdNdOtmultiplier = 1.5; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    SpHolRdmultiplier = parseFloat(prompt("Adjust multiplier for Special Holiday & Rest Day rate (default is 1.5):")) || 1.5;
                    SpHolRdNdmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 1.5):")) || 1.5;
                    SpHolRdOtmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1.5):")) || 1.5;
                    SpHolRdNdOtmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 1.5):")) || 1.5;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //non special holiday + rest day salary = 1.5 or 150%
                var nonSpecialholidayRD = hourlyrate * SpHolRdmultiplier *  actualWork;
                //night diff rest day non special holiday = 1.5 x 1.1 = 1.65 or 165%
                var NDrestDaynonSpecial = hourlyrate * SpHolRdNdmultiplier * 0.1 * NightDiff ;
                //non special holiday rest day overtimepay = 1.5 x 1.3 = 1.95 or 195%
                var overtimenonspecialRD = hourlyrate * SpHolRdOtmultiplier * 1.3 * overtime ;
                //non special rest day night diff overtime pay = 
                var NDovertimeNonSpecialRD = hourlyrate * SpHolRdNdOtmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var NonSpecialovertimepaytotal = overtimenonspecialRD + NDovertimeNonSpecialRD ;
                //total pay non special holiday + rest day
                var totalPay = nonSpecialholidayRD + NDrestDaynonSpecial + NonSpecialovertimepaytotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = nonSpecialholidayRD - RDnormalPay;
               
                row.find('td:eq(37)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(38)').text(NDrestDaynonSpecial.toFixed(2));
                row.find('td:eq(39)').text(overtimenonspecialRD.toFixed(2));
                row.find('td:eq(40)').text(NDovertimeNonSpecialRD.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');



                row.find('td:eq(18)').text(NDrestDaynonSpecial.toFixed(2));
                row.find('td:eq(0)').text('₱'+ nonSpecialholidayRD.toFixed(2));
                row.find('td:eq(13)').text(NonSpecialovertimepaytotal.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));
                attendance.totalngovertimePay = NonSpecialovertimepaytotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));
            
            } else if (dropdownValue === "Double Holiday") {

                var skipMultiplier = !confirm("Adjust the Double Holiday multipliers?");
                var doubleHolmultiplier = 3; // Default value for Rest Day multiplier
                var doubleHolNdmultiplier = 3; // Default value for Rest Day Night Diff multiplier
                var doubleHolOtmultiplier = 3; // Default value for Rest Day OT multiplier
                var doubleHolNdOtmultiplier = 3; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    doubleHolmultiplier = parseFloat(prompt("Adjust multiplier for Double Holiday rate (default is 3):")) || 3;
                    doubleHolNdmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 3):")) || 3;
                    doubleHolOtmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 3):")) || 3;
                    doubleHolNdOtmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 3):")) || 3;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //double holiday rate = 3 or 300%
                var doubleholidayrate = hourlyrate * doubleHolmultiplier *  actualWork;
                //double holiday night diff = 3 x 1.1 = 3.3 or 330%
                var doubleholND = hourlyrate * doubleHolNdmultiplier * 0.1 * NightDiff ;
                //double holiday overtime pay = 3 x 1.3 = 3.9 or 390%
                var overtimedoubleholiday = hourlyrate * doubleHolOtmultiplier * 1.3 * overtime ;
                //double holiday overtime nightdiff = 3 x 1.1 x 1.3 = 4.29 or 429%
                var NDdoubleHolOvertime = hourlyrate * doubleHolNdOtmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var doubleholidayOTtotal = overtimedoubleholiday + NDdoubleHolOvertime ;
                //total pay on double holiday
                var totalPay = doubleholidayrate + doubleholND + doubleholidayOTtotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = doubleholidayrate - RDnormalPay;

                row.find('td:eq(41)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(42)').text(doubleholND.toFixed(2));
                row.find('td:eq(43)').text(overtimedoubleholiday.toFixed(2));
                row.find('td:eq(44)').text(NDdoubleHolOvertime.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(doubleholND.toFixed(2));
                row.find('td:eq(0)').text('₱'+ doubleholidayrate.toFixed(2));
                row.find('td:eq(13)').text(doubleholidayOTtotal.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));
                attendance.totalngovertimePay = doubleholidayOTtotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Double Holiday + Rest Day") {

                var skipMultiplier = !confirm("Adjust the Double Holiday & Rest Day multipliers?");
                var doubleHolRdmultiplier = 3.9; // Default value for Rest Day multiplier
                var doubleHolRdNdmultiplier = 3.9; // Default value for Rest Day Night Diff multiplier
                var doubleHolRdOtmultiplier = 3.9; // Default value for Rest Day OT multiplier
                var doubleHolRdNdOtmultiplier = 3.9; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    doubleHolRdmultiplier = parseFloat(prompt("Adjust multiplier for Double Holiday & Rest Day rate (default is 3.9):")) || 3.9;
                    doubleHolRdNdmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 3.9):")) || 3.9;
                    doubleHolRdOtmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 3.9):")) || 3.9;
                    doubleHolRdNdOtmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 3.9):")) || 3.9;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //double holiday + restday rate = 3.9 or 390%
                var RDdoubleholidayrate = hourlyrate * doubleHolRdmultiplier *  actualWork;
                //double holiday + restday night diff = 3.9 x 1.1
                var doubleholRdNd = hourlyrate * doubleHolRdNdmultiplier * 0.1 * NightDiff ;
                //double holiday + rest day overtime pay = 3.9 x 1.3
                var overtimedoubleholidayRD = hourlyrate * doubleHolRdOtmultiplier * 1.3 * overtime ;
                //double holiday + restday overtime nightdiff = 3.9 x 1.1 x 1.3
                var RdNDdoubleHolOvertime = hourlyrate * doubleHolRdNdOtmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var RDdoubleholidayOTtotal = overtimedoubleholidayRD + RdNDdoubleHolOvertime ;
                //total pay on double holiday
                var totalPay = RDdoubleholidayrate + doubleholRdNd + RDdoubleholidayOTtotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = RDdoubleholidayrate - RDnormalPay;

                row.find('td:eq(45)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(46)').text(doubleholRdNd.toFixed(2));
                row.find('td:eq(47)').text(overtimedoubleholidayRD.toFixed(2));
                row.find('td:eq(48)').text(RdNDdoubleHolOvertime.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(doubleholRdNd.toFixed(2));
                row.find('td:eq(0)').text('₱'+ RDdoubleholidayrate.toFixed(2));
                row.find('td:eq(13)').text(RDdoubleholidayOTtotal.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));
                attendance.totalngovertimePay = RDdoubleholidayOTtotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Double Special Holiday") {

                var skipMultiplier = !confirm("Adjust the Double Special Holiday multipliers?");
                var doubleSpeHoldmultiplier = 1.5; // Default value for Rest Day multiplier
                var doubleSpeHoldNdmultiplier = 1.5; // Default value for Rest Day Night Diff multiplier
                var doubleSpeHoldOtmultiplier = 1.5; // Default value for Rest Day OT multiplier
                var doubleSpeHoldNdOtmultiplier = 1.5; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    doubleSpeHoldmultiplier = parseFloat(prompt("Adjust multiplier for Double Special Holiday rate (default is 1.5):")) || 1.5;
                    doubleSpeHoldNdmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 1.5):")) || 1.5;
                    doubleSpeHoldOtmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1.5):")) || 1.5;
                    doubleSpeHoldNdOtmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 1.5):")) || 1.5;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //double special holiday rate = 1.5 or 150%
                var doubleSpecHolidayrate = hourlyrate * doubleSpeHoldmultiplier *  actualWork;
                //double special holiday night diff = 
                var doubleSpecHolND = hourlyrate * doubleSpeHoldNdmultiplier * 0.1 * NightDiff ;
                //double special holiday overtime pay = 
                var overtimedoubleSpecHol = hourlyrate * doubleSpeHoldOtmultiplier * 1.3 * overtime ;
                //double special holiday overtime nightdiff = 
                var NDdoubleSpecOvertime = hourlyrate * doubleSpeHoldNdOtmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var doubleholidayOTtotal = overtimedoubleSpecHol + NDdoubleSpecOvertime ;
                //total pay on double special holiday
                var totalPay = doubleSpecHolidayrate + doubleSpecHolND + doubleholidayOTtotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = doubleSpecHolidayrate - RDnormalPay;

                row.find('td:eq(49)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(50)').text(doubleSpecHolND.toFixed(2));
                row.find('td:eq(51)').text(overtimedoubleSpecHol.toFixed(2));
                row.find('td:eq(52)').text(NDdoubleSpecOvertime.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(53)').text('0.00');
                    row.find('td:eq(54)').text('0.00');
                    row.find('td:eq(55)').text('0.00');
                    row.find('td:eq(56)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(doubleSpecHolND.toFixed(2));
                row.find('td:eq(0)').text('₱'+ doubleSpecHolidayrate.toFixed(2));
                row.find('td:eq(13)').text(doubleholidayOTtotal.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));
                attendance.totalngovertimePay = doubleholidayOTtotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "Double Special Holiday + Rest Day") {

                var skipMultiplier = !confirm("Adjust the Double Special Holiday & Rest Day multipliers?");
                var doubleSpeHoldRdmultiplier = 1.95; // Default value for Rest Day multiplier
                var doubleSpeHoldRdNdmultiplier = 1.95; // Default value for Rest Day Night Diff multiplier
                var doubleSpeHoldRdOtmultiplier = 1.95; // Default value for Rest Day OT multiplier
                var doubleSpeHoldRdNdOtmultiplier = 1.95; // Default value for Rest Day Night Diff OT multiplier

                if (!skipMultiplier) {
                    doubleSpeHoldRdmultiplier = parseFloat(prompt("Adjust multiplier for Double Special Holiday & Rest Day rate (default is 1.95):")) || 1.95;
                    doubleSpeHoldRdNdmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff (default is 1.95):")) || 1.95;
                    doubleSpeHoldRdOtmultiplier = parseFloat(prompt("Adjust multiplier for OT (default is 1.95):")) || 1.95;
                    doubleSpeHoldRdNdOtmultiplier = parseFloat(prompt("Adjust multiplier for Night Diff OT (default is 1.95):")) || 1.95;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                //double special + rest day holiday rate = 1.95
                var RDdoubleSpecHolidayrate = hourlyrate * doubleSpeHoldRdmultiplier *  actualWork;
                //double special + rest day holiday night diff = 1.95 x 1.1
                var RDdoubleSpecHolND = hourlyrate * doubleSpeHoldRdNdmultiplier * 0.1 * NightDiff ;
                //double special + rest day holiday overtime pay = 1.95 x 1.3
                var overtimedoubleSpecHolRD = hourlyrate * doubleSpeHoldRdOtmultiplier * 1.3 * overtime ;
                //double special + rest day holiday overtime nightdiff = 1.95 x 1.1 x 1.3
                var RdNDdoubleSpecOvertime = hourlyrate * doubleSpeHoldRdNdOtmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var doubleholidayOTtotal = overtimedoubleSpecHolRD + RdNDdoubleSpecOvertime ;
                //total pay on double special holiday
                var totalPay = RDdoubleSpecHolidayrate + RDdoubleSpecHolND + doubleholidayOTtotal ;

                //dagdag sa restday
                var RDnormalPay = hourlyrate * actualWork;
                var RDnormaltotalPay = RDdoubleSpecHolidayrate - RDnormalPay;
               

                row.find('td:eq(53)').text(RDnormaltotalPay.toFixed(2));
                row.find('td:eq(54)').text(RDdoubleSpecHolND.toFixed(2));
                row.find('td:eq(55)').text(overtimedoubleSpecHolRD.toFixed(2));
                row.find('td:eq(56)').text(RdNDdoubleSpecOvertime.toFixed(2));

                row.find('td:eq(21)').text('0.00');
                    row.find('td:eq(22)').text('0.00');
                    row.find('td:eq(23)').text('0.00');
                    row.find('td:eq(24)').text('0.00');

                    row.find('td:eq(25)').text('0.00');
                    row.find('td:eq(26)').text('0.00');
                    row.find('td:eq(27)').text('0.00');
                    row.find('td:eq(28)').text('0.00');

                    row.find('td:eq(29)').text('0.00');
                    row.find('td:eq(30)').text('0.00');
                    row.find('td:eq(31)').text('0.00');
                    row.find('td:eq(32)').text('0.00');

                    row.find('td:eq(33)').text('0.00');
                    row.find('td:eq(34)').text('0.00');
                    row.find('td:eq(35)').text('0.00');
                    row.find('td:eq(36)').text('0.00');

                    row.find('td:eq(37)').text('0.00');
                    row.find('td:eq(38)').text('0.00');
                    row.find('td:eq(39)').text('0.00');
                    row.find('td:eq(40)').text('0.00');

                    row.find('td:eq(41)').text('0.00');
                    row.find('td:eq(42)').text('0.00');
                    row.find('td:eq(43)').text('0.00');
                    row.find('td:eq(44)').text('0.00');

                    row.find('td:eq(45)').text('0.00');
                    row.find('td:eq(46)').text('0.00');
                    row.find('td:eq(47)').text('0.00');
                    row.find('td:eq(48)').text('0.00');

                    row.find('td:eq(49)').text('0.00');
                    row.find('td:eq(50)').text('0.00');
                    row.find('td:eq(51)').text('0.00');
                    row.find('td:eq(52)').text('0.00');

                    row.find('td:eq(57)').text('0.00');
                    row.find('td:eq(58)').text('0.00');

                row.find('td:eq(59)').text('0.00');
                row.find('td:eq(60)').text('0.00');
                row.find('td:eq(61)').text('0.00');
                row.find('td:eq(62)').text('0.00');


                row.find('td:eq(18)').text(RDdoubleSpecHolND.toFixed(2));
                row.find('td:eq(0)').text('₱'+ RDdoubleSpecHolidayrate.toFixed(2));
                row.find('td:eq(13)').text(doubleholidayOTtotal.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));
                attendance.totalngovertimePay = doubleholidayOTtotal.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

                
            } else if (dropdownValue === "Holiday Leave") {

                var skipMultiplier = !confirm("Adjust the Holiday Leave multiplier?");
                var HolLeavemultiplier = 1; // Default value for Rest Day multiplier

                if (!skipMultiplier) {
                    HolLeavemultiplier = parseFloat(prompt("Adjust multiplier for Holiday Leave rate (default is 1):")) || 1;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                var HolLeave = hourlyrate * HolLeavemultiplier *  requiredWork;
                var HolLeaveND = hourlyrate * HolLeavemultiplier * 0.1 * NightDiff ;
                var HolLeaveOT = hourlyrate * HolLeavemultiplier * 1.3 * overtime ;
                var HolLeaveNDOT = hourlyrate * HolLeavemultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var holLeavetotsOTpay = HolLeaveOT + HolLeaveNDOT ;
                //total pay on double special holiday
                var totalPay = HolLeave + HolLeaveND + holLeavetotsOTpay ;

                row.find('td:eq(18)').text(HolLeaveND.toFixed(2));
                row.find('td:eq(0)').text('₱'+ HolLeave.toFixed(2));
                row.find('td:eq(13)').text(holLeavetotsOTpay.toFixed(2));
                row.find('td:eq(14)').text(HolLeave.toFixed(2));
                row.find('td:eq(57)').text(HolLeave.toFixed(2));

                attendance.totalngovertimePay = holLeavetotsOTpay.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;
                

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));

            } else if (dropdownValue === "OFF/Regular Holiday") {

                var skipMultiplier = !confirm("Adjust the OFF/Regular Holiday multiplier?");
                var offRegHolmultiplier = 1; // Default value for Rest Day multiplier

                if (!skipMultiplier) {
                    offRegHolmultiplier = parseFloat(prompt("Adjust multiplier for OFF/Regular Holiday rate (default is 1):")) || 1;
                }

                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                var HolLeave = hourlyrate * offRegHolmultiplier *  requiredWork;
                var HolLeaveND = hourlyrate * offRegHolmultiplier * 0.1 * NightDiff ;
                var HolLeaveOT = hourlyrate * offRegHolmultiplier * 1.3 * overtime ;
                var HolLeaveNDOT = hourlyrate * offRegHolmultiplier * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var offRegHolOTtotsPay = HolLeaveOT + HolLeaveNDOT ;
                //total pay on double special holiday
                var totalPay = HolLeave + HolLeaveND + offRegHolOTtotsPay ;

                row.find('td:eq(18)').text(HolLeaveND.toFixed(2));
                row.find('td:eq(0)').text('₱'+ HolLeave.toFixed(2));
                row.find('td:eq(13)').text(offRegHolOTtotsPay.toFixed(2));
                row.find('td:eq(14)').text(HolLeave.toFixed(2));
                row.find('td:eq(58)').text(HolLeave.toFixed(2));
                attendance.totalngovertimePay = offRegHolOTtotsPay.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;

                // Update attendance object if needed
                var attendanceData = JSON.parse($('#input_attendanceData').val());
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];
                attendance.dropdownValue = dropdownValue;
                attendance.multiplier = multiplier;

                $('#input_attendanceData').val(JSON.stringify(attendanceData));
            }
        });
        
        $('#update-all-button').click(function () {
            var totalPayFromConditionMeet = 0;
            $('#attendance_table_body tr').each(function () {
                var row = $(this);
                var dropdownValue = row.find('select').val();

                // Update calculations based on dropdown value
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));
                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var hourlyrate = originalDailySalary / requiredWork;

                var attendanceData = JSON.parse($('#input_attendanceData').val());

                // Find the corresponding attendance object in the attendanceData array
                var attendanceIndex = row.index();
                var attendance = attendanceData[attendanceIndex];

            
            if (dropdownValue === "Rest Day") {
                attendance.dropdownValue = dropdownValue;
            
            } else if (dropdownValue === "Regular Holiday") {
                attendance.dropdownValue = dropdownValue;
            
            } else if (dropdownValue === "Regular Holiday + Rest Day") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Special (non-working) Holiday") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Special (non-working) Holiday + Rest Day") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Double Holiday") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Double Holiday + Rest Day") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Double Special Holiday") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Double Special Holiday + Rest Day") {
                
                attendance.dropdownValue = dropdownValue;
            } else if (dropdownValue === "Normal Day") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Regular/Special Holiday") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-salary'));

                var requiredWork = parseFloat(row.find('td:eq(1)').text());
                var actualWork = parseFloat(row.find('td:eq(3)').text());
                var NightDiff = parseFloat(row.find('td:eq(5)').text());
                var overtime = parseFloat(row.find('td:eq(9)').text());
                var NDovertime = parseFloat(row.find('td:eq(11)').text());
                var overtimePay = parseFloat(row.find('td:eq(13)').data('original-overtime-pay'));

                var hourlyrate = originalDailySalary / requiredWork;
                var RegHolNopay = hourlyrate * 1 *  actualWork;
                var RegHolND = hourlyrate * 1 * 0.1 * NightDiff ;
                var RegHolOT = hourlyrate * 1 * 1.3 * overtime ;
                var RegHolNDOT = hourlyrate * 1 * 0.1 * 1.3 * NDovertime ;
                //total overtime pay
                var regHolOTtotsPay = RegHolOT + RegHolNDOT ;
                //total pay on double special holiday
                var totalPay = RegHolNopay + RegHolND + regHolOTtotsPay ;

                row.find('td:eq(18)').text(RegHolND.toFixed(2));
                row.find('td:eq(0)').text('₱'+ RegHolNopay.toFixed(2));
                row.find('td:eq(13)').text(regHolOTtotsPay.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));
                attendance.totalngovertimePay = regHolOTtotsPay.toFixed(2);
                attendance.totalPay = totalPay.toFixed(2);
                attendance.dropdownValue = dropdownValue;
                
            } else if (dropdownValue === "Holiday Leave") {
                
                attendance.dropdownValue = dropdownValue;
                
            } else if (dropdownValue === "OFF/Regular Holiday") {
                
                attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Condition Meet") {
                var originalDailySalary = parseFloat(row.find('td:eq(0)').data('original-leave-salary'));

                var requiredWork = parseFloat(row.find('td:eq(2)').text());
                // original-total-leaverequiredwork
                var hourlyrate = originalDailySalary / requiredWork;

                var totalPay = originalDailySalary * 1.2;

                row.find('td:eq(0)').text('₱'+ totalPay.toFixed(2));
                row.find('td:eq(14)').text(totalPay.toFixed(2));

                var increaseInTotalPay = totalPay - originalDailySalary;

                totalPayFromConditionMeet += increaseInTotalPay;

            } else if (dropdownValue === "Normal") {
           
                    attendance.dropdownValue = dropdownValue;

            } else if (dropdownValue === "Paid Leave") {
            // Revert back to original values
                var originalTotalPayleave = parseFloat(row.find('td:eq(14)').data('original-total-leavepay'));
                if (!isNaN(originalTotalPayleave)  ) {
                    row.find('td:eq(14)').text(originalTotalPayleave.toFixed(2));
                }
            }
            $('#input_attendanceData').val(JSON.stringify(attendanceData));
        });
            var totalSalaryBefore = 0;
            var totalOvertimePay = 0;
            var nightDiffsPay = 0;

            var TotsRDpay = 0;
            var TotsRdNdpay = 0;
            var TotsRdNdOvertimepay = 0;
            var TotsRdOvertimepay = 0;

            var TotsRHpay = 0;
            var TotsRHNdpay = 0;
            var TotsRHNdOvertimepay = 0;
            var TotsRHOvertimepay = 0;

            var TotsRhRdpay = 0;
            var TotsRhRdNdpay = 0;
            var TotsRhRdOvertimepay = 0;
            var TotsRhRdNdOvertimepay = 0;

            var TotsShpay = 0;
            var TotsShNdpay = 0;
            var TotsShOvertimepay = 0;
            var TotsShNdOvertimepay = 0;

            var TotsShRdpay = 0;
            var TotsShRdNdpay = 0;
            var TotsShRdOvertimepay = 0;
            var TotsShRdNdOvertimepay = 0;

            var TotsDhpay = 0;
            var TotsDhNdpay = 0;
            var TotsDhOvertimepay = 0;
            var TotsDhNdOvertimepay = 0;

            var TotsDhRdpay = 0;
            var TotsDhRdNdpay = 0;
            var TotsDhRdOvertimepay = 0;
            var TotsDhRdNdOvertimepay = 0;

            var TotsDshpay = 0;
            var TotsDshNdpay = 0;
            var TotsDshOvertimepay = 0;
            var TotsDshNdOvertimepay = 0;

            var TotsDshRdpay = 0;
            var TotsDshRdNdpay = 0;
            var TotsDshRdOvertimepay = 0;
            var TotsDshRdNdOvertimepay = 0;

            var Totsnormalpay = 0;
            var TotsnormalNDpay = 0;
            var TotsnormalOvertimepay = 0;
            var TotsnormalNdOvertimepay = 0;

            var holidayleavetots = 0;

            var OFFRegularHolTots = 0;


            $('#attendance_table_body tr').each(function () {
                var row = $(this);
                var totalPay = parseFloat(row.find('td:eq(14)').text());
                var totalngovertimePay = parseFloat(row.find('td:eq(13)').text());
                var nightDiffs = parseFloat(row.find('td:eq(18)').text());
                //REST DAY
                var RDpay = parseFloat(row.find('td:eq(21)').text());
                var RdNdPay = parseFloat(row.find('td:eq(22)').text());
                var RdOvertimePay = parseFloat(row.find('td:eq(23)').text());
                var RdNdOvertimePay = parseFloat(row.find('td:eq(24)').text());
                //REGULAR HOLIDAY
                var RHpay = parseFloat(row.find('td:eq(25)').text());
                var RhNdPay = parseFloat(row.find('td:eq(26)').text());
                var RhOvertimePay = parseFloat(row.find('td:eq(27)').text());
                var RhNdOvertimePay = parseFloat(row.find('td:eq(28)').text());
                //REGULAR HOLIDAY + Rest day
                var RhRdpay = parseFloat(row.find('td:eq(29)').text());
                var RhRddPay = parseFloat(row.find('td:eq(30)').text());
                var RhRdOvertimePay = parseFloat(row.find('td:eq(31)').text());
                var RhRdNdOvertimePay = parseFloat(row.find('td:eq(32)').text());
                //Special Holiday
                var Shpay = parseFloat(row.find('td:eq(33)').text());
                var ShNdPay = parseFloat(row.find('td:eq(34)').text());
                var ShOvertimePay = parseFloat(row.find('td:eq(35)').text());
                var ShNdOvertimePay = parseFloat(row.find('td:eq(36)').text());
                //Special Holiday + Restday
                var ShRdpay = parseFloat(row.find('td:eq(37)').text());
                var ShRdNdPay = parseFloat(row.find('td:eq(38)').text());
                var ShRdOvertimePay = parseFloat(row.find('td:eq(39)').text());
                var ShRdNdOvertimePay = parseFloat(row.find('td:eq(40)').text());
                //Double Holiday
                var Dhpay = parseFloat(row.find('td:eq(41)').text());
                var DhNdPay = parseFloat(row.find('td:eq(42)').text());
                var DhOvertimePay = parseFloat(row.find('td:eq(43)').text());
                var DhNdOvertimePay = parseFloat(row.find('td:eq(44)').text());
                //Double Holiday + rest day
                var DhRdpay = parseFloat(row.find('td:eq(45)').text());
                var DhRdNdPay = parseFloat(row.find('td:eq(46)').text());
                var DhRdOvertimePay = parseFloat(row.find('td:eq(47)').text());
                var DhRdNdOvertimePay = parseFloat(row.find('td:eq(48)').text());
                //Double special holiday
                var Dshpay = parseFloat(row.find('td:eq(49)').text());
                var DshNdPay = parseFloat(row.find('td:eq(50)').text());
                var DshOvertimePay = parseFloat(row.find('td:eq(51)').text());
                var DshNdOvertimePay = parseFloat(row.find('td:eq(52)').text());
                //Double special holiday + rest day
                var DshRdpay = parseFloat(row.find('td:eq(53)').text());
                var DshRdNdPay = parseFloat(row.find('td:eq(54)').text());
                var DshRdOvertimePay = parseFloat(row.find('td:eq(55)').text());
                var DshRdNdOvertimePay = parseFloat(row.find('td:eq(56)').text());

                var holidayleavePay = parseFloat(row.find('td:eq(57)').text());

                var OffRegHoldPay = parseFloat(row.find('td:eq(58)').text());


                var normalNdPay = parseFloat(row.find('td:eq(59)').text());
                var normalOvertimePay = parseFloat(row.find('td:eq(60)').text());
                var normalNdOvertimePay = parseFloat(row.find('td:eq(61)').text());
                var normalPay = parseFloat(row.find('td:eq(62)').text());


                if (!isNaN(totalPay) && !isNaN(totalngovertimePay) && !isNaN(nightDiffs)  
                && !isNaN(RDpay) && !isNaN(RdNdPay) && !isNaN(RdNdOvertimePay)&& !isNaN(RdOvertimePay)
                && !isNaN(RHpay) && !isNaN(RhNdPay) && !isNaN(RhOvertimePay) && !isNaN(RhNdOvertimePay)
                && !isNaN(RhRdpay) && !isNaN(RhRddPay) && !isNaN(RhRdOvertimePay) && !isNaN(RhRdNdOvertimePay)
                && !isNaN(Shpay)&& !isNaN(ShNdPay)&& !isNaN(ShOvertimePay)&& !isNaN(ShNdOvertimePay)
                && !isNaN(ShRdpay) && !isNaN(ShRdNdPay) && !isNaN(ShRdOvertimePay) && !isNaN(ShRdNdOvertimePay)
                && !isNaN(Dhpay) && !isNaN(DhNdPay) && !isNaN(DhOvertimePay) && !isNaN(DhNdOvertimePay)
                && !isNaN(DhRdpay) && !isNaN(DhRdNdPay) && !isNaN(DhRdOvertimePay) && !isNaN(DhRdNdOvertimePay)
                && !isNaN(Dshpay) && !isNaN(DshNdPay) && !isNaN(DshOvertimePay) && !isNaN(DshNdOvertimePay)
                && !isNaN(DshRdpay) && !isNaN(DshRdNdPay) && !isNaN(DshRdOvertimePay) && !isNaN(DshRdNdOvertimePay)
                && !isNaN(normalNdPay) && !isNaN(normalOvertimePay) && !isNaN(normalNdOvertimePay) && !isNaN(normalPay)
                && !isNaN(holidayleavePay)&& !isNaN(OffRegHoldPay))  {
                    
                    totalSalaryBefore += totalPay;
                    totalOvertimePay += totalngovertimePay;
                    /////////////////
                    TotsRDpay += RDpay;
                    TotsRdNdpay += RdNdPay;
                    TotsRdNdOvertimepay += RdNdOvertimePay;
                    TotsRdOvertimepay += RdOvertimePay;

                    TotsRHpay += RHpay;
                    TotsRHNdpay += RhNdPay;
                    TotsRHNdOvertimepay += RhOvertimePay;
                    TotsRHOvertimepay += RhNdOvertimePay;

                    TotsRhRdpay += RhRdpay;
                    TotsRhRdNdpay += RhRddPay;
                    TotsRhRdOvertimepay += RhRdOvertimePay;
                    TotsRhRdNdOvertimepay += RhRdNdOvertimePay;

                    TotsShpay += Shpay;
                    TotsShNdpay += ShNdPay;
                    TotsShOvertimepay += ShOvertimePay;
                    TotsShNdOvertimepay += ShNdOvertimePay;

                    TotsShRdpay += ShRdpay;
                    TotsShRdNdpay += ShRdNdPay;
                    TotsShRdOvertimepay += ShRdOvertimePay;
                    TotsShRdNdOvertimepay += ShRdNdOvertimePay;

                    TotsDhpay += Dhpay;
                    TotsDhNdpay += DhNdPay;
                    TotsDhOvertimepay += DhOvertimePay;
                    TotsDhNdOvertimepay += DhNdOvertimePay;

                    TotsDhRdpay += DhRdpay;
                    TotsDhRdNdpay += DhRdNdPay;
                    TotsDhRdOvertimepay += DhRdOvertimePay;
                    TotsDhRdNdOvertimepay += DhRdNdOvertimePay;

                    TotsDshpay += Dshpay;
                    TotsDshNdpay += DshNdPay;
                    TotsDshOvertimepay += DshOvertimePay;
                    TotsDshNdOvertimepay += DshNdOvertimePay;

                    TotsDshRdpay += DshRdpay;
                    TotsDshRdNdpay += DshRdNdPay;
                    TotsDshRdOvertimepay += DshRdOvertimePay;
                    TotsDshRdNdOvertimepay += DshRdNdOvertimePay;

                    TotsnormalNDpay += normalNdPay;
                    TotsnormalOvertimepay += normalOvertimePay;
                    TotsnormalNdOvertimepay += normalNdOvertimePay;
                    Totsnormalpay += normalPay;


                    holidayleavetots += holidayleavePay;

                    OFFRegularHolTots += OffRegHoldPay;

                }
            });
                
                
            // All Deductions
            var sssDeduction = parseFloat($('#input_sss_deduction').val());
            var totalSalary = parseFloat($('#paid_leave').text());
            var pagIbigDeduction = parseFloat($('#input_pag_ibig_deduction').val());
            var philhealthDeduction = parseFloat($('#input_philhealth_deduction').val());
            var houseRent = parseFloat($('#house_rent').val()); // Get the cash advance value
            var otherDeduction = parseFloat($('#other_deduction').val()); // Get the cash advance value

            var SSSLoan = parseFloat($('#sss_loan').val()); // Get the cash advance value
            var PagibigLoan = parseFloat($('#pag_ibig_loan').val()); // Get the cash advance value

            var latededuction = parseFloat($('#total_late_count_calculated').text()); // Get the cash advance value
            var undertimeDeduction = parseFloat($('#total_undertime_calculated').text()); // Get the cash advance value
            var cashAdvance = parseFloat($('#cashAdvanceInput').val()); // Get the cash advance value
            
            var otherDeducOne = parseFloat($('#input_other_deductionOne').val()); // Get the cash advance value

            //Addition on Salary
            var incetives = parseFloat($('#input_incentives').val()); // Get the cash advance value
            var bonus = parseFloat($('#input_bonus').val()); // Get the cash advance value
            var otherAdd = parseFloat($('#input_other_add_pay').val());
            var campaignAllowance = parseFloat($('#campAllow_input').val()); // Get the cash advance value
            var otherAddOne = parseFloat($('#input_other1_add_pay').val()); // Get the cash advance value
            var otherAddHidden = parseFloat($('#othersAddHidden').val()); // Get the cash advance value

            var totalDeductions = sssDeduction + pagIbigDeduction + philhealthDeduction + houseRent + latededuction + undertimeDeduction + otherDeduction + SSSLoan + PagibigLoan + cashAdvance + otherDeducOne;
            
            var totalSalarybeforeAll = totalSalaryBefore + incetives + bonus + otherAdd + totalSalary + totalPayFromConditionMeet + campaignAllowance + otherAddOne + otherAddHidden;
           
            var totalSalaryAfter = totalSalarybeforeAll - totalDeductions;

            var totalAllNightDiff = TotsRdNdpay + TotsRHNdpay + TotsRhRdNdpay + TotsShNdpay + TotsShRdNdpay + TotsDhNdpay + TotsDhRdNdpay + TotsDshNdpay
            + TotsDshRdNdpay + TotsnormalNDpay;

            var totalAllOvertime = TotsRdOvertimepay + TotsRHOvertimepay + TotsRhRdOvertimepay + TotsShOvertimepay + TotsShRdOvertimepay 
            + TotsDhOvertimepay + TotsDshOvertimepay + TotsDshRdOvertimepay + TotsnormalOvertimepay;

            var totalAllNdOvertime = TotsRdNdOvertimepay + TotsRHNdOvertimepay + TotsRhRdNdOvertimepay + TotsShNdOvertimepay + TotsShRdNdOvertimepay
            + TotsDhNdOvertimepay + TotsDhRdOvertimepay + TotsDhRdNdOvertimepay + TotsDshNdOvertimepay + TotsDshRdNdOvertimepay + TotsnormalNdOvertimepay

            $('#input_total_overtime_pay').val(totalAllOvertime.toFixed(2));
            $('#input_total_ND_pay').val(totalAllNightDiff.toFixed(2));
            $('#input_total_NDOT_pay').val(totalAllNdOvertime.toFixed(2));

            
            $('#input_total_salary_before').val(totalSalarybeforeAll.toFixed(2));
            $('#input_total_salary_after').val(totalSalaryAfter.toFixed(2));
            $('#input_total_deductions').val(totalDeductions.toFixed(2));

            $('#RD_totalPay_input').val(TotsRDpay.toFixed(2));
            $('#RdNd_totalPay_input').val(TotsRdNdpay.toFixed(2));
            $('#RdOvertime_totalPay_input').val(TotsRdOvertimepay.toFixed(2));
            $('#RdNdOvertime_totalPay_input').val(TotsRdNdOvertimepay.toFixed(2));

            $('#Rh_totalPay_input').val(TotsRHpay.toFixed(2));
            $('#RhNd_totalPay_input').val(TotsRHNdpay.toFixed(2));
            $('#RhOvertime_totalPay_input').val(TotsRHOvertimepay.toFixed(2));
            $('#RhNdOvertime_totalPay_input').val(TotsRHNdOvertimepay.toFixed(2));


            $('#RhRd_totalPay_input').val(TotsRhRdpay.toFixed(2));
            $('#RhRdNd_totalPay_input').val(TotsRhRdNdpay.toFixed(2));
            $('#RhRdOvertime_totalPay_input').val(TotsRhRdOvertimepay.toFixed(2));
            $('#RhRdNdOvertime_totalPay_input').val(TotsRhRdNdOvertimepay.toFixed(2));

            $('#Sp_totalPay_input').val(TotsShpay.toFixed(2));
            $('#SpNd_totalPay_input').val(TotsShNdpay.toFixed(2));
            $('#SpOvertime_totalPay_input').val(TotsShOvertimepay.toFixed(2));
            $('#SpNdOvertime_totalPay_input').val(TotsShNdOvertimepay.toFixed(2));

            $('#SpRd_totalPay_input').val(TotsShRdpay.toFixed(2));
            $('#SpRdNd_totalPay_input').val(TotsShRdNdpay.toFixed(2));
            $('#SpRdOvertime_totalPay_input').val(TotsShRdOvertimepay.toFixed(2));
            $('#SpRdNdOvertime_totalPay_input').val(TotsShRdNdOvertimepay.toFixed(2));

            $('#Db_totalPay_input').val(TotsDhpay.toFixed(2));
            $('#DbNd_totalPay_input').val(TotsDhNdpay.toFixed(2));
            $('#DbOvertime_totalPay_input').val(TotsDhOvertimepay.toFixed(2));
            $('#DbNdOvertime_totalPay_input').val(TotsDhNdOvertimepay.toFixed(2));


            $('#DbRd_totalPay_input').val(TotsDhRdpay.toFixed(2));
            $('#DbRdNd_totalPay_input').val(TotsDhRdNdpay.toFixed(2));
            $('#DbRdOvertime_totalPay_input').val(TotsDhRdOvertimepay.toFixed(2));
            $('#DbRdNdOvertime_totalPay_input').val(TotsDhRdNdOvertimepay.toFixed(2));

            $('#Dsh_totalPay_input').val(TotsDshpay.toFixed(2));
            $('#DshNd_totalPay_input').val(TotsDshNdpay.toFixed(2));
            $('#DshOvertime_totalPay_input').val(TotsDshOvertimepay.toFixed(2));
            $('#DshNdOvertime_totalPay_input').val(TotsDshNdOvertimepay.toFixed(2));
            
            $('#DshRd_totalPay_input').val(TotsDshRdpay.toFixed(2));
            $('#DshRdNd_totalPay_input').val(TotsDshRdNdpay.toFixed(2));
            $('#DshRdOvertime_totalPay_input').val(TotsDshRdOvertimepay.toFixed(2));
            $('#DshRdNdOvertime_totalPay_input').val(TotsDshRdNdOvertimepay.toFixed(2));

            $('#normalNd_totalPay_input').val(TotsnormalNDpay.toFixed(2));
            $('#normalOT_totalPay_input').val(TotsnormalOvertimepay.toFixed(2));
            $('#normalNdOvertime_totalPay_input').val(TotsnormalNdOvertimepay.toFixed(2));
            $('#normal_totalPay_input').val(Totsnormalpay.toFixed(2));

            $('#holidayleavePaid').val(holidayleavetots.toFixed(2));

            $('#regHolPaid').val(OFFRegularHolTots.toFixed(2));

        });
    });

    /////////////////////////////-INPUT EFFECTS-/////////////////////////////////

        //--////////////////////////////////////
    const overtimePayInput = document.getElementById('input_total_overtime_pay');
    const overtimePayLabel = document.getElementById('overtimePay_Label');
        //--////////////////////////////////////

    const NdpayInput = document.getElementById('input_total_ND_pay');
    const NDPayLabel = document.getElementById('ndpayLabel');
        //--////////////////////////////////////

    const othersPayInput = document.getElementById('input_other_add_pay');
    const othersPayLabel = document.getElementById('othersAddPayLabel');
        //--////////////////////////////////////

    const addSpecifyInput = document.getElementById('input_specify');
    const AddSpecifyLabel = document.getElementById('specifyLabel');
        //--////////////////////////////////////

    const grossPayInput = document.getElementById('input_total_salary_before');
    const grossPayLabel = document.getElementById('grossPayLabel');
        //--////////////////////////////////////
    const sssDeducInput = document.getElementById('input_sss_deduction');
    const sssDeducLabel = document.getElementById('sss_deductionLabel');
        //--////////////////////////////////////
    const sssLoanInput = document.getElementById('sss_loan');
    const sssLoanLabel = document.getElementById('SSSloanLabel');
        //--////////////////////////////////////
    const pagibigDeducInput = document.getElementById('input_pag_ibig_deduction');
    const pagibigDeducLabel = document.getElementById('pagibigDeductionLabel');
        //--////////////////////////////////////
    const pagibigLoanInput = document.getElementById('pag_ibig_loan');
    const pagibigLoanLabel = document.getElementById('PagibigloanLabel');
        //--////////////////////////////////////
    const philhealthDeducInput = document.getElementById('input_philhealth_deduction');
    const philhealthDeducLabel = document.getElementById('philhealthDeductionLabel');
        //--////////////////////////////////////
    const houseRentInput = document.getElementById('house_rent');
    const houseRentLabel = document.getElementById('houserentLabel');
        //--////////////////////////////////////
    const otherDeducInput = document.getElementById('other_deduction');
    const otherDeducLabel = document.getElementById('otherDeductionLabel');
        //--////////////////////////////////////
    const specifyDeducInput = document.getElementById('specify_deduction');
    const specifyDeducLabel = document.getElementById('specify_deductionLabel');
        //--////////////////////////////////////
    const totalDeducInput = document.getElementById('input_total_deductions');
    const totalDeducLabel = document.getElementById('totalDeductionLabel');
        //--////////////////////////////////////
    const totalPayInput = document.getElementById('input_total_salary_after');
    const totalPayLabel = document.getElementById('totalPayLabel');
        //--////////////////////////////////////
    const campAllInput = document.getElementById('campAllow_input');
    const campAllLabel = document.getElementById('campaignAllLabel');
        //--////////////////////////////////////
    const cashAdvanceINput = document.getElementById('cashAdvanceInput');
    const cashAdvanceLabel = document.getElementById('cashAdvanceLabel');
        //--////////////////////////////////////
        
    const othersoneaddInput = document.getElementById('input_other1_add_pay');
    const othersAddoneLabel = document.getElementById('others1AddPayLabel');
        //--////////////////////////////////////
        
    const specifyoneInput = document.getElementById('input_specify1');
    const specifyOneLabel = document.getElementById('specifyLabel1');
        //--////////////////////////////////////
        
    const otherdeductionOneInput = document.getElementById('input_other_deductionOne');
    const otherdeductionOneLabel = document.getElementById('otherDeductionLabelOne');
        //--////////////////////////////////////
    const specifyinputOne = document.getElementById('specifyOne_input');
    const specifyLabelOne = document.getElementById('specifyOneLabel');
        //--////////////////////////////////////

    const restDayInput = document.getElementById('RD_totalPay_input');
    const restDayLabel = document.getElementById('restdayLabel');
        //--////////////////////////////////////

    const restDayNdInput = document.getElementById('RdNd_totalPay_input');
    const restDayNdLabel = document.getElementById('restdayNDlabel');
        //--////////////////////////////////////

    const restDayOtInput = document.getElementById('RdOvertime_totalPay_input');
    const restDayOtLabel = document.getElementById('restdayOtlabel');
        //--////////////////////////////////////

    const restDayNdOtInput = document.getElementById('RdNdOvertime_totalPay_input');
    const restDayNdOtLabel = document.getElementById('restdayNdOtlabel');
        //--////////////////////////////////////

    const regularHolInput = document.getElementById('Rh_totalPay_input');
    const regularHolLabel = document.getElementById('regularHolLabel');
        //--////////////////////////////////////

    const regularHolNdInput = document.getElementById('RhNd_totalPay_input');
    const regularHolNdLabel = document.getElementById('regularHolNdLabel');
        //--////////////////////////////////////

    const regularHolOtInput = document.getElementById('RhOvertime_totalPay_input');
    const regularHoldOtLabel = document.getElementById('regularHolOtLabel');
        //--////////////////////////////////////

    const regularHolNdOtInput = document.getElementById('RhNdOvertime_totalPay_input');
    const regularHoldNdOtLabel = document.getElementById('regularHolNdOtLabel');
        //--////////////////////////////////////

    const regularHolRdInput = document.getElementById('RhRd_totalPay_input');
    const regularHoldRdLabel = document.getElementById('regularHolRdLabel');
        //--////////////////////////////////////

    const regularHolRdNdInput = document.getElementById('RhRdNd_totalPay_input');
    const regularHoldRdNdLabel = document.getElementById('regularHolRdNdLabel');
        //--////////////////////////////////////

    const regularHolRdOtInput = document.getElementById('RhRdOvertime_totalPay_input');
    const regularHoldRdOtLabel = document.getElementById('regularHolRdOtLabel');
        //--////////////////////////////////////

    const regularHolRdNdOtInput = document.getElementById('RhRdNdOvertime_totalPay_input');
    const regularHoldRdNdOtLabel = document.getElementById('regularHolRdNdOtLabel');
        //--////////////////////////////////////

    const specialHolInput = document.getElementById('Sp_totalPay_input');
    const specialHolLabel = document.getElementById('SpecialHolLabel');
        //--////////////////////////////////////
    const specialHolNdInput = document.getElementById('SpNd_totalPay_input');
    const specialHolNdLabel = document.getElementById('SpecialHolNdLabel');
        //--////////////////////////////////////

    const specialHolOtInput = document.getElementById('SpOvertime_totalPay_input');
    const specialHolOtLabel = document.getElementById('SpecialHolOtLabel');
        //--////////////////////////////////////

    const specialHolNdOtInput = document.getElementById('SpNdOvertime_totalPay_input');
    const specialHolNdOtLabel = document.getElementById('SpecialHolNdOtLabel');
        //--////////////////////////////////////

    const specialHolRdInput = document.getElementById('SpRd_totalPay_input');
    const specialHolRdLabel = document.getElementById('SpecialHolRdLabel');
        //--////////////////////////////////////

    const specialHolRdNdInput = document.getElementById('SpRdNd_totalPay_input');
    const specialHolRdNdLabel = document.getElementById('SpecialHolRdNdLabel');
        //--////////////////////////////////////

    const specialHolRdOtInput = document.getElementById('SpRdOvertime_totalPay_input');
    const specialHolRdOtLabel = document.getElementById('SpecialHolRdOtLabel');
        //--////////////////////////////////////

    const specialHolRdNdOtInput = document.getElementById('SpRdNdOvertime_totalPay_input');
    const specialHolRdNdOtLabel = document.getElementById('SpecialHolRdNdOtLabel');
        //--////////////////////////////////////

    const Db_totalPay_input = document.getElementById('Db_totalPay_input');
    const DoubleHolLabel = document.getElementById('DoubleHolLabel');
        //--////////////////////////////////////

    const DbNd_totalPay_input = document.getElementById('DbNd_totalPay_input');
    const DoubleHolNdLabel = document.getElementById('DoubleHolNdLabel');
        //--////////////////////////////////////

    const DbOvertime_totalPay_input = document.getElementById('DbOvertime_totalPay_input');
    const DoubleHolOtLabel = document.getElementById('DoubleHolOtLabel');
        //--////////////////////////////////////

    const DbNdOvertime_totalPay_input = document.getElementById('DbNdOvertime_totalPay_input');
    const DoubleHolNdOtLabel = document.getElementById('DoubleHolNdOtLabel');
        //--////////////////////////////////////
    
    const DbRd_totalPay_input = document.getElementById('DbRd_totalPay_input');
    const DoubleHolRdLabel = document.getElementById('DoubleHolRdLabel');
        //--////////////////////////////////////

    const DbRdNd_totalPay_input = document.getElementById('DbRdNd_totalPay_input');
    const DoubleHolRdNdLabel = document.getElementById('DoubleHolRdNdLabel');
        //--////////////////////////////////////

    const DbRdOvertime_totalPay_input = document.getElementById('DbRdOvertime_totalPay_input');
    const DoubleHolRdOtLabel = document.getElementById('DoubleHolRdOtLabel');
        //--////////////////////////////////////

    const DbRdNdOvertime_totalPay_input = document.getElementById('DbRdNdOvertime_totalPay_input');
    const DoubleHolRdNdOtLabel = document.getElementById('DoubleHolRdNdOtLabel');
        //--////////////////////////////////////

    const Dsh_totalPay_input = document.getElementById('Dsh_totalPay_input');
    const doubleSpecialHolLabel = document.getElementById('doubleSpecialHolLabel');
        //--////////////////////////////////////
    const DshNd_totalPay_input = document.getElementById('DshNd_totalPay_input');
    const doubleSpecialNdHolLabel = document.getElementById('doubleSpecialNdHolLabel');
        //--////////////////////////////////////

    const DshOvertime_totalPay_input = document.getElementById('DshOvertime_totalPay_input');
    const doubleSpecialOtHolLabel = document.getElementById('doubleSpecialOtHolLabel');
        //--////////////////////////////////////

    const DshNdOvertime_totalPay_input = document.getElementById('DshNdOvertime_totalPay_input');
    const doubleSpecialNdOtHolLabel = document.getElementById('doubleSpecialNdOtHolLabel');
        //--////////////////////////////////////

    const DshRd_totalPay_input = document.getElementById('DshRd_totalPay_input');
    const doubleSpecialHolRdLabel = document.getElementById('doubleSpecialHolRdLabel');
        //--////////////////////////////////////

    const DshRdNd_totalPay_input = document.getElementById('DshRdNd_totalPay_input');
    const doubleSpecialHolRdNdLabel = document.getElementById('doubleSpecialHolRdNdLabel');
        //--////////////////////////////////////

    const DshRdOvertime_totalPay_input = document.getElementById('DshRdOvertime_totalPay_input');
    const doubleSpecialHolOtLabel = document.getElementById('doubleSpecialHolOtLabel');
        //--////////////////////////////////////

    const DshRdNdOvertime_totalPay_input = document.getElementById('DshRdNdOvertime_totalPay_input');
    const doubleSpecialHolRdNdOtLabel = document.getElementById('doubleSpecialHolRdNdOtLabel');
        //--////////////////////////////////////

    const paid_leave = document.getElementById('paid_leave');
    const paidLeaveLabel = document.getElementById('paidLeaveLabel');
        //--////////////////////////////////////

    const holidayleavePaid = document.getElementById('holidayleavePaid');
    const holLeaveLabel = document.getElementById('holLeaveLabel');
        //--////////////////////////////////////

    const regHolPaid = document.getElementById('regHolPaid');
    const offRegHolLabel = document.getElementById('offRegHolLabel');
        //--////////////////////////////////////

    const input_base_pay = document.getElementById('input_base_pay');
    const basePay_label = document.getElementById('basePay_label');
        //--////////////////////////////////////

    const input_bonus = document.getElementById('input_bonus');
    const attendance_bonuslabel = document.getElementById('attendance_bonuslabel');
        //--////////////////////////////////////

    const input_incentives = document.getElementById('input_incentives');
    const incentive_label = document.getElementById('incentive_label');
        //--////////////////////////////////////

    const normalNd_totalPay_input = document.getElementById('normalNd_totalPay_input');
    const normalDayNdLabel = document.getElementById('normalDayNdLabel');
        //--////////////////////////////////////

    const normalOT_totalPay_input = document.getElementById('normalOT_totalPay_input');
    const normalDayOtLabel = document.getElementById('normalDayOtLabel');
        //--////////////////////////////////////

    const normalNdOvertime_totalPay_input = document.getElementById('normalNdOvertime_totalPay_input');
    const normalDayNdOtLabel = document.getElementById('normalDayNdOtLabel');
        //--////////////////////////////////////

    const othersAddHidden = document.getElementById('othersAddHidden');
    const othersHidden = document.getElementById('othersHidden');
        //--////////////////////////////////////

        othersAddHidden.addEventListener('focus', () => {
            othersHidden.classList.add('green-label');
        });

        othersAddHidden.addEventListener('blur', () => {
            if (!othersAddHidden.matches(':hover')) {
                othersHidden.classList.remove('green-label');
            }
        });

        othersAddHidden.addEventListener('mouseover', () => {
            othersHidden.classList.add('green-label');
        });

        othersAddHidden.addEventListener('mouseout', () => {
            if (!othersAddHidden.matches(':focus')) {
                othersHidden.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        normalNdOvertime_totalPay_input.addEventListener('focus', () => {
            normalDayNdOtLabel.classList.add('green-label');
        });

        normalNdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!normalNdOvertime_totalPay_input.matches(':hover')) {
                normalDayNdOtLabel.classList.remove('green-label');
            }
        });

        normalNdOvertime_totalPay_input.addEventListener('mouseover', () => {
            normalDayNdOtLabel.classList.add('green-label');
        });

        normalNdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!normalNdOvertime_totalPay_input.matches(':focus')) {
                normalDayNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        normalOT_totalPay_input.addEventListener('focus', () => {
            normalDayOtLabel.classList.add('green-label');
        });

        normalOT_totalPay_input.addEventListener('blur', () => {
            if (!normalOT_totalPay_input.matches(':hover')) {
                normalDayOtLabel.classList.remove('green-label');
            }
        });

        normalOT_totalPay_input.addEventListener('mouseover', () => {
            normalDayOtLabel.classList.add('green-label');
        });

        normalOT_totalPay_input.addEventListener('mouseout', () => {
            if (!normalOT_totalPay_input.matches(':focus')) {
                normalDayOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        normalNd_totalPay_input.addEventListener('focus', () => {
            normalDayNdLabel.classList.add('green-label');
        });

        normalNd_totalPay_input.addEventListener('blur', () => {
            if (!normalNd_totalPay_input.matches(':hover')) {
                normalDayNdLabel.classList.remove('green-label');
            }
        });

        normalNd_totalPay_input.addEventListener('mouseover', () => {
            normalDayNdLabel.classList.add('green-label');
        });

        normalNd_totalPay_input.addEventListener('mouseout', () => {
            if (!normalNd_totalPay_input.matches(':focus')) {
                normalDayNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        input_incentives.addEventListener('focus', () => {
            incentive_label.classList.add('green-label');
        });

        input_incentives.addEventListener('blur', () => {
            if (!input_incentives.matches(':hover')) {
                incentive_label.classList.remove('green-label');
            }
        });

        input_incentives.addEventListener('mouseover', () => {
            incentive_label.classList.add('green-label');
        });

        input_incentives.addEventListener('mouseout', () => {
            if (!input_incentives.matches(':focus')) {
                incentive_label.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        input_bonus.addEventListener('focus', () => {
            attendance_bonuslabel.classList.add('green-label');
        });

        input_bonus.addEventListener('blur', () => {
            if (!input_bonus.matches(':hover')) {
                attendance_bonuslabel.classList.remove('green-label');
            }
        });

        input_bonus.addEventListener('mouseover', () => {
            attendance_bonuslabel.classList.add('green-label');
        });

        input_bonus.addEventListener('mouseout', () => {
            if (!input_bonus.matches(':focus')) {
                attendance_bonuslabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        input_base_pay.addEventListener('focus', () => {
            basePay_label.classList.add('green-label');
        });

        input_base_pay.addEventListener('blur', () => {
            if (!input_base_pay.matches(':hover')) {
                basePay_label.classList.remove('green-label');
            }
        });

        input_base_pay.addEventListener('mouseover', () => {
            basePay_label.classList.add('green-label');
        });

        input_base_pay.addEventListener('mouseout', () => {
            if (!input_base_pay.matches(':focus')) {
                basePay_label.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regHolPaid.addEventListener('focus', () => {
            offRegHolLabel.classList.add('green-label');
        });

        regHolPaid.addEventListener('blur', () => {
            if (!regHolPaid.matches(':hover')) {
                offRegHolLabel.classList.remove('green-label');
            }
        });

        regHolPaid.addEventListener('mouseover', () => {
            offRegHolLabel.classList.add('green-label');
        });

        regHolPaid.addEventListener('mouseout', () => {
            if (!regHolPaid.matches(':focus')) {
                offRegHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        holidayleavePaid.addEventListener('focus', () => {
            holLeaveLabel.classList.add('green-label');
        });

        holidayleavePaid.addEventListener('blur', () => {
            if (!holidayleavePaid.matches(':hover')) {
                holLeaveLabel.classList.remove('green-label');
            }
        });

        holidayleavePaid.addEventListener('mouseover', () => {
            holLeaveLabel.classList.add('green-label');
        });

        holidayleavePaid.addEventListener('mouseout', () => {
            if (!holidayleavePaid.matches(':focus')) {
                holLeaveLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        paid_leave.addEventListener('focus', () => {
            paidLeaveLabel.classList.add('green-label');
        });

        paid_leave.addEventListener('blur', () => {
            if (!paid_leave.matches(':hover')) {
                paidLeaveLabel.classList.remove('green-label');
            }
        });

        paid_leave.addEventListener('mouseover', () => {
            paidLeaveLabel.classList.add('green-label');
        });

        paid_leave.addEventListener('mouseout', () => {
            if (!paid_leave.matches(':focus')) {
                paidLeaveLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshRdNdOvertime_totalPay_input.addEventListener('focus', () => {
            doubleSpecialHolRdNdOtLabel.classList.add('green-label');
        });

        DshRdNdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DshRdNdOvertime_totalPay_input.matches(':hover')) {
                doubleSpecialHolRdNdOtLabel.classList.remove('green-label');
            }
        });

        DshRdNdOvertime_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialHolRdNdOtLabel.classList.add('green-label');
        });

        DshRdNdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DshRdNdOvertime_totalPay_input.matches(':focus')) {
                doubleSpecialHolRdNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshRdOvertime_totalPay_input.addEventListener('focus', () => {
            doubleSpecialHolOtLabel.classList.add('green-label');
        });

        DshRdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DshRdOvertime_totalPay_input.matches(':hover')) {
                doubleSpecialHolOtLabel.classList.remove('green-label');
            }
        });

        DshRdOvertime_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialHolOtLabel.classList.add('green-label');
        });

        DshRdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DshRdOvertime_totalPay_input.matches(':focus')) {
                doubleSpecialHolOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshRdNd_totalPay_input.addEventListener('focus', () => {
            doubleSpecialHolRdNdLabel.classList.add('green-label');
        });

        DshRdNd_totalPay_input.addEventListener('blur', () => {
            if (!DshRdNd_totalPay_input.matches(':hover')) {
                doubleSpecialHolRdNdLabel.classList.remove('green-label');
            }
        });

        DshRdNd_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialHolRdNdLabel.classList.add('green-label');
        });

        DshRdNd_totalPay_input.addEventListener('mouseout', () => {
            if (!DshRdNd_totalPay_input.matches(':focus')) {
                doubleSpecialHolRdNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshRd_totalPay_input.addEventListener('focus', () => {
            doubleSpecialHolRdLabel.classList.add('green-label');
        });

        DshRd_totalPay_input.addEventListener('blur', () => {
            if (!DshRd_totalPay_input.matches(':hover')) {
                doubleSpecialHolRdLabel.classList.remove('green-label');
            }
        });

        DshRd_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialHolRdLabel.classList.add('green-label');
        });

        DshRd_totalPay_input.addEventListener('mouseout', () => {
            if (!DshRd_totalPay_input.matches(':focus')) {
                doubleSpecialHolRdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshNdOvertime_totalPay_input.addEventListener('focus', () => {
            doubleSpecialNdOtHolLabel.classList.add('green-label');
        });

        DshNdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DshNdOvertime_totalPay_input.matches(':hover')) {
                doubleSpecialNdOtHolLabel.classList.remove('green-label');
            }
        });

        DshNdOvertime_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialNdOtHolLabel.classList.add('green-label');
        });

        DshNdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DshNdOvertime_totalPay_input.matches(':focus')) {
                doubleSpecialNdOtHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshOvertime_totalPay_input.addEventListener('focus', () => {
            doubleSpecialOtHolLabel.classList.add('green-label');
        });

        DshOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DshOvertime_totalPay_input.matches(':hover')) {
                doubleSpecialOtHolLabel.classList.remove('green-label');
            }
        });

        DshOvertime_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialOtHolLabel.classList.add('green-label');
        });

        DshOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DshOvertime_totalPay_input.matches(':focus')) {
                doubleSpecialOtHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DshNd_totalPay_input.addEventListener('focus', () => {
            doubleSpecialNdHolLabel.classList.add('green-label');
        });

        DshNd_totalPay_input.addEventListener('blur', () => {
            if (!DshNd_totalPay_input.matches(':hover')) {
                doubleSpecialNdHolLabel.classList.remove('green-label');
            }
        });

        DshNd_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialNdHolLabel.classList.add('green-label');
        });

        DshNd_totalPay_input.addEventListener('mouseout', () => {
            if (!DshNd_totalPay_input.matches(':focus')) {
                doubleSpecialNdHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        Dsh_totalPay_input.addEventListener('focus', () => {
            doubleSpecialHolLabel.classList.add('green-label');
        });

        Dsh_totalPay_input.addEventListener('blur', () => {
            if (!Dsh_totalPay_input.matches(':hover')) {
                doubleSpecialHolLabel.classList.remove('green-label');
            }
        });

        Dsh_totalPay_input.addEventListener('mouseover', () => {
            doubleSpecialHolLabel.classList.add('green-label');
        });

        Dsh_totalPay_input.addEventListener('mouseout', () => {
            if (!Dsh_totalPay_input.matches(':focus')) {
                doubleSpecialHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbRdNdOvertime_totalPay_input.addEventListener('focus', () => {
            DoubleHolRdNdOtLabel.classList.add('green-label');
        });

        DbRdNdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DbRdNdOvertime_totalPay_input.matches(':hover')) {
                DoubleHolRdNdOtLabel.classList.remove('green-label');
            }
        });

        DbRdNdOvertime_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolRdNdOtLabel.classList.add('green-label');
        });

        DbRdNdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DbRdNdOvertime_totalPay_input.matches(':focus')) {
                DoubleHolRdNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbRdOvertime_totalPay_input.addEventListener('focus', () => {
            DoubleHolRdOtLabel.classList.add('green-label');
        });

        DbRdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DbRdOvertime_totalPay_input.matches(':hover')) {
                DoubleHolRdOtLabel.classList.remove('green-label');
            }
        });

        DbRdOvertime_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolRdOtLabel.classList.add('green-label');
        });

        DbRdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DbRdOvertime_totalPay_input.matches(':focus')) {
                DoubleHolRdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbRdNd_totalPay_input.addEventListener('focus', () => {
            DoubleHolRdNdLabel.classList.add('green-label');
        });

        DbRdNd_totalPay_input.addEventListener('blur', () => {
            if (!DbRdNd_totalPay_input.matches(':hover')) {
                DoubleHolRdNdLabel.classList.remove('green-label');
            }
        });

        DbRdNd_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolRdNdLabel.classList.add('green-label');
        });

        DbRdNd_totalPay_input.addEventListener('mouseout', () => {
            if (!DbRdNd_totalPay_input.matches(':focus')) {
                DoubleHolRdNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbRd_totalPay_input.addEventListener('focus', () => {
            DoubleHolRdLabel.classList.add('green-label');
        });

        DbRd_totalPay_input.addEventListener('blur', () => {
            if (!DbRd_totalPay_input.matches(':hover')) {
                DoubleHolRdLabel.classList.remove('green-label');
            }
        });

        DbRd_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolRdLabel.classList.add('green-label');
        });

        DbRd_totalPay_input.addEventListener('mouseout', () => {
            if (!DbRd_totalPay_input.matches(':focus')) {
                DoubleHolRdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbNdOvertime_totalPay_input.addEventListener('focus', () => {
            DoubleHolNdOtLabel.classList.add('green-label');
        });

        DbNdOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DbNdOvertime_totalPay_input.matches(':hover')) {
                DoubleHolNdOtLabel.classList.remove('green-label');
            }
        });

        DbNdOvertime_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolNdOtLabel.classList.add('green-label');
        });

        DbNdOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DbNdOvertime_totalPay_input.matches(':focus')) {
                DoubleHolNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbOvertime_totalPay_input.addEventListener('focus', () => {
            DoubleHolOtLabel.classList.add('green-label');
        });

        DbOvertime_totalPay_input.addEventListener('blur', () => {
            if (!DbOvertime_totalPay_input.matches(':hover')) {
                DoubleHolOtLabel.classList.remove('green-label');
            }
        });

        DbOvertime_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolOtLabel.classList.add('green-label');
        });

        DbOvertime_totalPay_input.addEventListener('mouseout', () => {
            if (!DbOvertime_totalPay_input.matches(':focus')) {
                DoubleHolOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        DbNd_totalPay_input.addEventListener('focus', () => {
            DoubleHolNdLabel.classList.add('green-label');
        });

        DbNd_totalPay_input.addEventListener('blur', () => {
            if (!DbNd_totalPay_input.matches(':hover')) {
                DoubleHolNdLabel.classList.remove('green-label');
            }
        });

        DbNd_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolNdLabel.classList.add('green-label');
        });

        DbNd_totalPay_input.addEventListener('mouseout', () => {
            if (!DbNd_totalPay_input.matches(':focus')) {
                DoubleHolNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        Db_totalPay_input.addEventListener('focus', () => {
            DoubleHolLabel.classList.add('green-label');
        });

        Db_totalPay_input.addEventListener('blur', () => {
            if (!Db_totalPay_input.matches(':hover')) {
                DoubleHolLabel.classList.remove('green-label');
            }
        });

        Db_totalPay_input.addEventListener('mouseover', () => {
            DoubleHolLabel.classList.add('green-label');
        });

        Db_totalPay_input.addEventListener('mouseout', () => {
            if (!Db_totalPay_input.matches(':focus')) {
                DoubleHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolRdNdOtInput.addEventListener('focus', () => {
            specialHolRdNdOtLabel.classList.add('green-label');
        });

        specialHolRdNdOtInput.addEventListener('blur', () => {
            if (!specialHolRdNdOtInput.matches(':hover')) {
                specialHolRdNdOtLabel.classList.remove('green-label');
            }
        });

        specialHolRdNdOtInput.addEventListener('mouseover', () => {
            specialHolRdNdOtLabel.classList.add('green-label');
        });

        specialHolRdNdOtInput.addEventListener('mouseout', () => {
            if (!specialHolRdNdOtInput.matches(':focus')) {
                specialHolRdNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////


        specialHolRdOtInput.addEventListener('focus', () => {
            specialHolRdOtLabel.classList.add('green-label');
        });

        specialHolRdOtInput.addEventListener('blur', () => {
            if (!specialHolRdOtInput.matches(':hover')) {
                specialHolRdOtLabel.classList.remove('green-label');
            }
        });

        specialHolRdOtInput.addEventListener('mouseover', () => {
            specialHolRdOtLabel.classList.add('green-label');
        });

        specialHolRdOtInput.addEventListener('mouseout', () => {
            if (!specialHolRdOtInput.matches(':focus')) {
                specialHolRdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolRdNdInput.addEventListener('focus', () => {
            specialHolRdNdLabel.classList.add('green-label');
        });

        specialHolRdNdInput.addEventListener('blur', () => {
            if (!specialHolRdNdInput.matches(':hover')) {
                specialHolRdNdLabel.classList.remove('green-label');
            }
        });

        specialHolRdNdInput.addEventListener('mouseover', () => {
            specialHolRdNdLabel.classList.add('green-label');
        });

        specialHolRdNdInput.addEventListener('mouseout', () => {
            if (!specialHolRdNdInput.matches(':focus')) {
                specialHolRdNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolRdInput.addEventListener('focus', () => {
            specialHolRdLabel.classList.add('green-label');
        });

        specialHolRdInput.addEventListener('blur', () => {
            if (!specialHolRdInput.matches(':hover')) {
                specialHolRdLabel.classList.remove('green-label');
            }
        });

        specialHolRdInput.addEventListener('mouseover', () => {
            specialHolRdLabel.classList.add('green-label');
        });

        specialHolRdInput.addEventListener('mouseout', () => {
            if (!specialHolRdInput.matches(':focus')) {
                specialHolRdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolNdOtInput.addEventListener('focus', () => {
            specialHolNdOtLabel.classList.add('green-label');
        });

        specialHolNdOtInput.addEventListener('blur', () => {
            if (!specialHolNdOtInput.matches(':hover')) {
                specialHolNdOtLabel.classList.remove('green-label');
            }
        });

        specialHolNdOtInput.addEventListener('mouseover', () => {
            specialHolNdOtLabel.classList.add('green-label');
        });

        specialHolNdOtInput.addEventListener('mouseout', () => {
            if (!specialHolNdOtInput.matches(':focus')) {
                specialHolNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolOtInput.addEventListener('focus', () => {
            specialHolOtLabel.classList.add('green-label');
        });

        specialHolOtInput.addEventListener('blur', () => {
            if (!specialHolOtInput.matches(':hover')) {
                specialHolOtLabel.classList.remove('green-label');
            }
        });

        specialHolOtInput.addEventListener('mouseover', () => {
            specialHolOtLabel.classList.add('green-label');
        });

        specialHolOtInput.addEventListener('mouseout', () => {
            if (!specialHolOtInput.matches(':focus')) {
                specialHolOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolNdInput.addEventListener('focus', () => {
            specialHolNdLabel.classList.add('green-label');
        });

        specialHolNdInput.addEventListener('blur', () => {
            if (!specialHolNdInput.matches(':hover')) {
                specialHolNdLabel.classList.remove('green-label');
            }
        });

        specialHolNdInput.addEventListener('mouseover', () => {
            specialHolNdLabel.classList.add('green-label');
        });

        specialHolNdInput.addEventListener('mouseout', () => {
            if (!specialHolNdInput.matches(':focus')) {
                specialHolNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specialHolInput.addEventListener('focus', () => {
            specialHolLabel.classList.add('green-label');
        });

        specialHolInput.addEventListener('blur', () => {
            if (!specialHolInput.matches(':hover')) {
                specialHolLabel.classList.remove('green-label');
            }
        });

        specialHolInput.addEventListener('mouseover', () => {
            specialHolLabel.classList.add('green-label');
        });

        specialHolInput.addEventListener('mouseout', () => {
            if (!specialHolInput.matches(':focus')) {
                specialHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolRdNdOtInput.addEventListener('focus', () => {
            regularHoldRdNdOtLabel.classList.add('green-label');
        });

        regularHolRdNdOtInput.addEventListener('blur', () => {
            if (!regularHolRdNdOtInput.matches(':hover')) {
                regularHoldRdNdOtLabel.classList.remove('green-label');
            }
        });

        regularHolRdNdOtInput.addEventListener('mouseover', () => {
            regularHoldRdNdOtLabel.classList.add('green-label');
        });

        regularHolRdNdOtInput.addEventListener('mouseout', () => {
            if (!regularHolRdNdOtInput.matches(':focus')) {
                regularHoldRdNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolRdOtInput.addEventListener('focus', () => {
            regularHoldRdOtLabel.classList.add('green-label');
        });

        regularHolRdOtInput.addEventListener('blur', () => {
            if (!regularHolRdOtInput.matches(':hover')) {
                regularHoldRdOtLabel.classList.remove('green-label');
            }
        });

        regularHolRdOtInput.addEventListener('mouseover', () => {
            regularHoldRdOtLabel.classList.add('green-label');
        });

        regularHolRdOtInput.addEventListener('mouseout', () => {
            if (!regularHolRdOtInput.matches(':focus')) {
                regularHoldRdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolRdNdInput.addEventListener('focus', () => {
            regularHoldRdNdLabel.classList.add('green-label');
        });

        regularHolRdNdInput.addEventListener('blur', () => {
            if (!regularHolRdNdInput.matches(':hover')) {
                regularHoldRdNdLabel.classList.remove('green-label');
            }
        });

        regularHolRdNdInput.addEventListener('mouseover', () => {
            regularHoldRdNdLabel.classList.add('green-label');
        });

        regularHolRdNdInput.addEventListener('mouseout', () => {
            if (!regularHolRdNdInput.matches(':focus')) {
                regularHoldRdNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolRdInput.addEventListener('focus', () => {
            regularHoldRdLabel.classList.add('green-label');
        });

        regularHolRdInput.addEventListener('blur', () => {
            if (!regularHolRdInput.matches(':hover')) {
                regularHoldRdLabel.classList.remove('green-label');
            }
        });

        regularHolRdInput.addEventListener('mouseover', () => {
            regularHoldRdLabel.classList.add('green-label');
        });

        regularHolRdInput.addEventListener('mouseout', () => {
            if (!regularHolRdInput.matches(':focus')) {
                regularHoldRdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolNdOtInput.addEventListener('focus', () => {
            regularHoldNdOtLabel.classList.add('green-label');
        });

        regularHolNdOtInput.addEventListener('blur', () => {
            if (!regularHolNdOtInput.matches(':hover')) {
                regularHoldNdOtLabel.classList.remove('green-label');
            }
        });

        regularHolNdOtInput.addEventListener('mouseover', () => {
            regularHoldNdOtLabel.classList.add('green-label');
        });

        regularHolNdOtInput.addEventListener('mouseout', () => {
            if (!regularHolNdOtInput.matches(':focus')) {
                regularHoldNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolOtInput.addEventListener('focus', () => {
            regularHoldOtLabel.classList.add('green-label');
        });

        regularHolOtInput.addEventListener('blur', () => {
            if (!regularHolOtInput.matches(':hover')) {
                regularHoldOtLabel.classList.remove('green-label');
            }
        });

        regularHolOtInput.addEventListener('mouseover', () => {
            regularHoldOtLabel.classList.add('green-label');
        });

        regularHolOtInput.addEventListener('mouseout', () => {
            if (!regularHolOtInput.matches(':focus')) {
                regularHoldOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolNdInput.addEventListener('focus', () => {
            regularHolNdLabel.classList.add('green-label');
        });

        regularHolNdInput.addEventListener('blur', () => {
            if (!regularHolNdInput.matches(':hover')) {
                regularHolNdLabel.classList.remove('green-label');
            }
        });

        regularHolNdInput.addEventListener('mouseover', () => {
            regularHolNdLabel.classList.add('green-label');
        });

        regularHolNdInput.addEventListener('mouseout', () => {
            if (!regularHolNdInput.matches(':focus')) {
                regularHolNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        regularHolInput.addEventListener('focus', () => {
            regularHolLabel.classList.add('green-label');
        });

        regularHolInput.addEventListener('blur', () => {
            if (!regularHolInput.matches(':hover')) {
                regularHolLabel.classList.remove('green-label');
            }
        });

        regularHolInput.addEventListener('mouseover', () => {
            regularHolLabel.classList.add('green-label');
        });

        regularHolInput.addEventListener('mouseout', () => {
            if (!regularHolInput.matches(':focus')) {
                regularHolLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        restDayNdOtInput.addEventListener('focus', () => {
            restDayNdOtLabel.classList.add('green-label');
        });

        restDayNdOtInput.addEventListener('blur', () => {
            if (!restDayNdOtInput.matches(':hover')) {
                restDayNdOtLabel.classList.remove('green-label');
            }
        });

        restDayNdOtInput.addEventListener('mouseover', () => {
            restDayNdOtLabel.classList.add('green-label');
        });

        restDayNdOtInput.addEventListener('mouseout', () => {
            if (!restDayNdOtInput.matches(':focus')) {
                restDayNdOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        restDayOtInput.addEventListener('focus', () => {
            restDayOtLabel.classList.add('green-label');
        });

        restDayOtInput.addEventListener('blur', () => {
            if (!restDayOtInput.matches(':hover')) {
                restDayOtLabel.classList.remove('green-label');
            }
        });

        restDayOtInput.addEventListener('mouseover', () => {
            restDayOtLabel.classList.add('green-label');
        });

        restDayOtInput.addEventListener('mouseout', () => {
            if (!restDayOtInput.matches(':focus')) {
                restDayOtLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        restDayNdInput.addEventListener('focus', () => {
            restDayNdLabel.classList.add('green-label');
        });

        restDayNdInput.addEventListener('blur', () => {
            if (!restDayNdInput.matches(':hover')) {
                restDayNdLabel.classList.remove('green-label');
            }
        });

        restDayNdInput.addEventListener('mouseover', () => {
            restDayNdLabel.classList.add('green-label');
        });

        restDayNdInput.addEventListener('mouseout', () => {
            if (!restDayNdInput.matches(':focus')) {
                restDayNdLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        restDayInput.addEventListener('focus', () => {
            restDayLabel.classList.add('green-label');
        });

        restDayInput.addEventListener('blur', () => {
            if (!restDayInput.matches(':hover')) {
                restDayLabel.classList.remove('green-label');
            }
        });

        restDayInput.addEventListener('mouseover', () => {
            restDayLabel.classList.add('green-label');
        });

        restDayInput.addEventListener('mouseout', () => {
            if (!restDayInput.matches(':focus')) {
                restDayLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specifyinputOne.addEventListener('focus', () => {
            specifyLabelOne.classList.add('green-label');
        });

        specifyinputOne.addEventListener('blur', () => {
            if (!specifyinputOne.matches(':hover')) {
                specifyLabelOne.classList.remove('green-label');
            }
        });

        specifyinputOne.addEventListener('mouseover', () => {
            specifyLabelOne.classList.add('green-label');
        });

        specifyinputOne.addEventListener('mouseout', () => {
            if (!specifyinputOne.matches(':focus')) {
                specifyLabelOne.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        otherdeductionOneInput.addEventListener('focus', () => {
            otherdeductionOneLabel.classList.add('green-label');
        });

        otherdeductionOneInput.addEventListener('blur', () => {
            if (!otherdeductionOneInput.matches(':hover')) {
                otherdeductionOneLabel.classList.remove('green-label');
            }
        });

        otherdeductionOneInput.addEventListener('mouseover', () => {
            otherdeductionOneLabel.classList.add('green-label');
        });

        otherdeductionOneInput.addEventListener('mouseout', () => {
            if (!otherdeductionOneInput.matches(':focus')) {
                otherdeductionOneLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specifyoneInput.addEventListener('focus', () => {
            specifyOneLabel.classList.add('green-label');
        });

        specifyoneInput.addEventListener('blur', () => {
            if (!specifyoneInput.matches(':hover')) {
                specifyOneLabel.classList.remove('green-label');
            }
        });

        specifyoneInput.addEventListener('mouseover', () => {
            specifyOneLabel.classList.add('green-label');
        });

        specifyoneInput.addEventListener('mouseout', () => {
            if (!specifyoneInput.matches(':focus')) {
                specifyOneLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        othersoneaddInput.addEventListener('focus', () => {
            othersAddoneLabel.classList.add('green-label');
        });

        othersoneaddInput.addEventListener('blur', () => {
            if (!othersoneaddInput.matches(':hover')) {
                othersAddoneLabel.classList.remove('green-label');
            }
        });

        othersoneaddInput.addEventListener('mouseover', () => {
            othersAddoneLabel.classList.add('green-label');
        });

        othersoneaddInput.addEventListener('mouseout', () => {
            if (!othersoneaddInput.matches(':focus')) {
                othersAddoneLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        cashAdvanceINput.addEventListener('focus', () => {
            cashAdvanceLabel.classList.add('green-label');
        });

        cashAdvanceINput.addEventListener('blur', () => {
            if (!cashAdvanceINput.matches(':hover')) {
                cashAdvanceLabel.classList.remove('green-label');
            }
        });

        cashAdvanceINput.addEventListener('mouseover', () => {
            cashAdvanceLabel.classList.add('green-label');
        });

        cashAdvanceINput.addEventListener('mouseout', () => {
            if (!cashAdvanceINput.matches(':focus')) {
                cashAdvanceLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        campAllInput.addEventListener('focus', () => {
            campAllLabel.classList.add('green-label');
        });

        campAllInput.addEventListener('blur', () => {
            if (!campAllInput.matches(':hover')) {
                campAllLabel.classList.remove('green-label');
            }
        });

        campAllInput.addEventListener('mouseover', () => {
            campAllLabel.classList.add('green-label');
        });

        campAllInput.addEventListener('mouseout', () => {
            if (!campAllInput.matches(':focus')) {
                campAllLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        totalPayInput.addEventListener('focus', () => {
            totalPayLabel.classList.add('green-label');
        });

        totalPayInput.addEventListener('blur', () => {
            if (!totalPayInput.matches(':hover')) {
                totalPayLabel.classList.remove('green-label');
            }
        });

        totalPayInput.addEventListener('mouseover', () => {
            totalPayLabel.classList.add('green-label');
        });

        totalPayInput.addEventListener('mouseout', () => {
            if (!totalPayInput.matches(':focus')) {
                totalPayLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        totalDeducInput.addEventListener('focus', () => {
            totalDeducLabel.classList.add('green-label');
        });

        totalDeducInput.addEventListener('blur', () => {
            if (!totalDeducInput.matches(':hover')) {
                totalDeducLabel.classList.remove('green-label');
            }
        });

        totalDeducInput.addEventListener('mouseover', () => {
            totalDeducLabel.classList.add('green-label');
        });

        totalDeducInput.addEventListener('mouseout', () => {
            if (!totalDeducInput.matches(':focus')) {
                totalDeducLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        specifyDeducInput.addEventListener('focus', () => {
            specifyDeducLabel.classList.add('green-label');
        });

        specifyDeducInput.addEventListener('blur', () => {
            if (!specifyDeducInput.matches(':hover')) {
                specifyDeducLabel.classList.remove('green-label');
            }
        });

        specifyDeducInput.addEventListener('mouseover', () => {
            specifyDeducLabel.classList.add('green-label');
        });

        specifyDeducInput.addEventListener('mouseout', () => {
            if (!specifyDeducInput.matches(':focus')) {
                specifyDeducLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        otherDeducInput.addEventListener('focus', () => {
            otherDeducLabel.classList.add('green-label');
        });

        otherDeducInput.addEventListener('blur', () => {
            if (!otherDeducInput.matches(':hover')) {
                otherDeducLabel.classList.remove('green-label');
            }
        });

        otherDeducInput.addEventListener('mouseover', () => {
            otherDeducLabel.classList.add('green-label');
        });

        otherDeducInput.addEventListener('mouseout', () => {
            if (!otherDeducInput.matches(':focus')) {
                otherDeducLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        houseRentInput.addEventListener('focus', () => {
            houseRentLabel.classList.add('green-label');
        });

        houseRentInput.addEventListener('blur', () => {
            if (!houseRentInput.matches(':hover')) {
                houseRentLabel.classList.remove('green-label');
            }
        });

        houseRentInput.addEventListener('mouseover', () => {
            houseRentLabel.classList.add('green-label');
        });

        houseRentInput.addEventListener('mouseout', () => {
            if (!houseRentInput.matches(':focus')) {
                houseRentLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        philhealthDeducInput.addEventListener('focus', () => {
            philhealthDeducLabel.classList.add('green-label');
        });

        philhealthDeducInput.addEventListener('blur', () => {
            if (!philhealthDeducInput.matches(':hover')) {
                philhealthDeducLabel.classList.remove('green-label');
            }
        });

        philhealthDeducInput.addEventListener('mouseover', () => {
            philhealthDeducLabel.classList.add('green-label');
        });

        philhealthDeducInput.addEventListener('mouseout', () => {
            if (!philhealthDeducInput.matches(':focus')) {
                philhealthDeducLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        pagibigLoanInput.addEventListener('focus', () => {
            pagibigLoanLabel.classList.add('green-label');
        });

        pagibigLoanInput.addEventListener('blur', () => {
            if (!pagibigLoanInput.matches(':hover')) {
                pagibigLoanLabel.classList.remove('green-label');
            }
        });

        pagibigLoanInput.addEventListener('mouseover', () => {
            pagibigLoanLabel.classList.add('green-label');
        });

        pagibigLoanInput.addEventListener('mouseout', () => {
            if (!pagibigLoanInput.matches(':focus')) {
                pagibigLoanLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        pagibigDeducInput.addEventListener('focus', () => {
            pagibigDeducLabel.classList.add('green-label');
        });

        pagibigDeducInput.addEventListener('blur', () => {
            if (!pagibigDeducInput.matches(':hover')) {
                pagibigDeducLabel.classList.remove('green-label');
            }
        });

        pagibigDeducInput.addEventListener('mouseover', () => {
            pagibigDeducLabel.classList.add('green-label');
        });

        pagibigDeducInput.addEventListener('mouseout', () => {
            if (!pagibigDeducInput.matches(':focus')) {
                pagibigDeducLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        sssLoanInput.addEventListener('focus', () => {
            sssLoanLabel.classList.add('green-label');
        });

        sssLoanInput.addEventListener('blur', () => {
            if (!sssLoanInput.matches(':hover')) {
                sssLoanLabel.classList.remove('green-label');
            }
        });

        sssLoanInput.addEventListener('mouseover', () => {
            sssLoanLabel.classList.add('green-label');
        });

        sssLoanInput.addEventListener('mouseout', () => {
            if (!sssLoanInput.matches(':focus')) {
                sssLoanLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        sssDeducInput.addEventListener('focus', () => {
            sssDeducLabel.classList.add('green-label');
        });

        sssDeducInput.addEventListener('blur', () => {
            if (!sssDeducInput.matches(':hover')) {
                sssDeducLabel.classList.remove('green-label');
            }
        });

        sssDeducInput.addEventListener('mouseover', () => {
            sssDeducLabel.classList.add('green-label');
        });

        sssDeducInput.addEventListener('mouseout', () => {
            if (!sssDeducInput.matches(':focus')) {
                sssDeducLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        grossPayInput.addEventListener('focus', () => {
            grossPayLabel.classList.add('green-label');
        });

        grossPayInput.addEventListener('blur', () => {
            if (!grossPayInput.matches(':hover')) {
                grossPayLabel.classList.remove('green-label');
            }
        });

        grossPayInput.addEventListener('mouseover', () => {
            grossPayLabel.classList.add('green-label');
        });

        grossPayInput.addEventListener('mouseout', () => {
            if (!grossPayInput.matches(':focus')) {
                grossPayLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        addSpecifyInput.addEventListener('focus', () => {
            AddSpecifyLabel.classList.add('green-label');
        });

        addSpecifyInput.addEventListener('blur', () => {
            if (!addSpecifyInput.matches(':hover')) {
                AddSpecifyLabel.classList.remove('green-label');
            }
        });

        addSpecifyInput.addEventListener('mouseover', () => {
            AddSpecifyLabel.classList.add('green-label');
        });

        addSpecifyInput.addEventListener('mouseout', () => {
            if (!addSpecifyInput.matches(':focus')) {
                AddSpecifyLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        othersPayInput.addEventListener('focus', () => {
            othersPayLabel.classList.add('green-label');
        });

        othersPayInput.addEventListener('blur', () => {
            if (!othersPayInput.matches(':hover')) {
                othersPayLabel.classList.remove('green-label');
            }
        });

        othersPayInput.addEventListener('mouseover', () => {
            othersPayLabel.classList.add('green-label');
        });

        othersPayInput.addEventListener('mouseout', () => {
            if (!othersPayInput.matches(':focus')) {
                othersPayLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        NdpayInput.addEventListener('focus', () => {
            NDPayLabel.classList.add('green-label');
        });

        NdpayInput.addEventListener('blur', () => {
            if (!NdpayInput.matches(':hover')) {
                NDPayLabel.classList.remove('green-label');
            }
        });

        NdpayInput.addEventListener('mouseover', () => {
            NDPayLabel.classList.add('green-label');
        });

        NdpayInput.addEventListener('mouseout', () => {
            if (!NdpayInput.matches(':focus')) {
                NDPayLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////

        overtimePayInput.addEventListener('focus', () => {
            overtimePayLabel.classList.add('green-label');
        });

        overtimePayInput.addEventListener('blur', () => {
            if (!overtimePayInput.matches(':hover')) {
                overtimePayLabel.classList.remove('green-label');
            }
        });

        overtimePayInput.addEventListener('mouseover', () => {
            overtimePayLabel.classList.add('green-label');
        });

        overtimePayInput.addEventListener('mouseout', () => {
            if (!overtimePayInput.matches(':focus')) {
                overtimePayLabel.classList.remove('green-label');
            }
        });
         //--////////////////////////////////////


        ////////////////////////- INPUT EFFECT-/////////////////////////













        
    




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


   


</script>


<style>
.small-dropdown {
        width: 240px; /* Adjust the width as per your requirement */
        padding: 4px 8px; /* Adjust the padding to reduce height */
        font-size: 12px; /* Adjust the font size to reduce height */
    }
</style>
