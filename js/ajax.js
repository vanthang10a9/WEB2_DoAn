$("#giatu").keyup(function() {
    var giatu = $(this).val();
    $.post("data.php", { minp: giatu }, function(data) {
        $("#data").html(data);
        // alert(giatu);
    })
})

//check user
$("#username").keyup(function(){
    var username = $(this).val();
    $.post("handle-user.php",{user : username}, function(data){
        $("#message").html(data);
    })
})