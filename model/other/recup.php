<?php
//fonction qui me permettent de transformer les données json en donée php exploitable
function jsonToArray(){
    $path = __DIR__ . '/../../data/users.json';
    $json = file_get_contents($path);
    return json_decode($json, true);
}
//fonction qui me permettent de transformer des données php en données completment exploitable en json
function arrayToJson($array){
    $path = __DIR__ . '/../../data/users.json';
    $tab = json_encode($array, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    return file_put_contents($path,$tab);
}

function mailIsValide($mail){
    
}
?>