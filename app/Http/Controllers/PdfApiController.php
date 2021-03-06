<?php

namespace App\Http\Controllers;
use App\Models\File;
use Illuminate\Http\Request;
use ZipArchive;

class PdfApiController extends Controller
{
  

    public function storeOnePdf(Request $req){
      
        $pdf=new File();
        
        $req->validate([
            'title'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg',
            'readUrl'=>'required',
            'ageGroup'=>'required'
        ]);

        $newImageName='https://clicklab.app/uploads/images/read/'.$req->image->getClientOriginalName();
        $req->image->move("/var/www/clicklab.app/public_html/uploads/images/read/",$newImageName);
        
        $newpdfName='https://clicklab.app/uploads/pdf/read/'.$req->readUrl->getClientOriginalName();
        $pdf->readUrl=$newpdfName;
        if(substr($pdf->readUrl,strlen($pdf->readUrl)-3,strlen($pdf->readUrl))=='zip'){
            
            $zip= new ZipArchive;
            $newpdfName='https://clicklab.app/uploads/pdf/read/'.$req->readUrl->getClientOriginalName();
            
         $res=$zip->open($req->readUrl->move("/var/www/clicklab.app/public_html/uploads/pdf/read/",$newpdfName));
         if ($res===true){
             $zip->extractTo('/var/www/clicklab.app/public_html/uploads/pdf/read/');
             $zip->close();
             $pdf->readUrl=$newpdfName=substr($newpdfName,0,strlen($newpdfName)-4)."/";
         }
        
      
  }
       else{
    $newpdfName='https://clicklab.app/uploads/pdf/read/'.$req->readUrl->getClientOriginalName();
    $req->readUrl->move("/var/www/clicklab.app/public_html/uploads/pdf/read/",$newpdfName);
    $pdf->readUrl=$newpdfName;

 }
        
        $pdf->title=$req->title;
        $pdf->description=$req->description;
        $pdf->ageGroup=$req->ageGroup;
        // $pdf->readUrl=$newpdfName;
        $pdf->image=$newImageName;    
        $pdf->save();
        
      }
      public function getAllPdf(){

        $pdf=File::all();
        return response()->json(['pdf'=>$pdf]);
        
    }
    public function destroyOnepdf($id){
            
        File::find($id)->delete();

    }
}
