<?php


namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\DemandeDepannage;
use App\Models\FicheDepannage;
use App\Models\FicheSortie;
use App\Models\LignePieceDepannage;
use App\Models\PieceDetache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FicheController  extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = FicheSortie::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('f_name', 'like', "%{$value}%")
                        ->orWhere('l_name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new FicheSortie();
        }

        $agents = $agents->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.fiche.index', compact('agents', 'search'));
    }
    public function depannage(Request $request){
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = FicheDepannage::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('date_reservation', 'like', "%{$value}%")
                        ->orWhere('heure_reservation', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new FicheDepannage();
        }
        $demandes=DemandeDepannage::query()->where(['status'=>DemandeDepannage::ENVOYE])->get();
        $agents = $agents->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.fiche.depannage', compact('agents', 'search','demandes'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request,$id)
    {
        $user=auth()->user();
        $file=FicheDepannage::query()->where(['demande_depannage_id'=>$id])->first();
        if (is_null($file)){
            $file=new FicheDepannage();
            $file->demande_depannage_id=$id;
            $file->demande_depannage_id=$id;
            $file->user_id=$user->id;
            $file->isclose=false;
            $file->observation="";
            $file->save();
        }
        if ($request->method()=="POST"){
            $file->update([
               'observation'=>$request->get('observation'),
                'maindoeuvre'=>$request->get('maindoeuvre'),
                'totalpiece'=>$request->get('totalpiece'),
                'total'=>$request->get('total'),
            ]);
        }
        $pieces=PieceDetache::all();
        $lines=LignePieceDepannage::query()->where(['fiche_depannage_id'=>$file->id])->get();
        return view('pages.fiche.createfiledepannage', compact('file','pieces','lines'));
    }
    public function addpieceline(Request $request){
        $id=$request->get('item');
        $fiche=$request->get('fiche');
        $operation=$request->get('operation');
        $quantite=$request->get('quantite');
        if ($operation=="add"){
            $line=LignePieceDepannage::query()->where(['fiche_depannage_id'=>$fiche,'piece_detache_id'=>$id])->first();
            if (is_null($line)){
                $line=new LignePieceDepannage();
                $line->fiche_depannage_id=$fiche;
                $line->piece_detache_id=$id;
                $line->quantite=$quantite;
                $line->save();
            }else{
                $line->update([
                   'quantite'=>$quantite
                ]);
            }

        }else{
            $line=LignePieceDepannage::query()->find($id);
            $line->delete();
        }
        $lines_=[];
        $lines=LignePieceDepannage::query()->where(['fiche_depannage_id'=>$fiche])->get();
        foreach ($lines as $line){
            $lines_[]=[
                'libelle'=>$line->piece->libelle,
                'quantite'=>$line->quantite,
                'id'=>$line->id,
            ];
        }
        return response()->json(['data' => $lines_, 'status' => true]);

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'libelle' => 'required',
            'marque' => 'required',
            'modele' => 'required',
            'quantity' => 'min:1',
        ]);

        $libelle = $request->libelle;
        $piece = PieceDetache::where(['libelle' => $libelle])->first();
        if (isset($piece)){
            //  Toastr::warning(translate('This phone number is already taken'));
            return back();
        }

        DB::transaction(function () use ($request, $libelle) {
            $piece = new PieceDetache();
            $piece->libelle = $request->libelle;
            $piece->marque = $request->marque;
            //$user->image = Helpers::upload('agent/', 'png', $request->file('image'));
            $piece->modele = $request->modele;
            $piece->quantite = $request->quantite;
            $piece->save();
        });

        // Toastr::success(translate('Agent Added Successfully!'));
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(PieceDetache $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $piece = PieceDetache::find($id);
        return view('pages.piece.update', compact('piece'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $conge = PieceDetache::find($id);
        $conge->update([
            'libelle' => $request->libelle,
            'modele' => $request->modele,
            'marque' => $request->marque,
            'quantite' => $request->quantite,
        ]);
        return redirect()->route('piecedetache.index');
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
