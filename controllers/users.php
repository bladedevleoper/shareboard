<?php
class Users extends Controller{

    
    protected function register()
    {
        //viewmodel creates a new instance of the UserModel class
        $viewmodel = new UserModel();
        //this then returns the current method with the object and method being passed
        $this->returnView($viewmodel->register(), true);
    }

    //this method is used for the login view
    protected function login()
    {
        //viewmodel creates a new instance of the UserModel class
        $viewmodel = new UserModel();
        //this then returns the current method with the object and method being passed
        $this->returnView($viewmodel->login(), true);
    }

    // public static function logout()
    // {
    //     //viewmodel creates a new instance of the UserModel class
    //     $viewmodel = new UserModel();
    //     //this then returns the current method with the object and method being passed
    //     self::returnView($viewmodel->logout(), true);
    // }

    protected function logout()
    {
        unset($_SESSION['is_logged_in']);
        unset($_SESSION['user_data']);
        session_destroy();

        //redirect after session has been destroyed
        header('Location: '. ROOT_URL);
    }
}