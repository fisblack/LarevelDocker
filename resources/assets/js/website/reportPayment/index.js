$( document ).ready(function() {
    $(".btnUpload").click(function() {
        $('#fileUpload').click();
        $('select,input').css('color','black');
        $('select,input').css('font-weight','bold');
    });

        $(".img-pay img").height($(".fbox").height()-120);
          $(".in-box-bank").width($(".box-bank").width());
          $(".box-bank").height($(".list-bank").height());

          if ($(window).width() > 785) {

              $(".box-payment").height($(".fbox").height());
              $(".border-custom").height($(".fbox").height()+40);
          }

          if ($(window).width() <= 785) {
          $(".box-payment").height($(".fbox").height()+20);
              $(".border-custom").height($(".fbox").height()+40);
          }

        $(window).resize(function () {
          $(".img-pay img").height($(".fbox").height()-120);
            $(".in-box-bank").width($(".box-bank").width());
            $(".box-bank").height($(".list-bank").height());

            if ($(window).width() > 785) {

                $(".box-payment").height($(".fbox").height());
                $(".border-custom").height($(".fbox").height()+40);
            }

            if ($(window).width() <= 785) {
            $(".box-payment").height($(".fbox").height()+20);
                $(".border-custom").height($(".fbox").height()+40);
            }
        });

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

    var bank_default = $("#bank_acc").val();
    $(".list-bank").hide();
    /*var bank_default_str = ".list-bank[index='" + bank_default + "\']";
    $(bank_default_str).addClass("selected").show();
    */ //Edit by book
    
    $($("div.box-bank ul li").get(0)).addClass("selected").show();

    var index  ="";

    var Selected = false;

    $(".list-bank").click(function () {
		
        if (Selected) {
			$('#bk-list').css('height','0px');
			$('#bk-list').css('overflow-y','unset');

            $(".list-bank").hide();
            $(".list-bank .arrow").show();
            $(this).addClass("selected").show();
            Selected = false;

            index = $(this).attr('index');
            $("#bank_acc").val(index);
        } else {
			$('#bk-list').css('height','400px');
			$('#bk-list').css('overflow-y','auto');

            $(".list-bank").show();
            $(".list-bank .arrow").hide();
            $(this).removeClass("selected");
            Selected = true;
        }
    });


/*$(window).click(function() {
    //bank_default = $("#bank_acc").val()
    //$(".list-bank").hide();
  //bank_default_str = ".list-bank[index='" + bank_default + "\']";
    //    $(".list-bank .arrow").show();
    //$(bank_default_str).addClass("selected").show();
    
     //Edit by book
    
    //$($("div.box-bank ul li").get(0)).addClass("selected").show();
 
});*/

$('.list-bank').click(function(event){
    event.stopPropagation();
});


});
