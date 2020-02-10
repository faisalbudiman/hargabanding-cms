<?php  
defined('BASEPATH') OR exit('no direct script access allowed');

class _Process_Upload extends CI_Model 
{


    /**
     * File Process
     */

    public function __upload($name)
    {

        $this->load->library('upload');        

        $config_upload = [
        'upload_path' => PATH_ROOT.PATH_IMAGES,
        'allowed_types' =>'jpg|png|ico',
        ];

        $filename = $_FILES[$name]['name'];
        $newfilename = substr($filename, 0, strripos($filename, '.'))."_".date('YmdHis').substr($filename, strripos($filename, '.'));

        $this->upload->initialize(array_merge($config_upload,array('file_name' => $newfilename)));

        if($this->upload->do_upload($name))
        {

            $result = array('photo' => $this->upload->data());

            return $result['photo']['file_name'];
        }else {
            return 'failed';
        }

    }

    public function __delete($file)
    {
        @unlink(PATH_ROOT.$file);
    }
    

}