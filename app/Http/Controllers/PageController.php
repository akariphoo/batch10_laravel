<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Category;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth',['except'=>['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::orderBy('title','desc')->get();
        return view('post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //retrieve data from category table and send data to create.blade.php page using compact
        $categories=Category::all();
        // dd($categories);


       return view('post.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        // dd($request);title and content are name from input type
        $request->validate([
            'title'=>'required|min:5',
            'content'=>'required|min:10',
            'photo'=>'required|mimes:jpeg,png',
            'category'=>'required'
        ]);

        // files upload
        if($request->hasfile('photo'))
        {
            $photo=$request->file('photo');
            //$name=$photo->getClientOriginalName();
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/image/',$name);
            $photo='/storage/image/'.$name;
        }
        else{
            $photo='';
        }



// data insert
// post is obj and request->title, body,etc are keys from post.php and post->title,etc are columnname
        $post=new Post();
        $post->title=request('title');
        $post->body=request('content');
        $post->image=$photo;
        $post->category_id=request('category');
        $post->user_id=Auth::id();
        // $post->status=true;
        $post->save();

        // Redirect 
        return redirect()->route('fistpage');



        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find is equal condition and give data that is equal id
        $post=Post::find($id);
        //$post=Post::where('status',1)->first();

        return view('post.detail',compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::find($id);
        $categories=Category::all();
        return view('post.edit',compact('categories','post'));
        // compact('','post')=>post is to carry for old value
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
        // dd($request);
        $request->validate([
            'title'=>'required|min:5',
            'content'=>'required|min:10',
            'photo'=>'sometimes|required|mimes:jpeg,png',
            'category'=>'required'
        ]);

        // files upload
        if($request->hasfile('photo'))
        {
            $photo=$request->file('photo');
            //$name=$photo->getClientOriginalName();
            $name=time().'.'.$photo->getClientOriginalExtension();
            $photo->move(public_path().'/storage/image/',$name);
            $photo='/storage/image/'.$name;
        }
        else{
            $photo=request('oldphoto');
        }



// data update
// post is obj and request->title, body,etc are keys from post.php and post->title,etc are columnname
        //$post=new Post($id);
        $post=Post::find($id);
        $post->title=request('title');
        $post->body=request('content');
        $post->image=$photo;
        $post->category_id=request('category');
        $post->user_id=Auth::id();
        // $post->status=true;
        $post->save();

        // Redirect 
        return redirect()->route('fistpage');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        $post->delete();
        return redirect()->route('fistpage');
    }
}
