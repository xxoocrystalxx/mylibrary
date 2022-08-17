<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Models\MyLibrary;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function AllBook()
    {
        $books = Book::with('author')->latest()->get();
        return view('admin.book.book_all', compact('books'));
    }
    public function AddBook()
    {
        $authors = Author::orderBy('name', 'ASC')->get();
        $genres = Genre::orderBy('name', 'ASC')->get();
        return view('admin.book.book_add', compact('authors', 'genres'));
    }

    public function StoreBook(Request $request)
    {
        $book = new Book;
        $author_id = $request->author_id;
        $genres = $request->genres;

        if (ctype_digit($author_id)) { //author exists
            $book->author_id = $author_id;
        } else {
            $author = Author::create([
                'name' => $author_id,
            ]);
            $book->author_id = $author->id;
        }
        $book->title = $request->title;
        $book->description = $request->description;
        $book->date_publish = $request->date_publish;
        if ($request->file('image')) {
            $save_url = img_setup($request->file('image'), 214, 308, 'upload/book/');
            $book->image = $save_url;
        }
        $book->save();

        $genres_id = [];
        foreach ($genres as $key => $value) {
            $genre = Genre::firstOrCreate(
                ['name' => $value],
            );
            $genres_id[$key] = $genre->id;
        }

        $book->genres()->attach($genres_id);

        $notification = array('message' => 'Book inserted successfully', 'alert-type' => 'success');

        return redirect()->route('all.book')->with($notification);
    }

    public function DeleteBook($id)
    {
        $book = Book::findorFail($id);
        $book->genres()->detach();
        $img = $book->image;
        if ($img) {
            unlink($img);
        }

        $book->delete();

        $notification = array('message' => 'Book Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function EditBook($id)
    {
        $book = Book::findorFail($id);
        $authors = Author::orderBy('name', 'ASC')->get();
        $genres = Genre::orderBy('name', 'ASC')->get();
        return view('admin.book.book_edit', compact('book', 'authors', 'genres'));
    }

    public function UpdateBook(Request $request)
    {
        $book = Book::findorFail($request->id);

        if ($request->file('image')) {
            if ($book->image) {
                unlink($book->image);
            }
            $save_url = img_setup($request->file('image'), 214, 308, 'upload/book/');
            $book->update([
                'author_id' => $request->author_id,
                'title' => $request->title,
                'image' => $save_url,
                'date_publish' => $request->date_publish,
                'description' => $request->description,
            ]);
        } else {
            $book->update([
                'author_id' => $request->author_id,
                'title' => $request->title,
                'date_publish' => $request->date_publish,
                'description' => $request->description,
            ]);
        }

        $book->genres()->detach();
        $genres = Genre::find($request->genres);
        $book->genres()->attach($genres);

        $notification = array('message' => 'Book Updated  Image Successfully', 'alert-type' => 'success');
        return redirect()->route('all.book')->with($notification);
    }

    public function BookDetails($id)
    {
        $book = Book::with('author', 'genres')->findorFail($id);
        $author_books = Author::with('books')->find($book->author_id)->books()->where('id', '!=', $book->id)->get();
        $user = Auth::user();
        $review = $user ? Review::getThisReview($user->id, $book->id) : null;
        $list = $user ? MyLibrary::getThisList($user->id, $book->id) : null;
        $reviews = Review::with('user')->where('book_id', $book->id)->get();

        return view('frotend.book_details', compact('book', 'author_books', 'user', 'review', 'list', 'reviews'));
    }

    public function BookRank()
    {
        $user = Auth::user();
        $books = Book::orderByRating()->get();

        return view('frotend.book_rank', compact('books', 'user'));
    }

    public function SearchList(Request $request)
    {
        $user = Auth::user();
        $value = $request->q;
        $books = Book::with('author', 'genres')->where('books.title', 'ILIKE', "%{$value}%")->orWhereHas('author', function ($q) use ($value) {
            $q->where('name', 'ILIKE', "%{$value}%");
        })->get();

        return view('frotend.search_result', compact('books', 'value', 'user'));
    }
}
