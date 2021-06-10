<?php

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

function checkFileSize($img){
    if($img["size"] > 1048576){
        return false;
    }
    return true;
}

function checkFormatImage($img){
    $fileType = getFileType($img);
    if($fileType == "jpeg" || $fileType == "gif" || $fileType == "jpg"){
        return true;
    } else{
        return false;
    }
}

function uploadImage($img,$pseudo){
    if(!checkIfNotFakeImage($img))
        return false; //todo exception ?
    if(!checkFileSize($img))
        return false; //todo exception ?
    if(!checkFormatImage($img))
        return false; //todo exception ?
    return move_uploaded_file($img["tmp_name"], getTargetFile($img, $pseudo));
}

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

function getTargetDir(){
    return "./images/";
}

function getTargetFile($img, $pseudo){
    return getTargetDir() . $pseudo . '.' . getFileType($img);
}

function getFileType($img){
    $tmp = explode(".", $img["name"]);
    return end($tmp);
}
?>