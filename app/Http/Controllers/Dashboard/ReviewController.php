<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function WriteReview($id)
    {
        $book = Book::findorFail($id);
        $user = Auth::user();
        $review = Review::getThisReview($user->id, $id);
        return view('frotend.write_review', compact('book', 'review'));
    }

    public function StoreRating(Request $request, $id)
    {
        $request->validate([
            'rating' => "required",
        ]);

        $user = Auth::user()->id;

        Review::updateOrCreate(
            ['user_id' => $user, 'book_id' => $id],
            ['rating' => $request->rating]
        );
        $notification = array('message' => 'Rating successfully', 'alert-type' => 'success');

        return redirect()->route('book.details', $id)->with($notification);
    }

    public function StoreReview(Request $request)
    {
        $request->validate([
            'rating' => "required",
            'comment' => "required",
        ]);
        $user = Auth::user()->id;
        if ($request->comment) {
        }
        Review::updateOrCreate(
            ['user_id' => $user, 'book_id' => $request->book_id],
            ['rating' => $request->rating, 'comment' => $request->comment]
        );
        $notification = array('message' => 'Review inserted successfully', 'alert-type' => 'success');

        return redirect()->route('book.details', $request->book_id)->with($notification);
    }

    public function MyReviews()
    {
        $user = Auth::user()->id;
        $reviews = Review::with('book', 'book.author')->where('user_id', $user)->get();
        return view('frotend.my_reviews', compact('reviews', 'user'));
    }

    public function EditReview($id)
    {
        $review = Review::findorFail($id);
        return view('frotend.edit_review', compact('review'));
    }

    public function UpdateReview(Request $request, $id)
    {
        Review::findorFail($id)->update([
            'comment' => $request->comment,
            'rating' => $request->rating
        ]);
        $notification = array('message' => 'Review Updated Successfully', 'alert-type' => 'success');
        return redirect()->route('my.reviews')->with($notification);
    }

    public function DeleteReview($id)
    {
        Review::findorFail($id)->delete();
        $notification = array('message' => 'Review delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
