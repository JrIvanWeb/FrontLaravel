<?php

namespace App\Http\Controllers;

use App\Mail\AdmissionInquiryMail;
use App\Models\Info;
use App\Models\Programa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;

class AdmissionController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'programId' => [
                'required',
                'integer',
                Rule::exists('Programas', 'Id')->where(fn ($query) => $query->where('Estado', true)),
            ],
        ]);

        $program = Programa::query()->findOrFail($data['programId']);
        $recipient = Info::query()->orderBy('Id')->value('Correo') ?: config('mail.admissions_to');

        if (!$recipient) {
            return response()->json([
                'message' => 'Configura el correo institucional en la información del sitio antes de recibir solicitudes.',
            ], 503);
        }

        Mail::to($recipient)->send(new AdmissionInquiryMail(
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            program: $program->Nombre,
        ));

        return response()->json([
            'ok' => true,
            'message' => 'La solicitud fue enviada correctamente a la corporación.',
        ], 202);
    }
}
