<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Image;

class PortfolioController extends Controller
{
    public function AllPortfolio()
    {
        $portfolio = Portfolio::latest()->get();
        return view('admin.portfolio.portfolio_all', compact('portfolio'));
    }

    public function AddPortfolio()
    {
        return view('admin.portfolio.portfolio_add');
    }

    public function StorePortfolio(Request $request)
    {
        $request->validate([
            'portfolio_name' => 'required',
            'portfolio_title' => 'required',
            'portfolio_image' => 'required',
        ], [
            'portfolio_name.required' => 'Portfolio name is required',
            'portfolio_title.required' => 'Portfolio title is required',
        ]);

        $image = $request->file('portfolio_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1020, 852)->save('upload/portfolio/' . $name_gen);
        $save_url = 'upload/portfolio/' . $name_gen;

        Portfolio::insert([
            'portfolio_name' => $request->portfolio_name,
            'portfolio_title' => $request->portfolio_title,
            'portfolio_image' => $save_url,
            'portfolio_description' => $request->portfolio_description,
            'created_at' => Carbon::now()
        ]);

        $notification = array('message' => 'Portfolio inserted successfully', 'alert-type' => 'success');

        return redirect()->route('all.portfolio')->with($notification);
    }

    public function EditPortfolio($id)
    {
        $portfolio = Portfolio::findorFail($id);
        return view('admin.portfolio.portfolio_edit', compact('portfolio'));
    }

    public function UpdatePortfolio(Request $request)
    {
        $portfolio_id = $request->id;

        if ($request->file('portfolio_image')) {
            $image = $request->file('portfolio_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1020, 519)->save('upload/portfolio/' . $name_gen);
            $save_url = 'upload/portfolio/' . $name_gen;
            Portfolio::findorFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_image' => $save_url,
                'portfolio_description' => $request->portfolio_description,
            ]);
            $notification = array('message' => 'Portfolio Updated Successfully', 'alert-type' => 'success');
        } else {
            Portfolio::findorFail($portfolio_id)->update([
                'portfolio_name' => $request->portfolio_name,
                'portfolio_title' => $request->portfolio_title,
                'portfolio_description' => $request->portfolio_description,
            ]);
            $notification = array('message' => 'Portfolio Updated without Image Successfully', 'alert-type' => 'success');
        } //end Else
        return redirect()->route('all.portfolio')->with($notification);
    }

    public function DeletePortfolio($id)
    {
        $portfolio = Portfolio::findorFail($id);
        $img = $portfolio->portfolio_image;
        unlink($img);
        Portfolio::findorFail($id)->delete();
        $notification = array('message' => 'Portfolio Image Deleted Successfully', 'alert-type' => 'success');
        return redirect()->back()->with($notification);
    }

    public function PortfolioDetails($id)
    {
        $portfolio = Portfolio::findorFail($id);
        return view('frotend.portfolio_details', compact('portfolio'));
    }

    public function HomePortfolio()
    {
        $portfolio = Portfolio::latest()->get();
        return view('frotend.portfolio', compact('portfolio'));
    }
}
