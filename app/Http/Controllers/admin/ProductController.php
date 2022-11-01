<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Travel;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = Product::query();
        if ($request->search) {
            $search = $request->search;
           $products->where(function ($query) use ($search, $products) {
                $products->where('name', 'LIKE', "%{$search}%")
                ->orWhere('barcode', 'LIKE', "%{$search}%")
                ->orWhere('traffic_code', 'LIKE', "%{$search}%")
                ->orWhere('width', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%")
                ->orWhereHas('brand', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                })
                ->orWhereHas('suppliers', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
           });
        }
        $products = $products->latest()->paginate(10);
        return view('admin.product.all', compact(['products']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data=$request->validate([
            'name'=>'required|min:3|unique:products,name',
            'barcode'=>'required|min:3|unique:products,barcode',
            'inw'=>'required',
            'igw'=>'required',
            'width'=>'required',
            'height'=>'required',
            'unit'=>'required',
            'volume'=>'required',
            'price'=>'required',
            // 'traffic_code'=>'required',
            'south_code'=>'required',
            'euro_number'=>'required',
            'suppliers'=>'required|array',
            'brand_id'=>'required',
            'description'=>'required',
        ]);
        $product=Product::create($data);
        $product->suppliers()->attach($data['suppliers']);
        alert()->success(' New  product created' );
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $user)
    {
        return view('admin.product.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('admin.product.edit',compact(['product']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $data=$request->validate([
            'name'=>'required|min:3|unique:products,name,'.$product->id,
            'barcode'=>'required|min:3|unique:products,barcode,'.$product->id,
            'inw'=>'required',
            'igw'=>'required',
            'width'=>'required',
            'height'=>'required',
            'unit'=>'required',
            'volume'=>'required',
            'price'=>'required',
            // 'traffic_code'=>'required',
            'south_code'=>'required',
            'euro_number'=>'required',
            'suppliers'=>'required|array',
            'brand_id'=>'required',
            'description'=>'required',
        ]);
        $product->suppliers()->sync($data['suppliers']);
    $product->update($data);
    alert()->success('   product updated' );
    return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }





}
