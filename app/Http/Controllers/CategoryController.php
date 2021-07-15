<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $data = Category::all();
        // return view('admin.post.category.index', [
        //     'all_data'      =>  $data
        // ]);

        if(request() -> ajax()){
            return datatables() -> of(Category::latest()->get()) -> addColumn('action', function($data){
                $btn =  '<a class="btn btn-warning btn-sm" href="fgv"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </a>';
                $btn .=  ' <a class="btn btn-danger btn-sm" href="#"> <i class="fa fa-trash" aria-hidden="true"></i> </a>';
                return $btn;
            }) -> addColumn('test', function($data){
                return $data -> slug;
            }) ->  addColumn('sta', function($data){
                
                $output = '<div class="status-toggle">';
                $output .= '<input type="checkbox" ' . ( $data -> status == 1  ? "checked=\'checked\'" : "" )  .' status_id="'. $data -> id .'" id="cat_status_'. $data -> id .'" class="check cat_check">';
                $output .= '<label for="cat_status_'. $data -> id .'" class="checktoggle">checkbox</label>';
                $output .= '</div>';

                return  $output;
                    

            }) -> rawColumns(['action', 'test', 'sta']) ->  make(true);
        }

        return view('admin.post.category.index');




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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this -> validate($request, [
            'name'      => 'required'
        ]);


        Category::create([
            'name'          => $request -> name,
            'slug'          => $this -> getSlug($request -> name),
        ]);

        return redirect() -> route('category.index') -> with('success', 'Category added successful');


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
        $edit_data = Category::find($id);

        return [
            'id'    => $edit_data -> id,
            'name'  => $edit_data -> name
        ];
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
        $edit_id = $request -> edit_id;

        $edit_data =  Category::find($edit_id);
        $edit_data -> name = $request -> name;
        $edit_data -> slug = Str::slug($request -> name);
        $edit_data -> update();

        return redirect() -> back() -> with('success', 'Category updated successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete_data = Category::find($id);
        $delete_data -> delete();
        return redirect() -> back() -> with('confirm', 'Category deleted successful');
    }



    /**
     *
     */
    public function statusUpdateInactive($id){

        $status_update = Category::find($id);
        $status_update -> status = false;
        $status_update -> update();
    }

    /**
     *
     */
    public function statusUpdateActive($id){

        $status_update = Category::find($id);
        $status_update -> status = true;
        $status_update -> update();
    }
}
