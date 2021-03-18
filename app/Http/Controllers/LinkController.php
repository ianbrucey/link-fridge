<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $links = auth()->user()->links;
        return view("links.index", compact('links'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'url' => 'required|url|active_url',
            'title' => 'required|string',
        ]);

        try {
            Link::create([
                'user_id' => auth()->id(),
                'title' => $request->get('title'),
                'url' => $request->get('url')
            ]);

            return redirect()->back()->with("success", "Your link was saved successfully! Scroll down to see your list");
        } catch (\Exception $e) {
            return redirect()->back()->with("error", "There was a problem with your request. We're working on it");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            Link::destroy($id);
            return redirect()->back()->with("info", "Your link was delete successfully!");
        } catch (\Exception $e) {
            return redirect()->back()->with("warning", "There was a problem with your request. We're working on it");
        }
    }
}
