<?php

namespace App\Http\Controllers\Zarpes;

use App\Http\Controllers\Controller;
use App\Mail\ZarpesMail;
use App\Mail\ZarpesPDFMail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public function mailZarpe($receiver,$subject,$data,$view){

        Mail::to($receiver)->send(new ZarpesMail($subject,$data,$view));
    }

    public function mailZarpePDF($receiver,$subject,$data,$view){
        $pdf=new PdfGeneratorController();
        $file=$pdf->correo($data['id']);
        Mail::to($receiver)->send(new ZarpesPDFMail($subject,$data,$view,$file));
    }
    public function mailEstadiaPDF($receiver,$subject,$data,$view){
        $pdf=new PdfGeneratorController();
        $file=$pdf->correoEstadia($data['id']);
        Mail::to($receiver)->send(new ZarpesPDFMail($subject,$data,$view,$file));
    }

    public function mailZarpePDFZI($receiver,$subject,$data,$view){
        $pdf=new PdfGeneratorController();
        $file=$pdf->correoZI($data['id']);
        Mail::to($receiver)->send(new ZarpesPDFMail($subject,$data,$view,$file));
    }
}
