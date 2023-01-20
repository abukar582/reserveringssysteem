<?php

/** @var mysqli $db */
require_once "database.php";

// redirect when uri does not contain an id
if (!isset($_GET['id']) || $_GET['id'] == '') {
    // redirect to index.php
    header('Location: index.html');
    exit;
}

//Retrieve the GET parameter from the 'Super global'
$userId = $_GET['id'];
//Get the record from the database result
$query = "SELECT * FROM users WHERE id = '$userId'";
$result = mysqli_query($db, $query);

//If the album doesn't exist, redirect back to the homepage
if (mysqli_num_rows($result) == 0) {
    header('Location: index.html');
    exit;
}

$user = mysqli_fetch_assoc($result);

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Details - <?= $user['first_name'] . ' ' . $user['last_name'] ?></title>
</head>


<body
<div class="container px-4">
    <h1 class="title mt-4"><?= $user['first_name'] . ' ' . $user['last_name'] ?></h1>

    <section class="content">
        <ul>
            <li>Email: <?= $user['mail'] ?></li>
            <li>Datum: <?= $user['date'] ?></li>
            <li>Tijd: <?= $user['time'] ?></li>

        </ul>
    </section>
    <div>
        <a class="button" href="index.html">Go back to the list</a>
    </div>
</div>
</body>
</html>