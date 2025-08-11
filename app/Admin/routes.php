<?php

Route::get('', ['as' => 'admin.dashboard', function () {
	return redirect('/admin/products');
}]);

Route::get('/back', ['as' => 'admin.back', function () {
	return redirect()->route('home');
}]);