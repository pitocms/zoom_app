<?php include_once("elements/nav.php") ?>
    <div class="container">
        <div class="row">
            <div class="container pt-4 mt-5" style="min-height: 450px;">
                <div class="col-6 mx-auto">
                    <p>Sign Up</p>
                    <form action="actions/signup_action.php" method="POST" id="user_form">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input name="username" type="name" class="form-control" placeholder="Enter name" id="name">
                            <div class="text-danger error" id='username_error'>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input name="email" type="name" class="form-control" placeholder="Enter email" id="email">
                            <div class="text-danger error" id='email_error'>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="user_type">Choose a User Type:</label>
                            <select class="form-control" name="user_type" id="user_type">
                                <option value="0">Customer</option>
                                <option value="1">Seller</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="pwd">Password:</label>
                            <input name="password" type="password" class="form-control" placeholder="Enter password" id="pwd">
                            <div class="text-danger error" id="password_error">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd2">Re-type Password:</label>
                            <input name="repassword" type="password" class="form-control" placeholder="Enter password" id="pwd2">
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
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
        $('#user_form').submit(function(e){
            e.preventDefault();

            $.ajax({
                url : "actions/signup_action",
                method:'POST',
                data : $(this).serializeArray(),
                success:function(data)
                {
                    errorObj = JSON.parse(data)['errors'];

                    if(JSON.parse(data)['success'])
                    {
                        $("#msg").removeClass('d-none')
                        $("#msg").addClass('alert-success')
                        $("#msg").html('<p>'+JSON.parse(data)['success']+'</p>').fadeOut(10000)
                        $(".error").text("")
                    }

                    if(JSON.parse(data)['failed'])
                    {
                        $("#msg").removeClass('d-none')
                        $("#msg").addClass('alert-danger')
                        $("#msg").html('<p>'+JSON.parse(data)['failed']+'</p>').fadeOut(10000)
                        $(".error").text("")
                    }

                    if(!$.isEmptyObject(errorObj))
                    {
                        if(errorObj['username'])
                        {
                            $("#username_error").text(errorObj['username'])
                        }
                        else
                        {
                            $("#username_error").text("")
                        }

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