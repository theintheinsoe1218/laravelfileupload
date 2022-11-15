<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use App\DataTables\UsersDataTable;
use App\Models\Gallery;
use Yajra\DataTables\Facades\DataTables;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.home');
        // return $dataTable->render('admin.home');


    }

    public function ssd()
    {
        $users=User::query();


        return DataTables::of($users)
        ->addColumn('action',function($user){
            $btn = ' <a class="btn btn-sm btn-danger delete" data-id="'.$user->id.'">Delete</a>';
            return $btn;
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
