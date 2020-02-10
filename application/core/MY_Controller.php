<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Public controllers
 */
class MY_Controller extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        require_once 'constants/app.php';       
        require_once 'constants/filemanager.php';                                
        require_once 'constants/think.php';         

    }

}


/**
 * Include Controller 
 */
require_once 'My_App.php';