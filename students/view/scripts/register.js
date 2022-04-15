function validateRegistration(form){
	let mail  = form['mail'].value.trim();
	let pass = form['pass'].value.trim();
	let fname =form['fname'].value.trim();
	let lname = form['lname'].value.trim();
	let uname = form['uname'].value.trim();
	let cpass = form['cpass'].value.trim();
	let loe = form['loe'];
	let flag = true;
	const mailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

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

	if(uname === ""){
		document.getElementsByClassName("err un")[0].innerHTML = "Username cannot be empty"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err un")[0].innerHTML = ""; 

	}
	if(mail === ""){
		document.getElementsByClassName("err ms")[0].innerHTML = "Mail cannot be empty"; 
		flag = false;
	}
	else if(!mailPattern.test(mail))
	{
		document.getElementsByClassName("err ms")[0].innerHTML = "Not a proper mail"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err ms")[0].innerHTML = ""; 
	}
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
	if(cpass === ""){
		document.getElementsByClassName("err cps")[0].innerHTML = "Confirm Password cannot be empty"; 
		flag = false;
	}
	else if(pass !== cpass){
		document.getElementsByClassName("err cps")[0].innerHTML = "Password does not match"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err cps")[0].innerHTML = ""; 

	}
	return flag;
}