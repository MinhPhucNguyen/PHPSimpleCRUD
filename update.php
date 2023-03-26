<?php
include 'partials/header.php';
require __DIR__ . '/users/users.php';

if (!isset($_GET['id'])) {
    include 'partials/not_found.php';
    exit;
}
$userID = $_GET['id'];

$user = getUserByID($userID);
if (!$user) {
    include 'partials/not_found.php';
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $isValid = validateUser($user, $errors);

    if ($isValid) {
        $user = updateUser($_POST, $userID);
        uploadImage($_FILES['picture'], $user);
        header('Location: index.php');
    }
}

?>

<?php include '_form.php' ?>

<?php include 'partials/footer.php' ?>