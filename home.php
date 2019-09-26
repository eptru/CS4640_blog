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

  <div class="select-blogs">

      <div id="headerCarousel" class="carousel slide carousel-fade" data-interval="5000" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="images/img1.jpg" class="d-block w-100" alt="black and white dock">
            <div class="carousel-caption">
              <h1>TEST</h1>
              <p>Test</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images/img2.jpg" class="d-block w-100" alt="black and white waterfalls">
            <div class="carousel-caption">
              <h1>TEST</h1>
              <p>Test</p>
            </div>
          </div>

          <div class="carousel-item">
            <img src="images/img3.jpg" class="d-block w-100" alt="black and white skyline">
            <div class="carousel-caption">
              <h1>TEST</h1>
              <p>Test</p>
            </div>
          </div>
        </div>

    </div>

    <br />

    <div class="container">
      <div class="row">
        <div class="col text-center">
          <a href="index.php">
            <button class="pageButton" style="text-align: center;">EXPLORE</button>
          </a>
        </div>
      </div>
    </div>

    <br>


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

</body>
</html>
