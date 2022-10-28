<?php

namespace App\Http\Controllers\admin;

use App\Models\Chat;
use App\Models\City;
use App\Models\User;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $staffs = User::query();
        if ($request->search) {
            $search = $request->search;
           $staffs->where(function ($query) use ($search, $staffs) {
                $staffs->where('name', 'LIKE', "%{$search}%")
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
        $staffs = $staffs->whereIn('role', ['admin'])->latest()->paginate(10);
        return view('admin.staff.all', compact(['staffs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('admin.staff.create');
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
            'name'=>'required|min:3',
            'lastname'=>'required|min:3',
            'username'=>'required|min:3|unique:users,username',
            'password'=>'required|min:3',
        ]);
        $data['role']='admin';
        $user=User::create($data);
        $user->assignRole( 'admin');
        alert()->success(' New  staff created' );
        return redirect()->route('staff.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('admin.staff.show', compact(['user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff)
    {
        return view('admin.staff.edit',compact(['staff']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $staff)
    {
        $data=$request->validate([
            'name'=>'required|min:3',
            'lastname'=>'required|min:3',
            'username'=>'required|min:3|unique:users,username,'.$staff->id,
            'password'=>'required|min:3',
        ]);
    $staff->update($data);
    alert()->success('   staff updated' );
    return redirect()->route('staff.index');
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
