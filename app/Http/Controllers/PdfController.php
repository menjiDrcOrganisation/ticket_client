<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PdfController extends Controller
{
  public function generateTicket(Request $request)
{
    // Texte pour le QR code (utilisez un ID unique)
    $qrText = $request->qrcode ?: "TICKET_" . uniqid() . "_" . $request->name_user . "_" . $request->name_event;
    
    // Générer l'URL du QR code via une API
    $qrCodeUrl = "https://api.qrserver.com/v1/create-qr-code/?size=300x300&format=png&data=" . urlencode($qrText);
    
    $data = [
        'ticket' => [
            'user_name' => htmlspecialchars($request->name_user),
            'event_name' => htmlspecialchars($request->name_event),
            'location' => htmlspecialchars($request->location),
            'type' => htmlspecialchars($request->type),
            'quantity' => (int) $request->quantity,
            'price' => number_format($request->price, 2, ',', ' '),
            'devise' => htmlspecialchars($request->devise),
            'total' => number_format($request->price * $request->quantity, 2, ',', ' '),
            'qrcode_url' => $qrCodeUrl, // IMPORTANT: URL du QR code
            'purchase_date' => \Carbon\Carbon::parse($request->date_achat)->format('d/m/Y'),
            'event_date' => \Carbon\Carbon::parse($request->debut)->format('d/m/Y'),
            'event_time' => \Carbon\Carbon::parse($request->heure)->format('H:i'),
            'photo_affiche' => $request->photo_affiche,
            'ticket_id' => strtoupper(substr(md5($qrText), 0, 8)),
        ]
    ];
    
    $pdf = PDF::loadView('pdf.billet', $data);
    
    $pdf->setOptions([
        'isHtml5ParserEnabled' => true,
        'isRemoteEnabled' => true,
        'isPhpEnabled' => true,
        'defaultFont' => 'sans-serif',
        'chroot' => public_path(), // Important pour dompdf
    ]);
    
    return $pdf->download('ticket.pdf');
}


 public function testTicket(Request $request)
{
   
    
    $data = [
                'ticket' => [
                    'user_name' => "gg",
                    'event_name' => "gg",
                    'location' => "gg",
                    'type' => "gg",
                    'quantity' => "gg",
                    'price' => "gg",
                    'devise' => "gg",
                    'total' => "gg",
                    'qrcode' => "gg",
                    'purchase_date' => "gg",
                    'event_date' => "gg",
                    'event_time' => "gg",
                    'photo_affiche' => "gg",
                    'ticket_id' => "gg",
                ]
            ];
         $pdf = PDF::loadView('pdf.billet',  $data);

    return view('pdf.billet',$data);// Télécharger  
}



}
