function updateAccValidation(form){
	let fname =form['fname'].value.trim();
	let lname = form['lname'].value.trim();
	let loe = form['loe'];
	let flag = true;

	if(fname === ""){
		document.getElementsByClassName("err fn")[0].innerHTML = "First name cannot be empty"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err fn")[0].innerHTML = ""; 
	}
	if(lname === ""){
		document.getElementsByClassName("err ln")[0].innerHTML = "Last name cannot be empty"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err ln")[0].innerHTML = ""; 

	}

	let isChecked = false;
	for(let i=0;i<loe.length;i++){
		if(loe[i].checked === true){
			isChecked = true;
		}
	}

	if(isChecked === false){
		document.getElementsByClassName("err loe")[0].innerHTML = "Please select a level of education"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err loe")[0].innerHTML = ""; 

	}

	return flag;
}
