<?php

class Messages
{
    public static function setMessage($text, $type)
    {
        //this method we are setting the methods

        //$type means if its a success or an error
        if($type == 'error'){
            $_SESSION['error_message'] = $text;
        } else {
            $_SESSION['success_message'] = $text;
        }
    }

    public static function displayMessage()
    {
        //here we are going to check if the session is set
        if(isset($_SESSION['error_message'])){
            echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
            //once we've displayed it we will then need to unset the message from the array
            unset($_SESSION['error_message']);
        }

        //here we are going to check if the session is set
        if(isset($_SESSION['success_message'])){
            echo '<div class="alert alert-success">' . $_SESSION['success_message'] . '</div>';
            //once we've displayed it we will then need to unset the message from the array
            unset($_SESSION['success_message']);
        }
        
    }
}