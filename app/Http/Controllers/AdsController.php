<?php

namespace App\Http\Controllers;

use App\Models\AdImage;
use App\Models\Ads;
use Illuminate\Http\Request;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ads = Ads::latest()->paginate(10);
        $images = [];
        foreach ($ads->items() as $key => $value) {
            array_push($images, AdImage::where('ad_id', $value->ad_id)->get()->toArray());
        }
        return view('ads.user_ad', compact('ads', 'images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|string|max:255'
        ]);

        $ad = Ads::create([
            'titre' => $request->titre,
            'id' => auth()->user()->id,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if ($request->hasFile('image')) {
            $images = $request->file('image');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);

                AdImage::create([
                    'ad_id' => $ad->ad_id,
                    'image_path' => $imageName
                ]);
            }
        }

        return redirect()->route('ads')->with('sucess', 'Advertisement created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ads)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $ad = Ads::find($id);
        return view('ads.edit', compact('ad'))->with('ad', $ad);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $ads = Ads::find($id);

        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'required|string',
            'image[]' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'price' => 'required|string|max:255'
        ]);

        
        $ads->update([
            'titre' => $request->titre,
            'description' => $request->description,
            'price' => $request->price
        ]);

        if ($request->hasFile('image')) {
            AdImage::where('ad_id', $ads->ad_id)->delete();
            $images = $request->file('image');
            foreach ($images as $image) {
                $imageName = time() . '.' . $image->extension();
                $image->move(public_path('images'), $imageName);

                AdImage::create([
                    'ad_id' => $ads->ad_id,
                    'image_path' => $imageName
                ]);
            }
        }

        return redirect()->route('ads')->with('sucess', 'Advertisement created succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ads = Ads::find($id);
        $ads->delete();
        AdImage::where('ad_id', $id)->delete();
        return redirect()->route('ads')->with('success', 'Advertisement deleted successfully');
    }
}
