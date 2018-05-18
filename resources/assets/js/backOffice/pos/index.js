/** 
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

$(document).ready(function () {
    $('.btn-delete').click(function () {
        $(this).closest('form').submit()
        return false
    })

    $('.btn-force-delete').click(function () {
        swal({
            title: 'Are You Sure ?',
            text: "This member will be delete forever.",
            type: 'warning',
            confirmButtonColor: '#d60500',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it !'
        }).then(result => {
            if (result.value) {
                $(this).closest('form').submit()
            }
        });
        return false
    })

    $('.btn-restore').click(function () {
        $(this).closest('form').submit()
        return false
    })
});