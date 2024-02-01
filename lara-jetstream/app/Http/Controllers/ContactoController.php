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
        return view('contacto.index');
    }

    public function sendForm(Request $request)
    {
        $request->validate([
            'nombre' => ['required', 'string', 'min:5'],
            'contenido' => ['required', 'string', 'min:10'],
            'email' => ['required', 'email'],
        ]);

        $email = auth()->user() != null ? auth()->user()->email : $request->email;

        try {
            Mail::to('responsable@correo.es')
                ->send(new ContactoMailable($request->nombre, $request->contenido, $email));

            return redirect()->route('home')->with('info', 'Email enviado correctamente');
        } catch (Exception $ex) {
            return redirect()->route('home')->with('info', 'Hubo un error al enviar el mensaje, vuelve a intentarlo');
        }
    }
}
