<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Order;
use App\Models\Travel;
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
                $orders->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('lastname', 'LIKE', "%{$search}%")
                ->orWhere('username', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('company', 'LIKE', "%{$search}%")
                ->orWhere('person', 'LIKE', "%{$search}%")
                ->orWhere('tax', 'LIKE', "%{$search}%")
                ->orWhereHas('country', function ($query) use ($search) {
                    $query->where('en_name', 'LIKE', "%{$search}%");
                });
           });
        }

        $orders = $orders->latest()->paginate(10);
        return view('admin.order.all', compact(['orders']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.order.create');
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
            'username'=>'required|min:3|unique:users,username',$
            'company'=>'required|min:3',
            'person'=>'required|min:3',
            'phone'=>'required|min:3|unique:users,phone',
            'tax'=>'required|min:3|unique:users,tax',
            'country_id'=>'required|exists:countries,id',
            'address'=>'required|min:3|unique:users',
            'password'=>'required|min:3',
        ]);
        $order=User::create($data);
        $order->assignRole( 'order');
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
