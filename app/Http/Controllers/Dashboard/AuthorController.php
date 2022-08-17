<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
    public function AllAuthor()
    {
        $authors = Author::latest()->get();
        return view('admin.author.author_all', compact('authors'));
    }

    public function AddAuthor()
    {
        return view('admin.author.author_add');
    }

    public function StoreAuthor(Request $request)
    {
        Author::insert([
            'name' => $request->name,
            'born' => $request->born,
        ]);

        $notification = array('message' => 'Author inserted successfully', 'alert-type' => 'success');

        return redirect()->route('all.author')->with($notification);
    }

    public function UpdateAuthor(Request $request, $id)
    {

        $request->validate([
            'name' => "required",
        ]);

        Author::findorFail($id)->update([
            'name' => $request->name,
            'born' => $request->born,
        ]);
    }

    public function DeleteAuthor($id)
    {
        Author::findorFail($id)->delete();
        $notification = array('message' => 'Author Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function AuthorList()
    {
        $authors = Author::orderBy('name', 'ASC')->get();
        return view('frotend.author_list', compact('authors'));
    }

    public function AuthorDetails($id)
    {
        $author = Author::with('books', 'books.author')->findorFail($id);
        $authorbooks = $author->books()->latest()->limit(5)->get();
        $user = Auth::user();
        return view('frotend.author_details', compact('author', 'user', 'authorbooks'));
    }
}
