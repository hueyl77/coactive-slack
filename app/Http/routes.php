<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('slack/lantern', 'SlackLanternController');