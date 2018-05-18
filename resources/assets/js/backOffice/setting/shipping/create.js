/**
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */


function AddShippingFee(regionId) {
	$lastRow = $('#table' + regionId + ' tbody tr').eq(-3);

	if(''==$lastRow.find('input[name$="[maxWeight][]"]').val()) {
	    toastr.warning('Please input maxWeight!!!');
	    $lastRow.find('input[name$="[maxWeight][]"]').focus();
	    return;
	}

	if(''==$lastRow.find('input[name$="[amount][]"]').val()) {
	    toastr.warning('Please input amount!!!');
	    $lastRow.find('input[name$="[amount][]"]').focus();
	    return;
	}

	if(''==$lastRow.find('input[name$="[point][]"]').val()) {
	    toastr.warning('Please input point!!!');
	    $lastRow.find('input[name$="[point][]"]').focus();
	    return;
	}

	$('#table' + regionId + ' tbody tr').eq(-3).find('input[name$="[maxWeight][]"]').unbind( 'keyup' );

	$tr = $('#table' + regionId + ' tbody tr:last').clone();

	$tr.find('input[name$="[maxWeight][]"]').remove();
	$tr.find('td:first').find('span.maxWeight').remove();
	$tr.find('td:first').append(' - <span class="border-sm"><input type="number" min="0" name="shippingFee[' + regionId + '][maxWeight][]" value=""></span>');

	$('#table' + regionId + ' > tbody > tr').eq(-2).before($tr);

	$('#table' + regionId + ' tbody tr').eq(-3)
		.find('input[type=number][name$="[maxWeight][]"]')
		.on( 'keyup', ChangeMaxWeight )
		.on( 'focusout', ValidateMaxWeight );

	var $trOjb = $('#table' + regionId + ' > tbody > tr');

	var rowCount = $trOjb.length;

	if(rowCount>3) {
		$trOjb.eq(-3).find('td:last').removeClass('hidden');
		$trOjb.eq(-3).find('.delRow').on('click', DeleteRow);
	}
}

function DeleteRow() {
	var regionId = $(this).closest('table').attr('id').replace('table', '');
	var rowIndex = $(this).closest('tr').index();
	var minWeight = $(this).closest('tr').find('input[name$="[minWeight][]"]').val();

	$(this).closest('tr').remove();

	$('.delRow').unbind('click');

	var $trOjb = $('#table' + regionId + ' > tbody > tr');
	var rowCount = $trOjb.length;

	if((rowCount-rowIndex) == 2) {
		rowIndex = -1;
	}

	$trOjb.eq(rowIndex).find('input[name$="[minWeight][]"]').val(minWeight);
	$trOjb.eq(rowIndex).find('span.minWeight').text(minWeight);

	$('.delRow').on('click', DeleteRow);
}

function ChangeMaxWeight(){
	var regionId = $(this).closest('table').attr('id').replace('table', '');
	var rowIndex = $(this).closest('tr').index();

	var newMinWeight = ((parseFloat(this.value)*100)+1)/100;

	var $trOjb = $('#table' + regionId + ' > tbody > tr');
	var rowCount = $trOjb.length;

	if((rowCount-rowIndex) == 3) {
		rowIndex = -1;
	} else {
		rowIndex = rowIndex + 1;
	}

	$trOjb.eq(rowIndex).find('input[name$="[minWeight][]"]').val(newMinWeight);
	$trOjb.eq(rowIndex).find('span.minWeight').text(newMinWeight);
}

function ValidateMaxWeight(){
	var $trParent = $(this).closest('tr');

	if(parseFloat($(this).val()) <= parseFloat($trParent.find('input[name$="[minWeight][]"]').val())) {
	    toastr.warning('Please input more than ' + $trParent.find('input[name$="[minWeight][]"]').val());
	    $(this).focus();
	    return;
	}

	var regionId = $(this).closest('table').attr('id').replace('table', '');
	var rowIndex = $(this).closest('tr').index();

	var newMinWeight = ((parseFloat(this.value)*100)+1)/100;

	var $trOjb = $('#table' + regionId + ' > tbody > tr');
	var rowCount = $trOjb.length;

	if((rowCount-rowIndex) == 3) {
		rowIndex = -1;
	} else {
		rowIndex = rowIndex + 1;
	}

	$trOjb.eq(rowIndex).find('input[name$="[minWeight][]"]').val(newMinWeight);
	$trOjb.eq(rowIndex).find('span.minWeight').text(newMinWeight);
}

$(function() {
	$('table[id^=table] input[type=number][name$="[maxWeight][]"]').on( 'keyup', ChangeMaxWeight );
	$('table[id^=table] input[type=number][name$="[maxWeight][]"]').on( 'focusout', ValidateMaxWeight );
	$('.delRow').on('click', DeleteRow);
});
