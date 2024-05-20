
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from colorlib.com/etc/lf/Login_v1/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 22 Feb 2024 02:11:08 GMT -->
<head>
<title>Tamtech</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link rel="icon" type="image/png" href="<?= base_url('logindes/images/tamtechlogo.png') ?>" />

<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/vendor/bootstrap/css/bootstrap.min.css') ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/fonts/font-awesome-4.7.0/css/font-awesome.min.css') ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/vendor/animate/animate.css') ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/vendor/css-hamburgers/hamburgers.min.css') ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/vendor/select2/select2.min.css') ?>">

<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/css/util.css') ?>">
<link rel="stylesheet" type="text/css" href="<?= base_url('logindes/css/main.css') ?>">


<style>
.swal2-modal {
max-width: 330px !important; /* Adjust the width as needed */
max-height: 300px !important;
}
.swal2-icon {
font-size: 10px; /* Change the size to your desired value */
}
.input-checkbox {
    margin-left: 30px; /* Adjust the margin-left as needed */
}
</style>

<meta name="robots" content="noindex, follow">
<script nonce="fe8b5906-499f-43ac-88b8-7d43af90b9fc">try{(function(w,d){!function(j,k,l,m){j[l]=j[l]||{};j[l].executed=[];j.zaraz={deferred:[],listeners:[]};j.zaraz.q=[];j.zaraz._f=function(n){return async function(){var o=Array.prototype.slice.call(arguments);j.zaraz.q.push({m:n,a:o})}};for(const p of["track","set","debug"])j.zaraz[p]=j.zaraz._f(p);j.zaraz.init=()=>{var q=k.getElementsByTagName(m)[0],r=k.createElement(m),s=k.getElementsByTagName("title")[0];s&&(j[l].t=k.getElementsByTagName("title")[0].text);j[l].x=Math.random();j[l].w=j.screen.width;j[l].h=j.screen.height;j[l].j=j.innerHeight;j[l].e=j.innerWidth;j[l].l=j.location.href;j[l].r=k.referrer;j[l].k=j.screen.colorDepth;j[l].n=k.characterSet;j[l].o=(new Date).getTimezoneOffset();if(j.dataLayer)for(const w of Object.entries(Object.entries(dataLayer).reduce(((x,y)=>({...x[1],...y[1]})),{})))zaraz.set(w[0],w[1],{scope:"page"});j[l].q=[];for(;j.zaraz.q.length;){const z=j.zaraz.q.shift();j[l].q.push(z)}r.defer=!0;for(const A of[localStorage,sessionStorage])Object.keys(A||{}).filter((C=>C.startsWith("_zaraz_"))).forEach((B=>{try{j[l]["z_"+B.slice(7)]=JSON.parse(A.getItem(B))}catch{j[l]["z_"+B.slice(7)]=A.getItem(B)}}));r.referrerPolicy="origin";r.src="../../../cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(j[l])));q.parentNode.insertBefore(r,q)};["complete","interactive"].includes(k.readyState)?zaraz.init():j.addEventListener("DOMContentLoaded",zaraz.init)}(w,d,"zarazData","script");})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};</script></head>
<body>
<div class="limiter">
<div class="container-login100">
<div class="wrap-login100">
<div class="login100-pic js-tilt" data-tilt>
<img src="<?= base_url('logindes/images/tamtechlogo.png') ?>" alt="IMG">
</div>

<?php $validation =  \Config\Services::validation(); ?> 

                            
   <form action="<?= site_url('login') ?>" method="POST" enctype="multipart/form-data" class="login100-form validate-form">
    <span class="login100-form-title">
        <img src="<?= base_url('logindes/images/tamtechname.jpg') ?>" alt="IMG" width="250" height="100">
    </span>
    <?php if(session()->getFlashdata('msg')) : ?>
        <div class="alert alert-danger" role="alert">
            <?= session()->getFlashdata('msg') ?>
    </div>
    <?php endif; ?>
    <div  class="wrap-input100 validate-input" data-validate="">
    <input class="input100" type="text" id="username" name="username" value="<?= session()->get('email') ?>" placeholder="Username/Email">
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-envelope" aria-hidden="true"></i>
        </span>
    </div>
    <div id="usernameExist_error" class="text-danger input-checkbox"></div> 

    <div  class="wrap-input100 validate-input " data-validate="">
    <input class="input100" id="password" type="password" name="password" placeholder="Password" required>
        <span class="focus-input100"></span>
        <span class="symbol-input100">
            <i class="fa fa-lock" aria-hidden="true"></i>
        </span>
    </div>
    
    <div class="form-group">
        <input type="checkbox" class="input-checkbox" id="show_password_checkbox">
        <label for="show_password_checkbox" class="input-label">Show Password</label>
    </div>

    <div class="container-login100-form-btn">
        <button id="loginbtn" class="login100-form-btn">
            Login
        </button>
    </div>
    
    <div class="text-center p-t-12">
        <a class="txt2" href="<?= base_url('reset/password'); ?>">Forgot Password?</a>
    </div>
    
    <div class="text-center p-t-136">
        <a class="txt2" href="<?= base_url('Register'); ?>">Create your Account <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a>
        <div>
        <a class="txt2" href="<?= base_url('payroll/login'); ?>">Payroll <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i></a>
        </div>
    </div>
</form>

</div>
</div>
</div>

<script src="<?= base_url('logindes/vendor/jquery/jquery-3.2.1.min.js') ?>"></script>

<script src="<?= base_url('logindes/vendor/bootstrap/js/popper.js') ?>"></script>
<script src="<?= base_url('logindes/vendor/bootstrap/js/bootstrap.min.js') ?>"></script>

<script src="<?= base_url('logindes/vendor/select2/select2.min.j') ?>s"></script>

<script src="<?= base_url('logindes/vendor/tilt/tilt.jquery.min.j') ?>s"></script>
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

        document.addEventListener("DOMContentLoaded", function () {
            <?php if (session()->getFlashdata('status')) { ?>
                Swal.fire({
                    icon: '<?= session()->getFlashdata('status_icon')?>',
                    title: '<?= session()->getFlashdata('status')?>',
                    showConfirmButton: true,
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer);
                        toast.addEventListener('mouseleave', Swal.resumeTimer);
                    },
                });
            <?php } ?>
        });
	</script>

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>



<script src="<?= base_url('logindes/js/main.js') ?>"></script>
<script defer src="https://static.cloudflareinsights.com/beacon.min.js/v84a3a4012de94ce1a686ba8c167c359c1696973893317" integrity="sha512-euoFGowhlaLqXsPWQ48qSkBSCFs3DPRyiwVu3FjR96cMPx+Fr+gpWRhIafcHwqwCqWS42RZhIudOvEI+Ckf6MA==" data-cf-beacon='{"rayId":"8593b25e59e7b012","b":1,"version":"2024.2.1","token":"cd0b4b3a733644fc843ef0b185f98241"}' crossorigin="anonymous"></script>
</body>

</html>
