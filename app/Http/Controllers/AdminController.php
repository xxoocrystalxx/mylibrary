<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array('message' => 'User Logout Successfully', 'alert-type' => 'success');

        return redirect('/')->with($notification);
    } // End Method

    public function Profile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.profile.profile_view', compact('adminData'));
    } // End Method

    public function EditProfile()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.profile.profile_edit', compact('editData'));
    }

    public function StoreProfile(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;
        if ($request->file('profile_image')) {
            $file = $request->file('profile_image');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array('message' => 'Profile Updated Successfully', 'alert-type' => 'success');

        return redirect()->route('admin.profile')->with($notification);
    } // End Method

    public function ChangePassword()
    {
        return view('admin.profile.change_password');
    } //End Method

    public function UpdatePassword(Request $request)
    {
        $request->validate(([
            'oldpassword' => 'required',
            'newpassword' => 'required',
            'confirm_password' => 'required|same:newpassword',
        ]));
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->oldpassword, $hashedPassword)) {
            $users = User::find(Auth::id());
            $users->password = bcrypt($request->newpassword);
            $users->save();
            session()->flash('message', 'Password Updated Successfully');
            return redirect()->back();
        } else {
            session()->flash('message', 'Old Password is not match');
            return redirect()->back();
        }
    } //End Method

    public function AllUser()
    {
        $my = Auth::user()->id;
        $users = User::orderBy('type', 'DESC')->get();
        return view('admin.user.user_all', compact('users', 'my'));
    }

    public function DeleteUser($id)
    {
        $book = User::findorFail($id)->delete();
        $notification = array('message' => 'User Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
