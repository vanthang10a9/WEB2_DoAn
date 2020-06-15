function dangki(){
    var hoten = document.form_register.txtFullname;
    var email = document.form_register.txtEmail;
    var diachi = document.form_register.txtAddress;
    var sdt = document.form_register.txtPhone;
    var cmnd = document.form_register.txtCmnd;
    var sdt = document.form_register.txtPhone;
    var username = document.form_register.txtUsername;
    var password = document.form_register.txtPassword;
    var rePassword = document.form_register.txtRePassword;
    if(!checkname(hoten.value))
	{
		alert("Mời bạn kiểm tra lại họ tên!!!");
		hoten.focus();
		return false;
    }
    else if(!checkemail(email.value))
	{
		alert("Mời bạn kiểm tra lại email!!!");
		email.focus();
		return false;
    }
    else if(diachi.value == "")
    {
        alert("Mời bạn nhập địa chỉ!!!");
		diachi.focus();
		return false;
    }
	else if(!checksdt(sdt.value))
	{
		alert("Mời bạn kiểm tra lại số điện thoại!!!");
		sdt.focus();
		return false;
    }
	else if(!checkcmnd(cmnd.value))
	{
		alert("Mời bạn kiểm tra lại chứng minh nhân dân!!!");
		cmnd.focus();
		return false;
    }
    else if(username.value == "")
    {
        alert("Mời bạn nhập tên đăng nhập!!!");
        username.focus();
        return false;
    }
    else if(password.value == "")
    {
        alert("Mời bạn nhập vào mật khẩu!!!");
        password.focus();
        return false;
    }
    else if (password.value != rePassword.value)
    {
        alert("Mật khẩu nhập lại không đúng!!!");
        rePassword.focus();
        return false;
    }
    return true;
}
function checkname(str)
{
    var pattern = /[a-zA-Z\s]{1,50}/;
    if(str.match(pattern)) return true;
    return false;
}
function checksdt(str)
{
    var pattern = /^0[1-9]\d{8}$/;
    if(str.match(pattern)) return true;
    return false;
}
function checkcmnd(str)
{
    var pattern = /^[0-9]{9}$/;
    if(str.match(pattern)) return true;
    return false;
}
function checkemail(str)
{
	var pattern = /[a-zA-Z0-9]{1,50}[@]\w{2,7}[.]\w{1,8}$/;
	if(str.match(pattern)) return true;
	return false;
}