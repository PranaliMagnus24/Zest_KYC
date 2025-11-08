<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Upload extends CI_model
{
    public function upload_image($image,$name,$ext='png')
    {
        $filterData=substr($image, strpos($image, ",")+1);
        $mime_split_without_base64 = explode(';', $image, 2);
        $ext = explode('/', $mime_split_without_base64[0]);
        $decodeData=base64_decode($filterData); //Decode the string
        
        
        $output_dir = "uploads/";
        $NewImageName = $name.'.'.$ext[1];
        if(file_exists(BASEPATH.$output_dir.$NewImageName))
        {
            unlink(BASEPATH.$output_dir.$NewImageName);
        }
        if(file_put_contents(BASEPATH.'uploads/'.$NewImageName, $decodeData))
        return $image=$this->config->config['base_url'].$output_dir. $NewImageName;
        
    }

}