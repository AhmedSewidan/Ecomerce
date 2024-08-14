@extends('layouts.auth')

@section('content')
    <div class="form-container">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="input">
                <label>
                    Username :
                    <input type="text" name="name" id="name"  placeholder="Enter Your Name">
                </label>
            </div>
            <div class="input">
                <label>
                    Email :
                    <input type="email" name="email" id="email" placeholder="Enter Your Email">
                </label>
            </div>
            <div class="input">
                <label>
                    Password :
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                </label>
            </div>
            <div class="input">
                <label>
                    Confirm Password :
                    <input type="password" name="confirm-password" id="password" placeholder="Confirm Youe Password">
                </label>
            </div>
    
            <input type="submit" value="Register">
            
        </form>
    </div>
@endsection