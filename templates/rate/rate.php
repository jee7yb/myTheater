<!DOCTYPE html>
<!-- SOURCES USED:
https://www.w3schools.com/howto/howto_js_rangeslider.asp
https://stackoverflow.com/questions/16841323/making-gradient-background-fill-page-with-css
-->
<html lang = "en">
<head>
	<title>Rate Shangchi</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Rachel Zhao">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="templates/rate/style/rate.css">
</head>
<body>
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

<div class="row">
	<div class="col-md-4 col-sm-12">
		<img class="poster" src="<?=$clickedmovie[0]['poster']?>" alt="Movie Poster">
	</div>
	<!-- TODO: figure out how to make these sliders orange [or black, blue is a no] -->
	<div class="col-md-8 col-sm-12 rating">
	<form action="?command=rate" method="post">
		<p class = "rating-title">Rating</p>
		<label for = "overallrating">1 &ensp;</label><input type="range" min="1" max="5" name="ratingNum" class="slider" id = "overallrating">&ensp; 5
		<input type="hidden" name = "clickedmovie" value="<?=$clickedmovie[0]["title"]?>"/>
		<div class = "row notes-label">
			<label class = "rating-title" for="review">Notes</label>
		</div>
		<div class = "row notes-textbox" style="width:77%;">
				<input type="text" id="review" name="review" rows="4" size="80" placeholder="Leave your review here"></textarea></br>
			<button type="submit" class="btn btn-primary" style="width:50%; background-color:darkorange;">Submit Review</button>
		</div>
	</div>
	</form>
</div>

</body>
</html>