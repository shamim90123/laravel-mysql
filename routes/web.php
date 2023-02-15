<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-procedure', function () {
    $user_id = 1;

    $post = DB::select("CALL get_users_by_id(".$user_id.")");
    if ($post) {
        return $post;
    } else {
        return 'no user found';
    }
});

Route::get('/get-procedure-book', function () {
    $book_id = 1;

    $post = DB::select("CALL select_by_author_id(".$book_id.")");
    return $post;
});
