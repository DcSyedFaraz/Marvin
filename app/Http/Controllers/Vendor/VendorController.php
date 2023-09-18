<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class VendorController extends Controller
{
    public function profile()
    {
        $profile=Auth()->user();
        return view('vendor.user.profile')->with('profile',$profile);
    }

    public function profileUpdate(Request $request,$id)
    {
        $user=User::findOrFail($id);
        $data=$request->all();
        $status=$user->fill($data)->save();

        if($status)
        {
            request()->session()->flash('success','Successfully updated your profile');
        }
        else
        {
            request()->session()->flash('error','Please try again!');
        }
        
        return redirect()->back();
    }
}
