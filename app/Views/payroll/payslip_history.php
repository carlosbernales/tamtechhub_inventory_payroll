<?= $this->include('footers_headers/payroll_table_header') ?>


<link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>">

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
                <h5>Payslips History</h5>
              </div>


              
              <div class="card-body">
                <div class="dt-responsive">
                  <table id="setting-default" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <th style="text-align: left;">Payslip No</th>
                                <th>Agent</th>
                                <th>Email</th>
                                <th>Date Created</th>
                                <th style="text-align: left;">Payslip</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($payslips as $new): ?>
                            <tr>
                                <td style="text-align: left;" class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['payslip_no']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['agent_name']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['user_email']; ?></td>
                                <td class="agent-cell-clickable" data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>"><?php echo $new['formatted_date']; ?></td>
                                <td style="text-align: left;">
                                            <a href="<?= base_url('payslip_pdf/' . $new['image_name']); ?>" target="_blank" class="file-item-icon far fa-file-pdf text-danger" style="font-size: 24px;"></a>
                                        </td>
                                <td style="width:5%">
                                    <button class="btn btn-primary btn-sm send-email" data-id="<?php echo $new['id']; ?>" data-payslip-no="<?php echo $new['payslip_no']; ?>" data-agent-name="<?php echo $new['agent_name']; ?>" data-user-email="<?php echo $new['user_email']; ?>" data-image-name="<?php echo $new['image_name']; ?>"data-start-date="<?php echo $new['startDate']; ?>"data-end-date="<?php echo $new['end_date']; ?>"><i class="fas fa-paper-plane"></i> Resend</button>
                                </td>

                                <td style="width:3%">
                                <button class="btn btn-primary btn-sm hidden " data-toggle="modal" data-target="#editModal-<?php echo $new['id']; ?>" data-id="<?php echo $new['id']; ?>">Edit</button>
                                <a href="<?= site_url('delete_payslip/leave/'.$new['id']) ?>" class="fa fa-trash delete" style="font-size: 2em; color: red;" onclick="confirmAgentDelete(event)"></a>
                                </td>
                            </tr>

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

 





    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/payroll_scripts.js') ?>"></script>
	  <script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>

    <script>
$(document).ready(function() {
    var totalEmails = $('.send-email').length; // Total number of emails to send
    var emailsSentCount = 0; // Counter for successful email sends

    // Function to show the alert
    function showAlert(message, icon) {
        Swal.fire({
            icon: icon,
            title: message,
            timer: 3000 // Set the timer for auto close
        });
    }

    function showSendingEmailAlert() {
        Swal.fire({
            icon: 'info',
            title: 'Sending Email...',
            showConfirmButton: false,
            allowOutsideClick: false
        });
    }

    $('.send-email').click(function() {
        var payslipNo = $(this).data('payslip-no');
        var agentName = $(this).data('agent-name');
        var userEmail = $(this).data('user-email');
        var imageName = $(this).data('image-name');
        var startDates = $(this).data('start-date');
        var enDdate = $(this).data('end-date');


        showSendingEmailAlert(); // Show "Sending Email..." alert
        sendEmail(payslipNo, agentName, userEmail, imageName, startDates , enDdate, true);
    });

    $('#send-all-emails').click(function() {
        showSendingEmailAlert(); // Show "Sending Email..." alert

        $('.send-email').each(function() {
            var payslipNo = $(this).data('payslip-no');
            var agentName = $(this).data('agent-name');
            var userEmail = $(this).data('user-email');
            var imageName = $(this).data('image-name');
            var startDates = $(this).data('start-date');
            var enDdate = $(this).data('end-date');

            sendEmail(payslipNo, agentName, userEmail, imageName, startDates, enDdate, false);
        });
    });

    function sendEmail(payslipNo, agentName, userEmail, imageName, startDates, enDdate, isSingle ) {
        $.ajax({
            url: '<?php echo base_url('payslip/sendMmail'); ?>',
            type: 'POST',
            data: {
                payslip_no: payslipNo,
                agent_name: agentName,
                user_email: userEmail,
                image_name: imageName,
                startDate: startDates,
                end_date: enDdate
            },
            success: function(response) {
                if (response.success) {
                    emailsSentCount++; 
                    if (emailsSentCount === totalEmails) {
                        showAlert('Sent successfully.', 'success');
                        setTimeout(function() {
                            location.reload(); 
                        }, 3000);
                    } else if (isSingle) {
                        location.reload(); 
                        showAlert('Sent successfully.', 'success');
                    }
                } else {
                    showAlert('Error sending email for one or more recipients.', 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                showAlert('An error occurred while sending the email.', 'error');
            }
        });
    }
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
