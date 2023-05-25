<?php


namespace App\Http\Controllers;


use App\Models\Connexion;
use App\Models\DemandeDepannage;
use App\Models\FicheSortie;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class DashboardController
{
    public function dashboard(){
        $vistes=Connexion::all();
        $customers=User::Customer()->get();
        $depannages=DemandeDepannage::all();
        $sorties=FicheSortie::all();
        return view('pages/dashboard',compact('vistes','customers','depannages','sorties'));
    }
// Generate PDF
    public function createPDF() {
        // retreive all records from db
        $data = User::all();
        // share data to view
        view()->share('employee',$data);
        $pdf = PDF::loadView('pdf_view', $data);
        // download PDF file with download method
        return $pdf->download('pdf_file.pdf');
    }
}
