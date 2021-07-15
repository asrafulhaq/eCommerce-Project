<?php

namespace App\Http\Controllers;

use App\Models\Asraf;
use Illuminate\Http\Request;

class AsrafController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       $data = App\Models\Asraf::latest() -> get();
       return view('view.name', [
           'all_data'   => $data
       ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('view.name');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this -> validate($request, [
           'title'      => 'required',
           'content'      => 'required',
           'cell'      => ['required', 'starts_with:+8801,8801,01', 'numeric'],
        ]);

        App\Models\Asraf::create([
            'name'          => $request -> name
        ]);

        return redirect() -> back() -> with('succ','message');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asraf  $asraf
     * @return \Illuminate\Http\Response
     */
    public function show(Asraf $asraf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asraf  $asraf
     * @return \Illuminate\Http\Response
     */
    public function edit(Asraf $asraf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asraf  $asraf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asraf $asraf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asraf  $asraf
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asraf $asraf)
    {
        //
    }
}
