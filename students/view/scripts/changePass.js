function changePassValidation(form) {
	let pass = form['pass'].value.trim();
	let cpass = form['cpass'].value.trim();
	let npass = form['npass'].value.trim();

	let flag = true;

	if(pass === ""){
		document.getElementsByClassName("err ps")[0].innerHTML = "Password cannot be empty"; 
		flag = false;
	}
	else if((pass.length < 6 || pass.length > 10)){
		document.getElementsByClassName("err ps")[0].innerHTML = "Password can be maximum 6 characters long and less than 10 characters long"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err ps")[0].innerHTML = "";
	}

	if(npass === ""){
		document.getElementsByClassName("err nps")[0].innerHTML = "Password cannot be empty"; 
		flag = false;
	}
	else if((npass.length < 6 || npass.length > 10)){
		document.getElementsByClassName("err nps")[0].innerHTML = "Password can be maximum 6 characters long and less than 10 characters long"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err nps")[0].innerHTML = "";
	}


	if(cpass === ""){
		document.getElementsByClassName("err cps")[0].innerHTML = "Confirm Password cannot be empty"; 
		flag = false;
	}
	else if(npass !== cpass){
		document.getElementsByClassName("err cps")[0].innerHTML = "Password does not match"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err cps")[0].innerHTML = ""; 

	}
	return flag;
}