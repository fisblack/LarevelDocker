/** 
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

$(function() {

    $('form[id^="form_force_delete"]').submit(function(e) {

        e.preventDefault();

        $(this).children(':image').attr('disabled', 'disabled');

        swal({
            title: 'Are You Sure ?',
            text: "มีข้อมูลที่จะถูกลบถาวร!!",
            type: 'warning',
            confirmButtonColor: '#d60500',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $(this).unbind('submit').submit();
            } else {
                $(this).children(':image').attr('disabled', false);
            }
        });
    });


    $('#delete_all_button').on('click', function(e) {

        e.preventDefault();

        var ids = [];
        $('input[name=select]:checked').each((i, l) => {
            ids.push($(l).val());
        });

        $('#form_delete_all input[name=id]').val(ids);

        var count = $('#form_delete_all input[name=id]').val();

        if (count != null && count != "") {

            const trashIds = ids.filter((item) => {
                return ($('#form_soft_delete_' + item).attr('data-is-trashed') == "true");
            });

            swal({
                title: 'Are You Sure ?',
                text: "มีข้อมูลที่จะถูกลบถาวร!!",
                type: 'warning',
                confirmButtonColor: '#d60500',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    $('#form_delete_all').submit();
                } else {
                    $(this).children(':image').attr('disabled', false);
                }
            });

        } else {
            swal({
                title: 'Warning',
                text: "Please select at least one item to delete!",
                type: 'warning',
                confirmButtonColor: '#d60500',
                showCancelButton: false
            })
        }

        return false;

    });

});