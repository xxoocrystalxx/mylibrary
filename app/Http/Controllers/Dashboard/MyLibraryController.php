<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\MyLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyLibraryController extends Controller
{
    public function StoreLibrary(Request $request)
    {
        $user = Auth::user()->id;
        MyLibrary::updateOrCreate(
            ['user_id' => $user, 'book_id' => $request->book_id],
            ['status' => $request->status]
        );

        $notification = array('message' => 'Updated successfully', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function MyLibrary()
    {
        $user = Auth::user()->id;
        $mylibrary = MyLibrary::with('book', 'book.author', 'book.genres')->where('user_id', $user)->get();
        return view('frotend.my_library', compact('user', 'mylibrary'));
    }

    public function DeleteReadingBook($id)
    {
        MyLibrary::findorFail($id)->delete();
        $notification = array('message' => 'Book delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
