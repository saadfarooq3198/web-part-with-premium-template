<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    { 
        $admin=$this->middleware(['role:Admin','permission:view_user']);
    }
    public function index()
    {
        $users = User::latest()->get();
        return view('user',compact('users',$users));
    }


    public function get_user(Request $request)
    {
        if ($request->ajax()) {
            if ($request->status == 'Active' || $request->status == 'Pending' || $request->status == 'Suspended') {
                $data= User::where('status', $request->status);
            }
            else{
                $data = User::latest()->get();
            }
           
            return DataTables::of($data)
                    ->addIndexColumn()
                    // start
                    ->addColumn('status', function($row){
                        if($row->status=='Active'){
                           return '<td class="nk-tb-col tb-col-md"><span class="tb-status text-success">Active</span></td>';
                        }
                        elseif($row->status=='Pending'){
                            return '<td class="nk-tb-col tb-col-md"><span class="tb-status text-warning">Pending</span></td>';
                         }
                        else{
                           return ' <td class="nk-tb-col tb-col-md"><span class="tb-status text-danger">Suspended</span></td>';
                        }
                   })
                    // end
   
                    ->addColumn('edit', function($row){
                        $edit = '<td><button value="'.$row->id.'" class="btn-edit btn btn-primary btn-sm">Edit</button></td>
                        ';
                        return $edit;
                     })->addColumn('delete', function($row){
                        $delete = '<td> <button value="'.$row->id.'" class="delete-btn btn-delete btn btn-danger btn-sm">Delete</button></td>
                        ';
                        return $delete;
                     })->addColumn('image', function($row){
                        $image = '<img src="images/'.$row->image.'"  alt="no image" width="100px" height="100px"/>';
                        return $image;
                     })->rawColumns(['edit','delete','image','status'])->make(true);   
            }
                    return view('user');
    }

    // function fetch_user(Request $request)
    // {
    //  if($request->ajax())
    //  {
    //     $users = DB::table('users')->paginate(3);
    //      return view('user_chaild_pagination', compact('users'))->render();
    //  }
    // }

    public function search(Request $request)
    { 
        $users = User::where('first_name','LIKE','%'.$request->search.'%')
        ->orWhere('last_name','LIKE','%'.$request->search.'%')
        ->orWhere('email','LIKE','%'.$request->search.'%')->paginate(3);
        return view('user_chaild_pagination', compact('users'))->render();
        // return response()->json([
        //     'users'=>$users
        // ]);
    }

    public function get_users(){

        $allusers = User::all();
        return response()->json([
            'users'=>$allusers
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
        { 
                $user = new User;
                $user->first_name = $request->first_name;
                $user->last_name = $request->last_name;
                $user->email = $request->email;
                $file = $request->file('img');
                if($file=='') {
                    $user->image='user.jpg';
                }
                else{
                    $user->image=$request->file('img')->getClientOriginalName();
                    $file->store('public/images');
                }
                $user->password=$request->password;
                $user->save();
                return response()->json([
                    'success'=>200,
                    'message'=>'User Added Successfully'
                ]);
        }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return response()->json([
            'status'=>200,
            'user'=>$user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $id)
    {
        if($request->has('img')){
            $file = $request->file('img');
            $pic=$request->file('img')->getClientOriginalName();
            $file->store('public/images');
            User::where('id',$id)->update(['image'=>$pic]);
        }
            if($request->password !=''){
                $pass=$request->password;
                User::where('id',$id)->update(['password'=>$pass]); 
            }
                 User::where('id',$id)->update([
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email' => $request->email
                    ]);
                    return response()->json([
                        'status'=>200,
                        'message'=>'successfully updated'
                    ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        return response()->json([
            'status'=>200,
            'message'=>'User deleted Successfully'
        ]);
    }

    public function update_loggedin_user(Request $request){
        // $user = User::find(1);
        if($request->has('img')){
            $file = $request->file('img');
            $pic=$request->file('img')->getClientOriginalName();
            $file->store('public/images');
            User::where('id',$request->user_id)->update(['image'=>$pic]);
        }
            if($request->password !=''){
                $pass=$request->password;
                User::where('id',$request->user_id)->update(['password'=>Hash::make($pass)]);
            }
                 User::where('id',$request->user_id)->update([
                    'first_name'=>$request->first_name,
                    'last_name'=>$request->last_name,
                    'email' => $request->email
                    ]);
                    return redirect('users');
                    // return response()->json([
                    //     'status'=>200,
                    //     'message'=>'successfully updated'
                    // ]);
    }
}
