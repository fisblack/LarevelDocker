/**
 * @author: Phitchaporn Pipatpunlop
 * @phone: 0909915818
 * @email: phitchaporn.pipa@gmail.com
 */

 $(function() {
   $('#date_form, #date_to').datepicker()
 })

$(function() {
  $('#toggle-active-event, #toggle-condition-event').bootstrapToggle({
    on: '',
    off: ''
  })

  $('#toggle-active-event').change(function() {
    var active = $(this).prop('checked') ? 'เปิด' : 'ปิด'
    $('span#active').html(active)

    $(this).prop('checked') ?
      $('.switch-active span.toggle-handle.btn.btn-default').css('margin-left', '-44px') :
      $('.switch-active span.toggle-handle.btn.btn-default').css('margin-left', '44px')
  })

  $('#toggle-condition-event').change(function() {
    var condition = $(this).prop('checked') ? 'เปิด' : 'ปิด'
    $('span#condition').html(condition)

    $(this).prop('checked') ?
      $('.switch-condition span.toggle-handle.btn.btn-default').css('margin-left', '-44px') :
      $('.switch-condition span.toggle-handle.btn.btn-default').css('margin-left', '44px')
  })
})

$(function() {
  var container = $('.pop-up .panel-default')
  var popup = $('.pop-up')

  $('.condition-add .list li').click(function() {
    container.show()
    popup.show()
  })

  $('.condition-add').click(function() {
    $('.condition-add .list').toggle()
  })

  $(document).mouseup(function(e) {
    if (!container.is(e.target) && container.has(e.target).length === 0) {
      container.hide()
      popup.hide()
    }
  })
})
