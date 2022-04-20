<!DOCTYPE html>
<html lang = "en">
<head>
	<title>myTheater Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="author" content="Jessie Eoff and Rachel Zhao">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous"> 
	<link rel="stylesheet" type="text/css" href="templates/profile/style/profile.css">
</head>

<body>
<!-- HEADER / NAVBAR -->
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

	<!-- Profile pic, info, and bio for deskop view (>768px) -->
	<div class = "container desktop-profile">
		<div class = "row">
			<div class = "col-md-4 col-sm-6 pinfo-container">
				
				<div ondblclick="nameUpdate();">
					<div class = "row pinfo-line" id = "name-text">
						<span id = "name-text-update"><?=$user["name"]?>'s Profile!</span>
					</div>					
					<div class = "row pinfo-line" id = "name-input" style = "display: none;">
                          <input type="text" value = "<?=$user["name"]?>'s Profile!" class="form-control" id="name-input-update"/>
					</div>
				</div>
				<div ondblclick="emailUpdate();">
					<div class = "row pinfo-line" id = "email-text">
						<span id = "email-text-update"><?=$user["email"]?></span>
					</div>					
					<div class = "row pinfo-line" id = "email-input" style = "display: none;">
                          <input type="text" value = "<?=$user["email"]?>" class="form-control" id="email-input-update"/>
					</div>
				</div>
				<div ondblclick="phoneUpdate();">
					<div class = "row pinfo-line" id = "phone-text">
						<span id = "phone-text-update"><?=$user["phone"]?></span>
					</div>					
					<div class = "row pinfo-line" id = "phone-input" style = "display: none;">
                          <input type="text" value = "<?=$user["phone"]?>" class="form-control" id="phone-input-update"/>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Profile pic, info, and bio for mobile view (<768px) -->
	<div class = "container mobile-profile">
		<div class = "row">
			<div class = "col-6">
				<aside ondblclick="editProfile();"><div class = "row pinfo-line"><span id = "try"><?=$user["name"]?>'s Profile!</span></div></aside>
				<div class = "row pinfo-line"><?=$user["email"]?></div>
				<div class = "row pinfo-line"><?=$user["phone"]?></div>
			</div>
			<div class = "col-6">
			</div>
		</div>
	</div>

	<!-- SEARCH ROW -->
	<div class = "row">
		<div class="input-group p-3 search-container">
  			<span class="input-group-text search-addon"><img src="templates/home/style/imgs/searchicon.png" class = "searchicon" alt = "Search Icon"></span>
			<input type="text" class = "searchbar col-md-4" placeholder="Search your ratings" aria-label="Username">
			<div class="input-group-text search-addon">
				<div class = "dropdown">
					<button class="btn" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="templates/home/style/imgs/filtericon.png" class = "searchicon" alt = "Filter Icon"></button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="#">Alphabetized</a>
						<a class="dropdown-item" href="#">Release Date</a>
						<a class="dropdown-item" href="#">Rating</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- FUNCTIONALITY TO DISPLAY A USER'S RATINGS -->
	<div class = "container">
		<div class = "row">
			<?php 
			foreach ($ratedMovies as $key=>$value) { 
			?>
				<div class= "col-md-3 col-sm-6">
					<div class = "card" style = "align-items: center;">
						<form action="?command=rate" method="post" class = "card">
							<input type="hidden" name = "clickedmovie" value="<?=$value["title"]?>"/>
							<input type="image" name="placeholder" src="<?=$value["poster"]?>" value="<?=$value["title"]?>"/>
						</form>
			<?php 
							$db = new Database();
							$result = $db->query("select rating, reviewText from review where uid = ? and mid = ? order by rid desc limit 1;", "ii", $user["id"][0]["uid"], $value["mid"]);
			?>
						<p class = "movie-rating"><img src="templates/home/style/imgs/rateicon.png" class = "rateicon" alt = "Rate Icon"><?=$result[0]["rating"]?></p>
			<?php
							echo $result[0]["reviewText"];
			?>
						<form action="?command=profile" method="post">
							<input type="submit" class = "btn btn-dark delete-btn" name="deleteRatingButton" value="Delete Rating"/>
							<input type="hidden" name="deleteRating" value="<?=$value["mid"]?>"/>
						</form>
					</div>
				</div>
			<?php 
	        	} 
	        ?>
		</div>
	</div>

<!-- Do more to the footer [universal for all pages] -->
<footer class = "main-footer">
    <small class = "container">&copy;2022 CS 4640 Jessie Eoff and Rachel Zhao</small>
</footer>

<!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

    <script>

    	function nameUpdate(){
    		if ($("#name-input").css('display') === "none"){
    			$("#name-input").css('display', 'flex');
    		} else {
    			$("#name-input").css('display', 'none');
    		}

    		if ($("#name-text").css('display') === "none"){
    			$("#name-text-update").html($("#name-input-update").val());
    			$("#name-text").css('display', 'flex');
    		} else {
    			$("#name-text").css('display', 'none');
    		}
    	}

    	function emailUpdate(){    		
			if ($("#email-input").css('display') === "none"){
    			$("#email-input").css('display', 'flex');
    		} else {
    			$("#email-input").css('display', 'none');
    		}

    		if ($("#email-text").css('display') === "none"){
    			$("#email-text-update").html($("#email-input-update").val());
    			$("#email-text").css('display', 'flex');
    		} else {
    			$("#email-text").css('display', 'none');
    		}
    	}

    	function phoneUpdate(){    		
			if ($("#phone-input").css('display') === "none"){
    			$("#phone-input").css('display', 'flex');
    		} else {
    			$("#phone-input").css('display', 'none');
    		}

    		if ($("#phone-text").css('display') === "none"){
    			$("#phone-text-update").html($("#phone-input-update").val());
    			$("#phone-text").css('display', 'flex');
    		} else {
    			$("#phone-text").css('display', 'none');
    		}
    	}
    </script>
	
</body>
</html>