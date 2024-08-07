<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function index(){ 
        $blogs =Blog::paginate(5);
        return view('blog', compact('blogs'));
    }
    function about(){
        $name = "Chayanon Muadsong";
        $date = "23/7/2566";
        return view('about', compact('name', 'date'));
    }
    function create(){
        return view('form');
    }
    function insert(Request $request){
        $request->validate([
            'title'=>'required|max:50',
            'content'=>'required',
        ],
        [
            'title.required'=>'Please enter the title of the article.',
            'title.max'=>'Article title must exceed 50 characters.',
            'content.required'=>'Please enter content'
        ]  
    );
      $data=[
        'title'=>$request->title,
        'content'=>$request->content
      ];
      DB::table('blogs')->insert($data);
      return redirect('/author/blog');
    }
    function delete($id){
        Blog::find($id)->delete();
        return redirect('/author/blog');
    }
    function change($id){
        $blog=Blog::find($id);
        $data=[
            'status'=>!$blog->status
        ];
        $blog=DB::table('blogs')->where('id',$id)->update($data);
        return redirect()->back();
    }
    function edit($id){
        $blog=Blog::find($id);
        return view('edit',compact('blog'));
    }
    function update(Request $request,$id){
        $request->validate([
            'title'=>'required|max:50',
            'content'=>'required',
        ],
        [
            'title.required'=>'กรุณาป้อนชื่อบทความ',
            'title.max'=>'ชื่อบทความเกิน 50 ตัวอักษร',
            'content.required'=>'กรุณาป้อนเนื้อหา'
        ]  
    );
    $data=[
        'title'=>$request->title,
        'content'=>$request->content
      ];
      Blog::find($id)->update($data);
      return redirect('/author/blog');
}
}