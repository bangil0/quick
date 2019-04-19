<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', function(){
	if (Auth::check() && Auth::user()->level == "relawan") {
		return redirect('relawan');
	}elseif (Auth::check() && Auth::user()->level == "admin") {
		return redirect('admin/dashboard');
	}else{
		return redirect()->route('login');
	}
})->name('home');

Route::group(['prefix'=>'relawan'],function(){
	Route::get('/','VolunteerController@index');

	Route::group(['prefix'=>'pemilu'],function(){
		Route::get('/','VolunteerController@create');
		Route::get('caleg/{pemilu_setting_id}','VolunteerController@caleg');
	});
});

Route::group(['prefix'=>'province','middleware'=>'admin'],function(){
	Route::get('/','ProvinsiController@index')->name('province.index');
	Route::post('store','ProvinsiController@store')->name('province.store');
	Route::get('destroy/{id}','ProvinsiController@destroy')->name('province.destroy');
	Route::patch('update/{id}','ProvinsiController@update')->name('province.update');
});

Route::group(['prefix'=>'kokab','middleware'=>'admin'],function(){
	Route::get('/','KokabController@index')->name('kokab.index');
	Route::post('store','KokabController@store')->name('kokab.store');
	Route::get('destroy/{id}','KokabController@destroy')->name('kokab.destroy');
	Route::patch('update/{id}','KokabController@update')->name('kokab.update');
});

Route::group(['prefix'=>'kecamatan','middleware'=>'admin'],function(){
	Route::get('/','KecamatanController@index')->name('kecamatan.index');
	Route::post('store','KecamatanController@store')->name('kecamatan.store');
	Route::get('destroy/{id}','KecamatanController@destroy')->name('kecamatan.destroy');
	Route::patch('update/{id}','KecamatanController@update')->name('kecamatan.update');
});

Route::get('kecamatan/kokab/{province_id}','KecamatanController@kokab')->name('kecamatan.kokab');

Route::group(['prefix'=>'kelurahan','middleware'=>'admin'],function(){
	Route::get('/','KelurahanController@index')->name('kelurahan.index');
	Route::post('store','KelurahanController@store')->name('kelurahan.store');
	Route::get('destroy/{id}','KelurahanController@destroy')->name('kelurahan.destroy');
	Route::patch('update/{id}','KelurahanController@update')->name('kelurahan.update');
});

Route::get('kelurahan/kecamatan/{kokab_id}','KelurahanController@kecamatan')->name('kelurahan.kecamatan');

Route::group(['prefix'=>'partai','middleware'=>'admin'],function(){
	Route::get('/','PartaiController@index')->name('partai.index');
	Route::post('store','PartaiController@store')->name('partai.store');
	Route::get('destroy/{id}','PartaiController@destroy')->name('partai.destroy');
	Route::patch('update/{id}','PartaiController@update')->name('partai.update');
});

Route::group(['prefix'=>'type_candidates','middleware'=>'admin'],function(){
	Route::get('/','TypeCandidatesController@index')->name('type_candidates.index');
	Route::post('store','TypeCandidatesController@store')->name('type_candidates.store');
	Route::get('destroy/{id}','TypeCandidatesController@destroy')->name('type_candidates.destroy');
	Route::patch('update/{id}','TypeCandidatesController@update')->name('type_candidates.update');
});

Route::group(['prefix'=>'caleg','middleware'=>'admin'],function(){
	Route::get('/','CalegController@index')->name('caleg.index');
	Route::post('store','CalegController@store')->name('caleg.store');
	Route::get('destroy/{id}','CalegController@destroy')->name('caleg.destroy');
	Route::patch('update/{id}','CalegController@update')->name('caleg.update');
});

Route::group(['prefix'=>'tps','middleware'=>'admin'],function(){
	Route::get('/','TpsController@index')->name('tps.index');
	Route::post('store','TpsController@store')->name('tps.store');
	Route::get('destroy/{id}','TpsController@destroy')->name('tps.destroy');
	Route::patch('update/{id}','TpsController@update')->name('tps.update');
});

Route::get('tps/di/{kelurahan_id}','TpsController@kelurahan')->name('tps.kelurahan');

Route::get('tps/kelurahan/{kecamatan_id}','TpsController@kelurahan_by_kecamatan');
Route::get('tps/pemilu/{type}/{prov_id}/{kokab_id}','TpsController@pemilu');

Route::group(['prefix'=>'pemilu_setting','middleware'=>'admin'],function(){
	Route::get('/','PemiluSettingController@index')->name('pemilu_setting.index');
	Route::post('store','PemiluSettingController@store')->name('pemilu_setting.store');
	Route::get('destroy/{id}','PemiluSettingController@destroy')->name('pemilu_setting.destroy');
	Route::patch('update/{id}','PemiluSettingController@update')->name('pemilu_setting.update');
});

Route::group(['prefix'=>'admin','middleware'=>'admin'],function(){
	Route::get('relawan','VolunteerController@admin');
	Route::get('dashboard','HomeController@index');
});

Route::group(['prefix'=>'transaction','middleware'=>'auth'],function(){
	Route::post('store','TransactionController@store');
	Route::get('result','TransactionController@result');
	Route::get('caleg/{pemilu_setting_id}','TransactionController@caleg');
	Route::get('caleg_vote/{pemilu_setting_id}','TransactionController@getCalegVote');
});

Route::group(['prefix'=>'candidates_pemilu','middleware'=>'admin'],function(){
	Route::get('/{pemilu_setting_id}','CandidatesPemiluController@index')->name('candidates_pemilu.index');
	Route::get('destroy/{id}','CandidatesPemiluController@destroy')->name('candidates_pemilu.destroy');
	Route::patch('update/{id}','CandidatesPemiluController@update')->name('candidates_pemilu.update');
});

