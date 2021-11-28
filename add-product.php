<?php include_once("elements/nav.php") ?>
<div class="container" style="min-height: 450px;">
    <div class="mt-5 py-2 pt-3 pl-3 bg-white bd-lt-red">
        <h2>
            Add Product
        </h2>
    </div>

    <div class="row">
        <div class="col">
            <div class="product-form bg-white p-2 mt-2">
            <form action="actions/add-product" method="POST" enctype="multipart/form-data" id="imageUploadForm">
                <div class="form-row">

                    <div class="form-group col-md-6">
                        <label>Name</label>
                        <input name="name" type="name" class="form-control" id="name" placeholder="Name" autocomplete="off">

                        <div class="text-danger error" id='name_error'>
                                
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label>Price for customer</label>
                        <input name="customer_price" class="form-control" id="price-customer" placeholder="Cutomer Price" autocomplete="off">

                        <div class="text-danger error" id='price_error'>
                                
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Price for Wholesaler</label>
                    <input name="wholesaler_price"  class="form-control" id="price-wholesale" placeholder="price-wholesale" readonly>
                </div>

                <div class="form-group">
                    <label for="inputAddress2">Image 1</label>
                    <input name="image" type="file" class="form-control" id="image">

                    <div class="text-danger error" id='image_error'>
                                
                    </div>
                </div>
            
                <button type="submit" class="btn btn-primary">Add Product</button>
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
        $("#price-customer").keyup(function(){
            retail_price = $(this).val();
            price_wholesaler = retail_price - ((retail_price*10)/100)
            $('#price-wholesale').val(price_wholesaler)
            console.log(price_wholesaler)
        })
        $('#imageUploadForm').submit(function(e){
            e.preventDefault()
            var formData = new FormData(this)

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,

                success:function(data){
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
                        if(errorObj['name'])
                        {
                            $("#name_error").text(errorObj['name'])
                        }
                        else
                        {
                            $("#name_error").text("")
                        }
                        
                        if(errorObj['customer_price'])
                        {
                            $("#price_error").text(errorObj['customer_price'])
                        }
                        else
                        {
                            $("#price_error").text("")
                        }

                        if(errorObj['image'])
                        {
                            $("#image_error").text(errorObj['image'])
                        }
                        else
                        {
                            $("#image_error").text("")
                        }
                    }
                },
                error: function(data){
                    console.log("error");
                    console.log(data);
                }
            })
        })

    });
</script>