<?php //use Google\Cloud\Storage\StorageClient;
 ?>

<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>My Post</title>
	<link rel="stylesheet" href="
	https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />
	
	<link rel="stylesheet" href="home.css" />
</head>

<style>


.post {
	border-style:solid;
	border-color:#FF0048;
	padding-left:30px;
	padding-right:30px;
	margin-bottom:30px;
	margin-top:30px;
	position:relative;
}

.posttitle {
	color:#FF0048;
	margin-top:15px;
	margin-right:20px;
  justify-content: center;
  align-items: center;
}

.postcontent {
	margin-bottom:15px;
}

hr{
  height: 1px;
  color: black;
  background-color: black;
  border: none;
  margin-top:0;
  margin-bottom:30px;
}

.post img {
 width: 30%; 
 margin-left:auto; 
 margin-right:auto; 
 display:block;
}

.post .view {
	position:absolute;
	top:0px;
	right:5px;

}

.post .update {
	position:absolute;
	top:20px;
	right:5px;

}

.firstline {
	position:Relative;
}

.sortbutton {
	position:absolute;
	top:13px;
	right:15px;
}

#blogviewcount {
	position:Absolute;
	bottom:4px;
	left:105px;
	color:grey;
}


.posttitle a {
	text-decoration: none;
	color:#FF0048;
}


body{
    overflow-x: hidden;
}

</style>



</head>

<body>

<?php
require ('header.php');
//var_dump($_REQUEST);
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (!isset($_GET['postid'])) {
        if (isset($_GET['username'])) {
            $username = $_GET['username'];
            $sortbyid = false;
			if (isset($_GET['sortby'])) {
				if ($_GET['sortby']=='time') {
					$sortbyid=true;
				}
				else if ($_GET['sortby']=='view') {
					$sortbyid=false;
				}
			}
?>




<div class="container">
	<div class="firstline">
	<h1 class="posttitle"><a href="blogpost.php?username=<?php echo $username . '">' . $username; ?></a></h1>
	
	<small id="blogviewcount"></small>
	
	
	<div class="btn-group btn-group-toggle sortbutton" >
		<label class="btn btn-outline-secondary btn-sm">
		<input type="radio" name="view" id="optionview" autocomplete="off" checked onclick="window.location.href='blogpost.php?username=<?php echo $username ?>&sortby=view'"> view
		</label>
		
		<label class="btn btn-outline-secondary btn-sm">
		<input type="radio" name="time" id="optiontime" autocomplete="off" onclick="window.location.href='blogpost.php?username=<?php echo $username ?>&sortby=time'"> time
		</label>
	</div>
	</div>
	<hr/>
	
	<script>
	(function () {
		var sortbyid = <?php echo $sortbyid ? 'true' : 'false' ?>;
		if (!sortbyid) var button = document.getElementById('optionview');
		else var button = document.getElementById('optiontime');
		button.parentNode.classList.add("active");
	})();
	</script>
	
	<span id="helper"><?php //echo $sortbyid
             ?></span>
	<span id="helper2"><?php //var_dump($sortbyid)
             ?></span>
	<?php if ($sortbyid) $results = getPostsByusernameSortedById($username);
            else $results = getPostsByusernameSortedByView($username);
            //var_dump($results);
            $blogviewsum = 0;
            foreach ($results as $result) {
                $blogviewsum+= $result["viewcount"];
                echo '<div class = "post">';
                echo '<h3 class="posttitle"><a href="blogpost.php?postid=' . $result["postid"] . '">' . $result["title"] . "</a></h3><small class='view' style='color:grey'>view: " . $result["viewcount"] . "</small>";
                echo '	<div class = "postcontent">' . substr($result['content'], 0, 100);
                if (strlen($result['content']) > 100) echo '<a href="blogpost.php?postid=' . $result["postid"] . '">+read more</a>';
                echo "</div></div>";
            } ?>
	<script>
		(function () {
			document.getElementById('blogviewcount').innerHTML = "blog view total: "+<?php echo $blogviewsum ?>;
		})();
		</script>
	
	
<?php
        }
    } else {
        $postid = $_GET['postid'];
?>
		


		<div class="container">

	<?php $result = getPostByPostId($postid);
        //var_dump($result);
        if (sizeof($result) > 0) {
            $result = $result[0];
            $username = $result["username"];
            incView($postid);
            echo '<h1 class="posttitle"><a href="blogpost.php?username=' . $username . '">' . $username . '</a></h1><hr/>';
            echo '<div class = "post">';
            echo '<h3 class="posttitle">' . $result["title"] . "</h3>";

			echo "<small class='view' style='color:grey'>view: " . $result["viewcount"] . "</small>";
			if ((isset($_SESSION['username']) && $_SESSION['username'] === $username)) {
				echo "<small class='update' style='color:grey' onclick='update()'>update</small>";
			}//add one new button for post update. Delete the ! in if statement before submission.
            echo '	<div class = "postcontent">' . $result['content'];

            echo "</div></div>";
        }
    }
}
?>


<script>
function update() {
	//add one new button for post update
document.getElementById("newPostPopupID").classList.toggle("show");
	document.getElementById("postTitle").value = "<?php echo trim($result['title'])?>";
	document.getElementById("postBody").value = "<?php echo trim($result['content'])?>";
	document.getElementById("postid").value = "<?php echo $postid?>";

}

</script>

</body>

</html>
