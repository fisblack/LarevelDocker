/**
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

function deleteOrder(orderId) {
    swal({
        title: 'ลบ Order #' + orderId + ' ?',
        text: "มีข้อมูลที่จะถูกลบ",
        type: 'warning',
        confirmButtonColor: '#d60500',
        showCancelButton: true,
        confirmButtonText: 'ลบ',
        cancelButtonText: 'ยกเลิก',
    })
    .then((willDelete) => {
        if (willDelete) {
            console.log('delete');
            $.ajax({
                type: 'post',
                url: 'order/' + orderId,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: orderId,
                    _method: 'delete'
                },
                success: (data) => {
                    window.location.reload(true);
                }});
        } else {
            swal("Your imaginary file is safe!");
        }
    });
}

function restoreOrder(orderId) {
    swal({
        title: 'กู้คืน Order #' + orderId + ' ?',
        text: "",
        type: 'warning',
        confirmButtonColor: '#d60500',
        showCancelButton: true,
        confirmButtonText: 'กู้คืน',
        cancelButtonText: 'ยกเลิก',
    }).then(willDelete => {
        if(willDelete) {
            $.ajax({
                type: 'post',
                url: 'order/' + orderId + '/restore',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    id: orderId,
                    _method: 'put'
                },
                success: (data) => {
                window.location.reload(true);
        }
        });
        }
    });
}
