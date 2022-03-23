const csrf_token = $("meta[name='_token']").attr("content");

function formatNumber(nStr, decSeperate = ",", groupSeperate = ",") {
    nStr += '';
    x = nStr.split(decSeperate);
    x1 = x[0];
    x2 = x.length > 1 ? ',' + x[1] : '';
    var rgx = /(\d+)(\d{3})/;
    while (rgx.test(x1)) {
        x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
    }
    return x1 + x2;
}

$.get('/gio-hang/hien-thi', function(data, status) {
    if (status == 'success') load(data);
});

function load(cart) {
    let list = $("[data-cart='products']");
    list.html("");

    let products = cart['cart'];

    $.each(products, function(id, prod) {
        list.append('<li class="single-product-cart">\
        <div class="cart-img">\
            <a href="#"><img src="'+prod.image+'" alt=""></a>\
        </div>\
        <div class="cart-title">\
            <h3><a href="'+prod.link+'"> '+prod.name+'</a></h3>\
            <span>'+prod.quantity+' x '+prod.price +'</span>\
        </div>\
        <div class="cart-delete">\
            <a href="#" onclick="removeCart(this, '+id+')"><i class="ti-trash"></i></a>\
        </div>\
    </li>');
    });

    $("[data-cart='total']").html(formatNumber(cart['total']));
    $("[data-cart='count']").html(cart['count']);
    if (cart['count'] == 0) {
        list.append('<tr><td colspan="5" class="text-center">Không có sản phẩm nào trong giỏ hàng</td></tr>');
        $(".btn-checkout").addClass("d-none");
    } else {
        $(".btn-checkout").removeClass("d-none");
    }
}

$("[data-cart='add']").on("click", function(e) {
    e.preventDefault();

    let t = $(this);

    let id = t.attr("data-id");

    $.post('/gio-hang/them', {
        _token: csrf_token,
        id: id
    }, function(data, status) {
        if (status == 'success' && data.status != 'error') {
            load(data);
        }
    });
});

function removeCart(e, id) {
    let t = $(e);

    let cur_html = t.html();


    $.get('/gio-hang/xoa', { id: id }, function(data, status) {
        if (status == 'success' && data.status != 'error') {
            load(data);
        }
        t.html(cur_html);
    });
}

function quickView(form) {

    let id = form['id'].value;

    let quantity = form['quantity'].value;

    $.post('/gio-hang/them', {
        _token: csrf_token,
        id: id,
        quantity: quantity
    }, function(data, status) {
        if (status == 'success' && data.status != 'error') {
            load(data);
        }

    });
    return false;
}

function qView(id) {
    $.get('/xem-nhanh', { id:id }, function(data, status){
        if (status == 'success') {
            $("#product_id").remove();
            $("#name").html(data.name);
            $("#description").html(data.description);
            $("#price").html(formatNumber(data.price));
            $("#newPrice").html(formatNumber(data.newPrice));
            $("#form-addCart").append('<input type="hidden" id="product_id" name="id" value="'+data.id+'">');
            $("#image").html('<img src="/backend/images/product/'+data.image+'" class="d-block w-100" alt="">');
        }
    })
}

