<!DOCTYPE html>
<html lang = "en">

<head>
	<title>MyTheater</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Jessie Eoff and Rachel Zhao">
	<link rel="stylesheet" type="text/css" href="templates/home/style/home.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
 <!-- Header, Nav bar --> 
<header class="row">
	<div class = "header col-12">
		<nav class="navbar navbar-light bg-light fixed-top mytheater-nav">
			<div class="container-fluid">
				<a class="navbar-brand" href="?command=profile">
					<img src="templates/home/style/imgs/profileicon.png" alt="Profile Icon" class="d-inline-block align-text-top profileicon">
					myTheater
				</a>
				<a class="navbar-brand" href="?command=logout">Logout</a>
				<a href="?command=home">
				<img class="homeicon" alt = "Home icon redirecting to the home page" src="templates/home/style/imgs/homeicon.png">
				</a>
			</div>
		</nav>
	</div>
</header>

<!-- TODO: When movie database is created, use JavaScript to repeat card div x times -->
<div class = "container">
<!-- Search Row -->
	<div class = "row">
		<div class="input-group p-3 search-container">
  			<span class="input-group-text search-addon"><img src="templates/home/style/imgs/searchicon.png" class = "searchicon" alt = "..."></span>
			  	<input type="text" class = "searchbar col-md-4" placeholder="Search" aria-label="Username">
				<div class="input-group-text search-addon">
					<div class = "dropdown">
						<button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="templates/home/style/imgs/filtericon.png" class = "searchicon" alt = "..."></button>
				  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						    <a class="dropdown-item" href="#">Alphabetized</a>
						    <a class="dropdown-item" href="#">Release Date</a>
						    <a class="dropdown-item" href="#">Rating</a>
					  	</div>
				  	</div>
				</div>
		</div>
	</div>

<div class="row">
<!-- TODO: maybe change the layout to have 5xn instead of 4xn, and mobile to have 2xn -->
	<!-- TODO: change the bottom of the movie to include name, director, and release date [not just the rating] -->
		<!-- <div class = "col-md-3 col-sm-6">
			<div class="card">
				<a href = "?command=rate">
					<img src="templates/home/style/imgs/shangchi.png" class="card-img-top" alt="Shangchi">
				</a>
			</div>
			<p class = "movie-rating"><img src="templates/home/style/imgs/rateicon.png" class = "rateicon" alt = "...">4.5</p>
		</div> --> 
		<!-- col-md-3 col-sm-6 -->
		<div class="col-md-3 col-sm-6">
		<!-- <div class = "row row-cols-3"> -->
					<?php
					$db = new Database();
					$result = $db->query("select * from movie");
					foreach ($result as $key => $value) { ?>
						<form action="?command=rate" method="post">
						<?php 
						$poster = $value["poster"];
						echo '<div class="col">';
						?>
						<input type="hidden" name = "clickedmovie" value="<?=$value["title"]?>"/>
						<input type="image" name="placeholder" src="<?=$poster?>" value="<?=$value["title"]?>"/>
						<?php
						echo $value["title"];
						echo '</div>';
						echo '</form>';
					}
					
					?>
					</div>
				</div>

<!-- Do more to the footer [universal for all pages] -->
<footer class = "main-footer">
    <small class = "container">&copy;2022 CS 4640 Jessie Eoff and Rachel Zhao</small>
</footer>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</body>
</html>