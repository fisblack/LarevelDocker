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

		this.itemChecked = [];
		var multipleDelete = this;

		$('input[type="checkbox"]:checked').each(function () {
			multipleDelete.itemChecked.push(this.value);
		});

		$('input[name*="deleteId"]').val(JSON.stringify(this.itemChecked));

		$('form[id="form_multiple_delete"]').submit();

		// $('#deleteAll').bind(click, multipleDelete);
	}

	$('#deleteAll').click(multipleDelete);

    $('#link_search').click(function() {
        // if(!window.location.href.search("search=")){
        //     alert("dd");
            window.location.href=window.location.href.replace('search=','search='+$('input[name=search]').val());
        // }else{
        //     window.location.href=window.location.href + '?type_id=1&search='+$('input[name=search]').val();
        // }
	});
});
