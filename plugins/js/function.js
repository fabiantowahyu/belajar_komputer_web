// open new window
/*
function popWindow(s_Url, s_Name, s_Width, s_Height, s_Scroll, s_resize) {
    o_Win = window.open(s_Url, s_Name, ' alwaysRaised=yes, resizable=' + s_resize + ', scrollbars=' + s_Scroll + ', menubar=0, width=' + s_Width + ', height=' + s_Height + ', Left=' + (screen.availWidth - s_Width) / 2 + ', Top=' + (screen.availHeight - s_Height) / 2 );
    o_Win.focus();
    //history.go(0);
} 

function popWindowGeneric(s_Url) {
    o_Win = window.open(s_Url, 'inputData', ' alwaysRaised=yes, resizable=yes, scrollbars=yes, menubar=0, width=850, height=200, Left=' + (screen.availWidth - 850) / 2 + ', Top=' + (screen.availHeight - 200) / 2 );
    o_Win.focus();
   //history.go(0);
} 

function popWindow_old(s_Url, s_Name, s_Width, s_Height, s_Scroll, s_resize) {
    o_Win = window.open(s_Url, s_Name, ' alwaysRaised=yes, resizable=' + s_resize + ', scrollbars=' + s_Scroll + ', menubar=0, width=' + s_Width + ', height=' + s_Height + ', Left=' + (screen.availWidth - s_Width) / 2 + ', Top=' + (screen.availHeight - s_Height) / 2 );
    o_Win.focus();
} 

function checkAll(o_Checkbox_Coll) {
    if (o_Checkbox_Coll == null) return; 

    if (o_Checkbox_Coll.length == null) {
        o_Checkbox_Coll.checked = true;
    } else {
        for(i=0; i<o_Checkbox_Coll.length; i++) {
            o_Checkbox_Coll[i].checked = true;
        }
    }
}

function clearAll(o_Checkbox_Coll) {
    if(o_Checkbox_Coll == null) return;

    if(o_Checkbox_Coll.length == null) {
        o_Checkbox_Coll.checked = false;
    } else {
        for(i=0; i<o_Checkbox_Coll.length; i++) {
            o_Checkbox_Coll[i].checked = false;
        }
    }
}
*/

// Add middle windows by Danang, 02062014
function PopUpWindow(url,name,w,h,r,s,sys) { //sys,title,msg

	if (w==null||w == '')
		w=500;
	if (h==null||h == '')
		h=500;
	
	var theLeft = Math.round((screen.width - w) / 2);
	var theTop = Math.round((screen.height - h) / 2);
			
	var newwindow = window.open(url,name,"toolbar=0,location=0,directories=0,status=0,menubar=0,resizable="+r+",scrollbars="+s+",width="+w+",height="+h+",left="+theLeft+",top="+theTop+"");
	if (newwindow.focus != null) newwindow.focus();
	//newwindow.opener.name = name;
}

function formatCurrency(num) {
    num = num.toString().replace(/\$|\,/g,'');
    var emptyString=0;
    if(isNaN(num) || num.length==0) {
        num = "0";
        emptyString=1;
    }
    sign = (num == (num = Math.abs(num)));
    num = Math.floor(num*100+0.50000000001);
    cents = num%100;
    num = Math.floor(num/100).toString();
    if(cents<10)
        cents = "0" + cents;
    
    for (var i = 0; i < Math.floor((num.length-(1+i))/3); i++)
        num = num.substring(0,num.length-(4*i+3))+','+
    
    num.substring(num.length-(4*i+3));

    if(emptyString==1) {
        return "";
    }
    else {
        return (((sign)?'':'-') + num);
    }
}

function numbersonly(e){
    var unicode=e.charCode? e.charCode : e.keyCode;
    if (unicode!=8) { //if the key isn't the backspace key (which we should allow)
        if (unicode!=9) { //if the key isn't the tab key (which we should allow)
            if (unicode!=37) { //if the key isn't the left key (which we should allow)
                if (unicode!=39) { //if the key isn't the right key (which we should allow)
					if (unicode!=46) { //if the key isn't the delete key (which we should allow)
                        if (unicode<48||unicode>57) //if not a number
                            return false //disable key press
                   }
                }
            }
        }
    }
}

function setComboSelected(o_Combo, s_Value) {
    o_Combo = eval(o_Combo);
    for (i=0 ; i<o_Combo.length ; i++) {
        if (o_Combo.options[i].value == s_Value) {
            o_Combo.options[i].selected = true;
            break;
        }
    }
}

function jsLTrim(p_s_Val) {
    var sRes = p_s_Val;
    while (sRes.substr(0, 1)==" ") {
        sRes = sRes.substr(1, sRes.length-1); }
    return sRes;
}

function jsRTrim(p_s_Val) {
    var sRes = p_s_Val;
    while (sRes.substr(sRes.length-1, 1)==" ") {
        sRes = sRes.substr(0, sRes.length-1); }
    return sRes;
}

function jsTrim(p_s_Val) {
    var sRes = p_s_Val;
    sRes = jsLTrim(sRes);
    sRes = jsRTrim(sRes);
    return sRes;
}

function isEmptyTextArea(p_s_Val){
	var s_Value = p_s_Val;
	if(s_Value != ""){
		// looping for detect enter(return) key and space
		for(var i=0;i<s_Value.length;i++){
			if(s_Value.charCodeAt(i) == 13 || s_Value.charCodeAt(i) == 10 || s_Value.charCodeAt(i) == 32){
				//true
			}
			else{
				return false;
			}
		}
	}
	return true;
}

//Untuk validasi input email
function isEmail(isi) {
	var myExp = /^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/
	return myExp.test(isi)
}

//Untuk validasi nilai yang diterima hanya berupa angka saja (inc: decimal, minus)
function isNumber(p_s_Val) {
  var myExp = /^[-]?[0-9]+$|^[-]?[0-9]+[\.]?[0-9]+$|^[-]?[\.][0-9]+$/
  return myExp.test(p_s_Val)  
}

//Untuk validasi nilai yang diterima hanya berupa angka saja (not inc: decimal, minus)
function isNumericOnly(p_s_Val){
	var myExp = /^^\d{1,}$$/
	return myExp.test(p_s_Val)
}

function validateDate(p_s_Val){
/******************************************************************************
DESCRIPTION: Validates that a string contains only valid date.

PARAMETERS:
   p_s_Val - String to be tested for validity, format is: dd/mm/yyyy (as listed in "Application.properties")

RETURNS:
   True if valid, otherwise false.
******************************************************************************/
	if(p_s_Val=="") 
		return true;
	var m_strDate = p_s_Val;
	var m_arrDate = m_strDate.split("/");
	
        if (m_arrDate.length != 3)
		return false;
	
        var m_DAY = m_arrDate[0];
	if (!isNumericOnly(m_DAY))
		return false;
	
        var m_MONTH = m_arrDate[1];
	if (!isNumericOnly(m_MONTH))
		return false;
	
        var m_YEAR = m_arrDate[2];
	if(!isNumericOnly(m_YEAR) || (m_YEAR.length != 4))
		return false;
	
	m_strDate = m_MONTH + "/" + m_DAY + "/" + m_YEAR;
	var testDate=new Date(m_strDate);
	if(testDate.getMonth()+1==m_MONTH)
		return true;
	return false;
}


