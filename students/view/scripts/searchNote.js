function validateAndSearchNote(form) {
	let searchData = form['n_name'].value.trim();
	if(searchData === ""){
		document.getElementsByClassName("err ns")[0].innerHTML = "Please enter note name to search";
		
	}
	else{
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function(){
			if(this.responseText === ""){
				document.getElementsByClassName("err ns")[0].innerHTML = "Note doesn't exit or invalid request";			
				
			}
			else{
				document.getElementById("noteData").innerHTML = this.responseText;
				document.getElementsByClassName("err ns")[0].innerHTML = "";
			}
		}
		xhttp.open("GET","../controller/noteSearchAjax.php?n_name="+searchData);
		xhttp.send();
	}
	//return false;
}