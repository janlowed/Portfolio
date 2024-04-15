<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class AboutController extends Controller
{
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(empty(auth()->user()->role)){
            abort(404);
        }
        $abouts = About::get();
        return view('about.index', compact('abouts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
       About::create($request->all());
       return redirect()->route('abouts.index');
     
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(About $about)
    {
        //
        return view("about.edit", compact("about"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, About $about): RedirectResponse
    {
        //
       $about->update($request->all());

       return redirect()->route('abouts.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(About $about): RedirectResponse
    {
        //
        $about->delete();

        return redirect()->route('abouts.index');
    }
}