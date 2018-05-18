/**
 * @author: Natthanon Ochaphong
 * @phone: 0809135244
 * @email: baraear@gmail.com
 */

$(function() {

    /**
     * Number.prototype.format(n, x)
     *
     * @param n: length of decimal
     * @param x: length of sections
     */
    Number.prototype.format = function(n, x) {
        var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\.' : '$') + ')';
        return this.toFixed(Math.max(0, ~~n)).replace(new RegExp(re, 'g'), '$&,');
    };

    function getFullText (data) {
        return data.address_line_1 + ' ' + data.address_line_2 + ' ' + data.sub_district + ' ' + data.district + ' ' + data.province + ' ' + data.postal_code
    }

    function getAddress (data) {
        if(data.trim() == ''){
            return false;
        }
        return '<div class="row pb-15">\n' +
            '<textarea class="address__block form-control" disabled>' + data + '</textarea>\n' +
            '</div>'
    }

    $('#selectMember').change(function () {
        $('#billingAddressArea').html("");
        $('#billingAddressLineOne').val("");
        $('#billingAddressLineTwo').val("");
        $('#billingSubDistrict').val("");
        $('#billingDistrict').val("");
        $('#billingProvince').val("");
        $('#billingPostalCode').val("");
        $('#shippingAddressArea').html("");
        $('#shippingAddressLineOne').val("");
        $('#shippingAddressLineTwo').val("");
        $('#shippingSubDistrict').val("");
        $('#shippingDistrict').val("");
        $('#shippingProvince').val("");
        $('#shippingPostalCode').val("");
        $('#addressMemberID').val("");
        $('#full_name').val("");
        if ($(this).val() > 0) {
            $('#addressMemberID').val($(this).val());
            $.ajax({
                url: "/api/member/" + $(this).val() + "/addresses"
            }).done(function(data) {
                if(getAddress(getFullText(data.billing_address))){
                    $('#billingAddressArea').append(getAddress(getFullText(data.billing_address)));
                }
                $('#billingAddressLineOne').val(data.billing_address.address_line_1);
                $('#billingAddressLineTwo').val(data.billing_address.address_line_2);
                $('#billingSubDistrict').val(data.billing_address.sub_district_id);
                $('#billingDistrict').val(data.billing_address.district_id);
                $('#billingProvince').val(data.billing_address.province_id);
                $('#billingPostalCode').val(data.billing_address.postal_code_id);
                if(getAddress(getFullText(data.shipping_address))){
                    $('#shippingAddressArea').append(getAddress(getFullText(data.shipping_address)));
                }
                $('#shippingAddressLineOne').val(data.shipping_address.address_line_1);
                $('#shippingAddressLineTwo').val(data.shipping_address.address_line_2);
                $('#shippingSubDistrict').val(data.shipping_address.sub_district_id);
                $('#shippingDistrict').val(data.shipping_address.district_id);
                $('#shippingProvince').val(data.shipping_address.province_id);
                $('#shippingPostalCode').val(data.shipping_address.postal_code_id);
                $('#full_name').val(data.full_name);
            })
        }
    });

    var addressFor = '';

    $('.addMoreAddress').click(function () {
        switch ($(this).data('for')) {
            case 'billing':
                addressFor = 'billing';
                break
            case 'shipping':
                addressFor = 'shipping';
                break
        }
        $('input[name="address_line_1"]').val("");
        $('input[name="address_line_2"]').val("");
        $("#sub_district_span").text("");
        $("#sub_district_id").val("");
        $("#district_span").text("");
        $("#district_id").val("");
        $("#province_span").text("");
        $("#province_id").val("");
        // $("#postal_code_span").text(postal_code);
        $("#postal_code_id").val("");

        $("#addresses").val("");
    });

    var options = {
        url: "/js/website/addresses.json",
        getValue: function(element) {
            return element.sub_district + ' » ' + element.district + ' » ' + element.province + ' » ' + element.postal_code;
        },
        list: {
            maxNumberOfElements: 10,
            match: {
                enabled: true
            },
            onClickEvent: function() {
                const selectedItemData = $("#addresses").getSelectedItemData();
                let sub_district = selectedItemData.sub_district;
                let sub_district_id = selectedItemData.sub_district_id;
                let district = selectedItemData.district;
                let district_id = selectedItemData.district_id;
                let province = selectedItemData.province;
                let province_id = selectedItemData.province_id;
                let postal_code = selectedItemData.postal_code;
                let postal_code_id = selectedItemData.postal_code_id;
                $("#sub_district_span").text(sub_district);
                $("#sub_district_id").val(sub_district_id);
                $("#district_span").text(district);
                $("#district_id").val(district_id);
                $("#province_span").text(province);
                $("#province_id").val(province_id);
                // $("#postal_code_span").text(postal_code);
                $("#postal_code_id").val(postal_code_id);

                $("#addresses").val(postal_code);
            }
        }
    };

    $("#addresses").easyAutocomplete(options);

    $('#btnAddAddress').click(function () {
        // $('#billingAddressArea').html("");
        // $('#billingAddressLineOne').val("");
        // $('#billingAddressLineTwo').val("");
        // $('#billingSubDistrict').val("");
        // $('#billingDistrict').val("");
        // $('#billingProvince').val("");
        // $('#billingPostalCode').val("");
        // $('#shippingAddressArea').html("");
        // $('#shippingAddressLineOne').val("");
        // $('#shippingAddressLineTwo').val("");
        // $('#shippingSubDistrict').val("");
        // $('#shippingDistrict').val("");
        // $('#shippingProvince').val("");
        // $('#shippingPostalCode').val("");
        var data = {
            "billing_address": {
                "address_line_1": $('input[name="address_line_1"]').val(),
                "address_line_2": $('input[name="address_line_2"]').val(),
                "sub_district": $('#sub_district_span').text(),
                "sub_district_id": $("#sub_district_id").val(),
                "district": $('#district_span').text(),
                "district_id": $("#district_id").val(),
                "province": $('#province_span').text(),
                "province_id": $("#province_id").val(),
                "postal_code": $('#addresses').val(),
                "postal_code_id": $("#postal_code_id").val()
            },
            "shipping_address": {
                "address_line_1": $('input[name="address_line_1"]').val(),
                "address_line_2": $('input[name="address_line_2"]').val(),
                "sub_district": $('#sub_district_span').text(),
                "sub_district_id": $("#sub_district_id").val(),
                "district": $('#district_span').text(),
                "district_id": $("#district_id").val(),
                "province": $('#province_span').text(),
                "province_id": $("#province_id").val(),
                "postal_code": $('#addresses').val(),
                "postal_code_id": $("#postal_code_id").val()
            }
        }
        switch (addressFor) {
            case 'billing':
                $('#billingAddressArea').html("").append(getAddress(getFullText(data.billing_address)));
                $('#billingAddressLineOne').val(data.billing_address.address_line_1);
                $('#billingAddressLineTwo').val(data.billing_address.address_line_2);
                $('#billingSubDistrict').val(data.billing_address.sub_district_id);
                $('#billingDistrict').val(data.billing_address.district_id);
                $('#billingProvince').val(data.billing_address.province_id);
                $('#billingPostalCode').val(data.billing_address.postal_code_id);
                break
            case 'shipping':
                $('#shippingAddressArea').html("").append(getAddress(getFullText(data.shipping_address)));
                $('#shippingAddressLineOne').val(data.shipping_address.address_line_1);
                $('#shippingAddressLineTwo').val(data.shipping_address.address_line_2);
                $('#shippingSubDistrict').val(data.shipping_address.sub_district_id);
                $('#shippingDistrict').val(data.shipping_address.district_id);
                $('#shippingProvince').val(data.shipping_address.province_id);
                $('#shippingPostalCode').val(data.shipping_address.postal_code_id);
                break
        }
        $('#addMoreAddress').modal('hide');
    });

    var productSearch = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        remote:   {
            url: '/api/product/all?is_preorder=1',
            ajax: {
                type: 'GET'
            }
        }
    });
    productSearch.initialize();

    var productTemplate = function(data) {
        if (data.image) {
            return  '<div class="product-search__body">' +
                '<ul class="product-search__list">' +
                '<li class="item">\n' +
                '<a href="javascript:void(0)">\n' +
                '<div class="item-image">\n' +
                '<img class="img-responsive" src="http://via.placeholder.com/250x330" alt="" />\n' +
                '</div>\n' +
                '<div class="item-detail">\n' +
                '<span class="item-detail__name">\n' +
                data.name + ' / ' + data.name_en + '\n' +
                '</span>\n' +
                '<span class="item-detail__quantity text-grey">\n' +
                'ราคา : <span class="text-red pull-right">' + parseInt(data.suggested_retail_price).format(2) + ' บาท</span>\n' +
                '</span>\n' +
                '<span class="item-detail__point text-grey">\n' +
                'คะแนนสะสม : <span class="text-red pull-right">' + data.reward_points + ' คะแนน</span>\n' +
                '</span>\n' +
                '</div>\n' +
                '</a>\n' +
                '</li>\n' +
                '</ul>\n' +
                '</div>';
        }
        else {
            return  '<div class="product-search__body">' +
                '<ul class="product-search__list">' +
                '<li class="item">\n' +
                '<a href="javascript:void(0)">\n' +
                '<div class="item-image">\n' +
                '<img class="img-responsive" src="http://via.placeholder.com/250x330" alt="" />\n' +
                '</div>\n' +
                '<div class="item-detail">\n' +
                '<span class="item-detail__name">\n' +
                data.name + ' / ' + data.name_en + '\n' +
                '</span>\n' +
                '<span class="item-detail__quantity text-grey">\n' +
                'ราคา : <span class="text-red pull-right">' + parseInt(data.suggested_retail_price).format(2) + ' บาท</span>\n' +
                '</span>\n' +
                '<span class="item-detail__point text-grey">\n' +
                'คะแนนสะสม : <span class="text-red pull-right">' + data.reward_points + ' คะแนน</span>\n' +
                '</span>\n' +
                '</div>\n' +
                '</a>\n' +
                '</li>\n' +
                '</ul>\n' +
                '</div>';
        }
    };

    var product;
    var image;

    $('[data-action="typeaheadProduct"]').typeahead(null, {
        name: 'product-search',
        hint: true,
        display: 'name',
        limit: 10,
        highlight: true,
        source: productSearch.ttAdapter(),
        templates: {
            notFound: '<div class="product-search-item" style="text-align: center;">ไม่พบสินค้าที่ต้องการ</div>',
            suggestion: productTemplate
        }
    }).on('typeahead:selected', function (e, datum) {
        product = datum
        image = undefined;
        imageSource(product.cover_image_id).success(function (data) {
            image =  data
        });
    });

    $('.datetime > span > img').click(function() {
        $(this).parent().parent().find('input').focus()
    });

    $(".datetime input").click(function() {
        $(this).datetimepicker()
    });

    $('.datetime').datetimepicker();

    var priceBeforeDiscount =0;
    var priceDiscount =0;
    var priceShipping =0;
    var totalPrice =0;

    /**
     * Add product to list
     */
    $('#addProductList').click(function () {
        if (product) {
            var productQty = $('#product_add_qty').val();
            if (productQty && parseInt(productQty, 10) > 0) {
                var productList =  $('#productItemList');
                var currentList = productList.html();
                productList.html(htmlItemList(product, productQty, image).concat(currentList))
                priceBeforeDiscount += product.suggested_retail_price * productQty;
                totalPrice = priceBeforeDiscount + priceShipping - priceDiscount;
                $('#price_before_discount').text(priceBeforeDiscount.format(2));
                $('#total_price').text(totalPrice.format(2));
                $('#shipping_free').text(priceShipping.format(2));
                clearData();
            }
        }
    });

    function clearData() {
        product = undefined;
        image = undefined;
    }

    function htmlItemList(product, qty, image) {
        return '<li class="item">' +
            htmlInput('products', product.id)+
            htmlInput('products_qty', qty)+
            '<a href="#">'+
            '<div class="item-image">' +
            '<img class="img-responsive" src="'+ image +'" alt="" />' +
            '</div>' +
            '<div class="item-detail">' +
            '<span class="item-detail__name">' + product.name + '</span>' +
            '<span class="item-detail__quantity">จำนวน ' + qty + ' เล่ม</span>' +
            '<span class="item-detail__point text-grey">'+htmlPoint(product)+'</span>' +
            '</div>' +
            '<div class="item-price text-center">' +
            '<span class="text-grey">ราคา</span>' +
            '<span class="text-red">'+ parseInt(product.suggested_retail_price).format(2) +'</span>'+
            '</div>' +
            '</a>' +
            '</li>'
    }

    function htmlInput(name, value) {
        return '<input type="text" name="'+name+'[]" value="'+value+'" hidden>';
    }

    function htmlPoint(product) {
        if (product.reward_points) {
            return 'PTS ' + product.reward_points + ' คะแนนสะสม'
        }

        return'';
    }

    function imageSource(id) {
        return $.ajax({
            type: 'GET',
            url: '/api/product/product-image',
            data: {
                cover_image_id: id
            }});
    }
});
