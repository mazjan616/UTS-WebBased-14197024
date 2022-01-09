<?php

namespace App\Controllers;

class Site extends BaseController
{
    public function __construct(){
        // parent ::__construct();
        $this->db = \Config\Database::connect();
        $this->email = \Config\Services::email();
    }


    public function index()
    {
        return view('site/login');
    }

    public function dashboard()
    {
        $username14 = $this->request->getPost('username14');
        $katakunci = $this->request->getPost('katakunci');
        $hashKatakunci = hash('sha512', $katakunci);
        $respon = $this->getUserName($username14, $hashKatakunci);
        
        if ($respon != ''){
            return view('menu/menu');
        } else {
            return $this->index();
            // return view('site/login');
        }
    }

    public function getUserName($username14, $katakunci){

        $query = $this->db->query("select username14 from tbl_guru_14 where username14='$username14' and katakunci='$katakunci'");
        $row = $query->getRow();

        return isset($row->username14) ? $row->username14 : '';
    }
}

