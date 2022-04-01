<?php

// AUTHORS: Rachel Zhao

class TheaterController {

    private $command;
    private $db;

    public function __construct($command) {
        $this->command = $command;
        $this->db = new Database();
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
        if (isset($_POST["email"]) && !empty($_POST["email"])) { /// validate the email coming in
            $data = $this->db->query("select * from user where email = ?;", "s", $_POST["email"]);
            if ($data === false) {
                $error_msg = "Error checking for user";
            } else if (!empty($data)) { // if they've logged in before
                if (password_verify($_POST["password"], $data[0]["password"]) && ($_POST["name"] === $data[0]["name"]) && ($_POST["phone"] === $data[0]["phone"])) {
                    $_SESSION["name"] = $_POST["name"];
                    $_SESSION["email"] = $_POST["email"];
                    $_SESSION["phone"] = $_POST["phone"];
                    header("Location: ?command=home");
                } else {
                    $error_msg = "Incorrect name or phone or password";
                }
            } else { // if this is a new user
                // TODO: input validation
                if (preg_match("/\d{10}/", $_POST["phone"])) {
                    $insert = $this->db->query("insert into user (email, name, password, phone) values (?, ?, ?, ?);", "sssi", 
                    $_POST["email"], $_POST["name"], password_hash($_POST["password"], PASSWORD_DEFAULT), $_POST["phone"]);
                    if ($insert === false) {
                        $error_msg = "Error inserting user";
                    } else {
                        $_SESSION["name"] = $_POST["name"];
                        $_SESSION["email"] = $_POST["email"];
                        $_SESSION["phone"] = $_POST["phone"];
                        header("Location: ?command=home");
                    }
                } else {
                    $error_msg = "Incorrectly formatted phone number";
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

        if (isset($_POST["deleteRating"])) {
            $this->db->query("delete from review where mid = ? and uid = ?;", "ii", $_POST["deleteRating"], $user["id"][0]["uid"]);
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

        $clickedMovieID = $this->db->query("select mid from movie where title=?;", "s", $_POST["clickedmovie"]);
        if (isset($user["id"][0]["uid"]) && isset($_POST["review"]) && isset($_POST["ratingNum"])) {
            $insert = $this->db->query("insert into review (uid, mid, rating, reviewText) values (?, ?, ?, ?)", "iiis", $user["id"][0]["uid"], $clickedMovieID[0]["mid"], $_POST["ratingNum"], $_POST["review"]);
            if ($insert === false) {
                $error_msg = "Error inserting movie review";
            } else {
                header("Location: ?command=profile");
            }
        } 
        
        $clickedmovie = $this->db->query("select * from movie where title = ?", "s", $_POST["clickedmovie"]);

        include "templates/rate/rate.php";
    }


    public function logout() {
        include "templates/login.php";
    }

}