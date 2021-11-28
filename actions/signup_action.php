<?php
require_once("../vendor/autoload.php");
use App\Model\UserModelClass;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(isset($_POST))
    {
        $userModel = new UserModelClass($_POST);
        $erros['errors'] = $userModel->validateForm(); 

        if(sizeof($erros['errors'])!=0)
        {
            echo json_encode($erros);
            exit();
        }
        else
        {
            //save data 
            $message = []; 
            if($userModel->saveUser($_POST))
            {
                $message['success'] =["Data has saved."];
            }
            else
            {
                $message['failed'] =["Data save failed."];
            }
            echo json_encode($message);
            exit();
        }
    }
}
else
{
    header('Location: /signup');
}
