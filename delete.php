<?php
    include 'partials/header.php';
    require __DIR__ . '/users/users.php';
    
    if (!isset($_POST['id'])) {
        include 'partials/not_found.php';
        exit;
    }
    $userID = $_POST['id'];
    deleteUser($userID);
    
    // $user = getUserByID($userID);
    // if (!$user) {
    //     include 'partials/not_found.php';
    //     exit;
    // }

    header('Location: index.php');

?>