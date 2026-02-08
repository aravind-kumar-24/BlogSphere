<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\BloggerRejectedMail;
use App\Mail\BlogRejectedMail;
use App\Models\Bloggers;
use App\Models\Blogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    public function all_bloggers(){

        try{
            $all_bloggers = Bloggers::where('user_type', '2')->orderBy('id', 'desc')->with(['states', 'cities'])->paginate(10);

            return view('ManageBloggers', compact('all_bloggers'));
        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }

    }

    public function bloggers_status_change($blogger_id){
        try{

            $blogger = Bloggers::where('user_id', $blogger_id)->first();

            if(!$blogger){
                return Response::json([
                    'status' => false,
                    'message' => 'Blogger not found!',
                ],404);
            }

            $updated_status = $blogger->status == 'active' ? 'inactive' : 'active';

            $blogger->status = $updated_status;
            $blogger->save();

            return Response::json([
                'status' => true,
                'message' => 'Blogger Status Updated successfully!',
            ],200);

        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function delete_blogger($blogger_id){
        try{

            $blogger = Bloggers::where('user_id', $blogger_id)->first();

            $email_id = $blogger->email_id;

            if(!$blogger){
                return Response::json([
                    'status' => false,
                    'message' => 'Blogger not found!',
                ],404);
            }

            $blogger->status = 'rejected';
            $blogger->deleted_at = now();
            $blogger->save();

            //For testing purpose
            $email_id = 'aravindmpkas@gmail.com';
            $blogger_name = $blogger->first_name . ' ' . $blogger->last_name;

            try{
                Mail::to($email_id)->send(new BloggerRejectedMail($blogger_name));
            }catch(\Exception $e){
                Log::error("Failed to send blogger rejected mail: " . $e->getMessage());
            }

            return Response::json([
                'status' => true,
                'message' => 'Blogger Deleted successfully!',
            ],200);

        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function manage_blogs(){
        try{
            $all_blogs = Blogs::with('categories')->orderBy('id', 'desc')->paginate(5);

            return view('ManageBlogs', compact('all_blogs'));
        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function reject_blogs($blog_id){
        try{

            $blog = Blogs::where('blog_id', $blog_id)->with('bloggers')->first();

            $email_id = $blog->email_id;

            if(!$blog){
                return Response::json([
                    'status' => false,
                    'message' => 'Blog not found!',
                ],404);
            }

            $blog->status = 'inactive';
            $blog->deleted_at = now();
            $blog->save();

            $blog_name = $blog->blog_name;
            $blogger_name = $blog->bloggers->first_name .' '.$blog->bloggers->last_name;

            try{
                Mail::to($email_id)->send(new BlogRejectedMail($blog_name, $blog_id, $blogger_name));
            }catch(\Exception $e){
                Log::error("Failed to send blog rejected mail: " . $e->getMessage());
            }

            return Response::json([
                'status' => true,
                'message' => 'Blog Rejected successfully!',
            ],200);

        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }
}
