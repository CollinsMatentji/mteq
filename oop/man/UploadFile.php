<?php
class UploadFile
{
    public function uploadImageFile($file,$upDir,$fname)
    {
        if(!$this->errorInfile($file))
        {
            if(!$this->isFileImage($file))
            {
                if($fname != ""){
                    return $this->save_rename_uploaded_file($file,$upDir,$fname);
                }
                else {
                    return $this->save_uploaded_file($file,$upDir);
                }
            }
        }
    }
    private function save_uploaded_file($file,$upDir)
    {
        if(is_uploaded_file($file['tmp_name']))
        {
                if(!move_uploaded_file($file['tmp_name'], "$upDir/".$file['name']))
                {
                        echo "Problem: Could not move file to destination directory";
                        return false;
                }
        }
        else
        {
                echo "Problem: Possible file upload attack. Filename: ";
                echo $file['userfile']['name'];
                return false;
        }
        //echo "File uploaded succesfully";
        return "$upDir/".$file['name'];
    }
    private function save_rename_uploaded_file($file,$upDir,$fname)
    {
        if(is_uploaded_file($file['tmp_name']))
        {
                if(!move_uploaded_file($file['tmp_name'], $upDir."/$fname.png"))
                {
                        echo "Problem: Could not move file to destination directory";
                        return false;
                }
        }
        else
        {
                echo "Problem: Possible file upload attack. Filename: ";
                echo $file['userfile']['name'];
                return false;
        }
        //echo "File uploaded succesfully";
        return $upDir."/".$fname.".png";
    }
    private function isFileImage($file)
    {
        $imageinfo = getimagesize($file['tmp_name']);

        if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg' && $imageinfo['mime'] != 'image/png')
        {
                echo "Sorry, we only accept GIF, PNG and JPEG images\n";
                return true;
        }
        return false;
    }
    private function errorInfile($file)
    {
        if($file['error'] > 0)
        {
                $_COOKIE['err'] = "Notice: ";

                switch($file['error'])
                {
                        case 1: $_COOKIE['err'] = $_COOKIE['err'].'File exceeded upload_max_file';
                                        break;
                        case 2: $_COOKIE['err'] = $_COOKIE['err'].'File exceeded max_file_size';
                                        break;
                        case 3: $_COOKIE['err'] = $_COOKIE['err']."File only partially uploaded";
                                        break;
                        case 4: $_COOKIE['err'] = $_COOKIE['err']."No file uploaded";
                                        break;
                        case 5: $_COOKIE['err'] = $_COOKIE['err']."Can not upload file: No temp directory specified";
                                        break;
                        case 6: $_COOKIE['err'] = $_COOKIE['err']."Upload failed: Cannot write to disk";
                                        break;
                }
                return true;
        }
        return false;
    }
}
?>