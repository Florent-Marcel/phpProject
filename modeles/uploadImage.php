<?php

//Vérifie que le fichier est une image
function checkIfNotFakeImage($img)
{
        $check = getimagesize($img["tmp_name"]);
        if ($check !== false) {
            return true;
        } else {
            return false;
        }
}

function overwriteImage(){

}


//Vérifie le poids de l'image
function checkFileSize($img){
    if($img["size"] > 1048576){
        return false;
    }
    return true;
}

//Vérifie le poids de l'image
function checkFormatImage($img){
    $fileType = getFileType($img);
    if($fileType == "jpeg" || $fileType == "gif" || $fileType == "jpg"){
        return true;
    } else{
        return false;
    }
}

//Upload l'image
function uploadImage($img,$pseudo){
    if(!checkIfNotFakeImage($img))
        return false; //todo exception ?
    if(!checkFileSize($img))
        return false; //todo exception ?
    if(!checkFormatImage($img))
        return false; //todo exception ?
    return move_uploaded_file($img["tmp_name"], getTargetFile($img, $pseudo));
}

//Upload l'image et la lie à un utilisateur
function uploadImageAndLink($img, $pseudo){
    if(uploadImage($img, $pseudo)){
        if(linkImage($img, $pseudo)){
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
    
}

//Donne le dosser des images
function getTargetDir(){
    return "./images/";
}

//Donne l'image de l'utilisateur
function getTargetFile($img, $pseudo){
    return getTargetDir() . $pseudo . '.' . getFileType($img);
}

//Donne l'extension du fichier
function getFileType($img){
    $tmp = explode(".", $img["name"]);
    return end($tmp);
}
?>