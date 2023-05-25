<?php


namespace App\Http\Controllers;


use App\Helpers\helpers;
use App\Models\DemandeDepannage;
use Illuminate\Http\Request;

class DemandeController extends Controller
{
    public function index(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $agents = DemandeDepannage::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('f_name', 'like', "%{$value}%")
                        ->orWhere('l_name', 'like', "%{$value}%")
                        ->orWhere('phone', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        } else {
            $agents = new DemandeDepannage();
        }

        $agents = $agents->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
        return view('pages.demande.index', compact('agents', 'search'));
    }
public function demandepending(Request $request){
    $query_param = [];
    $search = $request['search'];
    if ($request->has('search')) {
        $key = explode(' ', $request['search']);
        $agents = DemandeDepannage::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('f_name', 'like', "%{$value}%")
                    ->orWhere('l_name', 'like', "%{$value}%")
                    ->orWhere('phone', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%");
            }
        });
        $query_param = ['search' => $request['search']];
    } else {
        $agents = new DemandeDepannage();
    }

    $agents = $agents->newQuery()->where("status","!=",DemandeDepannage::COMPLETED)->latest()->paginate(Helpers::pagination_limit())->appends($query_param);
    return view('pages.demande.pending', compact('agents', 'search'));
}
}
