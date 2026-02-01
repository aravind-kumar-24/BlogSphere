@extends('layouts.MainLayout')

@section('content')
   <link rel="stylesheet" href="{{asset('css/forgot_password.css')}}">
   <div class="forgot-password-container">
        <form class="forgot-password-form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="module-title">
                Forgot Password ?
            </div>
            <div class="top-section">
                <div class="email_field">
                    <label for="email_id">Email ID</label>
                    <input type="text" id="email_id" name="email_id" placeholder="Enter Email ID here" value="{{old('email_id')}}" autocomplete="off"/>
                    <small class="error"></small>
                </div>
            </div>
            <div class="bottom-section">
                <div class="bottom-section-01">
                    <input id="submit_button" type="submit" value="Send"/>
                    <a id="cancel_button" href="{{url('/blogger-login')}}">Cancel</a>
                </div>
            </div>
        </form>
   </div>
   <script src="{{asset('js/login-validation.js')}}"></script>
   <script src="{{asset('js/input-validation.js')}}"></script>
   <script>
        $(document).ready(function(){
            $('.forgot-password-form').on('submit', function(e){
                e.preventDefault();

                let formData = new FormData(this);

                $('#loader').addClass('active');

                $.ajax({
                    url:"{{url('send-forgot-password-mail')}}",
                    type:"POST",
                    data:formData,
                    contentType:false,
                    processData: false,
                    success:function(response){
                        if(response.status){
                            toastr.success(response.message);

                            $('.forgot-password-form')[0].reset();

                            $('.error').text('');

                            $('#loader').removeClass('active');

                            setTimeout(function(){
                                window.location.href = response.redirect_url;
                            }, 1000);
                        }
                    },
                    error:function(error){
                        if(error.status === 422){

                            $('#loader').removeClass('active');
                            
                            let errors = error.responseJSON.errors;

                            console.log(errors.email_id);

                            $('.error').text('');
                            
                            $('.error').text(errors.email_id);

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