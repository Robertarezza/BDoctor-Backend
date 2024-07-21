<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index() {

        $user = Auth::user();
        $reviews = Review::where('doctor_id', $user->id)->orderByDesc('created_at')->first();
        $messages = Message::where('doctor_id', $user->id)->orderByDesc('created_at')->first();
        return view('admin.dashboard', compact('user', 'reviews', 'messages'));
    }
}
