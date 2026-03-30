<?php
require_once __DIR__ . '/../other/recup.php';
$allUsers = jsonToArray();
$usr = [];
foreach($allUsers['users'] as $user){
    if($user['role'] === "user"){
        $usr[] = $user;
    }
}
var_dump($usr)


?>