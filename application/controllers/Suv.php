<?php
/**
 * Created by PhpStorm.
 * User: James
 * Date: 2014/5/15
 * Time: 上午12:40
 */

class Suv extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('suv/header_view');
        $this->load->view('suv/suv_view');
        $this->load->view('suv/footer_view');
    }


}