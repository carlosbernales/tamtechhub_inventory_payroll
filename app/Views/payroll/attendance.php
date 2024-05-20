<?= $this->include('footers_headers/payroll_table_header') ?>

<link rel="stylesheet" href="<?= base_url('payroll_template/payroll_style.css') ?>"> 
<style>
    #setting-default th,
    #setting-default td {
        padding: 5px; /* Adjust this value to change the cell padding */
        font-size: 15px; /* Adjust this value to change the font size */
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
              <h3>Attendance</h3>
          <div class="card-header" style="display: flex; justify-content: flex-end;">
              <a href="#" id="deleteButton" class="btn btn-danger" style="margin-right: 10px;"><i class="fas fa-trash"> Delete</i></a>
              <a href="#" class="btn btn-success " data-toggle="modal" data-target="#myexctractModal" style="margin-right: 10px;">Export Attendance</a>
              <a href="#" class="btn btn-success" data-toggle="modal" data-target="#myModal" style="margin-right: 10px;"><i class="fas fa-upload">Upload</i></a>
              <a href="<?= site_url('download/Template') ?>" class="btn btn-success"><i class="fas fa-download"></i> Download Template</a>
              </div>
              <div class="card-body">
                <div class="dt-responsive">
                  <table id="setting-default" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                                <input type="checkbox" id="selectAllCheckbox"><label for="selectAllCheckbox">Select All </label>
                                <p id="selectedCount" style="display: none">0 selected</p>
                                <th style="width:1%"></th>
                                <th><small>Agent</small></th>
                                <th><small>Agent ID</small></th>
                                <th><small>Date</small></th>
                                <th><small>Time In</small></th>
                                <th><small>Time Out</small></th>
                                <th><small>Required Work</small></th>
                                <th><small>Actual Work</small></th>
                                <th><small>ND</small></th>
                                <th><small>Overtime</small></th>
                                <th><small>ND Overtime</small></th>
                                <th><small>Late</small></th>
                                <th><small>Early Out</small></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($attendance as $new): ?>
                            <tr>
                                <td>
                                <input type="checkbox" class="attendanceCheckBox" data-id="<?= $new['id'] ?>" name="selected_attendance[]" value="<?= $new['id'] ?>">
                                </td>
                                <td><?php echo $new['agent_name']; ?></td>
                                <td><?php echo $new['agent_id']; ?></td>
                                <td><?php echo date('F j, Y', strtotime($new['date'])); ?></td>
                                <td><?php echo $new['time_in']; ?></td>
                                <td><?php echo $new['time_out']; ?></td>
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['required_work']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['actual_work']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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
                                
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['night_diff']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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
                                
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['ovetime']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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
                                
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['nd_overtime']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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
                                
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['late_count']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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
                                
                                <td style="text-align: left;">
                                    <?php
                                    $time = $new['early_out']; 
                                    
                                    $time_in_seconds = strtotime($time) - strtotime('TODAY');
                                    
                                    $hours = floor($time_in_seconds / 3600);
                                    $minutes = floor(($time_in_seconds % 3600) / 60);
                                    
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

                                <td style="width:3%">
                                <a href="<?= site_url('attendance/delete_'.$new['id']) ?>" class="fa fa-trash delete" style="font-size: 2em; color: red;" onclick="confirmAgentDelete(event)"></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
        </div>
      </div>
      
    </section>
    
    <div class="modal fade" id="myexctractModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                </div>
                 <form action="<?= site_url('exctract/attendance') ?>" method="POST">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        
                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
						
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" >Export</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
   

      
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Make Sure that the data of each agent is updated especially the required hours work and daily salary. 
                    Also make sure the attendance has no same date per agent unless only one of it will be inserted to the system</h5>
                </div>
                <form id="attendanceForm" action="<?= site_url('upload/attendance') ?>" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="file" class="form-control" name="upload_attendance" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="laptopsaveBtn">Insert</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



   
    <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('payroll_template/payroll_scripts.js') ?>"></script>

    
<script>
document.getElementById('attendanceForm').addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent form submission

        // Show sweet alert with loading spinner
        Swal.fire({
            title: 'Please wait',
            html: '<div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div>',
            allowOutsideClick: false,
            showCancelButton: false,
            showConfirmButton: false,
            onBeforeOpen: () => {
                Swal.showLoading();
            }
        });
        this.submit();
    });

function deleteSelectedItems() {
  const selectedIds = $('.attendanceCheckBox:checked').map(function() {
    return $(this).data('id');
  }).get();

  $.ajax({
    url: '<?= site_url('deleteMultiple/Attendance') ?>',
    type: 'POST',
    data: { ids: selectedIds },
    success: function(response) {
      console.log(response);

      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Selected items deleted successfully!',
      }).then((result) => {
        location.reload(); 
      });
    },
    error: function(xhr, status, error) {
      console.error(xhr.responseText);
    }
  });
}

function updateDeleteButtonVisibility() {
  const checkedCount = $('.attendanceCheckBox:checked').length;
  $('#deleteButton').toggle(checkedCount > 0);
  $('#selectedCount').text(`${checkedCount} selected`).toggle(checkedCount > 0);
}

$('#deleteButton').on('click', function(e) {
  e.preventDefault(); 
  deleteSelectedItems(); 
});

$('#selectAllCheckbox').on('change', function() {
  $('.attendanceCheckBox').prop('checked', $(this).prop('checked'));
  updateDeleteButtonVisibility(); 
});

$(document).on('change', '.attendanceCheckBox', function() {
  $('#selectAllCheckbox').prop('checked', $('.attendanceCheckBox:checked').length === $('.attendanceCheckBox').length);
  updateDeleteButtonVisibility(); 
});

updateDeleteButtonVisibility();



$(document).ready(function(){
    <?php if(session()->getFlashdata('status')){?>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
        timerProgressBar: true,
        didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
})
Toast.fire({
  icon: '<?= session()->getFlashdata('status_icon')?>',
  title: '<?= session()->getFlashdata('status')?>'
})
      <?php }?>
  });

  $(document).ready(function() {
    $('#deleteButton').hide();
    $('.attendanceCheckBox').change(function() {
      if ($('.attendanceCheckBox:checked').length > 0) {
        $('#deleteButton').show();
      } else {
        $('#deleteButton').hide();
      }
    });
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
