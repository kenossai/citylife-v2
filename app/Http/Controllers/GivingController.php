<?php

namespace App\Http\Controllers;

use App\Models\GiftAidDeclaration;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GivingController extends Controller
{
    public function index(): View
    {
        return view('pages.giving');
    }

    public function storeGiftAid(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'first_name'       => ['required', 'string', 'max:100'],
            'last_name'        => ['required', 'string', 'max:100'],
            'address'          => ['required', 'string', 'max:255'],
            'postcode'         => ['required', 'string', 'max:20'],
            'phone'            => ['required', 'string', 'max:30'],
            'email'            => ['required', 'email', 'max:255'],
            'gift_aid_code'    => ['required', 'string', 'max:50'],
            'declaration_date' => ['required', 'date'],
            'confirmed'        => ['accepted'],
        ]);

        GiftAidDeclaration::create($validated + ['confirmed' => true]);

        return redirect()->route('give')->with('gift_aid_success', true);
    }
}

