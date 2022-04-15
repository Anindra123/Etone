function validateWeeklySchedule(form){
	let wname = form['wname'].value.trim();
	let flag = true;

	if(wname === ""){
		document.getElementsByClassName("err ws")[0].innerHTML = "Week name cannot be empty";
		flag = false;	
	}
	else{
		document.getElementsByClassName("err ws")[0].innerHTML = ""
	}

	return flag;

}