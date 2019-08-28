<?php
/**
 * Created by PhpStorm.
 * User: lizer
 * Date: 2019/2/20
 * Time: 20:56
 */
function uploadfile($filename,$path)
{
    $upfile=$_FILES[$filename];
    if(empty($typelist))
    {
        $typelist=array("image/gif","image/jpg","image/jpeg","image/png");
    }
    $res=array("error"=>false);
    if($upfile['error']>0)
    {
        switch($upfile["error"])
        {
            case 1:
                $res["info"]="上传的文件超过了 php.ini中upload_max_filesize选项大小";
                break;
            case 2:
                $res["info"]="上传文件的大小超过了HTML表单中MAX_FILE_SIZE选项";
                break;
            case 3:
                $res["info"]="文件只有部分被上传";
                break;
            case 4:
                $res["info"]="没有文件被上传";
                break;
            case 6:
                $res["info"]="找不到临时文件夹";
                break;
            case 7:
                $res["info"]="文件写入失败";
                break;
            default:
                $res["info"]="未知错误!";
                break;

        }
        return $res;
    }

    if($upfile['size']>1000000000)
    {
        $res['info']="上传文件过大！";
        return $res;
    };

    if(!in_array($upfile['type'],$typelist))
    {
        $res['info']="上传类型不符！".$upfile['type'];
        return $res;
    }
    $fileinfo=pathinfo($upfile['name']);
    do {
       $newfile=date("YmdHis").rand(100,9999).".".$fileinfo['extension'];
    }while(file_exists($newfile));

    if(is_uploaded_file($upfile['tmp_name']))
    {
        if(move_uploaded_file($upfile['tmp_name'],"../".$path."/".$newfile))
        {
            $res['info']=$newfile;
            $res['error']=true;
            return $res;
        }else
        {
            $res['info']="上传文件失败";
        }


    } else
    {
        $res['info']="不是一个上传的文件！";
    }
    return $res;

}


function image_png_size_add($imgsrc,$imgdst){
    list($width,$height,$type)=getimagesize($imgsrc);
    $new_width = ($width>200?200:$width);
    $new_height =($height>150?150:$height);
    //echo $type;
    switch($type){
        case 1:
            $giftype=check_gifcartoon($imgsrc);
            if($giftype){

                $image_wp=imagecreatetruecolor($new_width, $new_height);
                $image = imagecreatefromgif($imgsrc);
                imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                imagejpeg($image_wp, $imgdst,75);
                imagedestroy($image_wp);
            }
            break;
        case 2:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefromjpeg($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,75);
            imagedestroy($image_wp);
            break;
        case 3:

            $image_wp=imagecreatetruecolor($new_width, $new_height);
            $image = imagecreatefrompng($imgsrc);
            imagecopyresampled($image_wp, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
            imagejpeg($image_wp, $imgdst,75);
            imagedestroy($image_wp);
            break;
    }
}
function check_gifcartoon($image_file){
    $fp = fopen($image_file,'rb');
    $image_head = fread($fp,1024);
    fclose($fp);
    return preg_match("/".chr(0x21).chr(0xff).chr(0x0b).'NETSCAPE2.0'."/",$image_head)?false:true;
}