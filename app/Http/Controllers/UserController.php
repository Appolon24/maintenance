<?php


namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function technicien(Request $request){
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = User::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new User();
        }

        $agents = $agents->Technicien()->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.users.technicien', compact('agents', 'search'));
    }
    public function customer(Request $request){
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = User::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new User();
        }

        $agents = $agents->Customer()->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.users.customer', compact('agents', 'search'));
    }
    public function administrateur(Request $request){
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = User::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new User();
        }

        $agents = $agents->Admin()->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.users.administrateur', compact('agents', 'search'));
    }
    public function technicienEdit(){
        return view('pages/edit/technicien');
    }
    public function customerEdit(){
        return view('pages/edit/customer');
    }
    public function administrateurEdit(){
        return view('pages/edit/administrateur');
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|min:4|max:100',
            'phone' => 'required|unique:users|min:8|max:100',
            'adresse' => 'required',
            'password' => 'required|min:4|max:14',
        ],[
            'password.min' => 'Password must contain 4 characters',
            'password.max' => 'Password must contain 14 characters',
        ]);

        $email = $request->email;
        $user = User::where(['email' => $email])->first();
        if (isset($user)){
            //  Toastr::warning(translate('This phone number is already taken'));
            return back();
        }

        DB::transaction(function () use ($request, $email) {
            $piece = new User();
            $piece->name = $request->name;
            $piece->phone = $request->phone;
            //$user->image = Helpers::upload('agent/', 'png', $request->file('image'));
            $piece->email = $email;
            $piece->adresse = $request->adresse;
            $piece->password = bcrypt($request->password);
            $piece->user_type = $request->user_type;    //['Admin'=>0, 'Agent'=>1, 'Customer'=>2]
            $piece->save();
        });

        // Toastr::success(translate('Agent Added Successfully!'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.users.update', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'adresse' => $request->adresse,
        ]);
        if ($user->user_type==1){
            return redirect()->route('users.technicien');
        }else{
            return redirect()->route('users.administrateur');
        }

    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Request $request)
    {
        $id=$request->get('item');
        $conge = PieceDetache::query()->find($id);
        $conge->delete();
        return response()->json(['data' => $conge, 'status' => true]);

    }

}
