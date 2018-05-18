/** 
 * @author: วราทัศน์ พานทองถาวร
 * @phone: 087-806-5868
 * @email: boss119@hotmail.com
 */

 
$(document).ready( function() {
    $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
        label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
    
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
                $('#my-images').css("display","block");
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readURLToBanner(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#banner-upload').attr('src', e.target.result);
                $('#my-images').css("display","block");
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

    $("#Imgbanner").change(function(){
        readURLToBanner(this);
    }); 	
});

$(function() {
    $('.date > span').click(function() {
        $(this).parent().parent().find('input').focus();
    });

    $(".date input").click(function() {
        //event when click datepicker
        $(this).datetimepicker();
    });

    $('#datetimepicker1').datetimepicker();
});