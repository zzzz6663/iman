<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

       $user=auth()->user();
       $clients = User::query();
       $clients-> whereIn('role', ['client']);
       if( $user->role =='branch'){
        $clients->where('branch_id',$user->id);
       }
       if( $request->branch_id){
        $clients->where('branch_id',$request->branch_id);
       }
        if ($request->search) {
            $search = $request->search;
           $clients->where(function ($query) use ($search, $clients) {
                $query->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('company', 'LIKE', "%{$search}%")
                ->orWhere('person', 'LIKE', "%{$search}%")
                ->orWhere('tax', 'LIKE', "%{$search}%")
                ->orWhereHas('country', function ($qu) use ($search) {
                    $qu->where('en_name', 'LIKE', "%{$search}%");
                });
           });

        }
        $route=route('order.index');

        $clients = $clients->latest()->paginate(10);
        return view('admin.client.all', compact(['clients','route']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.client.create');
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
       if( $user->role !='branch'){
        alert()->error('You must be Branch');
        return  back();
       }
        $data=$request->validate([
            'username'=>'required|min:3|unique:users,username',
            'company'=>'required|min:3',
            'person'=>'required|min:3',
            'phone'=>'required|min:3|unique:users,phone',
            'email'=>'required|min:3|unique:users,email',
            'tax'=>'required|min:3|unique:users,tax',
            'country_id'=>'required|exists:countries,id',
            'address'=>'required|min:3',
            'password'=>'required|min:3',
        ]);
        $data['role']='client';
        $data['branch_id']=$user->id;
        $client=User::create($data);
        $client->assignRole( 'client');
        alert()->success(' New  client created' );
        return redirect()->route('client.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.client.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $client)
    {
        return view('admin.client.edit',compact(['client']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $client)
    {
        $user=auth()->user();
        if( $user->role !='branch'){
        alert()->error('You must be Branch');
        return  back();
        }
        if( $user->id !=$client->branch_id){
        alert()->error('this client must be Branch');
        return  back();
        }
      $data=$request->validate([
        'username'=>'required|min:3|unique:users,username,'.$client->id,
        'company'=>'required|min:3',
        'person'=>'required|min:3',
        'phone'=>'required|min:3|unique:users,phone,'.$client->id,
        'email'=>'required|min:3|unique:users,email,'.$client->id,
        'tax'=>'required|min:3|unique:users,tax,'.$client->id,
        'country_id'=>'required|exists:countries,id',
        'address'=>'required|min:3',
        'password'=>'required|min:3',
    ]);
    $client->update($data);
    alert()->success('   client updated' );
    return redirect()->route('client.index');
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
    public function get_product(Brand $brand)
    {
        $user=auth()->user();
        $products=$user->branch->branch_products()->wherePivot('show',1);
        $products = $products->where('brand_id',$brand->id)->latest()->paginate(10);
        return response()->json([
            'body' => view('admin.product.get_product',compact('products'))->render(),
        ]);
    }
    public function client_orders(User $user, Request $request)
    {
        $orders = $user->orders();
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
        $route=route('client.orders',$user->id);
        $orders = $orders->latest()->paginate(10);
        return view('admin.order.all', compact(['orders' ,'route','user']));
    }





}
