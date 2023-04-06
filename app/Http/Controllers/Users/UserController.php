<?php

namespace App\Http\Controllers\Users;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Vendor;
use App\Models\UserVendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
       
        $users = UserResource::collection(User::paginate(10))->withQueryString();
        $roles = DB::table('users')
        ->select('role')
        ->distinct()
        ->get();
        $sub_roles = DB::table('user_vendors')
        ->select('sub_role')
        ->distinct()
        ->get();
        $vendors = Vendor::select('id','name')->get();
        return Inertia::render('Users/Index', [
            'users' => $users,
            'roles' => $roles,
            'sub_roles' => $sub_roles,
            'vendors'=>$vendors
        ]);
    }

    public function create(Request $request)
    {
        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'role'=>$request->role
        ]);
        if($request->role=='vendor'){
            UserVendor::create([
                'vendor_id' => $request->vendor_name,
                'user_id' => $user->id,
                'sub_role' => $request->sub_role
            ]);
        }
        return to_route('users:index');
    }
    public function update(User $user,Request $request)
    {  
        $vendordata=[
            'vendor_id' => $request->vendor_id,
            'sub_role' => $request->sub_role
        ];
        UserVendor::updateOrCreate([
            'user_id'  => $user->id,
        ],$vendordata);
    }
}
