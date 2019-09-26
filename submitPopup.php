<!-- PHP server-side input validation -->
<?php
	
	/* DO $_SESSION['username'] */
	
	/* Establishes database connection and session */
	require('connect_db.php');
	session_start(); 

	/* Main */
	
	$gotoURL = "home.php";
	$gotoURL = getURL();
	
	/* Sets a default state for the session's errors */
	$_SESSION['signupInputError'] = "none";
	$_SESSION['loginInputError'] = "none";
	$signuperror=false;
	$loginerror=false;
	
	/* Each function detects if it is a login or sign up form that is being submitted */
	loginSubmission();
	signupSubmission();
	
header('Location:'.$_SERVER['HTTP_REFERER']); 
	
	
	
	/* Login Submission function */
	function loginSubmission()
	{
		
		/* If the request method is post and the post is from the login submit button then continue */
		if (($_SERVER['REQUEST_METHOD'] == "POST")
			&& (isset($_POST['loginSubmit'])))
		{
			
			/* $_SESSION['inputError'] =  */
			
			/* If no client-side errors are detected then continue */
			/* Just in case check if there's an email or password in the post submission */
			if((trim($_POST['loginErrorCheck']) == 0)
				&& (isset($_POST['email']))
				&& (isset($_POST['password'])))
			{
				
				/* Take out any invalid character */
				$email = trim($_POST['email']);
				
				/* Trims the password of any invalid characters */
				$password = trim($_POST['password']);
				
				/* Convert the password into md5 encrypted version */
				$password = md5($password);
				
				/* Check if the user exists in the database */
				if(checkUser($email)) 
				{
					
					/* Check if the submitted email and password matches what's in the database */
					if(checkIdentity($email, $password))
					{
						
						
						
						/* If it's in the database then assign the user to this session */
						 $_SESSION['email'] = $email; 
						/* $_SESSION['password'] = $password; */
						
						$_SESSION['loginInputError'] = "none";
							
					}
					else
					{
						
						
						/* Input error given after server-side validation if the user and password matches */
						$_SESSION['loginInputError'] = "Invalid email or password";
						//$loginerror=true;
					}
					
				}
				else 
				{
					
					
					/* Input error given after server-side validation if the user doesn't exist within the database */
					$_SESSION['loginInputError'] = "Invalid email or password";
					//$loginerror=true;
					
				}
			
			} 
			else
			{
				
				//Nothing. Errors are already in use on front-end side.
				
			}
			
		}
		
	}
	
	/* Sign up submission function */
	function signupSubmission() 
	{
	
		/* If the request method is post and the username has more than 0 characters then continue evaluting the input */
		if ($_SERVER['REQUEST_METHOD'] == "POST" 
			&& (isset($_POST['signupSubmit'])))
		{

			/* If there's no client side sign up errors then continue */
			/* Just in case check if the email, username, and password have been submitted */
			if((trim($_POST['signupErrorCheck']) == 0) 
				&& (isset($_POST['email'])) 
				&& (isset($_POST['username'])) 
				&& (isset($_POST['password'])))
			{
				
				/* Take out any invalid character */
				$email = trim($_POST['email']);
				
				/* Take out any invalid character */
				$username = trim($_POST['username']);
				
				/* Take out any invalid character */
				$password = trim($_POST['password']);
				
				/* If the password contains invalid characters then set the inputError */
				if (!ctype_alnum($password)) 
				{
					
					/* Error message submitted */
					$_SESSION['signupInputError'] = "Password contains invalid characters";
					
				} 
				else
				{
					
					/* Trims the password of any invalid characters */
					$password = trim($_POST['password']);
					
					/* Encrypts password */
					$password = md5($password);
					
					/* Checks if user exists in the database */
					if(checkUser($email) == false) 
					{
						
						/* Creates a new user account if the user exists in the database */
						newUser($email, $username, $password);
						
					}	
					else
					{
						
						/* Error submitted upon the email being found in the database */
						$_SESSION['signupInputError'] = "Email already in use"; 
						//$signuperror=true;
						
					}
				
				}
			
			}
			
		}
							
	}
			
	/* Checks if the user exists in the database */
	function checkUser($emailSearchInput) 
	{
		
		/* Uses the database connection variable */
		global $db;
		
		/* Execute SQL statement without parameters  */
		$query = "SELECT * FROM users";
		$statement = $db->prepare($query);
		$statement->execute();
		
		/* Returns the rows of the table and puts them into an array */
		$results = $statement->fetchall();
	
		/* Stops the query (?) */
		$statement->closeCursor();
		
		/* Searching an array of rows to see if the email is there */
		foreach($results as $result)
		{
			
			/* If we find the email then return true indicating the user was found */
			if ($emailSearchInput == $result['email']) 
			{
				
				return true;
				break;
				
			}
			
		}
		
		return false;	
		
	}
	
	/* Creates the new user in the database */
	function newUser($emailInput, $userInput, $passwordInput) 
	{
		
		/* Uses the database connection variable */
		global $db;
		
		/* Dictates the type of query */
		$query = "INSERT INTO users (email, username, password) VALUES (:emailInput, :userInput, :passwordInput)";
		
		/* Prepares the query to the database */
		$statement = $db->prepare($query);
		
		/* Binds the variables to the query variable names */
		$statement->bindValue(':emailInput', $emailInput);
		$statement->bindValue(':userInput', $userInput);
		$statement->bindValue(':passwordInput', $passwordInput);
		
		/* Executes the query */
		$statement->execute();
		
		/* Stops the query (?) */
		$statement->closeCursor();
	
		
	}
	
	/* Checks if the user entered is actually the user by verifying their password */
	function checkIdentity($emailInput, $passwordInput) 
	{
		
		global $db;
		
		/* Execute SQL statement without parameters  */
		$query = "SELECT * FROM users";
		$statement = $db->prepare($query);
		$statement->execute();
		
		/* Returns the rows of the table and puts them into an array */
		$results = $statement->fetchall();
	
		$statement->closeCursor();
		
		foreach($results as $result)
		{
			
			/* CHANGE ME BACK TO && IF YOU FIXED THE PASSWORD LENGTH BUG */
			/* TIPS: DISALBE MD5 ENCRYPTING AND STORE PASSWORD PLAIN */
			if (($emailInput == $result['email']) && ($passwordInput == $result['password']))
			{
				
				echo $passwordInput;
				echo "      ";
				echo $result['password'];
				return true;
				
			}
			
		}
		
		return false;	
		
	}
	
	/* Gets the URL from the post */
	function getURL() 
	{
		
		/* Checks if the request is post and whether the url was submitted */
		if (($_SERVER['REQUEST_METHOD'] == "POST")
			&& (isset($_POST['signupUrlCommunicator']))) 
		{
			
			/* Trims it and returns it so this php file can use it */
			return trim($_POST['signupUrlCommunicator']);
			
		} 
		else if (($_SERVER['REQUEST_METHOD'] == "POST")
			&& (isset($_POST['loginUrlCommunicator']))) 
		{
		
			/* Trims it and returns it so this php file can use it */
			return trim($_POST['loginUrlCommunicator']);
		
		}
		else 
		{
			
			/* Default URL if none is sent is the homepage */
			return "home.php";
			
		}
		
	}

?>

