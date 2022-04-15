function changePassValidationAndUpdate(form) {
	let password = form['pass'].value.trim();
	let confirmpassword = form['cpass'].value.trim();
	let newpassword = form['npass'].value.trim();

	let flag = true;

	if(password === ""){
		document.getElementsByClassName("err ps")[0].innerHTML = "Password cannot be empty"; 
		flag = false;
	}
	else if((password.length < 6 || password.length > 10)){
		document.getElementsByClassName("err ps")[0].innerHTML = "Password can be maximum 6 characters long and less than 10 characters long"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err ps")[0].innerHTML = "";
	}

	if(newpassword === ""){
		document.getElementsByClassName("err nps")[0].innerHTML = "Password cannot be empty"; 
		flag = false;
	}
	else if((newpassword.length < 6 || newpassword.length > 10)){
		document.getElementsByClassName("err nps")[0].innerHTML = "Password can be maximum 6 characters long and less than 10 characters long"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err nps")[0].innerHTML = "";
	}


	if(confirmpassword === ""){
		document.getElementsByClassName("err cps")[0].innerHTML = "Confirm Password cannot be empty"; 
		flag = false;
	}
	else if(newpassword !== confirmpassword){
		document.getElementsByClassName("err cps")[0].innerHTML = "Password does not match"; 
		flag = false;
	}
	else{
		document.getElementsByClassName("err cps")[0].innerHTML = ""; 

	}
	if(flag === true){
		let xmlhtp = new XMLHttpRequest();
		xmlhtp.onload = function (){
			if(this.responseText === ""){
				document.getElementsByClassName("err ps")[0].innerHTML = "Password doesn't match with Old password";
			}
			else{
				document.getElementsByClassName("msg")[0].classList.add("success");
				document.getElementsByClassName("msg")[0].innerHTML = this.responseText
				form['pass'].value = "";
				form['cpass'].value = "";
				form['npass'].value = "";
			}
		}

		xmlhtp.open("POST","../controller/student_changePassAjax.php");
		xmlhtp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhtp.send(`pass=${password}&npass=${newpassword}&cpass=${confirmpassword}`);		
	}
}