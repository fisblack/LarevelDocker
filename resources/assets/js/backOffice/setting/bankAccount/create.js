/** 
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

var _ddlLoaded = false;
var name = $('#bankacc').attr('name');
var id = $('#bankacc').attr('id');

$(function() {

    $('#bankacc').ddslick({
        defaultSelectedIndex: 1,
        background: '#fff',
        width: "100%",
        onSelected: function(data) {

            var obj = $("#" + id + " .dd-selected-value");
            var value = data.selectedData.value;

            obj.prop('name', name);

            if (value == 'other_bank') {

                $('.new-bank').removeClass('hidden').slideDown();
                $('#bank_name_plus').attr('required', 'required');
                $('#bank-logo').attr('required', 'required');
                //$('#bankacc').addClass('disabled');
                $('#bankacc .dd-selected').html('<small class="dd-desc">ธนาคารอื่น</small>');
                $('.other-bank').val(1);
                obj.val('');

            } else {

                $('.new-bank').slideUp();
                $('#bank_name_plus').removeAttr('required').val('');
                $('#bank-logo').removeAttr('required').val('');
                $("input#bank-logo").val('');
                $("input#bank-logo").parent().find('img').addClass('hidden');
                $('.other-bank').val(0);
                //$('#bankacc').removeClass('disabled');
            }

            if (_ddlLoaded === false) {
                _ddlLoaded = true;
            } else {

            }
        }
    });

    $('#bankacc').each(function() {
        var name = $(this).attr('name');
        var id = $(this).attr('id');

        $("#" + id).ddslick({
            showSelectedHTML: true,
            onSelected: function() {}
        });

    });

    // $('#other_bank').on('click', function() {
    //     if ($(this).is(':checked')) {
    //         $('.new-bank').removeClass('hidden').slideDown();
    //         $('#bank_name_plus').attr('required', 'required');
    //         $('#bankacc').addClass('disabled');
    //         $('#bankacc .dd-selected').html('<small class="dd-desc">เลือกธนาคาร</small>');
    //     } else {
    //         $('.new-bank').slideUp();
    //         $('#bank_name_plus').removeAttr('required').val('');
    //         $("input#bank-logo").val('');
    //         $("input#bank-logo").parent().find('img').addClass('hidden');
    //         $('#bankacc').removeClass('disabled');
    //     }
    // });

    $('.input-file > a').click(function() {
        var id = $(this).attr('href');
        $(this).parent().find('input').trigger('click');

        return false;
    });

    $("input#bank-logo").change(function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
        $(this).parent().find('img').removeClass('hidden').fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
    });
})