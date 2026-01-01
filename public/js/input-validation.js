function input_value_restrictions(inputValue, inputName){

    if(inputName == 'user_name' || inputName == 'email_id' || inputName == 'password' || inputName == 'confirm_password'){
        /*
            Allows: Special characters, strings, numbers
            Restricts: Empty spaces 
        */

        inputValue = inputValue.replace(/\s/g, '');
        
    }else if(inputName == 'contact_number'){
        /*
            Allows: Numbers
            Restricts: Special characters, strings, Empty spaces
        */

        inputValue = inputValue.replace(/\D/g, '');

    }else{
        /*
            Allows: Special characters, strings, numbers
            Restricts: Empty spaces at the beginning
        */

        inputValue = inputValue.replace(/^\s+/, '');
    
        /*
            Allows: Special characters, strings, numbers, one empty space in the middle
        */

        inputValue = inputValue.replace(/\s+$/g, ' ');
    
        if(inputName == 'first_name' || inputName == 'last_name' || inputName == 'profession'){
            /*
                Allows: strings 
                Restricts: Empty spaces at the beginning, Special characters, numbers
            */

            inputValue = inputValue.replace(/[^A-Za-z\s]/g, '');

        }
    }

    return inputValue;
}