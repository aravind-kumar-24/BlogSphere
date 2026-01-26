
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

    $('#address').on('input', function(){
        let address = input_value_restrictions($(this).val(), 'address');
        $(this).val(address)
    })

    $('#state').on('change', function(){
        let state_id = $(this).val();

        load_cities(state_id);
    })

    if (oldState) {
        load_cities(oldState, oldCity);
    }

    function load_cities(state_id, selected_city = null) {
        $.ajax({
            url: '/get-cities/' + state_id,
            type: 'GET',
            dataType: 'json',
            success: function (response) {

                $('#city').empty();

                if(selected_city !== null && selected_city !== ''){
                    $('#city').append('<option value="" disabled >Select a City</option>');
                }else{
                    $('#city').append('<option value="" selected disabled >Select a City</option>');
                }

                if (response.length === 0) {
                    toastr.info('No cities available for the selected state');
                }

                $.each(response, function (key, city) {
                    let selected = (selected_city && selected_city == city.id) ? 'selected' : '';
                    $('#city').append(
                        `<option value="${city.id}" ${selected}>${city.city_name}</option>`
                    );
                });


                if (selected_city !== null && selected_city !== '') {
                    $('#city').val(String(selected_city));
                }
            },
            error: function () {
                toastr.error('Error fetching the cities');
            }
        });
    }

    $('#update_profile_pic').on('change', function(){
        let file = this.files[0];

        let file_name = file.name;
        let file_extension = file_name.split('.').pop().toLowerCase();

        let size_in_bytes = file.size;
        let size_in_mb = size_in_bytes / (1024 * 1024);

        let allowed_extensions = ['jpg', 'jpeg', 'png'];

        if(size_in_mb > 2){
            toastr.error('File size must not be greater than 2 mb');
            $(this).val('');
        }

        if(!allowed_extensions.includes(file_extension)){
            toastr.error('Invalid file type, Allowed types: jpg, jpeg, png');
            $(this).val('');
        }
    })

    $('#update_cancel_button').on('click', function(){
        const $form = $('.profile-update-form');

        $form.find('input, textarea, select').each(function () {
            $(this).val($(this).data('original'));
        });

        $form.data('type', 'view').attr('data-type', 'view');

        $form.find('input:not([type=button]):not([type=submit]), textarea, select').prop('disabled', true);

        $('#update_button, #update_cancel_button').hide();

        $('#edit_button').show();

        $('.module-title').text('Profile Page')

        if ($('#state').val()) {
            load_cities(oldState, oldCity);
        }
    })

    $('#edit_button').on('click', function(){

        const $form = $('.profile-update-form');

        $form.find('input, textarea, select').each(function () {
            $(this).data('original', $(this).val());
        });

        $form.data('type', 'update').attr('data-type', 'update');

        $form.find('input:not([type=button]):not([type=submit]), textarea, select').prop('disabled', false);

        $('#email_id').prop('disabled', true);
        $('#contact_number').prop('disabled', true);
        $('#user_name').prop('disabled', true);

        $('#edit_button').hide();

        $('#update_button, #update_cancel_button').show();

        $('.module-title').text('Update Profile')
    })

})

