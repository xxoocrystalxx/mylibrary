<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GenreController extends Controller
{
    public function AllGenre()
    {
        $genres = Genre::latest()->get();
        return view('admin.genre.genre_all', compact('genres'));
    }

    public function AddGenre()
    {
        return view('admin.genre.genre_add');
    }

    public function StoreGenre(Request $request)
    {
        Genre::insert([
            'name' => $request->name,
        ]);

        $notification = array('message' => 'Genre inserted successfully', 'alert-type' => 'success');

        return redirect()->route('all.genre')->with($notification);
    }

    public function UpdateGenre(Request $request, $id)
    {
        Genre::findorFail($id)->update([
            'name' => $request->value,
        ]);
    }

    public function DeleteGenre($id)
    {
        Genre::findorFail($id)->delete();
        $notification = array('message' => 'Genre Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function GenreDetails($id)
    {
        $genre = Genre::with('books', 'books.author')->findorFail($id);
        $genrebooks = $genre->books()->latest()->limit(5)->get();
        $user = Auth::user();
        return view('frotend.genre_details', compact('genre', 'genrebooks', 'user'));
    }

    public function GenreList()
    {
        $genres = Genre::orderBy('name', 'ASC')->get();
        return view('frotend.genre_list', compact('genres'));
    }
}
