<?php

namespace App\Http\Controllers\BackOffice;

use Api;
use App\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class BlogController extends Controller
{
    protected $page;
    protected $api;
    public function __construct()
    {
        $this->api = new Api;
        $this->page = 'backoffice.pages.blog.';
    }
    public function index()
    {
        $blogs = Blog::with('user')->get();
        return view($this->page . 'index', compact('blogs'));
    }
    public function create()
    {
        return view($this->page . 'create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5',
            'content' => 'required|min:75'
        ]);
        $blog = new Blog();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->publish_date = Carbon::now();
        $blog->user_id = Auth::user()->id;
        if ($blog->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success Create Post!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot Create Post!
            </div>');
        }
        return redirect()->route('backoffice.blog');
    }
    public function update(Request $request)
    {
        $blog = Blog::find($request->post_id);
        $blog->title = $request->title;
        $blog->content = $request->content;
        if ($blog->save()) {
            $request->session()->flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success updated Post!
            </div>');
        } else {
            $request->session()->flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot updated Post!
            </div>');
        }
        return redirect()->route('backoffice.blog');
    }
    public function edit($id)
    {
        $blog = Blog::find($id);
        return view($this->page . 'edit', compact('blog'));
    }
    public function delete($id)
    {
        $blog = Blog::find($id);
        if ($blog->delete()) {
            Session::flash('status', '<div class="alert alert-primary mb-2" role="alert">
            <strong>Success!</strong> Success deleted Post!
            </div>');
        } else {
            Session::flash('status', '<div class="alert alert-danger mb-2" role="alert">
            <strong>Error!</strong> Cannot deleted Post!
            </div>');
        }
        return redirect()->route('backoffice.blog');
    }
}
