<?php

// AUTHORS: Rachel Zhao and Jessie Eoff

spl_autoload_register(function ($classname) {
    include "classes/$classname.php";
});

// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT); //ONLY INCLUDE FOR TESTING
$db = new mysqli(Config::$db["host"], Config::$db["user"],
                 Config::$db["pass"], Config::$db["database"]);

$db->query("set FOREIGN_KEY_CHECKS=0;");
$db->query("drop table if exists user;");
$db->query("create table user (
            uid int not null auto_increment,
            email text not null,
            name text not null,
            password text not null,
            phone text not null,
            primary key (uid)
            );");
$db->query("set FOREIGN_KEY_CHECKS=1;");

$db->query("set FOREIGN_KEY_CHECKS=0;");
$db->query("drop table if exists movie;");
$db->query("create table movie (
            mid int not null auto_increment,
            title text not null,
            poster text not null,
            rating text not null,
            primary key (mid)
            );");
$db->query("set FOREIGN_KEY_CHECKS=1;");


$db->query("drop table if exists review;");
$db->query("create table review (
            rid int not null auto_increment,
            uid int not null,
            mid int not null,
            rating text not null,
            reviewText text not null,
            primary key (rid),
            foreign key (uid) references user(uid),
            foreign key (mid) references movie(mid)
            );");


$data = json_decode(file_get_contents("https://api.themoviedb.org/3/movie/popular?api_key=ea4c9f0b82e70498eab13ca7d40893e9&language=en-US&page=1"), true);
$movies = $data["results"];

$stmt = $db->prepare("insert into movie (title, poster, rating) values (?, ?, ?);");
foreach ($movies as $key=>$value) {
    $posterPath = "https://image.tmdb.org/t/p/w500" . $value["poster_path"];
    $rand_int = mt_rand(150,500) / 100;
    $stmt->bind_param("sss", $value["title"], $posterPath, $rand_int);
    if (!$stmt->execute()) {
        echo "Could not add movie to database";
    }
}
// print_r($data); //ONLY INCLUDE FOR TESTING