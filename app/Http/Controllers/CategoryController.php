<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::all();
        return view("CategoryFiles.index",[
            "data"=>$data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("CategoryFiles.addCategory");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "categoryName" => "required|min:5"
            ],
            [
                "categoryName.required"=>"يجب عليك إدخال هذه القيمة",
                "categoryName.min"=>"يجب أن يكون عدد الحروف أكبر من 5"
            ]
        );
        $categoryName = $request->post("categoryName");
        $category = new Category();
        $category->name = $categoryName;
        $category->user_id = Auth::id();
        $status = $category->save();
        if($status){
            FacadesSession::flash("insertion_true","insertion done");
            return redirect()->route("getAllCategory");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $category = Category::findOrFail($id); 
        return view("categoryFiles.editCategory",[
            "category" => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
       $category =  Category::findOrFail($id);
       $category->name = $request->input("categoryName");
       $result = $category->update();
       if($result){
        return redirect()->route("getAllCategory");
       }
       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
       $category =  Category::findOrFail($id);
       $numberOfRows = $category->delete();
       if($numberOfRows == 1){
        return redirect()->route("getAllCategory");
       }
    }
}
