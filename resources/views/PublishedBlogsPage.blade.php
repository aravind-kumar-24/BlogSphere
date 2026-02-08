@extends('layouts.MainLayout')

@section('content')

@include('includes.Header')

@php
    use Illuminate\Support\Str;
@endphp

<link rel="stylesheet" href="{{asset('css/published_blogs.css')}}">

<div class="published-blogs-container">
    <div class="page-title">
        Published Blogs
    </div>
    @if ($published_blogs->count() == 0)
        <div class="no-record">
            No Blogs Published
        </div>
    @else
        <div class="published">
            @foreach ($published_blogs as $blogs)
                <div class="blog">
                    <img class="blog-image" src="{{asset($blogs->blog_image)}}" alt="">
                    <div class="blog-content">
                        <div class="blog-category">{{$blogs->categories->category_name}}</div>
                        <div class="blog-name">{{$blogs->blog_name}}</div>
                        <div class="blog-description">
                            {{ Str::limit($blogs->blog_description, 60) }}

                            @if (strlen($blogs->blog_description) > 60)
                                <a href="" class="read-more" data-description="{{$blogs->blog_description}}">Read more</a>
                            @endif
                        </div>
                        <div class="option-buttons">
                            <a class="blog-update" href="{{url('blogsphere/create-blog/update/'.$blogs->blog_id)}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" stroke="#C97C5D" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><path d="M12 3H5a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.375 2.625a1 1 0 0 1 3 3l-9.013 9.014a2 2 0 0 1-.853.505l-2.873.84a.5.5 0 0 1-.62-.62l.84-2.873a2 2 0 0 1 .506-.852z"/></g></svg>
                            </a>
                            <a class="blog-delete" href="#" data-id="{{$blogs->blog_id}}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="#C97C5D" d="m9.129 0l1.974.005c.778.094 1.46.46 2.022 1.078c.459.504.7 1.09.714 1.728h5.475a.69.69 0 0 1 .686.693a.69.69 0 0 1-.686.692l-1.836-.001v11.627c0 2.543-.949 4.178-3.041 4.178H5.419c-2.092 0-3.026-1.626-3.026-4.178V4.195H.686A.69.69 0 0 1 0 3.505c0-.383.307-.692.686-.692h5.47c.014-.514.205-1.035.554-1.55C7.23.495 8.042.074 9.129 0m6.977 4.195H3.764v11.627c0 1.888.52 2.794 1.655 2.794h9.018c1.139 0 1.67-.914 1.67-2.794zM6.716 6.34c.378 0 .685.31.685.692v8.05a.69.69 0 0 1-.686.692a.69.69 0 0 1-.685-.692v-8.05c0-.382.307-.692.685-.692m2.726 0c.38 0 .686.31.686.692v8.05a.69.69 0 0 1-.686.692a.69.69 0 0 1-.685-.692v-8.05c0-.382.307-.692.685-.692m2.728 0c.378 0 .685.31.685.692v8.05a.69.69 0 0 1-.685.692a.69.69 0 0 1-.686-.692v-8.05a.69.69 0 0 1 .686-.692M9.176 1.382c-.642.045-1.065.264-1.334.662c-.198.291-.297.543-.313.768l4.938-.001c-.014-.291-.129-.547-.352-.792c-.346-.38-.73-.586-1.093-.635z"/></svg>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="pagination-container">
            {{ $published_blogs->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
<script>
    $(document).ready(function(){
        $('.blog-delete').on('click', function(e){
            e.preventDefault();

            let blog_id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#C97C5D',
                cancelButtonColor: '#4A4A4A',
                confirmButtonText: 'Yes'
            }).then((result)=>{
                if(result.isConfirmed){

                    $('#loader').addClass('active');

                    $.ajax({
                        url: "{{url('blogsphere/published-blogs/delete')}}/" + blog_id,
                        type: 'GET',
                        dataType: 'json',
                        success:function(response){
                            console.log(response);
                            if(response.status == true){
                                toastr.success(response.message);

                                $('#loader').removeClass('active');

                                location.reload();
                            }
                        },
                        error:function(error){
                            $('#loader').removeClass('active');
                            let errMsg = 'Something went wrong';
                            if(error.responseJSON && error.responseJSON.message){
                                errMsg = error.responseJSON.message;
                            }
                            toastr.error(errMsg);
                        }
                    })
                }
            })

        })

        $('.read-more').on('click', function(e){

            e.preventDefault();

            let blog_description = $(this).data('description');

            Swal.fire({
                title: 'Blog Description',
                text: blog_description,
                confirmButtonColor: '#C97C5D',
            })
        })
    })
</script>
@endsection