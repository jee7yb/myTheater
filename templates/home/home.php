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

<div class = "container">
	<!-- Search Functionality -->
	<div class = "row">
		<div class="input-group p-3 search-container">
  			<span class="input-group-text search-addon">
  				<img src="templates/home/style/imgs/searchicon.png" class = "searchicon" alt = "...">
  			</span>
			 <input type="text" class = "searchbar col-md-4" placeholder="Search" aria-label="Username">
			<div class="input-group-text search-addon" id = "filterDiv">
				<div class = "dropdown">
					<button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="filter"><img src="templates/home/style/imgs/filtericon.png" class = "searchicon" alt = "..."></button>
			  		<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
				  	</div>
			  	</div>
			</div>
		</div>
	</div>

	<!-- Movies Display Row -->
	<div class = "row">
	<?php
		//checking for temporary JSON requirement 
		if (isset($_SESSION["json"])){
			echo $_SESSION["json"];
		}
		//else, displaying movies requested for
		else {
			foreach($_SESSION["movies"] as $key => $value){
				$poster = $value["poster"];
	?>
				<div class = "col-md-3 col-sm-6 col-10">	
					<form action = "?command=rate" method = "post" class = "card card-img-top" style = "align-items: center;">
						<input type="hidden" name = "clickedmovie" value="<?=$value["title"]?>"/>
						<input type="image" class = "card-img-top" name="placeholder" src="<?=$poster?>" value="<?=$value["title"]?>"/>
						<div>
							<p class = "movie-rating">
								<img src="templates/home/style/imgs/rateicon.png" class = "rateicon" alt = "..."><?=$value['rating']?>
							</p>
						</div>
					</form>
				</div>
	<?php
			}
		}
	?>
	</div>

<!-- FOOTER // TODO -->
<footer class = "main-footer">
    <small class = "container">&copy;2022 CS 4640 Jessie Eoff and Rachel Zhao</small>
</footer>


<!-- scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script>
	var filter = document.getElementById("filterDiv");

	filter.onmouseenter = function() {
		filter.innerHTML = '<a class="dropdown-item" href="?command=home&sort=alphabetized">Alphabetized</a><a class="dropdown-item" href="?command=home&sort=none">Popularity</a><a class="dropdown-item" href="?command=home&sort=rating">Rating</a>';
	}

	filter.onmouseleave = function() {
		filter.innerHTML = '<button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="filter"><img src="templates/home/style/imgs/filtericon.png" class = "searchicon" alt = "..."></button>';
	}
</script>

</body>
</html>