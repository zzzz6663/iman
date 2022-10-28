<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Brand;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::query();
        if ($request->search) {
            $search = $request->search;
           $brands->where(function ($query) use ($search, $brands) {
                $query->where('name', 'LIKE', "%{$search}%");
           });
        }
        $brands = $brands->latest()->paginate(10);
        return view('admin.brand.all', compact(['brands']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.brand.create');
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
            'name'=>'required|min:3|unique:users,username',
        ]);
        $user=Brand::create($data);
        alert()->success(' New  brand created' );
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.brand.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $brand)
    {
        return view('admin.brand.edit',compact(['brand']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $brand)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'lastname'=>'required|min:3',
            'username'=>'required|min:3|unique:users,username,'.$brand->id,
            'password'=>'required|min:3',
        ]);
    $brand->update($data);
    alert()->success('   brand updated' );
    return redirect()->route('brand.index');
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
    public function edit_company(Request $request)
    {
        $company=User::whereRole('company')->first();
        // dd($request->method());
        if($request->method()=='POST'){
            $data=$request->validate([
                'name'=>'required|min:3',
                'person'=>'required|min:3',
                'phone'=>'required|min:3|unique:users,phone,'.$company->id,
                'tax'=>'required|min:3|unique:users,tax,'.$company->id,
                'email'=>'required|unique:users,email,'.$company->id,
                'logo'=>'nullable',
            ]);
              if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $name_img = 'logo_' . $company->id . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('/media/company/'), $name_img);
                $data['logo'] = $name_img;
              }
              $company->update($data);
            alert()->success('    Company Updated' );
            return redirect()->route('brand.index');
        }
        return view('admin.brand.edit_company',compact(['company']));

    }





}
