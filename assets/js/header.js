
//Function that shows the login popup
function loginPopupFunc() {

	/* Toggles the display of the log in popup. */
	var loginPopupElement = document.getElementById("loginPopupID");
	loginPopupElement.classList.toggle("show");

	/* Gets the status of the css display property from the log in popup */
	var loginDisplayStatus = getComputedStyle(loginPopupElement, null).display;

	/* Gets the status of the css display property from the sign up popup */
	var signupPopupElement = document.getElementById("signupPopupID");
	var signupDisplayStatus = getComputedStyle(signupPopupElement, null).display;
	
	var opaqueBackgroundElement = document.getElementById("opaqueBackground");
	
	if((getComputedStyle(loginPopupElement, null).display == "block") 
		&& (getComputedStyle(opaqueBackgroundElement, null).display == "none"))
			opaqueBackgroundElement.classList.toggle("show");
	
	if((getComputedStyle(loginPopupElement, null).display == "none") 
		&& (getComputedStyle(opaqueBackgroundElement, null).display == "block"))
			opaqueBackgroundElement.classList.toggle("show");
	
	/* If both are showing at the sametime disable the one that isn't being used */
	if ((loginDisplayStatus == 'block') && (signupDisplayStatus == 'block')) {
	
		signupPopupElement.classList.toggle("show");
		document.getElementById("signupEmailInput").value = "";
		document.getElementById("signupUsernameInput").value = "";
		document.getElementById("signupPasswordInput").value = "";
		document.getElementById("signupPasswordConfirmInput").value = "";
	
		clearAllSignupErrors();
	
	}

} //loginPopup()

//Function that shows the signup popup
function signupPopupFunc() {

	/* Toggles the display of the sign up popup */
	var signupPopupElement = document.getElementById("signupPopupID");
	signupPopupElement.classList.toggle("show");
	
	/* Gets the status of the css display property from the sign up popup */
	var signupDisplayStatus = getComputedStyle(signupPopupElement, null).display;
	
	/* Gets the status of the css display property from the log in popup */
	var loginPopupElement = document.getElementById("loginPopupID");
	var loginDisplayStatus = getComputedStyle(loginPopupElement, null).display;
	
	var opaqueBackgroundElement = document.getElementById("opaqueBackground");
	
	if((getComputedStyle(signupPopupElement, null).display == "block") 
		&& (getComputedStyle(opaqueBackgroundElement, null).display == "none")) {
			
			opaqueBackgroundElement.classList.toggle("show");
			
	}
	
	if((getComputedStyle(signupPopupElement, null).display == "none") 
		&& (getComputedStyle(opaqueBackgroundElement, null).display == "block")) {
			
			opaqueBackgroundElements.classList.toggle("show");
			
	}
		
	/* If both are showing at the sametime disable the one that isn't being used */
	if ((loginDisplayStatus == 'block') && (signupDisplayStatus == 'block')) {
	
		loginPopupElement.classList.toggle("show");
		document.getElementById("loginEmailInput").value = "";
		document.getElementById("loginPasswordInput").value = "";
		
		clearAllLoginErrors();
			
	}

} //signupPopupFunc()

function submitLogin() {
	
	var loginEmailElement = document.getElementById("loginEmailInput");
	var loginPasswordElement = document.getElementById("loginPasswordInput");

	var loginEmailErrorElement = document.getElementById("loginEmailError");
	var loginPasswordErrorElement = document.getElementById("loginPasswordError");
	var loginErrorBufferElement = document.getElementById("loginErrorBuffer");
	/* If the input in the email section is invalid then go to to it */
	
	var disableFocus = false;
	
	var errorBufferOn = false;
	
	/* Checks if the input is a valid email */
	if(loginEmailElement.checkValidity() == false) {
		
		/* If the focus is still enabled then put focus to this textbox */
		if(!disableFocus)
			loginEmailElement.focus();
		
		/* If the display is at none when an error is detected then allow toggling of the show class */
		if(getComputedStyle(loginEmailErrorElement, null).display == "none")
			loginEmailErrorElement.classList.toggle("show");
					
		/* Prevents the other textboxes to have focus */
		disableFocus = true;
		
		/* Boolean that will activate the error buffer function that makes the error buffer visible */
		errorBufferOn = true;
		
	} else {
	
		/* If the detected error is gone upon pressing the submit button again then toggle this 
		/* specific error message off */
		if(getComputedStyle(loginEmailErrorElement, null).display == "block")
			loginEmailErrorElement.classList.toggle("show");
								
	} /* else */
	
	/* Checks if the input is a valid password */
	if(loginPasswordElement.checkValidity() == false) {
		
		/* If the focus is still enabled then put focus to this textbox */
		if(!disableFocus)
			loginPasswordElement.focus();
		
		/* If the display is at none when an error is detected then allow toggling of the show class */
		if(getComputedStyle(loginPasswordErrorElement, null).display == "none")
			loginPasswordErrorElement.classList.toggle("show");
					
		/* Prevents the other textboxes to have focus */
		disableFocus = true;
		
		/* Boolean that will activate the error buffer function that makes the error buffer visible */
		errorBufferOn = true;
		
	} else {
	
		/* If the detected error is gone upon pressing the submit button again then toggle this 
		/* specific error message off */
		if(getComputedStyle(loginPasswordErrorElement, null).display == "block")
			loginPasswordErrorElement.classList.toggle("show");
								
	} /* else */
	
	/* Creates an error buffer that allows for a constant distance between the submit button and the textbox */
	if(errorBufferOn) {
	
		if(getComputedStyle(loginErrorBufferElement, null).display == "none")
			loginErrorBufferElement.classList.toggle("show");
			
	
	} else {
	
		if(getComputedStyle(loginErrorBufferElement, null).display == "block")
			loginErrorBufferElement.classList.toggle("show");
	
	}

} /* submitlogin() */ 	

function submitSignup() {
	
	/* TODO: Make it so that the error messages dynamically appear after a user types them */
	
	var signupEmailElement = document.getElementById("signupEmailInput");
	var signupUsernameElement = document.getElementById("signupUsernameInput");
	var signupPasswordElement = document.getElementById("signupPasswordInput");
	var signupPasswordConfirmElement = document.getElementById("signupPasswordConfirmInput");

	var signupEmailErrorElement = document.getElementById("signupEmailError");
	var signupUsernameErrorElement = document.getElementById("signupUsernameError");
	var signupPasswordErrorElement = document.getElementById("signupPasswordError");
	var signupPasswordConfirmErrorElement = document.getElementById("signupPasswordConfirmError");
	var signupErrorBufferElement = document.getElementById("signupErrorBuffer");
	
	/* When enabled all other forms that are not filled in won't use focus. 
	/* This allows the top most elements to have focus if they are not filled in.  */
	var disableFocus = false;
	
	var errorBufferOn = false;
	
	/* Checks if the input is a valid email */
	if(signupEmailElement.checkValidity() == false) {
		
		/* If the focus is still enabled then put focus to this textbox */
		if(!disableFocus)
			signupEmailElement.focus();
		
		/* If the display is at none when an error is detected then allow toggling of the show class */
		if(getComputedStyle(signupEmailErrorElement, null).display == "none")
			signupEmailErrorElement.classList.toggle("show");
					
		/* Prevents the other textboxes to have focus */
		disableFocus = true;
		
		/* Toggles the error buffer on since there's an error */
		errorBufferOn = true;
		
	} else {
	
		/* If the detected error is gone upon pressing the submit button again then toggle this 
		/* specific error message off */
		if(getComputedStyle(signupEmailErrorElement, null).display == "block")
			signupEmailErrorElement.classList.toggle("show");
								
	} /* else */
			
	/* Username Validity Check */
	if(signupUsernameElement.checkValidity() == false) {

		/* If the focus is still enabled then put focus to this textbox */
		if(!disableFocus)
			signupUsernameElement.focus();
		
		/* If the display is at none when an error is detected then allow toggling of the show class */
		if(getComputedStyle(signupUsernameErrorElement, null).display == "none")
			signupUsernameErrorElement.classList.toggle("show");
					
		/* Prevents the other textboxes to have focus */
		disableFocus = true;
		
		/* Toggles the error buffer on since there's an error */
		errorBufferOn = true;
		
	} else {
	
		/* If the detected error is gone upon pressing the submit button again then toggle this 
		/* specific error message off */
		if(getComputedStyle(signupUsernameErrorElement, null).display == "block")
			signupUsernameErrorElement.classList.toggle("show");
		
	} /* else */
	
	/* Password Validity Check */
	if(signupPasswordElement.checkValidity() == false) {
	
		/* If the focus is still enabled then put focus to this textbox */
		if(!disableFocus)
			signupPasswordElement.focus();
		
		/* If the display is at none when an error is detected then allow toggling of the show class */
		if(getComputedStyle(signupPasswordError, null).display == "none") 
			signupPasswordError.classList.toggle("show");
		
		/* Prevents the other textboxes to have focus */					
		disableFocus = true;
		
		/* Toggles the error buffer on since there's an error */
		errorBufferOn = true;
		
	} else {
	
		/* If the detected error is gone upon pressing the submit button again then toggle this 
		/* specific error message off */
		if(getComputedStyle(signupPasswordError, null).display == "block") 
			signupPasswordError.classList.toggle("show");
		
	} /* else */
	
	/* Password Confirmation and Validity Check */
	if((signupPasswordElement.value != signupPasswordConfirmElement.value) && (getComputedStyle(signupPasswordError, null).display == "none")) {
		
		/* If the focus is still enabled then put focus to this textbox */
		if(!disableFocus)
			signupPasswordConfirmElement.focus();
		
		/* If the display is at none when an error is detected then allow toggling of the show class */
		if(getComputedStyle(signupPasswordConfirmErrorElement, null).display == "none")
			signupPasswordConfirmErrorElement.classList.toggle("show");
		
		/* Prevents the other textboxes to have focus */					
		disableFocus = true;
		
		/* Toggles the error buffer on since there's an error */
		errorBufferOn = true;
		
	} else {
	
		/* If the detected error is gone upon pressing the submit button again then toggle this 
		/* specific error message off */
		if(getComputedStyle(signupPasswordConfirmErrorElement, null).display == "block") 			
			signupPasswordConfirmErrorElement.classList.toggle("show");
		
	} /* else */
	
	/* Creates an error buffer that allows for a constant distance between the submit button and the textbox */
	if(errorBufferOn) {
	
		if(getComputedStyle(signupErrorBufferElement, null).display == "none")
			signupErrorBufferElement.classList.toggle("show");
			
	
	} else {
	
		if(getComputedStyle(signupErrorBufferElement, null).display == "block")
			signupErrorBufferElement.classList.toggle("show");
	
	} /* else */
	
}

/* Clears all the errors from the signup popup so that they don't stay past clicking out of it */
function clearAllSignupErrors() {

	if(getComputedStyle(signupEmailError, null).display == "block")
		document.getElementById("signupEmailError").classList.toggle("show");
	   
	if(getComputedStyle(signupUsernameError, null).display == "block")
		document.getElementById("signupUsernameError").classList.toggle("show");
			
	if(getComputedStyle(signupPasswordError, null).display == "block")
		document.getElementById("signupPasswordError").classList.toggle("show");
			
	if(getComputedStyle(signupPasswordConfirmError, null).display == "block")
		document.getElementById("signupPasswordConfirmError").classList.toggle("show");
		
	if(getComputedStyle(signupErrorBuffer, null).display == "block")
		document.getElementById("signupErrorBuffer").classList.toggle("show");
	
	if(getComputedStyle(signupServerError, null).display == "block")
		document.getElementById("signupServerError").classList.toggle("show");

}

/* Clears all the errors from the login popup so that they don't stay past clicking out of it */				
function clearAllLoginErrors() {

	if(getComputedStyle(loginEmailError, null).display == "block")
		document.getElementById("loginEmailError").classList.toggle("show");
	   
	if(getComputedStyle(loginPasswordError, null).display == "block")	
		document.getElementById("loginPasswordError").classList.toggle("show");
		
	if(getComputedStyle(loginErrorBuffer, null).display == "block")	
		document.getElementById("loginErrorBuffer").classList.toggle("show");
	
	if(getComputedStyle(loginServerError, null).display == "block")
		document.getElementById("loginServerError").classList.toggle("show");

}

function signupInputErrorDisplay(stringInput) {
	
 	var signupPopupElement = document.getElementById("signupPopupID");
	var signupServerErrorElement = document.getElementById("signupServerError");
	var signupErrorBufferElement = document.getElementById("signupErrorBuffer");
	
	if(stringInput == "none") {
	
		var signupServerErrorElement = document.getElementById("signupServerError");
	

		if(getComputedStyle(signupPopupElement, null).display == "block") 
			signupPopupFunc();
		
		if(getComputedStyle(signupServerErrorElement, null).display == "block") 
			signupServerErrorElement.classList.toggle("show");
		
		if(getComputedStyle(signupErrorBufferElement, null).display == "block")
			signupErrorBufferElement.classList.toggle("show");
		
		signupServerErrorElement.innerHTML = ""; 

	} else {
		
		if(getComputedStyle(signupPopupElement, null).display == "none") 
			signupPopupFunc();
		
		if(getComputedStyle(signupServerErrorElement, null).display == "none") 
			signupServerErrorElement.classList.toggle("show");
		
		if(getComputedStyle(signupErrorBufferElement, null).display == "none")
			signupErrorBufferElement.classList.toggle("show");
		
		signupServerErrorElement.innerHTML = stringInput;
			
	}		 
	
	
}

function loginInputErrorDisplay(stringInput) {
	
	var loginPopupElement = document.getElementById("loginPopupID");
	var loginServerErrorElement = document.getElementById("loginServerError");
	var loginErrorBufferElement = document.getElementById("loginErrorBuffer");
	
	if(stringInput == "none") {

		if(getComputedStyle(loginPopupElement, null).display == "block") 
			loginPopupFunc();
		
		if(getComputedStyle(loginServerErrorElement, null).display == "block") 
			loginServerErrorElement.classList.toggle("show");
		
		if(getComputedStyle(loginErrorBufferElement, null).display == "block")
			loginErrorBufferElement.classList.toggle("show");
		
		loginServerErrorElement.innerHTML = ""; 

	} else {
		
		if(getComputedStyle(loginPopupElement, null).display == "none") 
			loginPopupFunc();
		
		if(getComputedStyle(loginServerErrorElement, null).display == "none") 
			loginServerErrorElement.classList.toggle("show");
		
		if(getComputedStyle(loginErrorBufferElement, null).display == "none")
			loginErrorBufferElement.classList.toggle("show");
		
		loginServerErrorElement.innerHTML = stringInput;
			
	}		 
	 
}

function onloadCheck() {
		
 		var signupServerErrorCommunicatorInnerHTML = document.getElementById("signupServerErrorCommunicator").innerHTML;
		var loginServerErrorCommunicatorInnerHTML = document.getElementById("loginServerErrorCommunicator").innerHTML;
					
		document.getElementById("loginUrlCommunicator").value = document.URL;
		document.getElementById("signupUrlCommunicator").value = document.URL; 
		
 		signupInputErrorDisplay(signupServerErrorCommunicatorInnerHTML);
		
 		loginInputErrorDisplay(loginServerErrorCommunicatorInnerHTML); 
			
}

function exitPopup() {
	
	var loginPopupElement = document.getElementById("loginPopupID");
	var signupPopupElement = document.getElementById("signupPopupID");
	var opaqueElement = document.getElementById("opaqueBackground");
	
	
	if(getComputedStyle(loginPopupElement, null).display == "block")
			loginPopupElement.classList.toggle("show");
		
	if(getComputedStyle(signupPopupElement, null).display == "block")
			signupPopupElement.classList.toggle("show");
		
	if(getComputedStyle(opaqueElement, null).display == "block")
			opaqueElement.classList.toggle("show");
	
	clearAllSignupErrors();
	clearAllLoginErrors();
	
}

