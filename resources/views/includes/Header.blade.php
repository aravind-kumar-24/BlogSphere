<link rel="stylesheet" href="{{asset('css/header.css')}}">

<div class="header-container">
    <div class="header-section-01">
        BlogSphere
    </div>
    <div class="header-section-02">
        @if (auth()->user()->user_type == '2')
            <div>
                Home
            </div>
            <div>
                About us
            </div>
            <div>
                Contact
            </div>
        @endif
    </div>
    <div class="header-section-03">
        @guest
            <div class="header-login-button">
                <a href="{{url('/blogger-login')}}">
                    Login
                </a>
            </div>
            <div class="header-register-button">
                <a href="{{url('/blogger-register')}}">
                    Register
                </a>
            </div>
        @endguest 
        @auth
            <div class="header-menu-options">
                <svg class="header-menu-btn" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24">
                    <g fill="none">
                        <path d="m12.593 23.258l-.011.002l-.071.035l-.02.004l-.014-.004l-.071-.035q-.016-.005-.024.005l-.004.01l-.017.428l.005.02l.01.013l.104.074l.015.004l.012-.004l.104-.074l.012-.016l.004-.017l-.017-.427q-.004-.016-.017-.018"/>
                        <path fill="#C97C5D" d="M20 17.5a1.5 1.5 0 0 1 0 3H4a1.5 1.5 0 0 1 0-3zm0-7a1.5 1.5 0 0 1 0 3H4a1.5 1.5 0 0 1 0-3zm0-7a1.5 1.5 0 0 1 0 3H4a1.5 1.5 0 1 1 0-3z"/>
                    </g>
                </svg>

                <div class="header-dropdown-menu">
                    <ul>
                        @if (auth()->user()->user_type == '2')
                            <li><a href="{{url('/blogsphere/create-blog/create')}}">Create Blog</a></li>
                            <li class="all-blogs"><a href="{{url('/blogsphere/blogs')}}">All Blogs</a></li>
                            <li class="published-blogs"><a href="{{url('/blogsphere/published-blogs')}}">Published Blogs</a></li>
                            <li><a href="{{url('/blogsphere/deleted-blogs')}}">Deleted Blogs</a></li>
                        @else
                            <li><a href="{{url('/blogsphere/blogs')}}">All Blogs</a></li>
                            <li class="manage-bloggers"><a href="{{url('/blogsphere/manage-bloggers')}}">Manage Bloggers</a></li>
                            <li class="manage-blogs"><a href="{{url('/blogsphere/manage-blogs')}}">Manage Blogs</a></li>
                            <li><a href="{{url('/blogsphere/rejected-blogs')}}">Rejected Blogs</a></li>
                        @endif
                        <li class="my-profile"><a href="{{url('/blogsphere/my-profile/view')}}">My Profile</a></li>
                        <li class="change-password"><a href="{{url('/blogsphere/change-password')}}">Change Password</a></li>
                        <li><a class="logout" href="#">Logout</a></li>
                    </ul>
                </div>
            </div>
        @endauth
    </div>
</div>
<script>
    $(document).ready(function () {

        $(".header-menu-btn").on("click", function (e) {
            e.stopPropagation();
            $(this).siblings(".header-dropdown-menu").toggle();
        });

        $(".header-dropdown-menu").on("click", function (e) {
            e.stopPropagation();
        });

        $(document).on("click", function () {
            $(".header-dropdown-menu").hide();
        });

        $('.logout').on('click', function(e){
            e.preventDefault();
            $('#loader').addClass('active');
            $.ajax({
                url:"{{url('blogsphere/logout')}}",
                type:"GET",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function(response){
                    if(response.status){
                        toastr.success(response.message);
                        $('#loader').removeClass('active');
                        window.location.href = response.redirect_url;
                    }
                },
                error: function(error){
                    $('#loader').removeClass('active');
                    let errMsg = 'Something went wrong';
                    if(error.responseJSON && error.responseJSON.message){
                        errMsg = error.responseJSON.message;
                    }
                    toastr.error(errMsg);
                }
            })
        })

    });

</script>