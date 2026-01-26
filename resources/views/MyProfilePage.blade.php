@extends('layouts.MainLayout')


@section('content')
@include('includes.Header')

<link rel="stylesheet" href="{{asset('css/my_profile.css')}}">

<div class="profile-page">
    <div class="profile-container">
        <form class="profile-update-form" method="POST" enctype="multipart/form-data" data-type="{{$type}}">
            @csrf
            <div class="module-title">
                Profile Page
            </div>
            <div class="top-section">
                <div class="top-section-01">
                    <div>
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" value="{{old('first_name', $blogger->first_name)}}" autocomplete="off" disabled/>
                        <small class="error"></small>
                    </div>
                    <div>
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="{{old('last_name', $blogger->last_name)}}" autocomplete="off" disabled/>
                        <small class="error"></small>
                    </div>
                </div>
                <div class="top-section-02">
                    <div>
                        <label for="user_name">User Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="User Name" value="{{$blogger->user_name}}" disabled/>
                        <small class="error"></small>
                    </div>
                    <div>
                        <label for="profession">Profession</label>
                        <input type="text" name="profession" id="profession" placeholder="Profession" value="{{old('profession', $blogger->profession)}}" autocomplete="off" disabled/>
                        <small class="error"></small>
                    </div>
                </div>
                <div class="top-section-03">
                    <div>
                        <label for="email_id">Email ID</label>
                        <input type="text" id="email_id" placeholder="Email ID" value="{{$blogger->email_id}}" disabled/>
                    </div>
                    <div>
                        <label for="contact_number">Contact Number</label>
                        <input maxlength="10" type="text" id="contact_number" placeholder="Contact Number" value="{{$blogger->contact_number}}" disabled/>
                    </div>
                </div>
                <div class="top-section-04">
                    <div>
                        <label for="state">State</label>
                        <select name="state" id="state" disabled>
                            <option value="" disabled selected>Select a State</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{(old('state', $blogger->state_id) == $state->id) ? 'selected' : ''}}>{{$state->state_name}}</option>
                            @endforeach
                        </select>
                        <small class="error"></small>
                    </div>
                    <div>
                        <label for="city">City</label>
                        <select name="city" id="city" disabled>
                            <option value="" disabled selected>Select a City</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}" {{(old('city', $blogger->city_id) == $city->id) ? 'selected' : ''}}>{{$city->city_name}}</option>
                            @endforeach
                        </select>
                        <small class="error"></small>
                    </div>
                </div>
                <div class="top-section-05">
                    <div class="gender_input">
                        <label for="gender">Gender</label>
                        <div class="gender_inputs">
                            <div>
                                <input type="radio" id="male" value="Male" name="gender" {{(old('gender', $blogger->gender) == 'Male') ? 'checked' : ''}} disabled/>
                                <label for="male">Male</label>
                            </div>
                            <div>
                                <input type="radio" id="female" value="Female" name="gender" {{(old('gender', $blogger->gender) == 'Female') ? 'checked' : ''}} disabled/>
                                <label for="female">Female</label>
                            </div>
                            <div>
                                <input type="radio" id="others" value="Others" name="gender" {{(old('gender', $blogger->gender) == 'Others') ? 'checked' : ''}} disabled/>
                                <label for="others">Others</label>
                            </div>
                        </div>
                        <small class="error"></small>
                    </div>
                    <div class="date_of_birth_input">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth', $blogger->date_of_birth)}}" max="{{date('Y-m-d')}}" disabled/>
                        <small class="error"></small>
                    </div>
                </div>
                <div class="top-section-06">
                    <div>
                        <label for="address">Address</label>
                        <textarea name="address" id="address" cols="25" rows="2" disabled>{{old('address', $blogger->address)}}</textarea>
                        <small class="error"></small>
                    </div>
                </div>
                <div class="top-section-07">
                    <label for="profile_pic">Profile Picture</label>
                    <div>
                        <div>
                            <input type="file" name="profile_pic" id="update_profile_pic" disabled/>
                            <small class="error"></small>
                        </div>
                        <div class="profile-image-preview">
                            <img class="profile-image" src="{{asset($blogger->profile_pic)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <div class="bottom-section-01">
                    <input type="button" id="edit_button" value="Edit">  
                    <input id="update_button" type="submit" value="Update" style="display:none;"/>
                    <input id="update_cancel_button" type="button" value="Cancel" style="display:none;"/>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="{{asset('js/update-profile-validation.js')}}"></script>
<script src="{{asset('js/input-validation.js')}}"></script>
<script>
    let oldState = @json(old('state', $blogger->state_id));
    let oldCity  = @json(old('city', $blogger->city_id));
</script>
<script>
    $(document).ready(function(){
        $('.profile-update-form').on('submit',function(e){
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url:"{{url('blogsphere/update-my-profile')}}",
                type:"POST",
                data:formData,
                contentType:false,
                processData: false,
                success: function(response){
                    if(response.status){
                        toastr.success(response.message);

                        $('.error').text('');

                        setTimeout(function(){
                            window.location.href = response.redirect_url;
                        }, 1000);
                    }
                },
                error: function(error){
                    if(error.status === 422){
                        let errors = error.responseJSON.errors;

                        $('.error').text('');

                        for (let field in errors) {
                            let $field = $('[name="'+field+'"]');

                            if(field === 'gender') {
                                $field.closest('.gender_input').find('.error').text(errors[field][0]);
                            }else {
                                $field.next('.error').text(errors[field][0]);
                            }
                        }
                    }  else {
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

@include('includes.Footer')
@endsection
