$(function() {
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy'
    });

    function appendPromoInput() {
        var id=$('div[id^=promoVolume_]:last').attr('id').replace('promoVolume_','');
            $('div#promoVolume_'+id)
                    .clone()
                    .attr('id', 'promoVolume_'+(parseInt(id)+1))
                    .insertAfter('div[id^=promoVolume_]:last')
                    .find('input').val('');

        $('div[id^=promoVolume_]:not(:first) div:last span').html('');
    }

    function checkValueChange() {
        var obj = $(this).closest('div[id^=promoVolume_]');

        if($(obj).is('div[id^=promoVolume_]:last')) {
            if($(obj).find('input:first').val()!=='' && $(obj).find('input:last').val()!=='') {
                $('div[id^=promoVolume_] :input').unbind('change');
                appendPromoInput();
                $('div[id^=promoVolume_] :input').on('change', checkValueChange);
            }
        } else {
            if($(obj).find('input:first').val()=='' && $(obj).find('input:last').val()=='') {
                $(obj).remove();
            }
        }
    }

    $('div[id^=promoVolume_] :input').on('change', checkValueChange);
});
