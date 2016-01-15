<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = DB::table('categories')
            ->orderBy('id', 'asc')
            ->get();

        return view('show_categories', [
            'categories' => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($id != 'hot' && $id != 'new') {
            $category = DB::table('categories')->where('id', $id)->first();
            
            if ($category == null) {
                abort(404);
            }
            
            $category = $category->name;
        }
        else {
            $category = $id;
        }

        return redirect()->action('ThreadController@index', ['category' => $category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_category');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'string|required|unique:categories',
        ]);

        $name = $request->input('name');

        DB::table('categories')->insert([
            'name' => $name,
        ]);

        return redirect('/categories');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();

        if ($category == null) {
            abort(404);
        }
        
        return view('edit_category', [
            'category' => $category,
        ]);
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
        $category = DB::table('categories')->where('id', $id)->first();
        if ($category == null) {
            abort(404);
        }

        $this->validate($request, [
            'name' => 'string|required|unique:categories',
        ]);

        $name = $request->input('name');

        DB::table('categories')
            ->where('id', $id)
            ->update([
                'name' => $name
            ]);

        return redirect('/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        if ($category == null) {
            abort(404);
        }

        $threads = DB::table('threads')->where('category_id', $id)->get();
        foreach ($threads as $thread) {
            DB::table('replies')->where('thread_id', $thread->id)->delete();
            DB::table('threads')->where('id', $thread->id)->delete();
        }

        DB::table('categories')->where('id', $id)->delete();

        return redirect('/categories');
    }

    /**
     * Returns categories in array
     * 
     * @return array
     */
    public function getCategories()
    {
        return DB::table('categories')
            ->orderBy('id', 'asc')
            ->get();
    }
}
