<?php


namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\DemandeDepannage;
use App\Models\Machine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function index(Request $request)
    {
        if (auth()->check()){
            return redirect()->route('app.dashboard');
        }

        return view('front/index');
    }
    public function dashboard(Request $request)
    {
        $user=auth()->user();
        $demandes=DemandeDepannage::query()->where(['user_id'=>$user->id])->latest()->paginate(Helpers::pagination_limit());
        return view('front/dashboard',[
            'depannages'=>$demandes,
            'user'=>$user
        ]);

    }
    public function editdemande(Request $request,$id)
    {   $user=auth()->user();
        $machines=Machine::query()->where(['id'=>$user->id])->get();
        $demande=DemandeDepannage::query()->find($id);
        if ($request->method()=="POST"){
            $demande->update([
               'libelle'=>$request->libelle,
               'description'=>$request->description
            ]);
            $machine=$demande->machine;
            $machine->update([
               'marque'=>$request->marque,
                'modele'=>$request->model,
                'couleur'=>$request->couleur,
            ]);
            return redirect()->route('app.dashboard');
        }
        return view('front/editdemande',compact('machines','demande'));
    }
    public function adddemande(Request $request)
    {
        $user=auth()->user();
        $machines=Machine::query()->where(['id'=>$user->id])->get();
        if ($request->method()=="POST"){
            if ($request->get('machine')==0){
                $machine=new Machine();
                $machine->marque=$request->get('marque');
                $machine->modele=$request->get('model');
                $machine->couleur=$request->get('couleur');
                $machine->libelle=$request->get('marque');
                $machine->user_id=$user->id;
                $machine->save();
                $machine_id=$machine->id;
            }else{
                $machine_id=$request->get('machine');
            }
            $demande=new DemandeDepannage();
            $demande->type=$request->get('type');
            $demande->user_id=$user->id;
            $demande->description=$request->get('description');
            $demande->machine_id=$machine_id;
            $demande->status="ENVOYE";
            $demande->save();
            return redirect()->route('app.dashboard');
        }
        return view('front/adddemande',compact('machines'));
    }
    public function saveprofil(Request $request)
    {$user=auth()->user();
        $user->update([
            "name" => $request->get('name'),
            "phone" => $request->get('phone'),
            "adresse" => $request->get('adresse'),
            "email" => $request->get('email'),
        ]);
        return redirect('app/dashboard/#profile1');
    }
    public function changepassword(Request $request)
    {$user=auth()->user();
    $oldpassword=bcrypt($request->get('oldpassword'));

        $status= $user->update([
            'password' => bcrypt($request->get('newpassword')),
        ]);
        $data_ = array('name' => $user->name, 'password' => $request->get('newpassword'));

        Mail::send(['html'=>'mail.ressetpassword'], $data_, function($message) use ($user) {
            $message->to($user->email, $user->name)->subject
            ('Changement de mot de passe');
            $message->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'));
        });
        return redirect('app/dashboard/#message');
    }
}
