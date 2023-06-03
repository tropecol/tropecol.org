// JavaScript Document
function makeArray() {
     for (i = 0; i<makeArray.arguments.length; i++)
         this[i] = makeArray.arguments[i];
 }

function getFullYear(d) {
    var y = d.getYear();
    if (y < 1000) {y += 1900};
    return y;
}

//var zone = "EDT";
var days = new makeArray("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
var months = new makeArray("January","February","March","April","May","June","July","August","September","October","November","December");

function format_time(t) {

    var Day = t.getDay();
    var Date = t.getDate();
    var Month = t.getMonth();
    var Year = t.getFullYear();

    timeString = "";
    timeString += days[Day];
    timeString += ", ";
    timeString += " ";
    timeString += months[Month];
    timeString += " ";
    timeString += Date;
    timeString += ", ";
    timeString += " ";
    timeString += Year;

   return timeString;
 }
 
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


function attatchLinkBehavior(){
	if (document.getElementsByTagName) {
		var links = document.getElementsByTagName("a"); 
		for (var i=0; i <links.length; i++) {
			if (links[i].className.match("addclicklater")) {
				links[i].onclick = function() {
					var targetArea = this.getAttribute("href");
					targetArea.replace('/volumes/abstract/showabs.aspx?abspath=','');
					this.href = '/volumes/abstract/showabs.aspx?abspath=' + targetArea; 
					return true; 
				};
			}
		}
	}
}

function addEvent(elm, evType, fn, useCapture){
	var ret = 0;
	if (elm.addEventListener)
		ret = elm.addEventListener(evType, fn, useCapture);
	else if (elm.attachEvent)
			ret = elm.attachEvent('on' + evType, fn);
		else elm['on' + evType] = fn;
	return ret;
}

addEvent(window, "load", attatchLinkBehavior); 