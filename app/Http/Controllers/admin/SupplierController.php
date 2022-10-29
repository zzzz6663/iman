<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Travel;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class supplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::query();
        if ($request->search) {
            $search = $request->search;
           $suppliers->where(function ($query) use ($search, $suppliers) {
                $suppliers->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%");
           });
        }
        $suppliers = $suppliers->latest()->paginate(10);
        return view('admin.supplier.all', compact(['suppliers']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.supplier.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'email'=>'required|unique:suppliers,email',
            'phone'=>'required|unique:suppliers,phone',
            'address'=>'required|min:3',
            'info'=>'required|min:3',
        ]);
        Supplier::create($data);
        alert()->success(' New  supplier created' );
        return redirect()->route('supplier.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $user)
    {
        return view('admin.supplier.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        return view('admin.supplier.edit',compact(['supplier']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'email'=>'required|unique:suppliers,email,'.$supplier->id,
            'phone'=>'required|unique:suppliers,phone,'.$supplier->id,
            'address'=>'required|min:3',
            'info'=>'required|min:3',
        ]);
        return redirect()->route('supplier.index');
    $supplier->update($data);
    alert()->success('   supplier updated' );
    return redirect()->route('supplier.index');
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
