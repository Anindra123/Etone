function validateLecturePlan(form) {
	let sname = form['sname'].value.trim();
	let flag = true;
	if(sname === ""){
		document.getElementsByClassName("err sn")[0].innerHTML = "Subject name cannot be empty";
		flag = false
	}
	else{
		document.getElementsByClassName("err sn")[0].innerHTML = "";	
	}
	return flag;
}