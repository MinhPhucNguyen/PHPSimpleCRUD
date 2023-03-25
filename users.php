<?php
function getUsers()
{
    $users = json_decode(file_get_contents(__DIR__.'/users.json'), true);
}

function getUserByID($id)
{

}

function createUser($data)
{

}

function updateUser($data, $id)
{

}

function deleteUser($id)
{

}

?>