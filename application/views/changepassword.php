<!DOCTYPE html>
<html class="backend">
    <!-- START Head -->
    <head>
        <!-- START META SECTION -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>SPECTRA</title>
        <meta name="author" content="SPECTRA">
        <meta name="description" content="SPECTRA">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url(); ?>backend/image/touch/apple-touch-icon-144x144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url(); ?>backend/image/touch/apple-touch-icon-114x114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url(); ?>backend/image/touch/apple-touch-icon-72x72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url(); ?>backend/image/touch/apple-touch-icon-57x57-precomposed.png">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>backend/image/favicon.ico">
        <!--/ END META SECTION -->

        <!-- START STYLESHEETS -->
        <!-- Application stylesheet : mandatory -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/library/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/stylesheet/layout.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>backend/stylesheet/uielement.min.css">
        <!--/ Application stylesheet -->
        <!-- END STYLESHEETS -->

        <!-- START JAVASCRIPT SECTION - Load only modernizr script here -->
        <script src="<?php echo base_url(); ?>backend/library/modernizr/js/modernizr.min.js"></script>
        <!--/ END JAVASCRIPT SECTION -->
    </head>
    <!--/ END Head -->

    <!-- START Body -->
    <body>
        <!-- START Template Main -->
        <section id="main" role="main">
            <!-- START Template Container -->
            <section class="container">
                <!-- START row -->
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4">
                        <!-- Brand -->
                        <div class="text-center" style="margin-bottom:40px;">
                            <!--<span class="logo-figure inverse"></span>-->
                            <!--<span class="logo-text inverse"></span>-->
							<h3><a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>theme/img/logo1.png" height="70" alt="Buy Spectra" /></a></h3>
                            <!--<h5 class="semibold text-muted mt-5">Login to your account.</h5>-->
                        </div>
                        <!--/ Brand -->
                        
                        <hr><!-- horizontal line -->
                        
                        <div id="responseMsg"></div>
                        
                        <!-- Login form -->
                        <form class="panel" id="changePasswordForm" data-parsley-validate>
                            <div class="panel-body">
                                <div class="form-group">
                                    <div class="form-stack has-icon pull-left">
                                        <input type="password" class="form-control" placeholder="Old password" id="oldPassword" required="">
                                        <i class="ico-lock2 form-control-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-stack has-icon pull-left">
                                        <input type="password" class="form-control" placeholder="New password" id="newPassword" required="">
                                        <i class="ico-lock2 form-control-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group">
                                     <div class="form-stack has-icon pull-left">
                                        <input type="password" class="form-control" placeholder="Confirm password" id="confirmPassword" required="">
                                        <i class="ico-lock2 form-control-icon"></i>
                                    </div>
                                </div>
                                <div class="form-group nm">
                                    <button type="submit" class="btn btn-block btn-success">Change Password</button>
                                </div>
                            </div>
                        </form>
                        <!-- Login form -->

                        <hr><!-- horizontal line -->

                        <!--<p class="text-muted text-center">Don't have any account? <a class="semibold" href="page-register.html">Sign up to get started</a></p>-->
                    </div>
                </div>
                <!--/ END row -->
            </section>
            <!--/ END Template Container -->
        </section>
        <!--/ END Template Main -->

        <!-- START JAVASCRIPT SECTION (Load javascripts at bottom to reduce load time) -->
        <!-- Library script : mandatory -->
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/library/jquery/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/library/jquery/js/jquery-migrate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/library/bootstrap/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/library/core/js/core.min.js"></script>
        <!--/ Library script -->

        <!-- App and page level script -->
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/plugins/sparkline/js/jquery.sparkline.min.js"></script><!-- will be use globaly as a summary on sidebar menu -->
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/javascript/app.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>backend/plugins/parsley/js/parsley.min.js"></script>s
		<script type="text/javascript" src="<?php echo base_url(); ?>backend/javascript/jquery.ajax.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>backend/javascript/jquery.blockUI.js"></script>        
        <!--/ App and page level script -->
        <!--/ END JAVASCRIPT SECTION -->
    </body>
    <!--/ END Body -->
    
<script>

$('#changePasswordForm').submit(function(e)
{
	e.preventDefault();
	if ($('#changePasswordForm').parsley().validate()) 
	{
		var oldPassword = $("#oldPassword").val();
		var newPassword = $("#newPassword").val();
		var confirmPassword = $("#confirmPassword").val();
		
		if(newPassword == confirmPassword)
		{
			var req = new Request();
			req.data =
			{
				"oldPassword":oldPassword,
				"newPassword":newPassword
			};
			req.url = "admin/updatePassword";
			RequestHandler(req, showResponse);
		}
		else
		{
			alert('New Password and Confirm Password Should Be Same. Please Check.');
			return
		}
	}
});

function showResponse(data)
{
	data = JSON.parse(data);
	var str = '';
	if(data.isError == false)
	{	
		str = str + '<div class="alert alert-dismissable alert-success">';
		str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
		str = str + '<strong>Success! </strong>'+data.msg+' </div>';
		$("#responseMsg").html(str);
		$('html, body').animate({scrollTop: '0px'}, 0);
	}
	else
	{
		str = str + '<div class="alert alert-dismissable alert-danger">';
		str = str + '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">x</button>';
		str = str + '<strong>Oops! </strong>'+data.msg+'</div>';
		$("#responseMsg").html(str);
		$('html, body').animate({scrollTop: '0px'}, 0);
		return;
	}
	setTimeout(function()
	{
		location.href = '<?php echo base_url(); ?>admin';
	},1000);
}

</script>
</html>