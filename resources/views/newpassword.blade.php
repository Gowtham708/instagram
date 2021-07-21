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
<form action="{{ route('newpassword') }}" method="POST">
    @csrf

    @if(session()->has('success'))
    <div class="alert alert-danger">
        {{ session()->get('success') }}
    </div>
@endif

<?php $token = csrf_token(); ?>
<div class="col-sm-3">
<div class="form-group">
    <input type="hidden" value="{{$user->email}}" name="email">
    </div>

    <div class="form-group">
   <label>Current_password</label>
   <input type="password" name="current_password" class="form-control" placeholder="Enter your password"></>
</div>
@error('Current_password')
    <span>{{$message}}</span>
   @enderror
<div class="form-group">
   <label>New_password</label>
   <input type="password" name="new_password" class="form-control" placeholder="Enter your password"></>
</div>
@error('New_password')
    <span>{{$message}}</span>
   @enderror
<div class="form-group">
   <label>Confirm_password</label>
   <input type="password" name="confirm_password" class="form-control" placeholder="Enter your password"></>
</div>
@error('Confirm_password')
    <span>{{$message}}</span>
   @enderror

<div class="form-group">
   <button class="btn btn-success">Submit</button>
</div>
</body>
</html>