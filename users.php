<?php
function getUsers()
{
    //associative array: sử dụng các khóa được đặt tên và gắn giá trị 
    return json_decode(file_get_contents(__DIR__.'/users.json'), true);

}

function getUserByID($id)
{
    $users = getUsers();
    foreach($users as $user) {
        if($user['id'] == $id ){
            return $user;
        }
    }
    return null;
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