<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function enviar(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'asunto' => 'required|string|max:255',
            'mensaje' => 'required|string',
        ]);

        // Aquí puedes agregar la lógica para enviar el correo electrónico
        // Por ejemplo, usando la fachada Mail de Laravel

        /*
        Mail::send('emails.contacto', [
            'nombre' => $request->nombre,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'asunto' => $request->asunto,
            'mensaje' => $request->mensaje,
        ], function ($message) use ($request) {
            $message->to('info@bungrill.com', 'Bun & Grill');
            $message->subject('Nuevo mensaje de contacto: ' . $request->asunto);
        });
        */

        // Por ahora, simplemente redirigimos con un mensaje de éxito
        return redirect()->back()->with('success', 'Tu mensaje ha sido enviado correctamente. Nos pondremos en contacto contigo pronto.');
    }
}
