
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
 <!-- [Google Font : Public Sans] icon -->
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- [Tabler Icons] https://tablericons.com -->
<link rel="stylesheet" href="<?= base_url('payroll_template/login/assets/fonts/tabler-icons.min.css') ?>" >
<!-- [Feather Icons] https://feathericons.com -->
<link rel="stylesheet" href="<?= base_url('payroll_template/login/assets/fonts/feather.css') ?>" >
<!-- [Font Awesome Icons] https://fontawesome.com/icons -->
<link rel="stylesheet" href="<?= base_url('payroll_template/login/assets/fonts/fontawesome.css') ?>" >
<!-- [Material Icons] https://fonts.google.com/icons -->
<link rel="stylesheet" href="<?= base_url('payroll_template/login/assets/fonts/material.css') ?>" >
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="<?= base_url('payroll_template/login/assets/css/style.css') ?>" id="main-style-link" >
<link rel="stylesheet" href="<?= base_url('payroll_template/login/assets/css/style-preset.css') ?>" >

</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<style>
  
.swal2-modal {
max-width: 330px !important; /* Adjust the width as needed */
max-height: 300px !important;
}
.swal2-icon {
font-size: 10px; /* Change the size to your desired value */
}
.input-checkbox {
    margin-left: 10px; /* Adjust the margin-left as needed */
}
</style>

<body data-pc-preset="preset-1" data-pc-sidebar-theme="light" data-pc-sidebar-caption="true" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
  <div class="loader-bg">
    <div class="loader-track">
      <div class="loader-fill"></div>
    </div>
  </div>
  <!-- [ Pre-loader ] End -->

  <div class="auth-main v2">
    <div class="bg-overlay bg-dark"></div>
    <div class="auth-wrapper">
      <div class="auth-sidecontent">
        <div class="auth-sidefooter">
          <img src="<?= base_url('logindes/images/tamtechnamewithspace.png') ?>" class="" alt="images"  width="550" height="100"/>
          <hr class="mb-3 mt-4" />
          <div class="row">
          </div>
        </div>

      </div>
      <div class="auth-form">
        <div class="card my-5 mx-3">
          <div class="card-body">
            <h4 class="f-w-500 mb-1">Login with your email o username</h4>
            <p class="mb-3">Don't have an Account? <a href="<?= base_url('Register'); ?>" class="link-primary ms-1">Create Account</a></p>
          <form action="<?= site_url('payroll/login') ?>" method="POST" enctype="multipart/form-data" class="login100-form validate-form">

          <?php if(session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('msg') ?>
        </div>
        <?php endif; ?>
            <div class="mb-3">
              <input type="username" name="username" class="form-control" id="username" placeholder="Email or Username" required>
              <div id="usernameExist_error" class="text-danger input-checkbox"></div> 
            </div>
            <div class="mb-3">
              <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <input type="checkbox" class="input-checkbox" id="show_password_checkbox">
                <label for="show_password_checkbox" class="input-label">Show Password</label>
            </div>

            <div class="d-flex mt-1 justify-content-between align-items-center">
              <div class="form-check">
              </div>
              <a href="<?= base_url('reset/password'); ?>">
                <h6 class="text-secondary f-w-400 mb-0">Forgot Password?</h6>
              </a>
            </div>
            
            <div class="d-grid mt-4">
              <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
        <br><br>
        <div class="text-center p-t-136">
          <a class="txt2" href="<?= base_url('/'); ?>">Go to Inventory <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a>
        </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  <!-- Required Js -->

  <script src="<?= base_url('payroll_template/login/assets/js/plugins/popper.min.js') ?>"></script>
  <script src="<?= base_url('payroll_template/login/assets/js/plugins/simplebar.min.js') ?>"></script>
  <script src="<?= base_url('payroll_template/login/assets/js/plugins/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('payroll_template/login/assets/js/fonts/custom-font.js') ?>"></script>
  <script src="<?= base_url('payroll_template/login/assets/js/pcoded.js') ?>"></script>
  <script src="<?= base_url('payroll_template/login/assets/js/plugins/feather.min.js') ?>"></script>
<script src="<?= base_url('template/sweetalert2@11.js') ?>"></script>
  <script src="<?= base_url('template/jquery-3.6.0.min.js') ?>"></script>



  
  <script>
    $(document).ready(function() {
    $('#username').on('input', function() {
        var username = $(this).val();
        $.ajax({
            url: '<?= site_url('emailOrUsername/Check') ?>',
            method: 'POST',
            data: { username: username },
            success: function(response) {
                if (response.exists) {
                    $('#usernameExist_error').text('No username/email found');
                    $('#loginbtn').prop('disabled', true);
                } else {
                    $('#usernameExist_error').text('');
                    $('#loginbtn').prop('disabled', false);
                }
            }
        });
    });
});

    <?php if(session()->has('status_icon') && session()->has('status')): ?>
            // Display SweetAlert2 based on flash session data
            Swal.fire({
                icon: '<?php echo session('status_icon'); ?>',
                title: '<?php echo session('status'); ?>',
                showConfirmButton: false,
                timer: 1500
            });
        <?php endif; ?>

        const showPasswordCheckbox = document.getElementById('show_password_checkbox');
        const passwordInput = document.getElementById('password');
        const confirmPassInput = document.getElementById('confirm_password');

        showPasswordCheckbox.addEventListener('change', () => {
            if (showPasswordCheckbox.checked) {
                passwordInput.type = 'text';
                confirmPassInput.type = 'text';
            } else {
                passwordInput.type = 'password';
                confirmPassInput.type = 'password';
            }
        });
  </script>
  
  
  
  
  
  
  
  
  
  
  
</div>
</body>
<!-- [Body] end -->

</html>