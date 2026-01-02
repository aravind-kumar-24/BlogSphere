@extends('layouts.MainLayout')

@section('content')
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
    <div class="registration-container">
        <form class="registration-form" method="POST" enctype="multipart/form-data" action="{{url('register')}}">
            @csrf
            <div class="top-section">
                <div class="top-section-01">
                    <div>
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name"/>
                    </div>
                    <div>
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name"/>
                    </div>
                </div>
                <div class="top-section-02">
                    <div>
                        <label for="user_name">User Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="User Name"/>
                    </div>
                    <div>
                        <label for="profession">Profession</label>
                        <input type="text" name="profession" id="profession" placeholder="Profession"/>
                    </div>
                </div>
                <div class="top-section-03">
                    <div>
                        <label for="email_id">Email ID</label>
                        <input type="text" id="email_id" name="email_id" placeholder="Email ID"/>
                    </div>
                    <div>
                        <label for="contact_number">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" placeholder="Contact Number"/>
                    </div>
                </div>
                <div class="top-section-04">
                    <div>
                        <label for="state">State</label>
                        <select name="state" id="state">
                            <option value="" disabled selected>Select a State</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}">{{$state->state_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="city">City</label>
                        <select name="city" id="city">
                            <option value="" disabled selected>Select a City</option>
                            {{-- @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->city_name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                </div>
                <div class="top-section-05">
                    <div class="gender_input">
                        <label for="gender">Gender</label>
                        <div class="gender_inputs">
                            <div>
                                <input type="radio" id="male" value="Male" name="gender"/>
                                <label for="male">Male</label>
                            </div>
                            <div>
                                <input type="radio" id="female" value="Female" name="gender"/>
                                <label for="female">Female</label>
                            </div>
                            <div>
                                <input type="radio" id="others" value="Others" name="gender"/>
                                <label for="others">Others</label>
                            </div>
                        </div>
                    </div>
                    <div class="date_of_birth_input">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth"/>
                    </div>
                </div>
                <div class="top-section-06">
                    <div>
                        <label for="address">Address</label>
                        <textarea name="address" id="address" cols="25" rows="2"></textarea>
                    </div>
                </div>
                <div class="top-section-07">
                    <div>
                        <label for="profile_pic">Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile_pic"/>
                    </div>
                </div>
                <div class="top-section-08">
                    <div>
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                    <div>
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password"/>
                    </div>
                </div>
                <div class="top-section-09">
                    <div>
                        <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions"/>
                        <label for="terms_and_conditions">Agree to the Terms & Conditions</label>
                    </div>
                </div>
            </div>
            <div class="bottom-section">
                <div class="bottom-section-01">
                    <input id="submit_button" type="submit" value="Register"/>
                    <input id="reset_button" type="reset" value="Reset"/>
                </div>
                <div class="bottom-section-02">
                    Already have an account? <span>Log in...</span>
                </div>
            </div>
        </form>
    </div>
    <script src="{{asset('js/registration-validation.js')}}"></script>
    <script src="{{asset('js/input-validation.js')}}"></script>
@endsection