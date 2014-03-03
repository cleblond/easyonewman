
function getSmiles(textfieldid) {
	document.getElementById(textfieldid).value = document.getElementById('EASYONEWMAN' + textfieldid).smiles();
}


/*
function getSmilesEdit(buttonname){
    var buttonnumber= buttonname.slice(7,-1);
	textfieldid = 'id_answer_' + buttonnumber;
	document.getElementById(textfieldid).value = document.getElementById('JME').smiles();
}
*/


///modified by crl for easyonewman sketch
function getSmilesEdit(buttonname, format){
    var buttonnumber = buttonname.slice(7,-1);
//    var s = document.MSketch.getMol(format);
var	pos0=document.getElementById('apos0').value;
var	pos1=document.getElementById('apos1').value;
var	pos2=document.getElementById('apos2').value;
var	pos3=document.getElementById('apos3').value;
var	pos4=document.getElementById('apos4').value;
var	pos5=document.getElementById('apos5').value;

//	s = unix2local(s); // Convert "\n" to local line separator
	pos0=pos0.substring(0, pos0.length - 1)+'6';
	pos1=pos1.substring(0, pos1.length - 1)+'6';
	pos2=pos2.substring(0, pos2.length - 1)+'6';
	pos3=pos3.substring(0, pos3.length - 1)+'6';
	pos4=pos4.substring(0, pos4.length - 1)+'6';
	pos5=pos5.substring(0, pos5.length - 1)+'6';

	textfieldid = 'id_answer_' + buttonnumber;
	document.getElementById(textfieldid).value = pos0+"-"+pos1+"-"+pos2+"-"+pos3+"-"+pos4+"-"+pos5;
//	alert('here');
}








M.qtype_easyonewman={
    insert_structure_into_applet : function(){
		var textfieldid = 'id_answer_0';
		if(document.getElementById(textfieldid).value != '') {
		
		var s = document.getElementById(textfieldid).value;
		//console.log(s);


		var groups = s.split("-");

		//console.log(groups);


		for (var i=0;i<6;i++)
		{
		//document.write(cars[i] + "<br>");

		var elem = document.createElement("img");
		
		group = groups[i];
		trimgroup = group.substring(0, group.length - 1);
		elem.setAttribute("src", "type/easyonewman/pix/"+trimgroup+".png");
		elem.setAttribute("id", group+i);
		elem.setAttribute("height", "30");
		elem.setAttribute("width", "40");
		document.getElementById("pos"+i).appendChild(elem);
		document.getElementById("apos"+i).value=group;

		}







		//document.MSketch.setMol(s, 'cxsmiles');
		}

	}
}



M.qtype_easyonewman.init_reload = function(Y, url, htmlid){
    var handleSuccess = function(o) {
	        //newman_template.innerHTML = '';
	//selected = document.getElementById('id_stagoreclip').value;
	//console.log(selected);
        newman_template.innerHTML = o.responseText;
	M.qtype_easyonewman.insert_structure_into_applet();
        //div.innerHTML = "<li>JARL!!!</li>";
    }
    var handleFailure = function(o) {
        /*failure handler code*/
    }
    var callback = {
        success:handleSuccess,
        failure:handleFailure
    }
    var button = Y.one("#id_stagoreclip");
    button.on("change", function (e) {   
        div = Y.YUI2.util.Dom.get(htmlid);
        Y.use('yui2-connection', function(Y) {
		newurl = url+document.getElementById('id_stagoreclip').value;
            Y.YUI2.util.Connect.asyncRequest('GET', newurl, callback);
        });
    });
};






















