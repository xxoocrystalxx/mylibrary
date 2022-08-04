<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class BlogController extends Controller
{
    public function AllBlog()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.blog_all', compact('blogs'));
    }

    public function AddBlog()
    {
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blog_add', compact('categories'));
    }

    public function StoreBlog(Request $request)
    {
        $image = $request->file('blog_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(430, 327)->save('upload/blog/' . $name_gen);
        $save_url = 'upload/blog/' . $name_gen;

        Blog::insert([
            'blog_category_id' => $request->blog_category_id,
            'blog_title' => $request->blog_title,
            'blog_image' => $save_url,
            'blog_description' => $request->blog_description,
            'blog_tags' => $request->blog_tags,
            'created_at' => Carbon::now()
        ]);

        $notification = array('message' => 'Blog inserted successfully', 'alert-type' => 'success');

        return redirect()->route('all.blog')->with($notification);
    }

    public function EditBlog($id)
    {
        $blog = Blog::findorFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        return view('admin.blogs.blog_edit', compact('blog', 'categories'));
    }

    public function UpdateBlog(Request $request)
    {
        $blog_id = $request->id;

        if ($request->file('blog_image')) {
            // unlink($request->image);
            $image = $request->file('blog_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(430, 327)->save('upload/blog/' . $name_gen);
            $save_url = 'upload/blog/' . $name_gen;
            Blog::findorFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_image' => $save_url,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
            ]);
            $notification = array('message' => 'Blog Updated Successfully', 'alert-type' => 'success');
        } else {
            Blog::findorFail($blog_id)->update([
                'blog_category_id' => $request->blog_category_id,
                'blog_title' => $request->blog_title,
                'blog_description' => $request->blog_description,
                'blog_tags' => $request->blog_tags,
            ]);
            $notification = array('message' => 'Blog Updated without Image Successfully', 'alert-type' => 'success');
        } //end Else
        return redirect()->route('all.blog')->with($notification);
    }

    public function DeleteBlog($id)
    {
        $blog = Blog::findorFail($id);
        $img = $blog->blog_image;
        unlink($img);
        Blog::findorFail($id)->delete();
        $notification = array('message' => 'Blog Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function BlogDetails($id)
    {
        $allblogs = Blog::latest()->limit(5)->get();
        $blog = Blog::findorFail($id);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('frotend.blog_details', compact('blog', 'allblogs', 'categories'));
    }

    public function CategoryBlog($id)
    {
        $blogpost = Blog::where('blog_category_id', $id)->orderBy('id', 'DESC')->get();
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();
        $allblogs = Blog::latest()->limit(5)->get();
        $categoryname =
            BlogCategory::findorFail($id);

        return view('frotend.cat_blog_details', compact('blogpost', 'categories', 'allblogs', 'categoryname'));
    }

    public function HomeBlog()
    {
        $allblogs
            = Blog::latest()->paginate(3);
        $categories = BlogCategory::orderBy('blog_category', 'ASC')->get();

        return view('frotend.blog', compact('allblogs', 'categories'));
    }
}
