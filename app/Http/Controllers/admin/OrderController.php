<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Travel;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user=auth()->user();
        $orders = Order::query();
        if ($request->search) {
            $search = $request->search;
           $orders->where(function ($query) use ($search, $orders) {
                $query->orWhereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%{$search}%");
                });
           });
        }
        $route=route('order.index');
        $orders = $orders->latest()->paginate(10);
        return view('admin.order.all', compact(['orders','route']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user=auth()->user();

        return view('admin.order.create',compact(['user']));
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
        $user=auth()->user();
       if( $user->role !='client'){
        alert()->error('You must be Client');
        return  back();
       }
        $data=$request->validate([
            'products'=>'required',
            'brands'=>'required',
            'quantities'=>'required',
        ]);
        if(count( $data['products']) != count( $data['quantities'])){
            return redirect()->route('some thing is wrong');
        }
       $order= $user->orders()->create();
        for($i=0; $i<count($data['products']); $i++){
            $product=Product::find($data['products'][$i]);
            $info['name']=$product->name;
            $info['brand_id']=$product->brand_id;
            $info['barcode']=$product->barcode;
            $info['description']=$product->description;
            $info['width']=$product->width;
            $info['height']=$product->height;
            $info['unit']=$product->unit;
            $info['inw']=$product->inw;
            $info['igw']=$product->igw;
            $info['volume']=$product->volume;
            $info['price']=$product->price;
            $info['south_code']=$product->south_code;
            $info['euro_number']=$product->euro_number;
            $info['traffic_code']=$user->branch->product_traffic_code($product);
            $info['quantity']=$data['quantities'][$i];
            $order->products()->attach($product->id , $info);
        }
        alert()->success(' New  order created' );
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.order.show', compact(['order']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('admin.order.edit',compact(['order']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Order $order)
    {
        $user=auth()->user();
       if( $user->role !='client'){
        alert()->error('You must be Client');
        return  back();
       }
        $data=$request->validate([
            'products'=>'required',
            'brands'=>'required',
            'quantities'=>'required',
        ]);
        if(count( $data['products']) != count( $data['quantities'])){
            return redirect()->route('some thing is wrong');
        }

        foreach($order->products as $pro){
            $order->products()->detach($pro->id ,[]);
        }
        for($i=0; $i<count($data['products']); $i++){
            $product=Product::find($data['products'][$i]);
            $order->products()->detach($product->id ,[]);

            $info['name']=$product->name;
            $info['brand_id']=$product->brand_id;
            $info['barcode']=$product->barcode;
            $info['description']=$product->description;
            $info['width']=$product->width;
            $info['height']=$product->height;
            $info['unit']=$product->unit;
            $info['inw']=$product->inw;
            $info['igw']=$product->igw;
            $info['volume']=$product->volume;
            $info['price']=$product->price;
            $info['south_code']=$product->south_code;
            $info['euro_number']=$product->euro_number;
            $info['traffic_code']=$user->branch->product_traffic_code($product);
            $info['quantity']=$data['quantities'][$i];
            $order->products()->attach($product->id , $info);
        }
    alert()->success('   order updated' );
    return redirect()->route('order.index');
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
