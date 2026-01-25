$(document).ready(function(){

    $('#blog_name').on('input', function(){
        let blog_name = input_value_restrictions($(this).val(), 'blog_name');

        $(this).val(blog_name);
    })

    $('#blog_description').on('input', function(){
        let blog_description = input_value_restrictions($(this).val(), 'blog_description');

        $(this).val(blog_description);
    })

    $('#blog_media').on('change', function(){
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
    
})