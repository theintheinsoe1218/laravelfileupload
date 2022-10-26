<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
    }

    public function ssd()
    {
        $users=User::query();

        return DataTables::of($users)
        ->addColumn('action',function($user){
            return '<a class="btn btn-sm btn-danger delete" data-id="'.$user->id.'">Delete</a>';
        })
        ->editColumn('created_at',function($user){
            return Carbon::parse($user->created_at)->format('Y/m/d H:i:s');
        })
        ->editColumn('updated_at',function($user){
            return Carbon::parse($user->updated_at)->format('Y/m/d H:i:s');
        })
        ->make(true);

    }

    public function destroy($id)
    {
        $user=User::findOrfail($id);
        $user->delete();
        return back()->with('success','User has been deleted');
    }
}
