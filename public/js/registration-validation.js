$(document).ready(function(){
    
    $('#first_name').on('input', function(){

        let first_name = input_value_restrictions($(this).val(), 'first_name');

        $(this).val(first_name);
    })

    $('#last_name').on('input', function(){

        let last_name = input_value_restrictions($(this).val(), 'last_name');

        $(this).val(last_name);
    })

    $('#user_name').on('input', function(){

        let user_name = input_value_restrictions($(this).val(), 'user_name');

        $(this).val(user_name);
    })

    $('#profession').on('input', function(){
        let profession = input_value_restrictions($(this).val(), 'profession');
        $(this).val(profession);
    })

    $('#email_id').on('input', function(){
        let email_id = input_value_restrictions($(this).val(), 'email_id');
        $(this).val(email_id);
    })

    $('#contact_number').on('input', function(){
        let contact_number = input_value_restrictions($(this).val(), 'contact_number');
        $(this).val(contact_number);
    })

    $('#address').on('input', function(){
        let address = input_value_restrictions($(this).val(), 'address');
        $(this).val(address)
    })

    $('#password').on('input', function(){
        let password = input_value_restrictions($(this).val(), 'password');
        $(this).val(password)
    })

    $('#confirm_password').on('input', function(){
        let confirm_password = input_value_restrictions($(this).val(), 'confirm_password');
        $(this).val(confirm_password)
    })

})

