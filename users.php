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
    $users = getUsers();
    foreach($users as $i => $user){
        if($user['id'] == $id){
            $users[$i] = array_merge($user, $data); //nối nhiều mảng thành 1 mảng, mảng cuối cùng truyền vào có cùng key thì sẽ nhận làm kết quả 
        }
    }

    file_put_contents(__DIR__.'/users.json', json_encode($users));//ghi dữ liệu mới vào file users.json
}

function deleteUser($id)
{

}

?>