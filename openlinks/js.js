function checkTofes() {

var a=document.getElementById('link').value;
if(a.indexOf("fileflyer.com/view/") == -1) {
alert("לינק שגוי");
return false;
}

var b=document.getElementById('email').value;
if((b.indexOf("@") == -1) || (b.indexOf("@") != b.lastIndexOf("@"))) {
alert("מייל שגוי");
return false;
}
if(b.lastIndexOf(".") < b.indexOf("@")) {
alert("מייל שגוי");
return false;
}

return true;
}