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
                  <h4>Not Active Agents</h4>
              </div>


              
              <div class="card-body">
                <div class="dt-responsive">
                  <table id="setting-default" class="table table-striped table-bordered nowrap">
                        <thead>
                            <tr>
                            
                                <th><small>Agent</small></th>
                                <th><small>Agent ID</small></th>
                                <th><small>Campaign</small></th>
                                <th><small>Details</small></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($agent_list as $new): ?>
                            <tr>
                               
                                <td class="agent-cell-clickable" ><?php echo $new['agent_name']; ?></td>
                                <td class="agent-cell-clickable" ><?php echo $new['agent_id']; ?></td>
                                <td class="agent-cell-clickable" ><?php echo $new['campaign']; ?></td>
                               <td ><a href="#" data-toggle="modal" data-target="#resignedModal-<?= $new['agent_id'] ?>" data-id="<?php echo $new['agent_id']; ?>">View</a></td>
                                <td style="width:6%">

                                    <a href="<?= site_url('backto/active_' . $new['id']); ?>" onclick="document.getElementById('activeForm<?= $new['id']; ?>').submit(); return false;" style="color: green;">Active</a> 
    								<form id="activeForm<?= $new['id']; ?>" action="<?= site_url('backto/active_' . $new['id']); ?>" method="post" style="display: none;">
    									<input type="hidden" name="id" value="<?= $new['id']; ?>">
    									<input type="hidden" name="status" value="Active">
    								</form>
    

                                <td style="width:3%">
                                <button class="btn btn-primary btn-sm hidden "  data-id="<?php echo $new['id']; ?>">Edit</button>
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
    <script src="<?= base_url('template/semantic.min.js') ?>"></script>
    <script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>


<script>


$(document).ready(function(){
    <?php if(session()->getFlashdata('status')){?>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 500,
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
