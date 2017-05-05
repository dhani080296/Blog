<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use Intervention\Image\Facades\Image;
class BlogController extends BackendController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    protected $uploadPath;
    public function __construct(){
        parent::__construct();
        $this->uploadPath=public_path(config('cms.image.directory'));
    }
    public function index(Request $request)
    {   
        $onlyTrashed=false; 
        if(($status=$request->get('status'))&& $status=='trash'){
        $posts=Post::onlyTrashed()->with('category','author')->latest()->paginate($this->limit);
        $postCount=Post::onlyTrashed()->count();
        $onlyTrashed=true;
        }else if($status=='published'){
        $posts=Post::published()->with('category','author')->latest()->paginate($this->limit);
        $postCount=Post::published()->count();
          
        }else if($status=='draft'){
        $posts=Post::draft()->with('category','author')->latest()->paginate($this->limit);
        $postCount=Post::draft()->count();
        }else if($status=='scheduled'){
         $posts=Post::scheduled()->with('category','author')->latest()->paginate($this->limit);
        $postCount=Post::scheduled()->count();
        }
        else{
          $posts=Post::with('category','author')->latest()->paginate($this->limit);
        $postCount=Post::count();  
        }
        $statuslist=$this->statusList();

        return view("backend.blog.index",compact('posts','postCount','onlyTrashed','statuslist'));
    }
    private function statusList(){
        return[
        'all'=>Post::count(),
        'published'=>Post::published()->count(),
        'scheduled'=>Post::scheduled()->count(),
        'draft'=>Post::draft()->count(),
        'trash'=>Post::onlyTrashed()->count(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {   

        return view('backend.blog.create',compact('post'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\PostRequest $request)
    {
        $data= $this->handleRequest($request);
        $request->user()->posts()->create($data);
        return redirect('/backend/blog')->with('message','Your post was created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);
        return view("backend.blog.edit",compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\PostRequest $request, $id)
    {
        $post=Post::findOrFail($id);
        $oldImage=$post->image;
        $data=$this->handleRequest($request);
        $post->update($data);
        if($oldImage !== $post->image){
            $this->removeImage($oldImage);
        }
        return redirect('/backend/blog')->with('message','Your post was updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();
        return redirect('/backend/blog')->with('trash-message',['your post was moved to Trash',$id]);
    }
    public function restore($id){
        $post=Post::withTrashed()->findOrFail($id);
        $post->restore();
        return redirect()->back()->with('message','You post has been moved from the Trash');
    }
      public function forceDestroy($id){
        $post=Post::withTrashed()->findOrFail($id);
        $post->forceDelete();
        $this->removeImage($post->image);
        return redirect('/backend/blog?status=trash')->with('message','Your post has been deleted successfully');
    }
    private function handleRequest($request){
        $data=$request->all();
        if($request->hasFile('image')){
            $image=$request->file('image');
            $fileName=$image->getClientOriginalName();
            
            $destination=$this->uploadPath;
            $successUploaded=$image->move($destination,$fileName);
            if($successUploaded){
            $width=config('cms.image.thumbnail.width');
            $height=config('cms.image.thumbnail.height');
            $extension=$image->getClientOriginalExtension();
            $thumbnail=str_replace(".{$extension}", "_thumb.{$extension}",$fileName);
                Image::make($destination.'/'.$fileName)->resize($width, $height)->save($destination.'/'.$thumbnail);
            }
            $data['image']=$fileName;
        }
        return $data;
    }
    private function removeImage($image){
        if(!empty($image)){
            $imagepath=$this->uploadPath.'/'.$image;
            $extension=substr(strrchr($image,'.'),1);
            $thumbnail=str_replace(".{$extension}", "_thumb.{$extension}",$image);
            $thumbnailpath=$this->uploadPath.'/'.$thumbnail;
            if(file_exists($imagepath)) unlink($imagepath);
            if(file_exists($thumbnailpath)) unlink($thumbnailpath);
        }
    }
}