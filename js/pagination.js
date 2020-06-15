$("#pagination li").click(function() {
    $('#pagination li').removeClass('active');
    $(this).addClass('active');
    $.ajax({
        type: "GET",
        url: "getProduct-pagination.php",
        data: { start: $("#pagination .active").text() },
    }).done((results) => { //về sau được khuyên dùng thay cho success ( còn có fail(), alsway())
        obj = JSON.parse(results);
        var id = -1;
        obj.forEach(element => {
            //console.log(element[5]);
            id++;
            var id_div_product = "#id-div-product-" + id;
            $(id_div_product + " .img-prod")
                .html('<img class="img-fluid" src="images/products/' + element[9] + '" alt="Colorlib Template"></img>');
            //.setAttribute("href", 'href="product-single.php?id=' + element[0] + '"');
            if (element[5] != 0) {
                $(id_div_product + " .img-prod").append('<span class="status">' + element[5] + "%");
                $(".price-dc").html(element[4] - (element[4] * 10 / 100) + " Đ");
            } else {
                $(".price-sale").html(element[4] + " Đ");
            }

            $(id_div_product + " h3").html('<a href="product-single.php?id=' + element[0] + '">' + element[2] + '</a>');
        });
    })
})

//alert($(".pagination .active").text())