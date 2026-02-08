@extends('layouts.MainLayout')

@section('content')

@include('includes.Header')

<link rel="stylesheet" href="{{asset('css/create_blog.css')}}">

<div class="create-blog-container">
    <div class="create-blog-form-container">

        <form class="{{$type == 'update' ? 'update-blog-form' : 'create-blog-form'}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="top-section">

                <div class="title">
                    @if ($type == 'update')
                        Update your Blog here...
                    @else
                        Create your Blog here...
                    @endif
                </div>

                <div class="blog-name">
                    <label for="blog_name">Blog Name</label>
                    <input type="text" id="blog_name" name="blog_name" value="{{ $type == 'update' ? $blog_details->blog_name : old('blog_name')}}" autocomplete="off" placeholder="Enter Blog Name">
                    <small class="error"></small>
                </div>

                <div class="blog-category">
                    <label for="blog_category">Blog Category</label>
                    <select name="blog_category" id="blog_category">
                        <option value="" disabled selected>Select a Category</option>
                        @foreach ($categories as $category )
                            <option value="{{$category->id}}" {{ ($type == 'update' ? $blog_details->blog_category_id : old('blog_category')) == $category->id ? 'selected' : ''}}>{{$category->category_name}}</option>
                        @endforeach
                    </select>
                    <small class="error"></small>
                </div>

                <div class="blog-description">
                    <label for="blog_description">Blog Description</label>
                    <textarea name="blog_description" id="blog_description" cols="25" rows="2" placeholder="Enter Blog Description">{{ $type == 'update' ? $blog_details->blog_description :old('blog_description')}}</textarea>
                    <small class="error"></small>
                </div>

                <div class="blog-media">
                    <label for="blog_media">Blog Image</label>
                    <input type="file" name="blog_media" id="blog_media">
                    <small class="error"></small>
                </div>
                
                @if ($type == 'update')
                    <div class="blog-image-preview">
                        <img class="image-preview" src="{{asset($blog_details->blog_image)}}" alt="">
                    </div>
                @endif
                
            </div>
            <div class="bottom-section">
                <div class="bottom-section-01">
                    <input id="publish_blog" type="submit" value="{{$type == 'update' ? 'Update' : 'Publish'}}"/>
                    @if ($type == 'update')
                        <a id="cancel_update" href="{{url('/blogsphere/published-blogs')}}">Cancel</a>
                    @else
                        <input id="reset_blog" type="reset" value="Reset">
                    @endif
                </div>
            </div>
        </form>

    </div>
</div>
<script src="{{asset('js/create-blog-validation.js')}}"></script>
<script src="{{asset('js/input-validation.js')}}"></script>
<script>
    $(document).ready(function(){

        const $form = $('.create-blog-form-container form');
        const isUpdate = $form.hasClass('update-blog-form');

        $('.create-blog-container').css(
            'height',
            isUpdate ? '700px' : '650px'
        )

        $form.on('submit', function(e){
            
            e.preventDefault();
            
            let formData = new FormData(this);

            $('#loader').addClass('active');

            let url = isUpdate 
                ? "{{url('blogsphere/published-blogs/update')}}/{{$blog_id}}"
                : "{{url('blogsphere/publish-blog')}}";

            $.ajax({
                
                url:url,
                type:"POST",
                data:formData,
                contentType:false,
                processData: false,
                success: function(response){
                    if(response.status == true){
                        toastr.success(response.message);

                        if(!isUpdate){
                            $form[0].reset();
                            $('select').prop('selectedIndex', 0);
                        }

                        $('.error').text('');

                        $('#loader').removeClass('active');

                        setTimeout(function(){
                            window.location.href = response.redirect_url;
                        }, 1000);
                    }
                },
                error: function(error){
                    $('#loader').removeClass('active');
                    console.log(error);
                    if(error.status === 422){

                        let errors = error.responseJSON.errors;

                        $('.error').text('');

                        for (let field in errors) {
                            let $field = $('[name="'+field+'"]');
                            
                            $field.next('.error').text(errors[field][0]);
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
        });

        $('#reset_blog').on('click', function() {
            $('.error').text(''); 
            $('select').prop('selectedIndex', 0); 
        });
    })
</script>
@endsection