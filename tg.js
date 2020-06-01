function ShowHide(ID)
{
	var Object = document.getElementById(ID);
	Object.style.display = Object.style.display == "none" ? "" : "none";
}
function emoticon(code) {
	x = document.postform.text;
	x.value = x.value + ' [' + code + ']';
	document.postform.text.focus();
}
function emoticonp(code) {
	if (window.event && window.event.keyCode == 13) {
		return emoticon(code);
         	}
}


function checkTg(secid,nameid,msgid) {
var k;
if(secid) {
	k=document.getElementById(secid).value;
	if(k.length != 6) { alert("קוד אבטחה שגוי");return false; }
	if(isNaN(k)== true) { alert("קוד אבטחה שגוי");return false; } 
}

if(nameid) {
	k=document.getElementById(nameid).value;
	if(k.length < 2) { alert("שם קצר מידי");return false; }
	if(k == "") { alert("הכנס שם");return false; } 
}


if(msgid) {
	k=document.getElementById(msgid).value;
	if(k.length < 4) { alert("תגובה קצרה מידי");return false; }
	if(k == "") { alert("לא הכנסת תגובה");return false; } 
	if(k.length > 1000) { alert("תגובה ארוכה מידי");return false; }
}
return true;
	
}

function tdelete(id) {
	if (confirm("האם ברצונך למחוק תגובה זאת,\n זכור אחרי פעולה זו אין אפשרות להחזיר")) {
	self.location.href = "TG/delete.php?id=" + id;
	return true;
	} else {
	alert("לא מחקת את התגובה הזאת");
	return false;
	}
}

function vip()
{
	win3 = window.open("TG/vip.php", "AnTi", "top=" + ((screen.height) ? (screen.height-500)/2 : 0) + ",left="+((screen.width) ? (screen.width-567)/2 : 0)+"toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizeable=1,width=567,height=500");
	window.location='tg.php'
}

function rando2() 
{
if (document.tgo.email.value == "" || document.tgo.email.value == " ") {
return true;
}
else 
{ 
	if(document.tgo.pw2.value == "" || document.tgo.pw2.value == " ") {
	rando();
	} else { return true; }
}
}




function rando()
{

b=String.fromCharCode(97 + Math.round(Math.random() * 25));
for (i=0;i<2;i++)
{
b=b+String.fromCharCode(97 + Math.round(Math.random() * 25));
}
var rnd1=Math.floor(Math.random()*1001);
b=b+rnd1;
for (i=0;i<3;i++)
{
b=b+String.fromCharCode(97 + Math.round(Math.random() * 25));
}
var rnd2=Math.floor(Math.random()*1001);
b=b+rnd2;
document.tgo.pw2.value=b;
}

function textCounter(field,cntfield,maxlimit) {
if (field.value.length > maxlimit) // if too long...trim it!
field.value = field.value.substring(0, maxlimit);
// otherwise, update 'characters left' counter
else
cntfield.value = maxlimit - field.value.length;
}


