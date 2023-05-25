<?php


namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\PieceDetache;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PieceController extends Controller
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
            $agents = PieceDetache::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('f_name', 'like', "%{$value}%")
                        ->orWhere('l_name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new PieceDetache();
        }

        $agents = $agents->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.piece.index', compact('agents', 'search'));
    }
    public function paiement(Request $request){
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = PieceDetache::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('date_reservation', 'like', "%{$value}%")
                        ->orWhere('heure_reservation', 'like', "%{$value}%")
                    ;
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new PieceDetache();
        }

        $agents = $agents->Caisse()->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('back.caisse.paiement', compact('agents', 'search'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.caisse.create', []);
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
