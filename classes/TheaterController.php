<?php
// AUTHORS: Rachel Zhao and Jessie Eoff

class TheaterController {

    private $command;
    private $sort;
    private $db;

    public function __construct($command, $sort) {
        $this->command = $command;
        $this->db = new Database();
        $this -> sort = $sort;
    }

    public function run() {
        switch($this->command) {
            case "home":
                $this->home();
                break;
            case "logout":
                $this->logout();
                break;
            case "profile":
                $this->profile();
                break;
            case "rate":
                $this->rate();
                break;
            case "login":
            default:
                $this->login();
                break;
        }
    }

    public function login() {

        if (isset($_POST["email"]) && !empty($_POST["email"])) { 
            $data = $this->db->query("select * from user where email = ?;", "s", $_POST["email"]);

            if ($data === false) {
                $error_msg = "Error checking for user";
            } 
            // else if they've logged in before
            else if (!empty($data)) { 
                //information all correct
                if (password_verify($_POST["password"], $data[0]["password"]) && ($_POST["name"] === $data[0]["name"]) && ($_POST["phone"] === $data[0]["phone"])) {
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["phone"] = $_POST["phone"];
                    header("Location: ?command=home");
                } 
                //incorrect password
                else if (!password_verify($_POST["password"], $data[0]["password"])){
                    $error_msg = "Incorrect password";
                } 
                //incorrect name
                else if (($_POST["name"] !== $data[0]["name"])){
                    $error_msg = "Incorrect name";
                } 
                //incorrect phone number
                else if ($_POST["phone"] !== $data[0]["phone"]){
                    $error_msg = "Incorrect Phone Number";
                }
            } 
            // else, this is a new user
            else {
                //email validation
                if(!preg_match("/^[A-Za-z0-9\+\-_][A-Za-z0-9\+\-_\.]*[A-Za-z0-9\+\-_]+[@][A-Za-z0-9\-]+[\.][A-Za-z0-9\-\.]*[A-Za-z0-9\-]+/", $_POST["email"])){
                    $error_msg = "Please enter a valid email";
                } 
                //else, all information is good to go and a new user is created
                else {
                    $insert = $this->db->query("insert into user (email, name, password, phone) values (?, ?, ?, ?);", "ssss", 
                    $_POST["email"], $_POST["name"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["phone"]);
                    if ($insert === false) {
                        $error_msg = "Error inserting user";
                    } else {
                        $_SESSION["name"] = $_POST["name"];
                        $_SESSION["email"] = $_POST["email"];
                        $_SESSION["phone"] = $_POST["phone"];
                        header("Location: ?command=home");
                    }
                }
            }
        }
        include "templates/login.php";
    }

    public function home() {
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
            "id" => $this->db->query("select uid from user where email = ?;", "s", $_SESSION["email"]),
            "phone" => $_SESSION["phone"],
        ];

        $db = new Database();

        //different queries depending on sorting request
        if ($this -> sort === "none"){
            $result = $db -> query ("select * from movie");
            unset($_SESSION["json"]);
            $_SESSION["movies"] = $result;
        } else if ($this -> sort === "alphabetized"){
            $result = $db -> query ("select * from movie order by title");
            unset($_SESSION["json"]);
            $_SESSION["movies"] = $result;
        } else if ($this -> sort === "rating"){
            $result = $db -> query ("select * from movie order by rating desc");
            unset($_SESSION["json"]);
            $_SESSION["movies"] = $result;
        } else{
            $result = $db -> query ("select * from movie");
            $_SESSION["json"] = json_encode($result);

        }

        include "templates/home/home.php";
    }

    public function profile() {
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
            "id" => $this->db->query("select uid from user where email = ?;", "s", $_SESSION["email"]),
            "phone" => $_SESSION["phone"],
        ];

        //checking to see if a movie needs to be deleted
        if (isset($_POST["deleteRating"])) {
            $this->db->query("delete from review where mid = ? and uid = ?;", "ii", $_POST["deleteRating"], $user["id"][0]["uid"]);
        }

        //queries loading in individual user's ratings 
        $userReviews = $this->db->query("select * from review where uid = ?;", "i", $user["id"][0]["uid"]);
        $ratedMovies = $this->db->query("select * from movie where mid in (select mid from review where uid = ?);", "i", $user["id"][0]["uid"]);

        include "templates/profile/profile.php";
    }

    public function rate() {
        $user = [
            "name" => $_SESSION["name"],
            "email" => $_SESSION["email"],
            "id" => $this->db->query("select uid from user where email = ?;", "s", $_SESSION["email"]),
            "phone" => $_SESSION["phone"],
        ];

        //querying for specific movie to be rated
        $clickedMovieID = $this->db->query("select mid from movie where title=?;", "s", $_POST["clickedmovie"]);
        if (isset($user["id"][0]["uid"]) && isset($_POST["review"]) && isset($_POST["ratingNum"])) {
            $insert = $this->db->query("insert into review (uid, mid, rating, reviewText) values (?, ?, ?, ?)", "iiss", $user["id"][0]["uid"], $clickedMovieID[0]["mid"], $_POST["ratingNum"], $_POST["review"]);
            if ($insert === false) {
                $error_msg = "Error inserting movie review";
            } 

            else {
                header("Location: ?command=profile");
            }
        } 
        
        $clickedmovie = $this->db->query("select * from movie where title = ?", "s", $_POST["clickedmovie"]);

        include "templates/rate/rate.php";
    }


    public function logout() {
        if(isset($_SESSION["name"])){
            session_destroy();
            header("Location: ?command=login");
        }
    }

}