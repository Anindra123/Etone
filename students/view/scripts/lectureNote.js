function validateLectureNote(form){

	let tname = form['tname'].value;
	let notes = form['notes'].value;

	let flag = true;

	if(tname === ""){
		document.getElementsByClassName("err tn")[0].innerHTML = "Task title cannot be empty";
		flag = false;
	}
	else{
		document.getElementsByClassName("err tn")[0].innerHTML = ""
	}

	if(notes === ""){
		document.getElementsByClassName("err ln")[0].innerHTML = "Please write a note";
		flag = false;
	}
	else{
		document.getElementsByClassName("err ln")[0].innerHTML = ""
	}

	return flag;
}