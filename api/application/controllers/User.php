<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller 
{
    public function get_user_data()
    {
        $this->load->model('UserModel');
        return $this->UserModel->get_user_data();
    }
    public function login()
    {
        $this->load->model('UserModel');
        return $this->UserModel->login();
    }
    public function addUser()
    {
        $this->load->model('UserModel');
        return $this->UserModel->addUser();
    }
    public function addSocialUser()
    {
        $this->load->model('UserModel');
        return $this->UserModel->addSocialUser();
    }
    public function checkUsername()
    {
        $this->load->model('UserModel');
        return $this->UserModel->checkUsername();
    }
    public function checkEmail()
    {
        $this->load->model('UserModel');
        return $this->UserModel->checkEmail();
    }
    public function checkForgotEmail()
    {
        $this->load->model('UserModel');
        return $this->UserModel->checkForgotEmail();
    }
    public function verify_OTP()
    {
        $this->load->model('UserModel');
        return $this->UserModel->verify_OTP();
    }
    public function changePassword()
    {
        $this->load->model('UserModel');
        return $this->UserModel->changePassword();
    }
    public function upload_base_image()
    {
        $this->load->model('UserModel');
        return $this->UserModel->upload_base_image();
    }
    public function update_image()
    {
        $this->load->model('UserModel');
        return $this->UserModel->update_image();
    }
    public function send_email()
    {
        $this->load->model('UserModel');
        return $this->UserModel->send_email();
    }
}
?>