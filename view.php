<?php
include 'partials/header.php';
require __DIR__ . '/users.php';

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
?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h3>View User: <b><?php echo $user['name'] ?></b></h3>
        </div>
        <table class="table">
            <tbody>
                <tr>
                    <th>Name:</th>
                    <td><?php echo $user['name'] ?></td>
                </tr>
                <tr>
                    <th>Username:</th>
                    <td><?php echo $user['username'] ?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $user['email'] ?></td>
                </tr>
                <tr>
                    <th>Phone:</th>
                    <td><?php echo $user['phone'] ?></td>
                </tr>
                <tr>
                    <th>Website:</th>
                    <td><?php echo $user['website'] ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>



<?php include 'partials/footer.php' ?>