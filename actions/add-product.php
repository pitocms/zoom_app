<?php
session_start();
require_once("../vendor/autoload.php");

use App\Model\ProductModelClass;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    
    if(isset($_POST))
    {
        $productModel = new ProductModelClass($_POST,$_FILES,$_SESSION['user']->id);
        $erros['errors'] = $productModel->validateForm(); 

        if(sizeof($erros['errors'])!=0)
        {
            echo json_encode($erros);
            exit();
        }
        else
        {
            $message = []; 
            if($productModel->saveProduct())
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