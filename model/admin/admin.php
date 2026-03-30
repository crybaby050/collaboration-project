<?php
require_once __DIR__ . '/../other/recup.php';
$allUsers = jsonToArray();
$admin = [];
foreach($allUsers['users'] as $user){
    if($user['role'] === "admin"){
        $admin[] = $user;
    }
}
var_dump($admin)


?>