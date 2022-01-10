<script src="../admin/js/jquery-3.5.1.js"></script>

<!--script gestion de compte-->
<script src="../admin/bundles/lib.vendor.bundle.js"></script>
<script src="../admin/js/core.js "></script>
<script src="../admin/js/jquery.dataTables.min.js"></script>



<script src="../admin/plugins/dropify/js/dropify.min.js"></script>

<script src="../admin/js/page/tabs.js"></script>
<script src="../admin/js/fontAwesome.js"></script>

<script src="../admin/bundles/knobjs.bundle.js "></script>
<script src="../admin/bundles/c3.bundle.js "></script>


<script src="../admin/js/page/tabs.js"></script>





<script>
    $(function() {
        "use strict";

        $('.dropify').dropify();

    });

    $(document).ready(function() {
        $('#example').DataTable({
            "bLengthChange": false,

        });
    });
</script>
<script>
    $('#message_pass').hide();
    $('#messagePass2').hide();
    $('#password').on('input', function(e) {
        if (!$(this).val().match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,}$/)) {
            $(this).addClass('is-invalid');
            $('#messagePass2').show();
            $('#submitButton').attr('disabled', 'disabled');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $('#messagePass2').hide();
            $('#submitButton').removeAttr('disabled');
        }
    });

    $('#repeatPassword').on('input', function(e) {
        if ($(this).val() != $('#password').val()) {
            $(this).addClass('is-invalid');
            $('#message_pass').show();
            $('#submitButton').attr('disabled', 'disabled');
        } else {
            $(this).removeClass('is-invalid');
            $(this).addClass('is-valid');
            $('#message_pass').hide();
            $('#submitButton').removeAttr('disabled');
        }
    });
</script>