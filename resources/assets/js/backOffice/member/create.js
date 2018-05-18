/** 
 * @author: ระบุชื่อ-นามสกุลของคุณที่นี่
 * @phone: ระบุหมายเลขโทรศัพท์ของคุณที่นี่
 * @email: ระบุอีเมลของคุณที่นี่
 */

window.log = console.log.bind(console);


function $$(expr, context) {
  return [].slice.call((context || document).querySelectorAll(expr), 0);
}

function prepend(element, into) {
  if (element && into)
    into.insertBefore(element, into.firstChild);
}

let info = $('.toggles-info'),
  inputs = $$('.toggle input');

function showInfo(styledElement) {
  let div = document.createElement('div'),
    str = '';
  inputs.forEach(input => {
    str += input.checked ? '<span on> on </span> ' : '<span off> off </span>';
  });

  if (styledElement) {
    str += `<span click>click: ${styledElement.innerHTML}</span>`;
  }

  div.innerHTML = str;
  prepend(div, info);
}

function toggle(element, event) {
  showInfo(element.nextElementSibling);
}

showInfo();


$(document).ready(function() {
    var brand = document.getElementById('logo-id');
    brand.className = 'attachment_upload';
    brand.onchange = function() {
        document.getElementById('fakeUploadLogo').value = this.value.substring(12);
    };

    // Source: http://stackoverflow.com/a/4459419/6396981
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function(e) {
                $('.img-preview').attr('src', e.target.result);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#logo-id").change(function() {
        readURL(this);
    });

  $("#dateinput").datepicker({
    dateFormat: 'dd-M-yy'
  });
  $("#date").datepicker({
    dateFormat: 'dd-M-yy'
  });
});