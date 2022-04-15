function validateForgotPass(form){
	let mail  = form['mail'].value.trim();
	let uname = form['uname'].value.trim();
	const mailPattern = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/

	let flag = true;

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
	return flag;
}