<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\SubscriptionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/balance', function () {
    $user = Auth::user();
    $getUser = User::find($user->id);
    $getUser->balance += request()->amount;
    if ($getUser->save()) {
        return redirect('/dashboard');
    }
})->middleware(['auth', 'verified']);

Route::match(['get', 'post'], '/purchase-subscription/{plan_id}', [SubscriptionController::class, 'purchaseItem']);

Route::post('search/{model}', [SearchController::class, 'search']);

