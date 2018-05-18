/**
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

$(function() {

	function multipleDelete() {
		$('#deleteAll').unbind('click');

		if($('input[type="checkbox"]:checked').length == 0)
		{
			$('#deleteAll').bind('click', multipleDelete);
			return false;
		}

		$('input[name*="deleteId"]').remove();
		$('input.delete[type="checkbox"]:checked').each(function() {
			$('form[id="form_multiple_delete"]').append($("<input>", {
				type: "hidden",
				name: "deleteId[]",
				value: $(this).val()
			}));
		});

		$('input[name*="fDeleteId"]').remove();
		$('input.softDeleted[type="checkbox"]:checked').each(function() {
			$('form[id="form_multiple_delete"]').append($("<input>", {
				type: "hidden",
				name: "fDeleteId[]",
				value: $(this).val()
			}));
		});

		if ($(':hidden[name*=fDeleteId]').length > 0) {
			swal({
				title: 'Are You Sure ?',
				text: "มีข้อมูลที่จะถูกลบถาวร!!",
				type: 'warning',
				confirmButtonColor: '#d60500',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					$('form[id="form_multiple_delete"]').submit();
				} else {
					$('#deleteAll').bind('click', multipleDelete);
					return false;
				}
			});
		} else {
			$('form[id="form_multiple_delete"]').submit();
		}
	}

	$('#deleteAll').click(multipleDelete);

	$('form[id^="form_delete"] > a').click(function(e) {
		$(this).unbind('click');
		$(this).closest('form').submit();
	});

	$('form[id^="form_fdelete"]').submit(function(e) {

		e.preventDefault();

		$(this).children(':image').attr('disabled','disabled');

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
				$(this).children(':image').attr('disabled',false);
			}
		});
	});

	$('#link_search').click(function() {
		if(''!=$('input[name=search]').val())
			window.location.href=window.location.href.split('?')[0]+'?search='+$('input[name=search]').val();
	});
});
