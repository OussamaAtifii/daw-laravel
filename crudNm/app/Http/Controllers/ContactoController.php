<?php

namespace App\Http\Controllers;

use App\Mail\ContactoMailable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function showForm()
    {
        return view('contactform.form');
    }

    public function sendForm(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:5'],
            'email' => ['required', 'email'],
            'contenido' => ['required', 'string', 'min:10'],
        ]);

        try {
            Mail::to("admin@correo.es")->send(new ContactoMailable(
                ucwords($request->nombre),
                $request->email,
                ucfirst($request->contenido)
            ));

            return redirect()->route('home')->with('info', 'Correo enviado, gracias por sus comentarios');
        } catch (Exception $ex) {
            dd('Error: ' . $ex->getMessage());
            return redirect()->route('home')->with('error', 'No se pudo enviar el correo, intentelo de nuevo');
        }
    }
}
