<?php

namespace App\Http\Controllers;
use App\Http\Requests\UserRequest;
use App\Rules\Uppercase;

class FormController extends Controller
{    
    public function submitForm(UserRequest $request)
    {
        $request->validate([
            'name' => ['required', new Uppercase],
        ]);
        return "Data berhasil divalidasi!";
    }
}
