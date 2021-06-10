<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = Post::where('trash', false) -> get();
        $published = Post::where('trash', false) -> get() -> count();
        $trash = Post::where('trash', true) -> get() -> count();
        return view('admin.post.index', [
            'all_data'      => $data,
            'published'     => $published,
            'trash'         => $trash,
        ]);
    }


    /**
     * Post Trash
     */
    public function postTrashShow()
    {
        $data = Post::where('trash', true) -> get();
        $published = Post::where('trash', false) -> get() -> count();
        $trash = Post::where('trash', true) -> get() -> count();
        return view('admin.post.trash', [
            'all_data'      => $data,
            'published'     => $published,
            'trash'         => $trash,
        ]);
    }

    /**
     * Post Trash
     */
    public function postTrashUpdate($id)
    {
        $trash_data = Post::find($id);

        if( $trash_data -> trash == false ){
            $trash_data -> trash = true;
        }else {
            $trash_data -> trash = false;
        }

        $trash_data -> update();


        return back();

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $cat = Category::all();
        $tag = Tag::all();

        return view('admin.post.create', [
            'all_cat'       => $cat,
            'all_tag'       => $tag,
        ]);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {




       $this -> validate($request, [
           'title'      => 'required',
           'content'      => 'required',
       ]);


        $unique_file_name = '';
        if( $request -> hasFile('image') ){
            $img = $request -> file('image');
            $unique_file_name = md5(time().rand()) . '.' . $img -> getClientOriginalExtension();
            $img -> move(public_path('media/posts/'), $unique_file_name);
        }


        $gall_images = [];
        if( $request -> hasFile('post_gall') ){


            foreach( $request -> file('post_gall') as $post_gall ){
                $unique_gall_name = md5(time().rand()) .'.'. $post_gall -> getClientOriginalExtension();
                $post_gall-> move(public_path('media/posts/'), $unique_gall_name);
                array_push($gall_images, $unique_gall_name);
            }


        }



        $post_featured = [
            'post_type'          => $request -> post_type,
            'post_image'         => $unique_file_name,
            'post_gallery'       => $gall_images,
            'post_video'         => $this -> getEmbed($request -> video),
            'post_audio'         => $request -> audio,
        ];


       $post_data = Post::create([
        'title'             => $request -> title,
        'user_id'           => Auth::user() -> id,
        'slug'              =>  $this -> getSlug($request -> title),
        'featured'          => json_encode($post_featured),
        'content'           => $request -> content,
       ]);

       $post_data -> categories() -> attach($request -> cat);
       $post_data -> tags() -> attach($request -> tag);

       return redirect() -> back() -> with('success', 'Post added successful !');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Post::find($id);
        $delete_data -> delete();
        return back();
    }




}
