<!-- Citations: -->

<!-- Textarea Element:
https://www.w3schools.com/html/html_form_elements.asp -->

<!-- Turn off resize 
https://stackoverflow.com/questions/5235142/how-to-disable-resizable-property-of-textarea?rq=1 -->

						<!-- Submit test button -->
		<button id="newPostButtonID" class="headerButton" onclick="newPostFunc()">New Post</button>
			
			</header>
			
					<!-- Login popup container -->
		
			<div id="newPostPopupID" class="popup newPostPopup">
			
				<!-- <div style="font-size:22px">New post</div> -->
				<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
				<input required type="text" id="postTitle" placeholder="Enter Title" name="title"/>
				
				<span id="xButton" onclick="newPostFunc()">&#10006;</span>
				
				<hr class="popupHorizontalLine">
				
				<!-- <input required type="text" align="right" id="postBody" /> -->
				
				<textarea id="postBody" required placeholder="Enter text here..." rows="10" cols="30" type="text" name="content"/></textarea>
				
				<input hidden id="postid" value="" name="updatepostid"></input>
			<div class="invisibleContainer">
			
				<button id="newPostButtonID" class="postSubmitButton" type="submit">Submit</button>
			
			</div>
			</form>
		</div>
		
<?php 	
if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['updatepostid']) && $_POST['updatepostid']!="") {//added for post update. check if we are updating a exsiting post or add a new one. use a hidden input above.
		if (isset($_POST['title']) && isset($_POST['content'])) {
			?><script> document.getElementById("newPostPopupID").hide(); </script><?php
			updatePostById($_POST['updatepostid'], $_POST['title'], $_POST['content']);
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
		else {
			echo "Please fill all fields.";
		}
		}
		else {
			if (isset($_POST['title']) && isset($_POST['content'])) {
			?><script> document.getElementById("newPostPopupID").hide(); </script><?php
			if (isset($_SESSION['username'])) {$username = $_SESSION['username'];}
			else {header('Location:'.$_SERVER['HTTP_REFERER']);}
			postPosts($username, $_POST['title'], $_POST['content']);
			header('Location:'.$_SERVER['HTTP_REFERER']);
		}
		else {
			echo "Please fill all fields.";
		}
		}
	}
	?>	
	
	
				<script>
							
					//Function that shows the login popup
					function newPostFunc() {

						/* Toggles the display of the log in popup. */
						var newPostPopupElement = document.getElementById("newPostPopupID");
						newPostPopupElement.classList.toggle("show");

						/* Gets the status of the css display property from the log in popup */
						var newPostDisplayStatus = getComputedStyle(newPostPopupElement, null).display;

					} //newPostFunc()
				
				</script>
