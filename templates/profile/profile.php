<!DOCTYPE html>
<html lang = "en">
<head>
	<title>Julie's myTheater</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Jessie Eoff and Rachel Zhao">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="templates/profile/style/profile.css">
</head>
<body>
<!-- Header, Navbar -->
	<header class="row">
		<div class="header col-12">
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

	<!-- Profile pic, info, and bio for deskop view (>768px) -->
	<div class = "container desktop-profile">
		<div class = "row">
			<div class = "col-md-4 col-sm-6 pinfo-container">
				<div class = "row pinfo-line">Welcome, <?=$user["name"]?>!</div>
				<div class = "row pinfo-line"><?=$user["email"]?></div>
				<div class = "row pinfo-line"><?=$user["phone"]?></div>
			</div>
			<div class = "col-md-3 col-sm-6 profile-pic-container">
				<div class="card profile-card">
					<img src="templates/profile/imgs/profilepic.jpg" class="card-img-top profile-pic" alt="Profile Picture for Desktop View">
				</div>
			</div>
			<div class = "col-md-5 profile-bio">
				I am a movie enthusiast. My favorite movie is Finding nemo. My favorite actor is Brad Pitt and I value good directorship.
			</div>
		</div>
	</div>

	<!-- Profile pic, info, and bio for mobile view (<768px) -->
	<div class = "container mobile-profile">
		<div class = "row">
			<div class = "col-6">
				<div class = "row pinfo-line"> Welcome, <?=$user["name"]?>!</div>
				<div class = "row pinfo-line"><?=$user["email"]?></div>
				<div class = "row pinfo-line"><?=$user["phone"]?></div>
			</div>
			<div class = "col-6">
				<div class="card profile-card">
					<img src="templates/profile/imgs/profilepic.jpg" class="card-img-top profile-pic" alt="Profile Pricture for Mobile View">
				</div>
			</div>
		</div>
		<div class = "row profile-bio">
			I am a movie enthusiast. My favorite movie is Finding nemo. My favorite actor is Brad Pitt and I value good directorship.
		</div>
	</div>

	<!-- TODO: add outline to search bar to make it more visible -->
	<div class = "row">
		<div class="input-group p-3 search-container">
  			<span class="input-group-text search-addon"><img src="templates/home/style/imgs/searchicon.png" class = "searchicon" alt = "..."></span>
			<input type="text" class = "searchbar col-md-4" placeholder="Search your ratings" aria-label="Username">
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

	<!-- TODO: make grid much smaller than main page [maybe 6xn] -->
	<!-- TODO: add personal rating at the bottom of each movie -->
	<div class = "container">
		<div class = "row">
			<?php 
			foreach ($ratedMovies as $key=>$value) { ?>
				<div class= "col-md-3 col-sm-6">
						<form action="?command=rate" method="post">
							<input type="hidden" name = "clickedmovie" value="<?=$value["title"]?>"/>
							<input type="image" name="placeholder" src="<?=$value["poster"]?>" value="<?=$value["title"]?>"/>
						</form>
					Your Rating: <?php 
						$db = new Database();
						$result = $db->query("select rating, reviewText from review where uid = ? and mid = ? order by rid desc limit 1;", "ii", $user["id"][0]["uid"], $value["mid"]);
						echo $result[0]["rating"];
						echo "</br>Your Review: " . $result[0]["reviewText"];
					?>
					<form action="?command=home" method="post">
						<input type="submit" name="deleteRatingButton" value="Delete Rating"/>
						<input type="hidden" name="deleteRating" value="<?=$value["mid"]?>"/>
					</form>
				</div>
			<?php 
        	} ?>
			<div class= "col-md-3 col-sm-6">
			</div>
		</div>
	</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>	
</body>
</html>