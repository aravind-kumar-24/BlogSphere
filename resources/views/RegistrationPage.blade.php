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
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" value="{{old('first_name')}}"/>
                        @error('first_name')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" value="{{old('last_name')}}"/>
                        @error('last_name')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-02">
                    <div>
                        <label for="user_name">User Name</label>
                        <input type="text" id="user_name" name="user_name" placeholder="User Name" value="{{old('user_name')}}"/>
                        @error('user_name')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="profession">Profession</label>
                        <input type="text" name="profession" id="profession" placeholder="Profession" value="{{old('profession')}}"/>
                        @error('profession')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-03">
                    <div>
                        <label for="email_id">Email ID</label>
                        <input type="text" id="email_id" name="email_id" placeholder="Email ID" value="{{old('email_id')}}"/>
                        @error('email_id')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="contact_number">Contact Number</label>
                        <input maxlength="10" type="text" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{old('contact_number')}}"/>
                        @error('contact_number')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-04">
                    <div>
                        <label for="state">State</label>
                        <select name="state" id="state">
                            <option value="" disabled selected>Select a State</option>
                            @foreach($states as $state)
                                <option value="{{$state->id}}" {{(old('state') == $state->id) ? 'selected' : ''}}>{{$state->state_name}}</option>
                            @endforeach
                        </select>
                        @error('state')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                    <div>
                        <label for="city">City</label>
                        <select name="city" id="city">
                            <option value="" disabled selected>Select a City</option>
                        </select>
                        @error('city')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-05">
                    <div class="gender_input">
                        <label for="gender">Gender</label>
                        <div class="gender_inputs">
                            <div>
                                <input type="radio" id="male" value="Male" name="gender" {{(old('gender') == 'Male') ? 'checked' : ''}}/>
                                <label for="male">Male</label>
                            </div>
                            <div>
                                <input type="radio" id="female" value="Female" name="gender" {{(old('gender') == 'Female') ? 'checked' : ''}}/>
                                <label for="female">Female</label>
                            </div>
                            <div>
                                <input type="radio" id="others" value="Others" name="gender" {{(old('gender') == 'Others') ? 'checked' : ''}}/>
                                <label for="others">Others</label>
                            </div>
                        </div>
                        @error('gender')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="date_of_birth_input">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{old('date_of_birth')}}" max="{{date('Y-m-d')}}"/>
                        @error('date_of_birth')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-06">
                    <div>
                        <label for="address">Address</label>
                        <textarea name="address" id="address" cols="25" rows="2">{{old('address')}}</textarea>
                        @error('address')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-07">
                    <div>
                        <label for="profile_pic">Profile Picture</label>
                        <input type="file" name="profile_pic" id="profile_pic"/>
                        @error('profile_pic')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-08">
                    <div class="password_field">
                        <label for="password">Password</label>
                        <div class="password_input">
                            <input maxlength="10" type="password" name="password" id="password" placeholder="Password"/>
                            <svg class="password-eye-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="#C97C5D" d="M5.09 14.781c1.749 1.368 3.219 1.806 4.91 1.806c1.471 0 3.391-.613 5.238-1.919c1.332-.942 2.433-2.315 3.3-4.13q-1.41-2.447-3.263-4.013c-1.71-1.448-3.582-2.112-5.312-2.112c-1.79 0-3.85.798-5.608 2.474q-1.898 1.81-2.88 3.638q1.598 2.682 3.614 4.256M10 18c-1.974 0-3.735-.525-5.741-2.094q-2.365-1.85-4.164-5a.72.72 0 0 1-.021-.678Q1.176 7.99 3.42 5.851C5.438 3.928 7.833 3 9.963 3c2.043 0 4.223.775 6.184 2.434q2.173 1.84 3.763 4.722c.11.198.12.439.027.645c-.988 2.2-2.295 3.882-3.921 5.032C13.94 17.3 11.749 18 9.999 18m.234-3.6a3.7 3.7 0 1 1 0-7.4a3.7 3.7 0 0 1 0 7.4m0-1.4a2.3 2.3 0 1 0 0-4.6a2.3 2.3 0 0 0 0 4.6"/></svg>
                        </div>
                        @error('password')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                    <div class="confirm_password_field">
                        <label for="confirm_password">Confirm Password</label>
                        <div class="confirm_password_input">
                            <input maxlength="10" type="password" name="password_confirmation" id="confirm_password" placeholder="Confirm Password"/>
                            <svg class="confirm-password-eye-open" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 20 20"><path fill="#C97C5D" d="M5.09 14.781c1.749 1.368 3.219 1.806 4.91 1.806c1.471 0 3.391-.613 5.238-1.919c1.332-.942 2.433-2.315 3.3-4.13q-1.41-2.447-3.263-4.013c-1.71-1.448-3.582-2.112-5.312-2.112c-1.79 0-3.85.798-5.608 2.474q-1.898 1.81-2.88 3.638q1.598 2.682 3.614 4.256M10 18c-1.974 0-3.735-.525-5.741-2.094q-2.365-1.85-4.164-5a.72.72 0 0 1-.021-.678Q1.176 7.99 3.42 5.851C5.438 3.928 7.833 3 9.963 3c2.043 0 4.223.775 6.184 2.434q2.173 1.84 3.763 4.722c.11.198.12.439.027.645c-.988 2.2-2.295 3.882-3.921 5.032C13.94 17.3 11.749 18 9.999 18m.234-3.6a3.7 3.7 0 1 1 0-7.4a3.7 3.7 0 0 1 0 7.4m0-1.4a2.3 2.3 0 1 0 0-4.6a2.3 2.3 0 0 0 0 4.6"/></svg>
                        </div>
                        @error('password_confirmation')
                            <small class="error">{{$message}}</small>
                        @enderror
                    </div>
                </div>
                <div class="top-section-09">
                    <div>
                        <input type="checkbox" id="terms_and_conditions" name="terms_and_conditions" {{old('terms_and_conditions') ? 'checked' : ''}}/>
                        <label for="terms_and_conditions">Agree to the Terms & Conditions</label>
                        @error('terms_and_conditions')
                            <small class="error">{{$message}}</small>
                        @enderror
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
    <script>
        let oldState = "{{ old('state') }}";
        let oldCity  = "{{ old('city') }}";
    </script>

@endsection

