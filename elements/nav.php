<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title> Test project </title>
        <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="assets/css/custome.css"/> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    </head>
    
    <body>
        <?php // print_r($_SESSION['user']->username); exit(); ?>
        <!-- navigation -->
        <header class="site-header">
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" id='nav'>
                <div class="container">
                    <a class="navbar-brand" href=/>
                        Home
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navContent" aria-expanded="true" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse " id="navContent">
                        <ul class="navbar-nav nav-fade-border ml-auto">
                            <?php if(empty($_SESSION)): ?>
                                <a class='navbar-brand d-block' href=/login> <i class="fa fa-key"></i> Log In </a>
                                <a class='navbar-brand d-block' href=/signup> <i class="fa fa-user"></i> Sign Up </a>
                            <?php endif; ?>

                            <?php if($_SESSION): ?>
                                <?php if($_SESSION['user']->user_type == 1): ?>
                                    <a class='navbar-brand d-block' href=/my-products> <i class="fa fa-list"></i> My Products </a>
                                    <a class='navbar-brand d-block' href=/order-list> <i class="fa fa-plus"></i> Order List </a>
                                <?php endif; ?>

                                <a class='navbar-brand d-block' href=/logout> <i class="fa fa-user"></i>  Logout (<?php echo $_SESSION['user']->username  ?>)</a>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>