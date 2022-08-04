<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function Contact()
    {
        return view('frotend.contact');
    }

    public function StoreMessage(Request $request)
    {
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now()
        ]);

        $notification = array('message' => 'Your Message Submited Successfully', 'alert-type' => 'success');

        return redirect()->back()->with($notification);
    }

    public function ContactMessage()
    {
        $contacts = Contact::latest()->get();
        return view('admin.contact.allcontact', compact('contacts'));
    }

    public function DeleteMessage($id)
    {
        Contact::findorFail($id)->delete();
        $notification = array('message' => 'Your Message Delete Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }
}
