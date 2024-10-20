<?php

use App\Models\User;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;

Route::get('/dashboard', function () {
    $user = Auth::user();
    $referral_link = url('/register?referral=' . $user->referral_code);
    return view('dashboard', compact('user', 'referral_link'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/balance', function () {
    $user = Auth::user();
    $getUser = User::find($user->id);
    $getUser->balance += request()->amount;
    if ($getUser->save()) {
        return redirect('/dashboard');
    }
})->middleware(['auth', 'verified'])->name('balance');

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        $plans = SubscriptionPlan::all();
        return view('welcome', compact('plans'));
    });

    Route::match(['get', 'post'], '/purchase-subscription/{plan_id}', [SubscriptionController::class, 'purchaseItem'])->name('purchase.subscription');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
