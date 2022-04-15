function validateClassSchedule(form) {
	let weekdays = form.querySelectorAll('input[type=checkbox]');
	let cname = form['cname'].value.trim();
	let stime = form['stime'].value.trim();
	let etime = form['etime'].value.trim();

	let flag = true;
	let isChecked = false;
	for(let i=0;i<weekdays.length;i++){
		if(weekdays[i].checked === true){
			isChecked = true;
		}
	}	

	if(isChecked === false){
		document.getElementsByClassName("err wd")[0].innerHTML = "Please select a weekday";
		flag = false;
	}
	else{
		document.getElementsByClassName("err wd")[0].innerHTML = ""
	}

	if(cname === ""){
		document.getElementsByClassName("err cn")[0].innerHTML = "Please enter class name";
		flag = false;	
	}
	else{
		document.getElementsByClassName("err cn")[0].innerHTML = ""	
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