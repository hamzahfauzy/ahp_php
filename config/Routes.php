<?php
use vendor\zframework\Route;
use vendor\zframework\Request;
use vendor\zframework\Session;
use app\User;


Route::middleware("Auth")->post("/login","IndexController@doLogin");
Route::middleware("Auth")->get("/login","IndexController@login");
Route::middleware("Auth")->get("/logout","IndexController@logout");
Route::get("/","IndexController@login");
// for admin
Route::middleware("Admin")->prefix("/admin")->namespaces("Admin")->group(function(){
	Route::get("/","IndexController@index");
	Route::get("/tentang","IndexController@tentang");
	Route::get("/hasil", "IndexController@hasil");

	// Kriteria CRUD
	Route::get("/kriteria","KriteriaController@index");
	Route::get("/kriteria/create","KriteriaController@create");
	Route::get("/kriteria/edit/{kriteria}","KriteriaController@edit");
	Route::post("/kriteria/insert","KriteriaController@insert");
	Route::post("/kriteria/update","KriteriaController@update");
	Route::get("/kriteria/delete/{kriteria}","KriteriaController@delete");
	Route::get("/kriteria/perhitungan","KriteriaController@perhitungan");
	Route::post("/kriteria/perhitungan/save","KriteriaController@savePerhitungan");

	// Alternatif CRUD
	Route::get("/alternatif","AlternatifController@index");
	Route::get("/alternatif/create","AlternatifController@create");
	Route::get("/alternatif/edit/{alternatif}","AlternatifController@edit");
	Route::post("/alternatif/insert","AlternatifController@insert");
	Route::post("/alternatif/update","AlternatifController@update");
	Route::get("/alternatif/delete/{alternatif}","AlternatifController@delete");	
	Route::get("/alternatif/perhitungan","AlternatifController@perhitungan");
	Route::post("/alternatif/perhitungan/save","AlternatifController@savePerhitungan");

});