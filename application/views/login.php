<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <meta charset="utf-8">
    <meta name="author" content="VenPep">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="todook">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png">
    <!-- Page Title  -->
    <title>Login | Aerospace & Defence Supplier Identification Dashboard</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/dashlite.css?ver=1.6.0">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/skins/theme-egyptian.css?ver=1.6.0">
    <link id="skin-default" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom.css">
</head>

<style>
    .logo-img-lg {
        max-height: 150px;
    }
</style>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="preloader" style="display: none;"></div>
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body  wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <h6>Aerospace & Defence Supplier Identification Dashboard</h6>
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-light logo-img logo-img-lg" src="<?php echo base_url(); ?>assets/images/adsid.jpg" alt="logo">
                                <img class="logo-dark logo-img logo-img-lg" src="<?php echo base_url(); ?>assets/images/adsid.jpg" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Sign-In</h4>

                                    </div>
                                </div>
                                <form id="loginForm">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Email or Username</label>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="username" name="username" placeholder="Enter your email address or username" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Get OTP</button>
                                    </div>
                                </form>
                                <div id="responseMsg" class="my-3"></div>
                                <form id="otpForm" style="display: none;">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Enter OTP</label>
                                        </div>
                                        <input type="text" maxlength="6" class="form-control numeric form-control-lg" id="otp" name="otp" placeholder="" required>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Verify OTP</button>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="back-to-login" class="btn btn-lg btn-default btn-block">Back to Login</button>
                                    </div>
                                </form>
                                <div id="otpresponseMsg" class="my-3"></div>
                                <button type="button" data-toggle="modal" data-target="#registerModal" class="btn btn-lg btn-default btn-block">Don't have an account? Register Now</button>
                            </div>
                        </div>
                        <div class="d-flex flex-column justify-content-center text-center mt-3">
                            <img src="<?php echo base_url(); ?>assets/images/aandd-logo.webp" style="width: 100px; margin: auto" class="aandd-logo">
                            <h6 class="mt-3">An Initiative by A&D Market Reports</h6>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>

    <!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center">Register Now</h5>
                </div>
                <div class="modal-body">
                    <form id="registerForm">
                        <div class="form-group">
                            <label for="name">Company Name</label>
                            <input type="text" class="form-control form-control-lg" id="company_name" name="company_name" placeholder="Enter your company name" required>
                        </div>
                        <div class="form-group">
                            <label for="company_email">Company Email</label>
                            <input type="email" class="form-control form-control-lg" id="company_email" name="company_email" placeholder="Enter your company email" required>
                        </div>
                        <div class="form-group">
                            <label for="company_number">Company Phone</label>
                            <input type="text" class="form-control form-control-lg" id="company_number" name="company_number" placeholder="Enter your company phone" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="register-form-btn">Register</button>
                </div>
            </div>
        </div>
    </div>

    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="<?php echo base_url(); ?>assets/js/bundle.js?ver=1.6.0"></script>
    <script src="<?php echo base_url(); ?>assets/js/scripts.js?ver=1.6.0"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.blockUI.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.ajax.js"></script>
    <script>
        $('#loginForm').submit(function(event) {
            event.preventDefault();
            if ($('#loginForm').valid()) {
                var email = $("#username").val();
                var req = new Request();
                req.data = {
                    "email": email,
                };
                req.url = "login/checkLogin";
                RequestHandler(req, showResponse);
            }
        });

        function showResponse(data) {
            data = JSON.parse(data);
            var str = '';
            if (data.isError == false) {
                str = str + '<div class="alert alert-dismissable alert-success">';
                str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                str = str + '<strong>Success! </strong>' + data.msg + ' </div>';
                $("#responseMsg").html(str);
                $('html, body').animate({
                    scrollTop: '0px'
                }, 0);

                $("#otp").val('');
                $("#loginForm").hide();
                $("#otpForm").fadeIn();
            } else {
                str = str + '<div class="alert alert-dismissable alert-danger">';
                str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                str = str + '<strong>Oops! </strong>' + data.msg + '</div>';
                $("#responseMsg").html(str);
                $('html, body').animate({
                    scrollTop: '0px'
                }, 0);
                setTimeout(function() {
                    $("#responseMsg").html("");
                }, 3000);
                return;
            }
        }

        $('#otpForm').submit(function(event) {
            event.preventDefault();
            if ($('#otpForm').valid()) {
                var otp = $("#otp").val();
                var email = $("#username").val();
                var req = new Request();
                req.data = {
                    "email": email,
                    "otp": otp,
                };
                req.url = "login/checkotp";
                RequestHandler(req, showResponse1);
            }
        });

        function showResponse1(data) {
            data = JSON.parse(data);
            var str = '';
            if (data.isError == false) {
                str = str + '<div class="alert alert-dismissable alert-success">';
                str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                str = str + '<strong>Success! </strong>' + data.msg + ' </div>';
                $("#otpresponseMsg").html(str);
            } else {
                str = str + '<div class="alert alert-dismissable alert-danger">';
                str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                str = str + '<strong>Oops! </strong>' + data.msg + '</div>';
                $("#otpresponseMsg").html(str);
                $('html, body').animate({
                    scrollTop: '0px'
                }, 0);

                setTimeout(function() {
                    $("#otpresponseMsg").html("");
                }, 3000);
                return;
            }
            setTimeout(function() {
                localStorage.setItem('userConsent', 'true');
                location.href = '<?php echo base_url(); ?>';
            }, 1000);
        }

        $("#back-to-login").click(function() {
            $("#otpresponseMsg").html("");
            $("#responseMsg").html("");
            $("#username").val('')
            $("#otp").val('')
            $("#otpForm").hide();
            $("#loginForm").fadeIn();
        })

        $("#register-form-btn").click(function() {
            $("#registerForm").submit();
        });

        $("#registerForm").submit(function(event) {
            event.preventDefault();
            if ($('#registerForm').valid()) {
                var company_name = $("#company_name").val();
                var company_email = $("#company_email").val();
                var company_number = $("#company_number").val();

                var req = new Request();
                req.data = {
                    "company_name": company_name,
                    "company_email": company_email,
                    "company_number": company_number,
                };
                req.url = "login/registerCompany";
                RequestHandler(req, showResponse3);
            }
        });

        function showResponse3(data) {
            data = JSON.parse(data);
            var str = '';
            if (data.isError == false) {
                $("#registerModal").modal("hide");
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast(data.msg || 'Company registered successfully!. We will contact you soon.', 'success', {
                        position: 'top-right'
                    });
                } else {
                    alert(data.msg || 'Company registered successfully!. We will contact you soon.');
                }
                return;
            } else {
                if (window.NioApp && typeof NioApp.Toast === 'function') {
                    NioApp.Toast(data.msg || 'Error registering company', 'error', {
                        position: 'top-right'
                    });
                } else {
                    alert(data.msg || 'Error registering company');
                }
                return;
            }
        }
    </script>
</body>

</html>