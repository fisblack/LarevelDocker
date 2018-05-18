//Reference: 
//https://www.onextrapixel.com/2012/12/10/how-to-create-a-custom-file-input-with-jquery-css3-and-php/
/*;(function($) {

		  // Browser supports HTML5 multiple file?
		  var multipleSupport = typeof $('<input/>')[0].multiple !== 'undefined',
		      isIE = /msie/i.test( navigator.userAgent );

		  $.fn.customFile = function() {

		    return this.each(function() {

		      var $file = $(this).addClass('custom-file-upload-hidden'), // the original file input
		          $wrap = $('<div class="file-upload-wrapper">'),
		          $input = $('<input type="text" class="file-upload-input col-xs-9 " />'),
		          // Button that will be used in non-IE browsers
		          $button = $('<button type="button" id="btnAddImage" class="file-upload-button col-xs-3 ">Browse</button>'),
		          // Hack for IE
		          $label = $('<label class="file-upload-button col-xs-3 " for="'+ $file[0].id +'">Select a File</label>');

		      // Hide by shifting to the left so we
		      // can still trigger events
		      $file.css({
		        position: 'absolute',
		        left: '-9999px'
		      });

		      $wrap.insertAfter( $file )
		        .append( $file, ( isIE ? $label : $button ),$input );

		      // Prevent focus
		      $file.attr('tabIndex', -1);
		      $button.attr('tabIndex', -1);

		      $button.click(function () {
		        $file.focus().click(); // Open dialog
		      });

		      $file.change(function() {

		        var files = [], fileArr, filename;

		        // If multiple is supported then extract
		        // all filenames from the file array
		        if ( multipleSupport ) {
		          fileArr = $file[0].files;
		          for ( var i = 0, len = fileArr.length; i < len; i++ ) {
		            files.push( fileArr[i].name );
		          }
		          filename = files.join(', ');

		        // If not supported then just take the value
		        // and remove the path to just show the filename
		        } else {
		          filename = $file.val().split('\\').pop();
		        }

		        $input.val( filename ) // Set the value
		          .attr('title', filename) // Show filename in title tootlip
		          .focus(); // Regain focus

		      });

		      $input.on({
		        blur: function() { $file.trigger('blur'); },
		        keydown: function( e ) {
		          if ( e.which === 13 ) { // Enter
		            if ( !isIE ) { $file.trigger('click'); }
		          } else if ( e.which === 8 || e.which === 46 ) { // Backspace & Del
		            // On some browsers the value is read-only
		            // with this trick we remove the old input and add
		            // a clean clone with all the original events attached
		            $file.replaceWith( $file = $file.clone( true ) );
		            $file.trigger('change');
		            $input.val('');
		          } else if ( e.which === 9 ){ // TAB
		            return;
		          } else { // All other keys
		            return false;
		          }
		        }
		      });

		    });

		  };

		  // Old browser fallback
		  if ( !multipleSupport ) {
		    $( document ).on('change', 'input.customfile', function() {

		      var $this = $(this),
		          // Create a unique ID so we
		          // can attach the label to the input
		          uniqId = 'customfile_'+ (new Date()).getTime(),
		          $wrap = $this.parent(),

		          // Filter empty input
		          $inputs = $wrap.siblings().find('.file-upload-input')
		            .filter(function(){ return !this.value }),

		          $file = $('<input type="file" id="'+ uniqId +'" name="'+ $this.attr('name') +'"/>');

		      // 1ms timeout so it runs after all other events
		      // that modify the value have triggered
		      setTimeout(function() {
		        // Add a new input
		        if ( $this.val() ) {
		          // Check for empty fields to prevent
		          // creating new inputs when changing files
		          if ( !$inputs.length ) {
		            $wrap.after( $file );
		            $file.customFile();
		          }
		        // Remove and reorganize inputs
		        } else {
		          $inputs.parent().remove();
		          // Move the input so it's always last on the list
		          $wrap.appendTo( $wrap.parent() );
		          $wrap.find('input').focus();
		        }
		      }, 1);

		    });
		  }

}(jQuery));*/

//$('input[type=file]').customFile();

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

function updateCoverList(){
	var imgCover = $('#displayImageCover').attr('src');
	var imageFile = $('#addImage');
	var imageClone = imageFile.clone();
	var size = $('.gradient').size();

	imageClone.attr({name: 'coverImg['+size+']', id: ''});

	if(imgCover.length !== 0){
		var list = $('#coverLists').html();
		var newList = '<li class="gradient">\n\
		        <div class="btn-action">\n\
		          <div class="touch">\n\
		            <img src="../../../images/backOffice/setting/product/touch.png">\n\
		          </div>\n\
		        </div>\n\
		        <div class="v-lin"></div>\n\
		        <div class="btn-action">\n\
		          <input name="bookchk['+size+']" type="checkbox">\n\
		        </div>\n\
		        <div class="cover coverbook">\n\
		          <img src="'+imgCover+'" width="65px" style="max-height: 70px;">\n\
		        </div>\n\
		        <div class="btn-action">\n\
		          <div class="delete radius">\n\
		            <img src="../../../images/backOffice/setting/product/delete2.png">\n\
		          </div>\n\
		        </div>\n\
		        <div class="btn-action">\n\
		          <input name="book" value="'+size+'" type="radio">\n\
		        </div>\n\
		      </li>';
		$('#coverLists').html(newList.concat(list))
		$('#image-list-file').prepend(imageClone)
		clearForm()
	}
}

function clearForm(){
	$('#displayImageCover').attr('src', '');
	$('#displayImageName').val('');
	// $('.imageFile').attr('name', 'myfiles['+$('.gradient').size()+']');
}

function checkToggle(id=null, isCheck=false){
	if(isCheck){
		$('#'+id+'-num').removeAttr('disabled');
	}else{
		$('#'+id+'-num').attr('disabled', true);
		$('#'+id+'-num').val('');
	}
}