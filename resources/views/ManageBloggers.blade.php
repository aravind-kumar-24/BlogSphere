@extends('layouts.MainLayout')

@section('content')

@include('includes.Header')

<link rel="stylesheet" href="{{asset('css/manage_bloggers.css')}}">

<div class="manage-bloggers-container">
    <div class="page-title">
        Manage Bloggers
    </div>
    @if ($all_bloggers->count() == 0)
        <div class="no-record">
            No Bloggers found!
        </div>
    @else
        <div class="bloggers">
            <div class="bloggers-responsive-table">
                <table class="bloggers-table">
                    <thead>
                        <tr>
                            <th class="m-w-50">
                                Sl.No
                            </th>
                            <th>
                                Profile Image
                            </th>
                            <th class="m-w-100">
                                User Name
                            </th>
                            <th class="m-w-100">
                                Full Name
                            </th>
                            <th class="m-w-100">
                                Email ID
                            </th>
                            <th class="m-w-100">
                                Profession
                            </th>
                            <th class="m-w-100">
                                Contact Number
                            </th>
                            <th class="m-w-100">
                                Gender
                            </th>
                            <th class="m-w-100">
                                Address
                            </th>
                            <th class="m-w-100">
                                Status
                            </th>
                            <th class="m-w-100">
                                Delete
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($all_bloggers as $key => $blogger)
                            <tr>
                                <td class="m-w-50">
                                    {{$key + 1}}
                                </td>
                                <td>
                                    <div class="profile-image-preview">
                                        <img class="profile-image" src="{{asset($blogger->profile_pic)}}" alt="">
                                    </div>
                                </td>
                                <td class="m-w-100">
                                    {{$blogger->user_name}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogger->first_name . ' ' . $blogger->last_name}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogger->email_id}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogger->profession}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogger->contact_number}}
                                </td>
                                <td class="m-w-100">
                                    {{$blogger->gender}}
                                </td>
                                <td>
                                    <svg class="address_book" xmlns="http://www.w3.org/2000/svg" width="27" height="24" viewBox="0 0 576 512"><path fill="#C97C5D" d="M528 32H48C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48 48h480c26.5 0 48-21.5 48-48V80c0-26.5-21.5-48-48-48m-352 96c35.3 0 64 28.7 64 64s-28.7 64-64 64s-64-28.7-64-64s28.7-64 64-64m112 236.8c0 10.6-10 19.2-22.4 19.2H86.4C74 384 64 375.4 64 364.8v-19.2c0-31.8 30.1-57.6 67.2-57.6h5c12.3 5.1 25.7 8 39.8 8s27.6-2.9 39.8-8h5c37.1 0 67.2 25.8 67.2 57.6zM512 312c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8zm0-64c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8zm0-64c0 4.4-3.6 8-8 8H360c-4.4 0-8-3.6-8-8v-16c0-4.4 3.6-8 8-8h144c4.4 0 8 3.6 8 8z"/></svg>
                                </td>
                                <td>
                                    @if ($blogger->status != 'rejected' && $blogger->deleted_at == null)
                                        <label class="toggle">
                                            <input class="toggle-checkbox" type="checkbox" data-user_id="{{$blogger->user_id}}" {{$blogger->status == 'active' ? 'checked' : ''}}>
                                            <span class="toggle-switch"></span>
                                        </label>
                                    @else
                                        Rejected
                                    @endif
                                </td>
                                <td>
                                    @if ($blogger->status != 'rejected' && $blogger->deleted_at == null)
                                        <svg class="delete_blogger" data-user_id="{{$blogger->user_id}}" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 20 20"><path fill="#C97C5D" d="m9.129 0l1.974.005c.778.094 1.46.46 2.022 1.078c.459.504.7 1.09.714 1.728h5.475a.69.69 0 0 1 .686.693a.69.69 0 0 1-.686.692l-1.836-.001v11.627c0 2.543-.949 4.178-3.041 4.178H5.419c-2.092 0-3.026-1.626-3.026-4.178V4.195H.686A.69.69 0 0 1 0 3.505c0-.383.307-.692.686-.692h5.47c.014-.514.205-1.035.554-1.55C7.23.495 8.042.074 9.129 0m6.977 4.195H3.764v11.627c0 1.888.52 2.794 1.655 2.794h9.018c1.139 0 1.67-.914 1.67-2.794zM6.716 6.34c.378 0 .685.31.685.692v8.05a.69.69 0 0 1-.686.692a.69.69 0 0 1-.685-.692v-8.05c0-.382.307-.692.685-.692m2.726 0c.38 0 .686.31.686.692v8.05a.69.69 0 0 1-.686.692a.69.69 0 0 1-.685-.692v-8.05c0-.382.307-.692.685-.692m2.728 0c.378 0 .685.31.685.692v8.05a.69.69 0 0 1-.685.692a.69.69 0 0 1-.686-.692v-8.05a.69.69 0 0 1 .686-.692M9.176 1.382c-.642.045-1.065.264-1.334.662c-.198.291-.297.543-.313.768l4.938-.001c-.014-.291-.129-.547-.352-.792c-.346-.38-.73-.586-1.093-.635z"/></svg>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination-container">
            {{ $all_bloggers->links('pagination::bootstrap-4') }}
        </div>
    @endif
</div>
<script>
$(document).ready(function(){

    $('.toggle-checkbox').on('change', function () {

        let checkbox = $(this);
        let originalState = !checkbox.prop('checked'); 
        let blogger_id = checkbox.data('user_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to change the status of this Blogger!",
            showCancelButton: true,
            confirmButtonColor: '#C97C5D',
            cancelButtonColor: '#4A4A4A',
            confirmButtonText: 'Yes'
        }).then((result) => {

            if (result.isConfirmed) {

                $('#loader').addClass('active');

                $.ajax({
                    url: "{{url('blogsphere/manage-bloggers/update-bloggers-status')}}/" + blogger_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {

                        $('#loader').removeClass('active');

                        if (response.status === true) {
                            toastr.success(response.message);
                            location.reload();
                        }
                    },
                    error: function (error) {

                        $('#loader').removeClass('active');

                        let errMsg = 'Something went wrong';
                        if (error.responseJSON && error.responseJSON.message) {
                            errMsg = error.responseJSON.message;
                        }
                        toastr.error(errMsg);

                        checkbox.prop('checked', originalState);
                    }
                });

            } else {
                checkbox.prop('checked', originalState);
            }
        });
    });

    $('.delete_blogger').on('click', function(e){
        e.preventDefault();

        let blogger_id = $(this).data('user_id');

        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this Blogger!",
            showCancelButton: true,
            confirmButtonColor: '#C97C5D',
            cancelButtonColor: '#4A4A4A',
            confirmButtonText: 'Yes'
        }).then((result)=>{
            if(result.isConfirmed){

                $('#loader').addClass('active');

                $.ajax({
                    url: "{{url('blogsphere/manage-bloggers/delete-blogger')}}/" + blogger_id,
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