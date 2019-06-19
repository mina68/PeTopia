<?php

Route::group(
	[
	    'prefix'   		=> 'admin',
	    'namespace'  	=> 'Admin'
  	], 
  	function () {

  		// authentication
  		Route::get('login', 'Auth\LoginController@showLoginForm')->name('login.admin');
        Route::post('login', 'Auth\LoginController@login');
        Route::post('logout', 'Auth\LoginController@logout')->name('logout.admin');
        
  		Route::group(
  			[
  				'middleware'	=> 'auth:admin'
  			],
  			function(){
  				Route::get('/', 'DashboardController@index')->name('home.admin');
  				Route::post('/refreshCsrfAjax', 'DashboardController@refreshCsrfAjax');
  				
				// pets
				Route::resource('pets', 'PetController', ['except' => ['show'] ] );
				Route::get('/pets/index', 'PetController@apiIndex');
				Route::get('/pets/{pet}/show', 'PetController@show');
				Route::get('/pets/{pet}/hide', 'PetController@hide');

				Route::get('/pets/{pet}/medical_history', 'PetController@medicalHistoryIndex');
				Route::get('/pets/{pet}/medical_history/index', 'PetController@medicalHistoryApiIndex');
				Route::post('/pets/{pet}/medical_history', 'PetController@medicalHistoryStore');
				Route::delete('/pets/{pet}/medical_history/{medical_vaccination}', 'PetController@medicalHistoryDestroy');

				// foods
				Route::resource('foods', 'FoodController', ['except' => ['show'] ] );
				Route::get('/foods/index', 'FoodController@apiIndex');

				// drugs
				Route::resource('drugs', 'DrugController', ['except' => ['show'] ] );
				Route::get('/drugs/index', 'DrugController@apiIndex');

				// supplies
				Route::resource('supplies', 'SupplyController', ['except' => ['show'] ] );
				Route::get('/supplies/index', 'SupplyController@apiIndex');

				// medical vaccinations
				Route::resource('medical_vaccinations', 'MedicalVaccinationController', ['except' => ['show'] ] );
				Route::get('/medical_vaccinations/index', 'MedicalVaccinationController@apiIndex');

				// pet types
				Route::resource('pet_types', 'PetTypeController', ['except' => ['show'] ] );
				Route::get('/pet_types/index', 'PetTypeController@apiIndex');

				// food types
				Route::resource('food_types', 'FoodTypeController', ['except' => ['show'] ] );
				Route::get('/food_types/index', 'FoodTypeController@apiIndex');
  			}
  		);
	}
);
