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
	<meta name="author" content="Rachel Zhao and Jessie Eoff">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="templates/rate/style/rate.css">
</head>

<body>
	<!-- HEADER / NAV -->
    <header class = "row">
        <div class = "header col-12">
            <nav class="navbar navbar-light bg-light fixed-top mytheater-nav">
                <div class = "container-fluid">
                    <a class = "navbar-brand" href = "?command=home">
                        <img src="templates/home/style/imgs/logo.png" alt="Profile Icon" class="d-inline-block align-text-top logoicon">
                    </a>
                    <div class = "d-flex align-items-center">                            
                        <a class="navbar-brand" href="?command=profile">
                            <img src="templates/home/style/imgs/profileicon.png" alt="Profile Icon" class="d-inline-block align-text-top profileicon">
                        </a>
                        <a href = "?command=logout" class = "btn btn-light">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </header>

<!-- EXTRA PADDING -->
<div class = "row second-row">
</div>

<!-- RATING FUNCTIONALITY -->
<div class="row">
	<!-- Movie Poster -->
	<div class="col-md-4 col-sm-12">
		<img class="poster" src="<?=$clickedmovie[0]['poster']?>" alt="Movie Poster">
	</div>

	<div class="col-md-8 col-sm-12 rating">
		<!-- FORM TO RATE MOVIE -->
		<form action="?command=rate" method="post">
			<p class = "rating-title"><strong>Rating</strong></p>
			<label for = "overallrating">1 &ensp;</label><input type="range" min="1" max="5" step = ".1" name="ratingNum" class="slider" id = "overallrating" value = "<?=$clickedmovie[0]['rating']?>">&ensp; 5
			<input type="hidden" name = "clickedmovie" value="<?=$clickedmovie[0]["title"]?>"/>
			<div class = "row notes-label">
				<label class = "rating-title" for="review"><strong>Notes</strong></label>
			</div>
			<div class = "form-group" style = "width: 78%">
				<textarea class = "form-control" name = "review" rows = "3" placeholder="Leave your review here."></textarea>
			</div>
			<div class = "login-row"  style = "width: 78%">
				<button type = "submit" class = "btn btn-dark" >Submit</button>
			</div>
		</form>
	</div>
</div>

</body>
</html>