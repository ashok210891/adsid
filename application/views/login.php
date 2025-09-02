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
                            </div>
                        </div>
                    </div>
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
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
    </script>
</body>

</html>