<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Branch;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $branches = User::query();
        if ($request->search) {
            $search = $request->search;
           $branches->where(function ($query) use ($search, $branches) {
                $branches->where('name', 'LIKE', "%{$search}%")
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
        $branches = $branches->whereIn('role', ['branch'])->latest()->paginate(10);
        // $branches = $branches->latest()->paginate(10);
        return view('admin.branch.all', compact(['branches']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.branch.create');
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
        $data=$request->validate([
            'username'=>'required|min:3|unique:users,username',
            'company'=>'required|min:3',
            'person'=>'required|min:3',
            'phone'=>'required|min:3|unique:users,phone',
            'tax'=>'required|min:3|unique:users,tax',
            'country_id'=>'required|exists:countries,id',
            'address'=>'required|min:3',
            'logo'=>'required',
            'password'=>'required|min:3',
        ]);

        $data['role']='branch';

        $branch=User::create($data);

          if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            // dd( $image->getClientOriginalExtension());
            $name_img = 'logo_' . $branch->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/media/branch/'), $name_img);
            $data['logo'] = $name_img;
          }
          $branch->update($data);



        $branch->assignRole( 'branch');
        alert()->success(' New  branch created' );
        return redirect()->route('branch.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.branch.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $branch)
    {
        return view('admin.branch.edit',compact(['branch']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $branch)
    {
        $data=$request->validate([
            'username'=>'required|min:3|unique:users,username,'.$branch->id,
            'company'=>'required|min:3',
            'person'=>'required|min:3',
            'phone'=>'required|min:3|unique:users,phone,'.$branch->id,
            'tax'=>'required|min:3|unique:users,tax,'.$branch->id,
            'country_id'=>'required|exists:countries,id',
            'address'=>'required|min:3,'.$branch->id,
            'logo'=>'nullable',
            'password'=>'required|min:3',
        ]);

        $data['role']='branch';

        // $branch=Branch::create($data);
        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            // dd( $image->getClientOriginalExtension());
            $name_img = 'logo_' . $branch->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/media/branch/'), $name_img);
            $data['logo'] = $name_img;
          }
            $branch->update($data);
            alert()->success('   branch updated' );
            return redirect()->route('branch.index');
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
