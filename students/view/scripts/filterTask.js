function filterTask(val){
	if(val !== ""){
		const xhttp = new XMLHttpRequest();
		xhttp.onload = function(){
			document.getElementsByClassName("tasks")[0].innerHTML = this.responseText;
		}

		xhttp.open("GET",`../controller/filterTaskData.php?filter=${val}`);
		xhttp.send();
	}

}