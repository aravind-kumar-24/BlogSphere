$(document).ready(function(){

    $('#email_id').on('input', function(){
        let email_id = input_value_restrictions($(this).val(), 'email_id');

        $(this).val(email_id);
    })

    $('#password').on('input', function(){
        let password = input_value_restrictions($(this).val(), 'password');
        $(this).val(password);
    })

    $('.password-eye-open').on('click', function(){
        let password_type = $('#password').attr('type')

        if(password_type == 'password'){
            $('#password').attr('type', 'text');
            $(this).empty();
            $(this).append('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#C97C5D" d="M11.83 9L15 12.16V12a3 3 0 0 0-3-3zm-4.3.8l1.55 1.55c-.05.21-.08.42-.08.65a3 3 0 0 0 3 3c.22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53a5 5 0 0 1-5-5c0-.79.2-1.53.53-2.2M2 4.27l2.28 2.28l.45.45C3.08 8.3 1.78 10 1 12c1.73 4.39 6 7.5 11 7.5c1.55 0 3.03-.3 4.38-.84l.43.42L19.73 22L21 20.73L3.27 3M12 7a5 5 0 0 1 5 5c0 .64-.13 1.26-.36 1.82l2.93 2.93c1.5-1.25 2.7-2.89 3.43-4.75c-1.73-4.39-6-7.5-11-7.5c-1.4 0-2.74.25-4 .7l2.17 2.15C10.74 7.13 11.35 7 12 7"/></svg>')
        }else{
            $('#password').attr('type', 'password');
            $(this).empty();
            $(this).append('<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="#C97C5D" d="M5.09 14.781c1.749 1.368 3.219 1.806 4.91 1.806c1.471 0 3.391-.613 5.238-1.919c1.332-.942 2.433-2.315 3.3-4.13q-1.41-2.447-3.263-4.013c-1.71-1.448-3.582-2.112-5.312-2.112c-1.79 0-3.85.798-5.608 2.474q-1.898 1.81-2.88 3.638q1.598 2.682 3.614 4.256M10 18c-1.974 0-3.735-.525-5.741-2.094q-2.365-1.85-4.164-5a.72.72 0 0 1-.021-.678Q1.176 7.99 3.42 5.851C5.438 3.928 7.833 3 9.963 3c2.043 0 4.223.775 6.184 2.434q2.173 1.84 3.763 4.722c.11.198.12.439.027.645c-.988 2.2-2.295 3.882-3.921 5.032C13.94 17.3 11.749 18 9.999 18m.234-3.6a3.7 3.7 0 1 1 0-7.4a3.7 3.7 0 0 1 0 7.4m0-1.4a2.3 2.3 0 1 0 0-4.6a2.3 2.3 0 0 0 0 4.6"/></svg>')
        }
    })


})