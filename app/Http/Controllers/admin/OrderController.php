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
                $orders->where('barcode', 'LIKE', "%{$search}%")
                ->orWhere('width', 'LIKE', "%{$search}%")
                ->orWhere('height', 'LIKE', "%{$search}%")
                ->orWhere('unit', 'LIKE', "%{$search}%")
                ->orWhere('igw', 'LIKE', "%{$search}%")
                ->orWhere('volume', 'LIKE', "%{$search}%")
                ->orWhere('price', 'LIKE', "%{$search}%")
                ->orWhere('south_code', 'LIKE', "%{$search}%")
                ->orWhere('euro_number', 'LIKE', "%{$search}%")
                ->orWhere('quantity', 'LIKE', "%{$search}%");
                // ->orWhereHas('country', function ($query) use ($search) {
                //     $query->where('en_name', 'LIKE', "%{$search}%");
                // });
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
            'product_id'=>'required',
            'brand_id'=>'required',
            'quantity'=>'required|numeric|min:0|not_in:0',
        ]);
        $product=Product::find($data['product_id']);
        $data['supplier_id']=$product->supplier_id;
        $data['brand_id']=$product->brand_id;
        $data['barcode']=$product->barcode;
        $data['description']=$product->description;
        $data['width']=$product->width;
        $data['height']=$product->height;
        $data['unit']=$product->unit;
        $data['inw']=$product->inw;
        $data['igw']=$product->igw;
        $data['volume']=$product->volume;
        $data['price']=$product->price;
        $data['south_code']=$product->south_code;
        $data['euro_number']=$product->euro_number;
        $data['traffic_code']=$user->branch->product_traffic_code($product);
        $user->orders()->create($data);
        alert()->success(' New  order created' );
        return redirect()->route('order.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.order.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $order)
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
    public function update(Request $request, User $order)
    {
        $user=auth()->user();
        if( $user->role !='branch'){
        alert()->error('You must be Branch');
        return  back();
        }
        if( $user->id !=$order->branch_id){
        alert()->error('this order must be Branch');
        return  back();
        }
      $data=$request->validate([
        'username'=>'required|min:3|unique:users,username,'.$order->id,
        'company'=>'required|min:3',
        'person'=>'required|min:3',
        'phone'=>'required|min:3|unique:users,phone,'.$order->id,
        'tax'=>'required|min:3|unique:users,tax,'.$order->id,
        'country_id'=>'required|exists:countries,id',
        'address'=>'required|min:3|unique:users',
        'password'=>'required|min:3',
    ]);
    $order->update($data);
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
