<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>

<!--page specific plugin scripts treeview-->
<link rel="stylesheet" href="<?php echo base_url();?>themes/js/jstree/themes/default/style.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>themes/js/orgchart/jquery.orgchart.css">

<script src="<?php echo base_url();?>themes/js/jstree/jquery.min.js"></script>
<script src="<?php echo base_url();?>themes/js/jstree/jstree.min.js"></script>

<script src="<?php echo base_url();?>themes/js/orgchart/jquery.orgchart.js"></script>

<script type="text/javascript">
	function clickOrgLevel(id) {
		myframe.location.href= '<?php echo site_url(); ?>org_structure/CTRL_View_Tabel/'+ id;
	}
	
	$(function(){
		$('#treeOrgLevel').jstree({
			'core' : {
				'data' : {
					"url" : "<?php echo site_url(); ?>org_structure/CTRL_SelectData/detail",
					"dataType" : "json" // needed only if you do not supply JSON headers
				}
			}
		});
		
		$("#organisation").orgChart({container: $("#main"), interactive: true, fade: true, speed: 'slow'});

	});
	
/*
	var jsexpicon=document.getElementById("spexp").innerHTML;
	var jsclpicon=document.getElementById("spclp").innerHTML;
	drillchart(document.getElementById("sp_1"));
	// var jsexpicon="»";
	// var jsclpicon="«";
	var isblocked=null;
		isclicked=true;

	function drillchart(obj) {
		isclicked=false;
		posid=obj.id.split("_")[1];
		//alert(posid);
		otd=document.getElementById("child_"+posid);
		//alert(otd);
		if (obj.innerHTML==jsexpicon) {
			obj.innerHTML=jsclpicon;
	//		if (otd.innerHTML=="")
			//ifrdraw.location="getorgpos_old.cfm?posid="+posid;
			ifrdraw.location= '<?php echo $url_view; ?>' + posid;
			// else {
				// otd.style.display="";
				// oimg=document.getElementById("imgchild_"+posid);
				// if (oimg!=null)
					// oimg.style.display="";
			// }
		}
		else {
			obj.innerHTML=jsexpicon;
			// if (otd.innerHTML!="")
				// otd.style.display="none";
			otd.innerHTML="";
			oimg=document.getElementById("imgchild_"+posid);
			if (oimg!=null)
				oimg.style.display="none";
		}
		setTimeout("isclicked=true",1000);
	}
	function showBlock(sid,obj,flag) {
		var vcont=1;
		if (obj.id!=null) {
			if (obj.id==sid)
				vcont=0;
		}
		if (vcont) {
			if (isblocked!=null||flag) {//isblocked!=null && 
				if (obj.id!=null && obj.id.substr(0,9)=="imgchild_") {
					return false;
				}
				if (obj.style!=null && obj.style.display!=null && obj.style.display=='none') {
					if (flag) {
						if (obj.className=="tdleft")
							obj.className="tdsolleft";
						else if (obj.className=="tdright")
							obj.className="tdsolright";
						else if (obj.className=="tdsoleft")
							obj.className="tdsolsoleft";
					}
					obj.style.display='';
				}
				else {
					if (obj.className=="tdsolleft")
						obj.className="tdleft";
					else if (obj.className=="tdsolright")
						obj.className="tdright";
					else if (obj.className=="tdsolsoleft")
						obj.className="tdsoleft";
				}
				if (obj.childNodes!=null) {
					for (var j=0;j<obj.childNodes.length;j++)
						showBlock(sid,obj.childNodes[j],flag);
				}
			}
			else {
				if (obj.id!=null && obj.id.substr(0,9)=="imgchild_") {
					return false;
				}
				if (obj.style!=null && obj.style.display!=null && obj.style.display=='')
					obj.style.display='none';
				if (obj.childNodes!=null) {
					for (var j=0;j<obj.childNodes.length;j++)
						showBlock(sid,obj.childNodes[j],flag);
				}
			}
		}
	}
	function toggleEmp(id,flag) {
		dobj=document.getElementById(id);
		if (isclicked && dobj!=null) {
			if (dobj.style.display=="")
				dobj.style.display="none";
			else
				dobj.style.display="";
			if(flag!=null && flag==1){
				varName=id+"A";
				dobjA=document.getElementById(varName);
				if (dobjA.style.display=="")
					dobjA.style.display="none";
				else
					dobjA.style.display="";
			}
		}
	}
	function toggleBlock(ogd,id) {
		isclicked=false;
		dobj=document.getElementById(id);
		if (dobj!=null) {
			oroot=document.getElementById("child_2231");
			for (var i=0;i<oroot.childNodes.length;i++) {
				showBlock(id,oroot.childNodes[i]);
			}
			if (isblocked!=null) {
				isblocked.style.backgroundColor="";
			}
			else {
				ogd.style.backgroundColor="e9e9e9";
			}
			otbl=dobj.parentNode.parentNode;
			otr=otbl.parentNode.parentNode.parentNode;
			for (var i=0;i<otr.childNodes.length;i++) {
				if (otr.childNodes[i].style.display!=null) {
					if (isblocked!=null)
						otr.childNodes[i].style.display="";
					else
						otr.childNodes[i].style.display="none";
				}
			}
			for (var i=0;i<100;i++) {
				dobj.style.display="";
				dobj=dobj.parentNode;
				if (dobj.id!=null && dobj.id=="child_2231") {
					break;
				}
				else if (dobj.tagName.toUpperCase()=="BODY")
					break;
			}
			otr=otbl.childNodes[0];
			showBlock(id,otr,true);
			otbld=otbl.parentNode.parentNode.childNodes[0];
			showBlock(id,otbld,true);
			if (isblocked==null)
				isblocked=ogd;
			else
				isblocked=null;
		}
		setTimeout("isclicked=true",1000);
	}
	function shwSpan(flag) {
		osps=document.getElementsByTagName("SPAN");
		for (var i=0;i<osps.length;i++) {
			osps[i].style.display=flag;
		}
		odiv=document.getElementById('Layerprint');
		odiv.style.display=flag;
	}
	function printpr() {
		shwSpan('none');
		var OLECMDID = 7;
		// OLECMDID values:
		// * 6 - print
		// * 7 - print preview
		// * 1 - open window
		// * 4 - Save As
		
		var PROMPT = 1; // 2 DONTPROMPTUSER
		var WebBrowser = '<object ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
		document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
		WebBrowser1.ExecWB(OLECMDID, PROMPT);
		WebBrowser1.outerHTML = "";
		setTimeout("shwSpan('');",1000);
	}

	function printhor(){
		//history.back();
		self.location='/stp_demo/sunfish5/ehrm/popup.cfm?FID=HR0546&FUID=HR05460004&menu=1&referesh=%7Bts%20%272015%2D03%2D08%2022%3A24%3A05%27%7D';
	}
*/
</script>
<style type="text/css">
h1,h2,h3{
	line-height:20px;
	font-weight:bold;
}
/*
.Heading1 {
	background-color :c7f2e2;
	color : 000000;
	font-family : verdana;
	font-size : 8pt;
	font-weight : bold;
	background-image:
}
	
.Heading2 {
	background-color : daf6e1;
	color : 000000;
	font-family : verdana;
	font-size : 8pt;
	font-weight : bold;
}
	
.Heading3 {
	background-color : ffffff;
	color : 000000;
	font-family : verdana;
	font-size : 8pt;
}
	
.formtext {
	font-family : verdana;
	font-size : 8pt;
}
	
.helpcontent {
	background-color : e9fff4;
	color : 000000;
	font-family : verdana;
	font-size : 8pt;
}
	
.helpheader {
	background-color : 99ccff;
	color : navy;
	font-family : verdana;
	font-size : 8pt;
	font-weight : bold;
}
	
.helptitle {
	background-color : e9fff4;
	color : 333300;
	font-family : verdana;
	font-size : 8pt;
	font-weight : bold;
}
	
.navc a {
	font-family : verdana;
	font-size : 8pt;
	text-decoration : none;
}
	
.navc a:hover {
	color : ED1B24;
	font-family : verdana;
	font-size : 8pt;
	text-decoration : none;
}
	
.navc a:visited {
	color : 2552A9;
	font-family : verdana;
	font-size : 8pt;
	text-decoration : none;
}
	
.tablebodyeven {
	background-color : e1e9fe;
	font-family : verdana;
	font-size : 8pt;
}

.tablebodyodd {
	background-color : ffffff;
	font-family : verdana;
	font-size : 8pt;
}
	
a.link {
	color : Navy;
	font-family : verdana;
}
	
a.linktabbody {
	font-family : verdana;
	font-size : 8pt;
}
	
body {
	font-family : verdana;
	font-size : 8pt;
}
	
input {
	background-color : FFFFCC;
	font-family : verdana;
	font-size : 8pt;
}
	
input.button {
	background-color : FFFFCC;
	font-family : verdana;
	font-size : 8pt;
}
	
input.hidden {
	border-width : 0;
}
	
select {
	background-color : FFFFCC;
	border-width : 1;
	font-family : verdana;
	font-size : 8pt;
}
	
td {
	font-family : verdana;
	font-size : 8pt;
	font-style : normal;
	height : 23px;
}
	
textarea {
	background-color : FFFFCC;
	border-width : 1;
	font-family : verdana;
	font-size : 8pt;
}

.xlsnip {
	mso-font-charset:0;
	mso-number-format:"\@";
	background:white;
	mso-pattern:auto none;
	white-space:normal;
}	

.ifrmBody {
	overflow:auto;
	scrollbar-face-color: #FFFFFF;
	scrollbar-3dlight-color: #4A9ACE; 
	scrollbar-darkshadow-color: #FFFFFF;
	scrollbar-track-color: #FFFFFF; 
	scrollbar-highlight-color: #FFFFFF; 
	scrollbar-shadow-color: #4A9ACE;
	scrollbar-arrow-color: #4A9ACE;
}


.border {	
	border:1px solid #ADB7D6;
	border-top:none;
}

table {
	text-align:center;
	border:0px solid red;
}
td {
	text-align:center;
	vertical-align:top;
	border:0px solid red;
}
.box {
	padding:10px;
	border:4px double gray;
	text-align:center;
	width:100px;
}
.boxpos {
	padding:10px;
	border:1px ridge gray;
	text-align:center;
	width:100px;
}
.boxtransparan{
	padding:10px;
	border:1px white;
	text-align:center;
	width:100px;
}
.spdrill {
	cursor:pointer;
	color:red;
	font-weight:bold;
}
.tdleft {
	border-right:1px solid gray;
	border-top:1px solid gray;
}
.tdsoleft {
	border-right:1px solid gray;
}
.tdright {
	border-top:1px solid gray;
}
.tdsoright {
	border-top:0px solid gray;
}
.tdsolleft {
	border-right:1px dashed gray;
}
.tdsolright {
	border-top:0px solid gray;
}
.tdsolsoleft {
	border-right:1px dashed gray;
}
.tdsolsoright {
	border-top:0px solid gray;
}
.hlink {
	color:black;
	text-decoration:none;
}
.hlink:hover {
	color:red;
	text-decoration:none;
}
.posinneckright {
	border-right:1px solid gray;
	border-bottom:1px solid gray;
}
.posinneckleft {
	border-left:1px solid gray;
	border-bottom:1px solid gray;
}
*/
</style>