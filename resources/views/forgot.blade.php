  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <form action="{{ route('forgotpassword') }}" method="POST">
    @csrf
    <div class="col-sm-3"> 
    
    <div class="form-group">
    <label>Email:</label>
     <input type="text" name="email" class="form-control" placeholder="Enter your email">
    </div>
     <div class="form-group">
    <button  class="btn btn-success">Submit</button>
    </div>
    </form>
</body>
</html>