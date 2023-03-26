<?php
function getUsers()
{
    //associative array: sử dụng các khóa được đặt tên và gắn giá trị 
    return json_decode(file_get_contents(__DIR__ . '/users.json'), true);
}

function getUserByID($id)
{
    $users = getUsers();
    foreach ($users as $user) {
        if ($user['id'] == $id) {
            return $user;
        }
    }
    return null;
}

function createUser($data)
{
    $users = getUsers();
    $data['id'] = rand(1000000, 2000000);
    $users[] = $data;

    putJson($users);
    return $data;
}

function updateUser($data, $id)
{
    $updateUser = [];
    $users = getUsers();
    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            $users[$i] = $updateUser =  array_merge($user, $data); //nối nhiều mảng thành 1 mảng, mảng cuối cùng truyền vào có cùng key thì sẽ nhận làm kết quả 
        }
    }

    putJson($users);
    return $updateUser;
}

function deleteUser($id)
{
    $users = getUsers();
    foreach($users as $i => $user){
        if($user['id'] == $id){
            array_splice($users, $i, 1);
        }
    }
    putJson($users);
}

function uploadImage($file, $user)
{
    if (isset($_FILES['picture']) && $_FILES['picture']['name']) {
        if (!is_dir(__DIR__ . "/images")) {
            mkdir(__DIR__ . "/images");
        }
        $file_name = $file['name'];
        $dotPosition = strpos($file_name, '.'); // vị trí của dấu .
        $extension = substr($file_name, $dotPosition + 1);

        move_uploaded_file($file['tmp_name'], __DIR__ . "/images/${user['id']}.$extension"); //tmp_name: đường dẫn tạm của file trên server

        $user['extension'] = $extension;
        updateUser($user, $user['id']);
    }
}

function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT)); //ghi dữ liệu mới vào file users.json
}

function validateUser($user, $errors){
    $isValid = true;
    if (!$user['name']) {
        $isValid = false;
        $errors['name'] = 'Name is mandatory';
    }
    if(!$user['username'] || strlen($user['username']) < 6 || strlen($user['username']) > 16){
        $isValid = false;
        $errors['username'] = "Username is required and it must be more than 6 and less than 16 character";
    }

    if($user['email'] && !filter_var($user['email'], FILTER_VALIDATE_EMAIL)){
        $isValid = false;
        $errors['email'] = "This must be a valid email address";
    }

    if(!filter_var($user['phone'], FILTER_VALIDATE_INT)){
        $isValid = false;
        $errors['phone'] = "This must be a valid phone number";
    }
    return $isValid;
}
