<?php


namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\DemandeDepannage;
use App\Models\FicheDepannage;
use App\Models\FicheSortie;
use App\Models\LignePieceDepannage;
use App\Models\PieceDetache;
use Barryvdh\DomPDF\Facade\Pdf;
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
        $lines=LignePieceDepannage::query()->where(['fiche_depannage_id'=>$file->id])->get();
        if ($request->method()=="POST"){
            $total_piece=0.0;
            foreach ($lines as $line){
                $total_piece+=($line->quantite* $line->piece->price_sell);
            }
            $file->update([
                'priorite'=>$request->get('priorite'),
                'status'=>DemandeDepannage::REPARATION,
                'observation'=>$request->get('observation'),
                'maindoeuvre'=>$request->get('maindoeuvre'),
                'totalpiece'=>$total_piece,
                'total'=>$request->get('maindoeuvre')+$total_piece,
            ]);
            $demande=$file->demande();
            $demande->update([
                'priorite'=>$request->get('priorite'),
                'status'=>DemandeDepannage::REPARATION,
            ]);
        }
        $pieces=PieceDetache::all();
        return view('pages.fiche.createfiledepannage', compact('file','pieces','lines'));
    }
    public function createbonsortie(Request $request,$id)
    {
        $user=auth()->user();
        $file=FicheSortie::query()->where(['fiche_depannage_id'=>$id])->first();
        if (is_null($file)){
            $file=new FicheSortie();
            $file->fiche_depannage_id=$id;
            $file->user_id=$user->id;
            $file->date_sortie=date('Y-m-d');
            $file->save();
        }
        $fiche_depannage=$file->fiche_depannage();
        $fiche_depannage->update([
            'isclose'=>true,
        ]);
        return view('pages.fiche.createfilesortie', compact('file'));
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

    public function printFiche($id){
        $fiche=FicheDepannage::query()->find($id);
        $lines=LignePieceDepannage::query()->where(['fiche_depannage_id'=>$fiche->id])->get();
        $pdf = PDF::loadView('pages.fiche.view_pdf_fiche', ['fiche'=>$fiche,'lines'=>$lines]);
        // download PDF file with download method
       // return $pdf->download('pdf_file.pdf');
        return $pdf->stream('pdf_file.pdf');
    }
    public function printDemande($id){
        $demande=DemandeDepannage::query()->find($id);
        $pdf = PDF::loadView('pages.fiche.view_pdf_demande', ['demande'=>$demande]);
        // download PDF file with download method
        return $pdf->stream('pdf_file.pdf');
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
