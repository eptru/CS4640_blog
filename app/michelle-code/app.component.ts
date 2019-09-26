import { Component } from '@angular/core';

import { Post } from './post';
import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'cs4640-summer';

  responsedata = new Post('title','content','user');

  constructor(private http: HttpClient) { }

  senddata(data) {
    console.log(data);

    let params = JSON.stringify(data);

    //this.http.get('http://localhost/cs4640/ngphp-get.php?str'+encodeURIComponent(params))
    //this.http.get<Order>('http://localhost/cs4640/ngphp-get.php', data)
    this.http.post<Post>('http://localhost/finished_postpage/connect-db.php', data)
    .subscribe((data) => {
      console.log('Got data from backend', data);
      this.responsedata = data;
    }, (error) => {
      console.log('Error', error);
    })

  }

  loginPopupFunc() {

    // Toggles the display of the log in popup.
    var loginPopupElement = <HTMLInputElement>document.getElementById("loginPopupID");
    loginPopupElement.classList.toggle("show");

    // Gets the status of the css display property from the log in popup
    var loginDisplayStatus = getComputedStyle(loginPopupElement, null).display;

    // Gets the status of the css display property from the sign up popup
    var signupPopupElement = <HTMLInputElement>document.getElementById("signupPopupID");
    var signupDisplayStatus = getComputedStyle(signupPopupElement, null).display;

    // If both are showing at the sametime disable the one that isn't being used
    if ((loginDisplayStatus == 'block') && (signupDisplayStatus == 'block')) {

      signupPopupElement.classList.toggle("show");
      var clear = "";
      (<HTMLInputElement>document.getElementById("signupEmailInput")).value = "";
      (<HTMLInputElement>document.getElementById("signupUsernameInput")).value = "";
      (<HTMLInputElement>document.getElementById("signupPasswordInput")).value = "";
      (<HTMLInputElement>document.getElementById("signupPasswordConfirmInput")).value = "";

      this.clearAllSignupErrors();

    }
  }

  //Function that shows the signup popup
  signupPopupFunc() {

    //Toggles the display of the sign up popup
    var signupPopupElement = <HTMLInputElement>document.getElementById("signupPopupID");
    signupPopupElement.classList.toggle("show");

    // Gets the status of the css display property from the sign up popup
    var signupDisplayStatus = getComputedStyle(signupPopupElement, null).display;

    // Gets the status of the css display property from the log in popup
    var loginPopupElement = <HTMLInputElement>document.getElementById("loginPopupID");
    var loginDisplayStatus = getComputedStyle(loginPopupElement, null).display;

    // If both are showing at the sametime disable the one that isn't being used
    if ((loginDisplayStatus == 'block') && (signupDisplayStatus == 'block')) {

      loginPopupElement.classList.toggle("show");
      (<HTMLInputElement>document.getElementById("loginEmailInput")).value = "";
      (<HTMLInputElement>document.getElementById("loginPasswordInput")).value = "";

      this.clearAllLoginErrors();

    }

  } //signupPopupFunc()

  submitLogin() {

  	var loginEmailElement = <HTMLInputElement>document.getElementById("loginEmailInput");
  	var loginPasswordElement = <HTMLInputElement>document.getElementById("loginPasswordInput");

  	var loginEmailErrorElement = <HTMLInputElement>document.getElementById("loginEmailError");
  	var loginPasswordErrorElement = <HTMLInputElement>document.getElementById("loginPasswordError");
  	var loginErrorBufferElement = <HTMLInputElement>document.getElementById("loginErrorBuffer");
  	/* If the input in the email section is invalid then go to to it */

  	var disableFocus = false;

  	var errorBufferOn = false;

  	/* Checks if the input is a valid email */
  	if((<HTMLInputElement>loginEmailElement).checkValidity() == false) {

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
  	if((<HTMLInputElement>loginPasswordElement).checkValidity() == false) {

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

  submitSignup() {

  	/* TODO: Make it so that the error messages dynamically appear after a user types them */

  	var signupEmailElement = <HTMLInputElement>document.getElementById("signupEmailInput");
  	var signupUsernameElement = <HTMLInputElement>document.getElementById("signupUsernameInput");
  	var signupPasswordElement = <HTMLInputElement>document.getElementById("signupPasswordInput");
  	var signupPasswordConfirmElement = <HTMLInputElement>document.getElementById("signupPasswordConfirmInput");

  	var signupEmailErrorElement = <HTMLInputElement>document.getElementById("signupEmailError");
  	var signupUsernameErrorElement = <HTMLInputElement>document.getElementById("signupUsernameError");
  	var signupPasswordErrorElement = <HTMLInputElement>document.getElementById("signupPasswordError");
  	var signupPasswordConfirmErrorElement = <HTMLInputElement>document.getElementById("signupPasswordConfirmError");
  	var signupErrorBufferElement = <HTMLInputElement>document.getElementById("signupErrorBuffer");

  	/* When enabled all other forms that are not filled in won't use focus.
  	/* This allows the top most elements to have focus if they are not filled in.  */
  	var disableFocus = false;

  	var errorBufferOn = false;

  	/* Checks if the input is a valid email */
  	if((signupEmailElement).checkValidity() == false) {

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
  	if((signupUsernameElement).checkValidity() == false) {

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
  	if((signupPasswordElement).checkValidity() == false) {

  		/* If the focus is still enabled then put focus to this textbox */
  		if(!disableFocus)
  			signupPasswordElement.focus();

  		/* If the display is at none when an error is detected then allow toggling of the show class */
  		if(getComputedStyle(signupPasswordErrorElement, null).display == "none")
  			signupPasswordErrorElement.classList.toggle("show");

  		/* Prevents the other textboxes to have focus */
  		disableFocus = true;

  		/* Toggles the error buffer on since there's an error */
  		errorBufferOn = true;

  	} else {

  		/* If the detected error is gone upon pressing the submit button again then toggle this
  		/* specific error message off */
  		if(getComputedStyle(signupPasswordErrorElement, null).display == "block")
  			signupPasswordErrorElement.classList.toggle("show");

  	} /* else */

  	/* Password Confirmation and Validity Check */
  	if(((signupPasswordElement).value != (signupPasswordConfirmElement).value) && (getComputedStyle(signupPasswordErrorElement, null).display == "none")) {

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

  // Clears all the errors from the signup popup so that they don't stay past clicking out of it -->
  clearAllSignupErrors() {

  	var signupEmailErrorElement = <HTMLInputElement>document.getElementById("signupEmailError");
  	var signupUsernameErrorElement = <HTMLInputElement>document.getElementById("signupUsernameError");
  	var signupPasswordErrorElement = <HTMLInputElement>document.getElementById("signupPasswordError");
  	var signupPasswordConfirmErrorElement = <HTMLInputElement>document.getElementById("signupPasswordConfirmError");
  	var signupErrorBufferElement = <HTMLInputElement>document.getElementById("signupErrorBuffer");

    if(getComputedStyle(signupEmailErrorElement, null).display == "block")
      document.getElementById("signupEmailError").classList.toggle("show");

    if(getComputedStyle(signupUsernameErrorElement, null).display == "block")
      document.getElementById("signupUsernameError").classList.toggle("show");

    if(getComputedStyle(signupPasswordErrorElement, null).display == "block")
      document.getElementById("signupPasswordError").classList.toggle("show");

    if(getComputedStyle(signupPasswordConfirmErrorElement, null).display == "block")
      document.getElementById("signupPasswordConfirmError").classList.toggle("show");

    if(getComputedStyle(signupErrorBufferElement, null).display == "block")
      document.getElementById("signupErrorBuffer").classList.toggle("show");

  }


	// Clears all the errors from the login popup so that they don't stay past clicking out of it -->
	clearAllLoginErrors() {

    var loginEmailErrorElement = <HTMLInputElement>document.getElementById("loginEmailError");
    var loginPasswordErrorElement = <HTMLInputElement>document.getElementById("loginPasswordError");
    var loginErrorBufferElement = <HTMLInputElement>document.getElementById("loginErrorBuffer");

		if(getComputedStyle(loginEmailErrorElement, null).display == "block")
			document.getElementById("loginPasswordError").classList.toggle("show");

		if(getComputedStyle(loginPasswordErrorElement, null).display == "block")
			document.getElementById("loginPasswordError").classList.toggle("show");

		if(getComputedStyle(loginErrorBufferElement, null).display == "block")
			document.getElementById("loginErrorBuffer").classList.toggle("show");

	}



}
