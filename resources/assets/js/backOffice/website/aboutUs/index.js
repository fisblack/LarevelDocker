
/** 
 * @author: Napat Maipaiboon
 * @phone: 087-358-9259
 * @email: elecwebmaker@gmail.com
 */

$('.file_upload .input_upload input[type=file]').bind('change', function(val){
    if(val){
      $(this).parents('.input_upload').find('.name_display span').html(val.target.value.replace(/^.*[\\\/]/, ''));  
    }
});