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
    <title>Contact | Aerospace & Defence Supplier Identification Dashboard</title>
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
                                        <h4 class="nk-block-title">Contact Us</h4>

                                    </div>
                                </div>
                                <form id="loginForm">
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Name</label>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="fullname" placeholder="Enter your name" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Email</label>
                                        </div>
                                        <input type="email" class="form-control form-control-lg" id="email" placeholder="Enter your email address" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-label-group">
                                            <label class="form-label" for="username">Mobile Number</label>
                                        </div>
                                        <input type="text" class="form-control form-control-lg" id="mobile-number" placeholder="Enter your mobile number">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Send Contact Details</button>
                                    </div>
                                </form>
                                <div id="responseMsg" class="my-3"></div>
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
                var name = $("#fullname").val();
                var email = $("#email").val();
                var mobileNumber = $("#mobile-number").val();
                var req = new Request();
                req.data = {
                    "name": name,
                    "email": email,
                    "mobileNumber": mobileNumber,
                };
                req.url = "contact/submitcontact";
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
                $("#fullname").val("");
                $("#email").val("");
                $("#mobile-number").val("");
            } else {
                str = str + '<div class="alert alert-dismissable alert-danger">';
                str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
                str = str + '<strong>Oops! </strong>' + data.msg + '</div>';
                $("#responseMsg").html(str);
            }
        }
    </script>
</body>

</html>