<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Footer;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function FooterSetup()
    {
        $footer = Footer::find(1);
        return view('admin.footer.footer_all', compact('footer'));
    }

    public function UpdateFooter(Request $request)
    {
        $footer_id = $request->id;
        Footer::findorFail($footer_id)->update([
            'number' => $request->number,
            'shor_description' => $request->shor_description,
            'address' => $request->address,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'copyright' => $request->copyright,
        ]);
        $notification = array('message' => 'Footer Page Updated Successfully', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }
}
