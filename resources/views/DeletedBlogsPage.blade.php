@extends('layouts.MainLayout')

@section('content')

@include('includes.Header')

@php
    use Illuminate\Support\Str;
@endphp

<link rel="stylesheet" href="{{asset('css/deleted_blogs.css')}}">

<div class="deleted-blogs-container">
    <div class="page-title">
        Deleted Blogs
    </div>
    @if ($deleted_blogs->count() == 0)
        <div class="no-record">
            No Blogs Deleted
        </div>
    @else
        <div class="deleted">
            @foreach ($deleted_blogs as $blogs)
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
                    </div>
                </div>
            @endforeach
        </div>
        <div class="pagination-container">
            {{ $deleted_blogs->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
<script>
    $('.read-more').on('click', function(e){

        e.preventDefault();

        let blog_description = $(this).data('description');

        Swal.fire({
            title: 'Blog Description',
            text: blog_description,
            confirmButtonColor: '#C97C5D',
        })
    })
</script>
@endsection