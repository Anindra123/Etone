function taskValidation(form){
	let tname = form['tname'].value;
	let stime = form['stime'].value;
	let etime = form['etime'].value;
	let flag = true;

	if(tname === ""){
		document.getElementsByClassName("err tn")[0].innerHTML = "Task title cannot be empty"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err tn")[0].innerHTML = "";
	}

	if(stime === ""){
		document.getElementsByClassName("err st")[0].innerHTML = "Start time cannot be empty"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err st")[0].innerHTML = "";
	}
	if(etime === ""){
		document.getElementsByClassName("err et")[0].innerHTML = "End time cannot be empty"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err et")[0].innerHTML = "";
	}

	if(stime !== "" && etime !== ""){
		if(stime >= etime){
			document.getElementsByClassName("err st")[0].innerHTML = "Start time is greater or equal to end time"; 
			document.getElementsByClassName("err et")[0].innerHTML = "Start time is greater or equal to end time"; 
			flag = false;
		}
		else{
			document.getElementsByClassName("err st")[0].innerHTML = "";
			document.getElementsByClassName("err et")[0].innerHTML = "";
		}
	}
	return flag;
}