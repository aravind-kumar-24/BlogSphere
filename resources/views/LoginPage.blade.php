@extends('layouts.MainLayout')

@section('content')
   <link rel="stylesheet" href="{{asset('css/login.css')}}">
   <div class="login-container">
        <form class="login-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="top-section">
                <div class="email_field">
                    <label for="email_id">Email ID</label>
                    <input type="text" id="email_id" name="email_id" placeholder="Email ID" value="{{old('email_id')}}" autocomplete="off"/>
                    <small class="error"></small>
                </div>
                <div class="password_field">
                    <label for="password">Password</label>
                    <div class="password_input">
                        <input maxlength="15" type="password" name="password" id="password" placeholder="Password"/>
                        <svg class="password-eye-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="#C97C5D" d="M5.09 14.781c1.749 1.368 3.219 1.806 4.91 1.806c1.471 0 3.391-.613 5.238-1.919c1.332-.942 2.433-2.315 3.3-4.13q-1.41-2.447-3.263-4.013c-1.71-1.448-3.582-2.112-5.312-2.112c-1.79 0-3.85.798-5.608 2.474q-1.898 1.81-2.88 3.638q1.598 2.682 3.614 4.256M10 18c-1.974 0-3.735-.525-5.741-2.094q-2.365-1.85-4.164-5a.72.72 0 0 1-.021-.678Q1.176 7.99 3.42 5.851C5.438 3.928 7.833 3 9.963 3c2.043 0 4.223.775 6.184 2.434q2.173 1.84 3.763 4.722c.11.198.12.439.027.645c-.988 2.2-2.295 3.882-3.921 5.032C13.94 17.3 11.749 18 9.999 18m.234-3.6a3.7 3.7 0 1 1 0-7.4a3.7 3.7 0 0 1 0 7.4m0-1.4a2.3 2.3 0 1 0 0-4.6a2.3 2.3 0 0 0 0 4.6"/></svg>
                    </div>
                    <small class="error"></small>
                </div>
            </div>
            <div class="bottom-section">
                <div class="bottom-section-01">
                    <input id="submit_button" type="submit" value="Login"/>
                </div>
                <div class="bottom-section-02">
                    <div>
                        <a class="forgot-password" href="{{url('forgot-password')}}">
                            Forgot Password?
                        </a>
                    </div>
                    <div>
                        Don't have an account? <span><a href="{{url('blogger-register')}}">Sign up...</a></span>
                    </div>
                </div>
            </div>
        </form>
   </div>
   <script src="{{asset('js/login-validation.js')}}"></script>
   <script src="{{asset('js/input-validation.js')}}"></script>
   <script>
        $(document).ready(function(){
            $('.login-form').on('submit', function(e){
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url:"{{url('login')}}",
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData: false,
                    success:function(response){
                        if(response.status){
                            toastr.success(response.message);

                            $('.login-form')[0].reset();

                            $('.error').text('');

                            setTimeout(function(){
                                window.location.href = response.redirect_url;
                            }, 1000);
                        }
                    },
                    error:function(error){
                        if(error.status === 422){
                            let errors = error.responseJSON.errors;

                            $('.error').text('');

                            for (let field in errors) {
                                let $field = $('[name="'+field+'"]');

                                if(field === 'password') {
                                    $field.closest('.password_field').find('.error').text(errors[field][0]);
                                } else {
                                    $field.next('.error').text(errors[field][0]);
                                }
                            }
                        }  else {
                            $('.error').text('');
                            let errMsg = 'Something went wrong';
                            if(error.responseJSON && error.responseJSON.message){
                                errMsg = error.responseJSON.message;
                            }
                            toastr.error(errMsg);
                        }
                    }
                })
            })
        })
   </script>
@endsection