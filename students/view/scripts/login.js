function validateLogin(form){
	let mail  = form['mail'].value.trim();
	let pass = form['pass'].value.trim();
	let flag = true;
	
	const mailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/
	if(mail === ""){
		document.getElementsByClassName("err ms")[0].innerHTML = "Mail cannot be empty "; 
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
	return flag;
}