<?php
    include_once("elements/nav.php"); 
    if(!empty($_SESSION['user']))
    {
        exit("Already login!");
    }; 
?>
    <div class="container">
        <div class="row">
            <div class="container pt-4 mt-5" style="min-height: 450px;">
                <div class="col-6 mx-auto">
                    <p>Login</p>
                    <form action="actions/login_action" method="POST" id="login_form">
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email" id="email">
                            <div class="text-danger error" id='email_error'>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter password" id="pwd">
                            <div class="text-danger error" id="password_error">
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <label class="form-check-label">
                            <input class="form-check-input" type="checkbox"> Remember me
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">LogIn</button>
                    </form>

                    <div id="msg" class="mt-2 alert d-none alert-dismissible fade show hidden" role="alert" >
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php include_once("elements/footer.php") ?>


<script>
    $(function(){
        $('#login_form').submit(function(e){
            e.preventDefault();

            $.ajax({
                url : "actions/login_action",
                method:'POST',
                data : $(this).serializeArray(),
                success:function(data)
                {
                    errorObj = JSON.parse(data)['errors'];

                    if(JSON.parse(data)['failed'])
                    {
                        $("#msg").removeClass('d-none')
                        $("#msg").addClass('alert-danger')
                        $("#msg").html('<p>'+JSON.parse(data)['failed']+'</p>')
                        $(".error").text("")
                    }

                    if(JSON.parse(data)['url'])
                    {
                        window.location.replace(JSON.parse(data)['url'])
                    }
                    
                    if(!$.isEmptyObject(errorObj))
                    {
                        if(errorObj['email'])
                        {
                            $("#email_error").text(errorObj['email'])
                        }
                        else
                        {
                            $("#email_error").text("")
                        }

                        if(errorObj['password'])
                        {
                            $("#password_error").text(errorObj['password'])
                        }
                        else
                        {
                            $("#password_error").text("")
                        }
                    }
                }
            })
        })
    });
</script>