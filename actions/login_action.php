<?php

require_once("../vendor/autoload.php");

use App\Model\LoginModelClass;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST))
    {
        $loginModel = new LoginModelClass($_POST);
        $erros['errors'] = $loginModel->validateForm(); 

        if(sizeof($erros['errors'])!=0)
        {
            echo json_encode($erros);
            exit();
        }
        else
        {
            
            if(!empty($loginModel->login($_POST)))
            {
                session_start();
                $userObj = $loginModel->login($_POST);
                unset($userObj->password);
                $_SESSION['user'] = $userObj;

                $message['url'] = ["/"];

                echo json_encode($message);
                exit();
            }
            else
            {
                $message['failed'] = ["Incorrect email or password"];
                echo json_encode($message);
                exit();
            }
        }
    }
}    
else
{
    header('Location: /login');
}