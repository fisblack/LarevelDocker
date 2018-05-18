/** 
 * @author: MR.SOMPOB MOONSRI (Nick)
 * @phone: 0811129499
 * @email: eslidiingz@gmail.com
 */

$(document).ready(function() {
  $('#calendar-group-addon').click(function() {
    $('#calendar-addon').focus();
  }); 

  $('#calendar-addon').datepicker({
    format: "dd/mm/yyyy",
    todayHighlight: true
  });
})
