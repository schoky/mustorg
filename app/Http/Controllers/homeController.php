<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;

class homeController extends Controller
{
    public function home() {
        return view('static.home');
    }

    public function about() {
        return view('static.about');
    }

    public function contact() {
        return view('static.contact');
    }

    public function submit(ContactRequest $request) {

        $validated = $request->validated();
        // Перенаправление с сообщением об успехе
        return redirect()->route('contact')->with('success', 'Спасибо! Ваше обращение отправлено.');
    }
}