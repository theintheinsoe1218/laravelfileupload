<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            return $user->created_at->format('Y/m/d');
        })
        ->editColumn('updated_at',function($user){
            return $user->updated_at->format('Y/m/d');
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
