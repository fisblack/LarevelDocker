/** 
* Writer : Chayut Takaweekaew
*/

$('.datepicker').datepicker({
    autoclose: true,
    todayHighlight: true,
    language: "th"
});
var today = new Date();

var h = addZero(today.getHours());
var m = addZero(today.getMinutes());
var dd = ("0" + today.getDate()).slice(-2);
var mm = ("0" + (today.getMonth() + 1)).slice(-2);
var yyyy = today.getFullYear();
today = dd + '-' + mm + '-' + yyyy;
$(".datepicker").attr("value", today);

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

$("#hour").attr("value", h);
$("#mimute").attr("value", m);


/*Add by chayut*/
$( document ).ready(function() {
	$('#calendar').on('click', function(ev){
		$('.input-group-addon').trigger('click')
	});

	$('#btnAddImage, #displayImageName').click(function(){
		$('#addImage').trigger('click')
		$('#addImage').change(function(){
            readURL(this);
        }); 
	});

	$('#addImageToLists').on('click', function(ev){
		updateCoverList();
	});

	// PDF
	$('#btnAddPDF, #displayPDFName').click(function(){
		$('#attach').trigger('click')
		$('#attach').change(function(e){
            $('#displayPDFName').val(this.files[0].name);
        }); 
	});

	$('.clickToggle').on('click', function(ev){
		var id = $(this).attr('id');
		var isCheck = $(this).is(":checked");
		checkToggle(id, isCheck)
	})

	var checkOption = $('.clickToggle')
	checkOption.each(function(a, b){
		var id = $(this).attr('id');
		var isCheck = $(b).is(":checked")
		checkToggle(id, isCheck)
	})
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#displayImageCover').attr('src', e.target.result);
            $('#displayImageCover').removeClass('hidden');
            $('#displayImageName').val(input.files[0].name);
        }
        
        reader.readAsDataURL(input.files[0]);
    }
}


function clearForm(){
	$('#displayImageCover').attr('src', '');
	$('#displayImageName').val('');
}

function checkToggle(id=null, isCheck=false){
	if(isCheck){
		$('#'+id+'-num').removeAttr('disabled');
	}else{
		$('#'+id+'-num').attr('disabled', true);
		$('#'+id+'-num').val('');
	}
}