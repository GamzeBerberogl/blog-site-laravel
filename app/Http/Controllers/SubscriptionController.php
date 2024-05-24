<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscriber;

class SubscriptionController extends Controller
{
    public function subscribe(Request $request)
    {
        // Formdan gelen verileri doğrula
        $request->validate([
            'email' => 'required|email|unique:subscribers,email',
        ]);

        // Yeni bir abone oluştur
        Subscriber::create([
            'email' => $request->email,
        ]);

        // Başarı mesajı ile geri dön
        return redirect()->back()->with('status', 'Aboneliğiniz oluşturuldu.');
    }
}
