
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
    <link rel="icon" href="<?= base_url('logindes/images/tamtechlogo.png') ?>" type="image/x-icon" />
    <link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>">

    <link rel="icon" href="<?=base_url('payroll_template/tables/assets/images/favicon.svg')?>" type="image/x-icon" />

    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/plugins/dataTables.bootstrap5.min.css')?>">
    
    <link rel="stylesheet" href="<?=base_url('payroll_template/tables/assets/css/style.css')?>" id="main-style-link" >

    <link href="<?=base_url('payroll_template/fullcalendar@5.10.1-main.css')?>" rel="stylesheet">

    <link href="<?=base_url('payroll_template/bootstrap.min.css')?>" rel="stylesheet">

  </head>


<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light" style="margin-top: 30px;">

  <div class="">
    <div class="pc-content">
    <a href="<?php echo base_url('payroll/agents'); ?>" class="btn btn-close position-absolute top-0 end-0 m-3"></a>

    <div id="calendar"></div>

    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="eventModalLabel">Attendance Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalContent">

                </div>
            </div>
        </div>
    </div>






    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?=base_url('payroll_template/bootstrap.bundle.min.js')?>"></script>
    <script src="<?=base_url('payroll_template/fullcalendar@5.10.1.main.js')?>"></script>

 

    <script>
    document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        events: <?= json_encode($events) ?>,
        eventClick: function(info) {
            if (info.event.title === 'Present') {

                // Convert other time-related fields to hours and minutes
                var lateCount = convertToHoursAndMinutes(info.event.extendedProps.late_count);
                var earlyOut = convertToHoursAndMinutes(info.event.extendedProps.early_out);
                var nightDiff = convertToHoursAndMinutes(info.event.extendedProps.night_diff);
                var overtime = convertToHoursAndMinutes(info.event.extendedProps.overtime);
                var ndOvertime = convertToHoursAndMinutes(info.event.extendedProps.nd_overtime);
                var actualWork = convertToHoursAndMinutes(info.event.extendedProps.actual_work);
                var time_in = (info.event.extendedProps.time_in);
                var time_out = (info.event.extendedProps.time_out);

                // Populate modal content
                var modalContent = document.getElementById('modalContent');
                modalContent.innerHTML = `
                    <p><strong>Time In:</strong> ${time_in}</p>
                    <p><strong>Time Out:</strong> ${time_out}</p>
                    <p><strong>Late Count:</strong> ${lateCount}</p>
                    <p><strong>Early Out:</strong> ${earlyOut}</p>
                    <p><strong>Night Diff:</strong> ${nightDiff}</p>
                    <p><strong>Overtime:</strong> ${overtime}</p>
                    <p><strong>Night Differential Overtime:</strong> ${ndOvertime}</p>
                    <p><strong>Actual Work:</strong> ${actualWork}</p>
                `;
                // Show modal
                $('#eventModal').modal('show');
            } else if (info.event.title === 'Absent') {
                // Do nothing if the event title is "Absent"
                return false;
            }
        },
        eventContent: function(arg) {
            const { event } = arg;
            var backgroundColor = '';
            var textColor = '';

            if (event.title === 'OFF') {
                backgroundColor = 'yellow';
                textColor = 'black';
            } else if (event.title === 'Absent') {
                backgroundColor = 'red';
            } else if (event.title === 'Paid Leave') {
                backgroundColor = 'yellowgreen';
                textColor = 'black';
            } else if (event.title === 'Holiday Leave') {
                backgroundColor = 'yellowgreen';
                textColor = 'black';
            } else if (event.title === 'OFF/Holiday (Paid)') {
                backgroundColor = 'yellow';
                textColor = 'black';
            }
            
            var style = `background-color: ${backgroundColor}; color: ${textColor};`;
            return { html: `<div style="${style}">${event.title}</div>` };
        }
    });

    calendar.render();

    function convertTimeToAMPM(timeString) {
        var time = new Date('1970-01-01T' + timeString); // Appending dummy date to use Date object
        return time.toLocaleTimeString('en-US', { hour: 'numeric', minute: 'numeric', hour12: true });
    }

    function convertToHoursAndMinutes(timeString) {
        // Splitting timeString into hours, minutes, and seconds
        var timeParts = timeString.split(':').map(Number);
        var hours = timeParts[0];
        var minutes = timeParts[1];

        // Returning formatted hours and minutes
        if (hours === 0) {
            return minutes + ' minutes';
        } else if (minutes === 0) {
            return hours + ' hours';
        } else {
            return hours + ' hours ' + minutes + ' minutes';
        }
    }
});


    </script>


  </body>
</html>


