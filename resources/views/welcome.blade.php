<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
    <style type="text/css">
        .a{
            height: 440px;
            border: 2px solid;
            
            padding: 5px;
            margin: 40px;
        }
    </style>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">

        <center><h2>Shopping Cart</h2></center>
         @if(Session::has('flash_message_error'))
                <div class="alert alert-sm alert-danger alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{!! session('flash_message_error') !!}</strong>
                </div>
                @endif

                 @if(Session::has('flash_message_success'))
                <div class="alert alert-sm alert-success alert-block" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>{!! session('flash_message_success') !!}</strong>
                </div>
                @endif
        <div class="row">
             @foreach($product as $products)
            <div class="col-md-3 col-sm-12 a">
               
                <form method="post" action="{{url('/cart')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                     <input type="hidden" name="product_id" value="{{$products->id}}">
                        <input type="hidden" name="product_name" value="{{$products->product_name}}">
                        <input type="hidden" id="product_price" name="product_price" value="{{$products->product_price}}">

                    <center><img src="image/{{$products->image}}"  width="50%" height="200px"></center>
                    <h3>{{$products->product_name}}</h3>
                    <h5>$ {{$products->product_price}}</h5>

                    <div class="form-group quantity-box">
                        <label class="control-label">Quantity</label>
                        <input class="form-control" name="quantity" value="1" min="1" max="20" type="number">
                    </div>

                    <button class="btn btn-success" data-fancybox-close="" type="submit" style="color: white;">Add to cart</button>
                    
                </form>
              
                
                
            </div>
              @endforeach
           
            
        </div>
        <br>
        <br>
        <center><h2>Order Details</h2></center>
        
            <center><table border="2" width="100%">
                <thead>
                    <th>Item Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                    <th>Action</th>
                </thead>
                @foreach($cartDetails as $cartDetail)
                <tr>
                    <td>{{$cartDetail->product_name}}</td>
                    <td>{{$cartDetail->quantity}}</td>
                    <td>${{$cartDetail->product_price}}</td>
                    <td>${{$cartDetail->quantity * $cartDetail->product_price}}</td>
                    <td><a href="{{url('/cart/delete-product/'.$cartDetail->id)}}">Remove</a></td>
                </tr>
                @endforeach
            </table></center>
            <br>
            <br>
            
        
        
    </div>


</body>
</html>