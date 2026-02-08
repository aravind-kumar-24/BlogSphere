@extends('layouts.MainLayout')

@section('content')

@include('includes.Header')

@php
    use Illuminate\Support\Str;
@endphp

<link rel="stylesheet" href="{{asset('css/manage_blogs.css')}}">

<div class="manage-blogs-container">
    <div class="page-title">
        Manage Blogs
    </div>
    @if ($all_blogs->count() == 0)
        <div class="no-record">
            No Blogs found!
        </div>
    @else
        <div class="blogs">
            <div class="blogs-responsive-table">
                <table class="blogs-table">
                    <thead>
                        <tr>
                            <th class="m-w-50">
                                Sl.No
                            </th>
                            <th>
                                Blogger Email ID
                            </th>
                            <th class="m-w-100">
                                Blog Name
                            </th>
                            <th class="m-w-100">
                                Blog ID
                            </th>
                            <th class="m-w-100">
                                Blog Category
                            </th>
                            <th class="m-w-100">
                                Blog Description
                            </th>
                            <th class="m-w-100">
                                Blog Image
                            </th>
                            <th class="m-w-100">
                                Reject
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_blogs as $key => $blogs)
                            <tr>
                                <td class="m-w-50">
                                    {{$key + 1}}
                                </td>
                                <td>
                                    {{$blogs->email_id}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogs->blog_name}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogs->blog_id}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogs->categories->category_name}}
                                </td>
                                <td class="m-w-100">
                                    <div class="blog-description">
                                        {{ Str::limit($blogs->blog_description, 30) }}

                                        @if (strlen($blogs->blog_description) > 30)
                                            <a href="" class="read-more" data-description="{{$blogs->blog_description}}">Read more</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="m-w-100">
                                    <div class="blog-image-preview">
                                        <img class="blog-image" src="{{asset($blogs->blog_image)}}" alt="">
                                    </div>
                                </td>
                                <td>
                                    @if($blogs->status == 'deleted')
                                        Deleted by Blogger
                                    @elseif ($blogs->status == 'inactive')
                                        Rejected
                                    @else
                                        <svg class="reject-blog" data-blog_id="{{$blogs->blog_id}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="#C97C5D" d="m9.129 0l1.974.005c.778.094 1.46.46 2.022 1.078c.459.504.7 1.09.714 1.728h5.475a.69.69 0 0 1 .686.693a.69.69 0 0 1-.686.692l-1.836-.001v11.627c0 2.543-.949 4.178-3.041 4.178H5.419c-2.092 0-3.026-1.626-3.026-4.178V4.195H.686A.69.69 0 0 1 0 3.505c0-.383.307-.692.686-.692h5.47c.014-.514.205-1.035.554-1.55C7.23.495 8.042.074 9.129 0m6.977 4.195H3.764v11.627c0 1.888.52 2.794 1.655 2.794h9.018c1.139 0 1.67-.914 1.67-2.794zM6.716 6.34c.378 0 .685.31.685.692v8.05a.69.69 0 0 1-.686.692a.69.69 0 0 1-.685-.692v-8.05c0-.382.307-.692.685-.692m2.726 0c.38 0 .686.31.686.692v8.05a.69.69 0 0 1-.686.692a.69.69 0 0 1-.685-.692v-8.05c0-.382.307-.692.685-.692m2.728 0c.378 0 .685.31.685.692v8.05a.69.69 0 0 1-.685.692a.69.69 0 0 1-.686-.692v-8.05a.69.69 0 0 1 .686-.692M9.176 1.382c-.642.045-1.065.264-1.334.662c-.198.291-.297.543-.313.768l4.938-.001c-.014-.291-.129-.547-.352-.792c-.346-.38-.73-.586-1.093-.635z"/></svg>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination-container">
            {{ $all_blogs->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
<script>
    $(document).ready(function(){

        $('.read-more').on('click', function(e){

            e.preventDefault();

            let blog_description = $(this).data('description');

            Swal.fire({
                title: 'Blog Description',
                text: blog_description,
                confirmButtonColor: '#C97C5D',
            })
        })

        $('.reject-blog').on('click', function(e){
            e.preventDefault();

            let blog_id = $(this).data('blog_id');

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to reject this Blog!",
                showCancelButton: true,
                confirmButtonColor: '#C97C5D',
                cancelButtonColor: '#4A4A4A',
                confirmButtonText: 'Yes'
            }).then((result)=>{
                if(result.isConfirmed){

                    $('#loader').addClass('active');

                    $.ajax({
                        url: "{{url('blogsphere/manage-blogs/reject-blog')}}/" + blog_id,
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
        
    });
</script>
@endsection