<?php ?>
<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Index</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />

	<link rel="stylesheet" href="home.css" />
</head>

<body>

  <?php
  require ('header.php');
  ?>

  <br />

  <h4>Top three blogs this week:</h4>


  <div class="select-blogs">

    <hr>
    <br />

    <div class="card-deck" style="padding: 0px 20px 0px 20px;">
      <?php
      $results = getPostsSortedByView();
      $count = 0;
      foreach($results as $result)
      {
				$username = $result["username"];
        if ($count != 3)
        {
          echo '<div class="card">';
          //echo '<img class="card-img-top" src="..." alt="Blog image goes here.">';
          echo '<div class="card-body">';
          echo '<h5 class="card-title" style="display:inline-block"><a href="blogpost.php?postid='. $result["postid"] . '">' . substr($result["title"], 0, 10) . "</a></h5>";
					if (strlen($result['content']) > 10) echo "<h5 style='display:inline-block'>...</h5>";
          echo '<p class="card-text"><a href="blogpost.php?username=' . $username . '">' . $username . "</a></p>";
          echo "</div></div>";

          $count++;
        }
      } ?>

    <br />
    <hr>
  </div>

	<br />

  <h4>All blogs:</h4>

	<hr>

	<div class="container">
	  <div class="select-blogs">

	    <br />

			<?php
			$results = getAllPosts();
			foreach($results as $result)
			{
				$username = $result["username"];
				echo '<div class="card">';
				echo '<div class="card-body">';
				echo '<h5 class="card-title">' . $result["title"] . '</h5>';
				echo '<p class="card-text"><a href="blogpost.php?username=' . $username . '">' . $username . "</a></p>";
				echo '<a href="blogpost.php?postid=' . $result["postid"] . '">';
				echo '<button class="pageButton">GO TO PAGE</button>';
				echo '</a>';
				echo "</div></div>";

				echo '<br />';
			} ?>

	  </div>
	</div>

</body>
</html>
