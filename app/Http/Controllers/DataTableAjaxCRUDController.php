<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Recipe;
use Datatables;
use Redirect;

use Illuminate\Support\Str;
class DataTableAjaxCRUDController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(DB::table('recipes'))
            ->addColumn('action', 'recipe-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('home');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:recipes|max:20',
            'servings' => 'required',
            'procedure' => 'required|max:50',
        ]);

        $data =[
               'name'=>$request->input('name'),
               'servings'=>$request->input('servings'),
               'procedure'=>$request->input('procedure')
        ];

        DB::table('recipes')->insert($data);
        return Response()->json(['success'=>'Contact form submitted successfully']);

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {


        $recipes = DB::table('recipes')
                        ->where('id', '=', $request->id)
                        ->first();
        return Response()->json($recipes);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $recipes = DB::table('recipes')
                ->where('id', '=', $request->id)
                ->delete();

        return Response()->json($recipes);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $users = DB::table('recipes')
                ->where('id', '<>', $request->id)
                ->where('name', '=', $request->name)
                ->get();
        $exist = $users->count();
 
        if ($exist == 0 ) {
            if (Str::length($request->name) <= 20) {
                if (Str::length($request->procedure) <= 50) {

                $data =[
                       'name'=>$request->input('name'),
                       'servings'=>$request->input('servings'),
                       'procedure'=>$request->input('procedure')
                ];

                DB::table('recipes')->where('id', $request->id)->update($data);
                return Response()->json(['success'=>'Contact form submitted successfully']);

                } else {
                     return Response()->json(['procedure' => 'The procedure must not be greater than 20 characters.'], 404);
                }
            } else {

                return Response()->json(['name' => 'The name must not be greater than 20 characters.'], 404);
            }
        } else {       
           return Response()->json(['name' => 'Recipe name already exist'], 404); // Status code here
        }
    }
}
