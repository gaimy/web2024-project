<?php
function upload($target_dir, $file){
    if(isset($file['name'])){
        $filetmp = $file["tmp_name"];
        $imageFileType = strtolower(pathinfo($file["name"],PATHINFO_EXTENSION));
        $target_file = $target_dir . basename($filetmp.".$imageFileType");

        $check = getimagesize($filetmp);
        // Check if image file is a actual image or fake image
        if($check !== false) {
            if (move_uploaded_file($filetmp, $target_file)) {
                return $target_file;
                } else {
                return "ERROR";
            }
        } else {
            return "NOTIMAGE";
        }
    }else return "NOFILE";
}