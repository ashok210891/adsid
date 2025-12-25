<!-- footer @s -->
<div class="nk-footer">
    <div class="container-fluid">
        <div class="nk-footer-wrap">
            <div class="nk-footer-copyright"> &copy; <?php echo date("Y"); ?> <?php echo PROJECT_NAME; ?>. </div>
            <div class="nk-footer-links">
                <ul class="nav nav-sm">
                    <li class="nav-item"><a class="nav-link" href="#">Terms</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Privacy</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Help</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- footer @e -->
</div>
<!-- wrap @e -->
</div>
<!-- main @e -->
</div>
<!-- app-root @e -->
<!-- JavaScript -->

<script>
    $(document).ready(function() {
        $('input[name="help-question"]').click(function() {
            if ($(this).is(':checked') && $(this).val() == 'other-question') {
                $('#other-question-group').show();
            } else {
                $('#other-question-group').hide();
            }
        });

        if (localStorage.getItem('userConsent') == 'true') {
            $("#userConsentModal").modal({"backdrop": "static", "keyboard": false}).modal("show");
        }

        $('#user-consent-decline-btn').click(function() {
            localStorage.removeItem('userConsent');
            location.href = '<?php echo base_url(); ?>logout';
        });

        $('#user-consent-accept-btn').click(function() {
            localStorage.removeItem('userConsent');
            $("#userConsentModal").modal("hide");
        });
    });

    $('#help-form-btn').click(function() {
        $('#helpForm').submit();
    });

    $('#helpForm').submit(function(event) {
        event.preventDefault();
        if ($('#helpForm').valid()) {
            helpQuestions = $('input[name="help-question"]:checked').val();

            var newRequest = new Request();
            newRequest.data = {
                "helpQuestions": helpQuestions,
                "otherQuestion": $('#other-question-text').val() || null
            };
            newRequest.url = "submithelpquestion";
            RequestHandler(newRequest, showResponseHelpQuestion);
        }
    });

    function showResponseHelpQuestion(data) {
        data = JSON.parse(data);
        var str = '';
        if (data.isError == false) {
            $('#helpForm')[0].reset();
            $('#helpModal').modal('hide');
            if (window.NioApp && typeof NioApp.Toast === 'function') {
                NioApp.Toast(data.msg || 'Support request submitted successfully. We will contact you soon!', 'success', {
                    position: 'top-right'
                });
            } else {
                alert(data.msg || 'Support request submitted successfully. We will contact you soon!');
            }
            return;
        } else {
            if (window.NioApp && typeof NioApp.Toast === 'function') {
                NioApp.Toast(data.msg || 'Error submitting support request', 'error', {
                    position: 'top-right'
                });
            } else {
                alert(data.msg || 'Error submitting support request');
            }
            return;
        }
    }
</script>
</body>

</html>