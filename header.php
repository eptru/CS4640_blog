<!DOCTYPE html>

<?php
require('connect_db.php');
require('post_db.php');
?>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="home.css" />
	<link rel="stylesheet" href="headerStyle.css">
	<script src="header.js"></script>
	<link rel="stylesheet" href="newPostStyle.css" />

</head>

</style>



</head>

<body>
		<?php 
		makeThePostTable();
		
			if(session_status() == PHP_SESSION_NONE)
			{
	
				session_start(); 
				
			}
		
			if(isset($_SESSION['loginInputError']) && isset($_SESSION['signupInputError']))
			{	
			?>

				<?php if ($_SESSION['signupInputError']!='none') {?>
				<div id="signupServerErrorCommunicator" style="display:block"><?php echo $_SESSION['signupInputError'] ?></div><?php } ?>
				<?php if ($_SESSION['loginInputError']!='none') {?>
				<div id="loginServerErrorCommunicator" style="display:block"><?php echo $_SESSION['loginInputError'] ?></div><?php } ?>
				
			<?php	
			} 
			else 
			{
			?>
			
				<div id="signupServerErrorCommunicator" style="display:none">none</div>
				<div id="loginServerErrorCommunicator" style="display:none">none</div>
			
			<?php
			}
		
		?>
		
		<header class="header">

			<!-- Label in the header on the left -->
			<!-- <a class="headerLabel" href="index.html">omega</a> -->

			<a href="http://localhost:4200">
						<img class="headerImage" src="logo.png" alt="Omega" height="30" width="100">
			</a>
			<?php if (!isset($_SESSION['email'])) {?>
			<!-- Login button -->
			<button id="loginButtonID" class="headerButton headerLoginButton" onclick="loginPopupFunc()">LOGIN</button>

			<!-- Sign-up button -->
			<button id="signupButtonID" class="headerButton headerSignupButton" onclick="signupPopupFunc()">SIGN UP</button>

		</header>

		<form action="submitPopup.php" method="post">
		
			<!-- Login popup container -->
			<div id="loginPopupID" class="popup loginPopup">

				<div style="font-size:22px">Log in</div>

				<hr class="popupHorizontalLine">

				<!-- Username text and input textbox -->
				<div class="popupLabelText">Email</div>
				<input required class="popupInput" type="email" name="email" id="loginEmailInput" />

				<!-- Password text and input textbox -->
				<div class="popupLabelText">Password</div>
				<input required class="popupInput" type="password" name="password" id="loginPasswordInput" style="margin-bottom: 10px"/>

				<div id="loginEmailError" class="popupErrorText">Not a valid Email</div>
				<div id="loginPasswordError" class="popupErrorText">Incorrect Email or Password</div>
				
				<div id="loginServerError" class="popupErrorText"></div>

				<!-- Error buffer that ensures a constant 10px seperation between the submit button and any element -->
				<div id="loginErrorBuffer" class="popupErrorText" style="visibility: hidden; font-size: 10px">Break</div>

				<!--Hidden input that communicates to php if there's any errors displayed -->
				<input type="hidden" id="loginErrorCheck" name="loginErrorCheck" value="0">

				 <!--Hidden input that communicates to php if there's any errors displayed -->
				<input type="hidden" id="loginUrlCommunicator" name="loginUrlCommunicator" value="">

				<!-- Submit Button -->
				<input type="submit" class="popupSubmitButton" name="loginSubmit" value="Submit" onclick="submitLogin()">

				<!-- Text asking the user to sign up -->
				<div style="margin-top: 10px" class="popupGenericText">"Don't have an account?"</div>
				<div class="popupGenericText">Click here to <span class="popupTextButton" onclick="signupPopupFunc()"> Sign up</span></div>
			
			</div>
			
		</form>

		<!-- Sign up popuxp container -->
		<form action="submitPopup.php" method="post">
		
			<div id="signupPopupID" class="popup signupPopup">

				<div style="font-size:25px">Sign up</div>

				<hr class="popupHorizontalLine">

				<div class="popupLabelText">Email</div>
				<input required class="popupInput" name="email" type="email" id="signupEmailInput" />

				<div class="popupLabelText">Username</div>
				<input required class="popupInput" name="username" type="text" id="signupUsernameInput" />

				<!-- Password text and input textbox -->
				<div class="popupLabelText">Password</div>
				<input required class="popupInput" name="password" type="password" id="signupPasswordInput" />

				<div class="popupLabelText" style="margin-bottom: -5px">Confirm Password</div>
				<input required class="popupInput" name="confirmedPassword" type="password" id="signupPasswordConfirmInput" style="margin-bottom: 10px;" />

				<div id="signupEmailError" class="popupErrorText">Not a valid Email</div>
				<div id="signupUsernameError" class="popupErrorText">Please input a username</div>
				<div id="signupPasswordError" class="popupErrorText">Please input a password</div>
				<div id="signupPasswordConfirmError" class="popupErrorText">Passwords do not match</div>

				<div id="signupServerError" class="popupErrorText"></div>

				<!-- Error buffer that ensures a constant 10px seperation between the submit button and any element -->
				<div id="signupErrorBuffer" class="popupErrorText" style="visibility: hidden; font-size: 10px">Break</div>

				<!--Hidden input that communicates to php if there's any errors displayed -->
				<input type="hidden" id="signupErrorCheck" name="signupErrorCheck" value="0">

				<!--Hidden input that communicates to php if there's any errors displayed -->
				<input type="hidden" id="signupUrlCommunicator" name="signupUrlCommunicator" value="">

				<!-- Submit Button -->
				<input type="submit" name="signupSubmit" class="popupSubmitButton" value="Submit" onclick="submitSignup()">

				<!-- Text asking the user to sign up -->
				<div style="margin-top: 10px" class="popupGenericText">Already have an account?</div>
				<div class="popupGenericText">Click here to <span class="popupTextButton" onclick="loginPopupFunc()">Log in</span></div>

			</div>
			
		</form>
		
		<div id="opaqueBackground" class="opaqueBackground" onclick="exitPopup()"></div>

<?php }
	else {
		$_SESSION['username'] = retriveUsernameByEmail($_SESSION['email']);
		require('newPost.php');
	}
?>
		
		

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>

		<!-- <script src="js/postpage.js"></script> -->

</body>

</html>
