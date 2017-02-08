/**
 * This file is part of Form Handler package
 * (c) Dimitry Vasilenko <dmv.developer@gmail.com>
 */

$(function(){
    $config = {
        'method': 'POST',
        'url': '/serv/process.php'
    };

    /**
     * Validation Plugin config
     */
    $('#mainForm').validate({
        errorPlacement: function(){
            return true;
        }
    });

    /**
     * Validate on submit
     */
    $('#mainForm').submit(function(e){
        e.preventDefault();

        var isValid = $('#mainForm').valid();

        if(isValid){
            $.ajax({
                type: $config.method,
                url: $config.url,
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function(data){
                    showSuccessMsg();
                    //resetForm();
                }
            });
        }
    });

    /**
     * Select number of inputs
     */
    $("#fileCounter").change(function(e) {
        var value = parseInt($("#fileCounter").val(), 10);

        switch (value){
            case 1:
                $('.fileInput2, .fileInput3').addClass('hidden');
                break;
            case 2:
                $('.fileInput2').removeClass('hidden');
                $('.fileInput3').addClass('hidden');
                break;
            case 3:
                $('.fileInput2, .fileInput3').removeClass('hidden');
                break;
            default:
                throw new Error('Wrong select integer');
                break;
        }

    });

    function resetForm() {
        $("#mainForm").trigger("reset");
    }

    function showSuccessMsg() {

    }
});