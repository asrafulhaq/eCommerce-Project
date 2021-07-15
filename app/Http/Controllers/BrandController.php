<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if( request() -> ajax() ){

            return datatables() -> of(Brand::latest() -> get()) -> addColumn('action', function($data){

                $output = '';
                $output .='<a class="btn btn-sm btn-warning" href="#">Edit</a>';
                $output .= ' <a class="btn btn-sm btn-danger" href="#">Delete</a>';

                return $output;

            }) -> rawColumns(['action']) -> make(true);
        }

        return view('admin.product.brand.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file_name = '';
        if( $request -> hasFile('logo') ){
            $img  = $request -> file('logo');
            $file_name = md5(time().rand()) .'.'. $img -> getClientOriginalExtension();
            $img -> move(public_path('media/products/brands/'), $file_name);
        }
        
        Brand::create([
            'name'      => $request -> name,
            'slug'      => $this -> getSlug($request -> name),
            'logo'      => $file_name
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        //
    }
}
