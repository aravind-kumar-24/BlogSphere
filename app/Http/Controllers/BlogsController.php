<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\PublishBlogRequest;
use App\Http\Requests\UpdateBlogRequest;
use App\Models\BlogCategories;
use App\Models\Blogs;
use Illuminate\Support\Facades\Auth;
use Exception;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class BlogsController extends Controller
{

    public function index($type, $blog_id = null){
        try{

            $blogger = Auth::user();

            $categories = BlogCategories::whereNull('deleted_at')->where('status', 'active')->get();

            $blog_details = null;

            if($type == 'update'){

                $blog_details = Blogs::where('blog_id', $blog_id)->where('blogger_id', $blogger->id)->where('user_id', $blogger->user_id)->first();

                if(!$blog_details){
                    return Response::json([
                        'status' => false,
                        'message' => "Blog not found!",
                    ],404);
                }

                if($blog_details->deleted_at != null && $blog_details->status == 'deleted'){
                    return Response::json([
                        'status' => false,
                        'message' => "Blog already deleted",
                    ],404);
                }
            }

            return view('CreateBlogPage', compact('categories', 'type', 'blog_details', 'blog_id'));
        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }

    public function publish_blog(PublishBlogRequest $request){
        try{

            $blog_data = $request->all();

            $blogger = Auth::user();

            $blog_existing_check = Blogs::where('blog_name', $blog_data['blog_name'])
                ->where('blogger_id', $blogger->id)
                ->where('user_id', $blogger->user_id)
                ->whereNull('deleted_at')
                ->exists();

            if($blog_existing_check){
                return Response::json([
                    'status' => false,
                    'message' => 'Blog Name already exists',
                ],409);
            }

            $blog_image_file_path = null;

            if($request->hasFile('blog_media')){
                $blog_image = $request->file('blog_media');
                $blog_image_file_name = time().'_'.uniqid().'.'.$blog_image->extension();

                $directory = public_path('blog_images');

                if(!is_dir($directory)){
                    mkdir($directory, 0755, true);
                }

                $blog_image->move($directory, $blog_image_file_name);
                $blog_image_file_path = 'blog_images/'.$blog_image_file_name;
            }

            $blog_id = 'POST'.strtoupper(substr(Str::uuid()->toString(), 0, 8));

            Blogs::create([
                'blogger_id' => $blogger->id,
                'user_id' => $blogger->user_id,
                'email_id' => $blogger->email_id,
                'blog_id' => $blog_id,
                'blog_category_id' => $blog_data['blog_category'],
                'blog_name' => $blog_data['blog_name'],
                'blog_description' => $blog_data['blog_description'],
                'blog_image' => $blog_image_file_path,
                'status' => 'active'
            ]);

            return Response::json([
                'status' => true,
                'message' => 'Blog Published successfully!',
                'redirect_url' => url('/blogsphere/published-blogs')
            ],200);

        }catch(\Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ],500);
        }
    }
    
    public function all_blogs(){
        try{

            $all_blogs = Blogs::where('status', 'active')
                ->whereNull('deleted_at')
                ->orderBy('id', 'desc')
                ->with('categories')
                ->paginate(12);
            
            return view('Blogs', compact('all_blogs'));
        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => "Something went wrong",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function published_blogs(){

        try{
            $blogger = Auth::user();

            $published_blogs = Blogs::where('blogger_id', $blogger->id)
                ->where('user_id', $blogger->user_id)
                ->where('status', 'active')
                ->whereNull('deleted_at')
                ->orderBy('id', 'desc')
                ->with('categories')
                ->paginate(12);
            
            return view('PublishedBlogsPage', compact('published_blogs'));
        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => "Something went wrong",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function deleted_blogs(){
        try{

            $blogger = Auth::user();

            $deleted_blogs = Blogs::where('blogger_id', $blogger->id)
                ->where('user_id', $blogger->user_id)
                ->where('status', 'deleted')
                ->whereNotNull('deleted_at')
                ->orderBy('id', 'desc')
                ->with('categories')
                ->paginate(12);
            
            return view('DeletedBlogsPage', compact('deleted_blogs'));

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => "Something went wrong",
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update_published_blogs(UpdateBlogRequest $request,   $blog_id){
        try{

            $data = $request->all();
            $blogger = Auth::user();

            $blog = Blogs::where('blog_id', $blog_id)->where('blogger_id', $blogger->id)->where('user_id', $blogger->user_id)->first();

            if(!$blog){
                return Response::json([
                    'status' => false,
                    'message' => "Blog not found!",
                ],404);
            }

            if($blog->deleted_at != null && $blog->status == 'deleted'){
                return Response::json([
                    'status' => false,
                    'message' => "Blog already deleted!",
                ],404);
            }

            $blog_name_duplicate_check = Blogs::where('blog_name', $data['blog_name'])
                ->where('blog_id', '!=', $blog_id)
                ->where('blogger_id', $blogger->id)
                ->where('user_id', $blogger->user_id)
                ->whereNull('deleted_at')
                ->exists();

            if($blog_name_duplicate_check){
                return Response::json([
                    'status' => false,
                    'message' => "Blog Name already exists!",
                ],409);
            };

            $blog_image_file_path = null;

            if($request->hasFile('blog_media')){

                if($blog->blog_image && file_exists(public_path($blog->blog_image))){
                    unlink(public_path($blog->blog_image));
                } 

                $blog_image = $request->file('blog_media');

                $blog_image_file_name = time().'_'.uniqid().'.'.$blog_image->extension();

                $directory = public_path('blog_images');

                if(!is_dir($directory)){
                    mkdir($directory, 0755, true);
                }

                $blog_image->move($directory, $blog_image_file_name);
                $blog_image_file_path = 'blog_images/'.$blog_image_file_name;
            }

            $blog->blog_name = $data['blog_name'];
            $blog->blog_category_id = $data['blog_category'];
            $blog->blog_description = $data['blog_description'];

            if($blog_image_file_path != null){
                $blog->blog_image = $blog_image_file_path;
            };

            $blog->save();

            return Response::json([
                'status' => true,
                'message' => 'Blog Updated successfully!',
                'redirect_url' => url('/blogsphere/published-blogs')
            ],200);

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => 'Something went wrong',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete_published_blogs($blog_id){
        try{
            $blogger = Auth::user();
            $blog = Blogs::where('blog_id', $blog_id)->where('blogger_id', $blogger->id)->where('user_id', $blogger->user_id)->first();

            if(!$blog){
                return Response::json([
                    'status' => false,
                    'message' => "Blog not found!",
                ],404);
            }

            if($blog->deleted_at != null && $blog->status == 'deleted'){
                return Response::json([
                    'status' => false,
                    'message' => "Blog already deleted!",
                ],404);
            }

            $blog->status = 'deleted';
            $blog->deleted_at = now();
            $blog->save();

            return Response::json([
                'status' => true,
                'message' => 'Blog Deleted successfully!',
                'redirect_url' => url('/blogsphere/published-blogs')
            ],200);

        }catch(Exception $e){
            return Response::json([
                'status' => false,
                'message' => "Something went wrong",
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
