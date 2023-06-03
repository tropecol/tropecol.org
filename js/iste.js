// JavaScript 2.0  Created by Diptiman Singh (Dee Technologies)
// Dedicated to the mysterious lovely girl I saw in SMS pictures, if you know who she is, please drop me a line.
<!--

var cssStyle=0;
var blankImage="/images/spacer.gif";
var isHorizontal=0;
var menuWidth=140;
var absolutePos=1;
var posX=-1;
var posY=140;
var floatable=1;
var floatIterations=8;
var movable=0;
var moveCursor="move";
var moveImage="";
var moveWidth=0;
var moveHeight=0;
var fontStyle="bold 7pt Verdana";
var fontColor=["#FFFFFF","#000000"];
var fontDecoration=["none","none"];
var itemBackColor=["#94DF10","#FFFFFF"];
var itemBorderWidth=0;
var itemAlign="left";
var itemBorderColor=["",""];
var itemBorderStyle=["none","none"];
var itemBackImage=["",""];
var itemSpacing=1;
var itemPadding=4;
var itemCursor="hand";
var itemTarget="_self";
var iconTopWidth=0;
var iconTopHeight=0;
var iconWidth=0;
var iconHeight=0;
var menuBackImage="";
var menuBackColor="#94DF10";
var menuBorderColor="#FFFFFF #FFFFFF #FFFFFF #FFFFFF ";
var menuBorderStyle=["none"];
var menuBorderWidth=0;
var subMenuAlign="left";
var transparency=92;
var transition=22;
var transDuration=100;
var shadowColor="#000000";
var shadowLen=0;
var arrowImageMain=["",""];
var arrowImageSub=["",""];
var arrowWidth=7;
var arrowHeight=7;
var separatorImage="";
var separatorWidth="93%";
var separatorHeight="3";
var separatorAlignment="right";
var separatorVImage="";
var separatorVWidth="93%";
var separatorVHeight=3;
var statusString="link";
var pressedItem=-2;
var pathPrefix="";
var saveNavigationPath=1;

var itemStyles = [
   ["CSS=topItemNormal,topItemOver", "itemWidth=139"],
   ["CSS=itemNormal,itemOver"],
   ["CSS=itemNormal,itemOver"],
];

var menuStyles = [
   ["CSS=submenu"],
];

var menuItems = [
   ["HOME","/index.htm","/images/icon5.gif","/images/icon6.gif","",,"0",],
   ["ABOUT THE SOCIETY","/iste/default.htm","/images/icon5.gif","/images/icon6.gif","",,"0",],
   ["EXECUTIVE <br>COMMITTEE","/iste/executive.htm","/images/icon5.gif","/images/icon6.gif","",,"0",],
   ["MEMBERSHIP","/iste/membership.htm","/images/icon5.gif","/images/icon6.gif","",,"0",],
   ["PUBLICATIONS","/iste/publication.htm","/images/icon5.gif","/images/icon6.gif","",,"0",],
];

apy_init();