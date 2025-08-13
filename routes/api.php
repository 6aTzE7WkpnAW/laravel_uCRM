<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Customer;

// 既存のルート
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// テスト用ルート
Route::get('/test', function () {
    return [
        'message' => 'axios動作確認成功!',
        'timestamp' => now(),
        'status' => 'ok'
    ];
});

// 認証なしで検索テスト（後で認証付きに戻す）
Route::middleware('auth:sanctum')->get('/searchCustomers', function(Request $request){
    return Customer::query()
        ->when($request->search, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('kana', 'like', '%' . $search . '%')
                ->orWhere('tel', 'like', '%' . $search . '%');
        })
        ->select('id','name','kana','tel')
        ->orderBy('id', 'asc')
        ->paginate(20);
});