<?php

//simple postscontrollers...
Route::get('/homes','PostsController@homes');
Route::get('/','PostsController@homes');

//if login success for normal users...
Route::get('/dashboard','DashboardController@index');

//this helps to have common routes(those who need authetication) binds 
//problem is on using it, default login and custom admin login may conflict
//instead i used Session for my login, and default login is handle by it's own code...
//I am not using this , because it assumes the laravel default auth
Route::group(['middleware' => ['auth']],function(){
		
});

//login form for admin...
Route::match(['get','post'],'/admin','AdminController@login');

//if login success for admin...
Route::get('admin/dashboard', 'AdminController@dashboard');

Route::Auth();
//view the list of users...
Route::get('/admin/view','AdminController@view');

//view the list of admins...
Route::get('/admin/view2','AdminController@view_admins');

//simple logout functionality...
Route::get('/logout', 'AdminController@logout');

//to delete the users...
Route::get('/admin/delete/{id}','AdminController@delete');

//form to add users...
Route::match(['get','post'],'/admin/add_user','AdminController@register_users');

//to update users...
Route::get('/admin/{id}/edit','AdminController@edit');    

Route::patch('/admin/update/{id}',[
    'uses' =>'AdminController@update',
    'as'   => 'admin.update'
]);


//view the list of submenus...
Route::get('/submenu/view','SubmenuController@index');

//form to create submenu...
Route::get('/submenu/create','SubmenuController@create');

//to update menus...
Route::get('/menu/{id}/edit','MenuController@edit');

//view the list of menus...
Route::get('/menu/view','MenuController@index');

//to toogle active to inactive and vice-versa in button pressed
Route::get('/admin/toogle/{id}','AdminController@toogle_status');
Route::get('/menu/toogle/{id}','MenuController@toogle_status');
Route::get('/submenu/toogle/{id}','SubmenuController@toogle_status');

Route::patch('/menu/update/{id}',[
    'uses' => 'MenuController@update',
    'as'  => 'menu.update'
]);
    
//to delete the menus...
Route::get('/menu/delete/{id}','MenuController@destroy');
Route::get('/submenu/delete/{id}','SubmenuController@destroy');

//for menus...
Route::resource('menus','MenuController');

Route::post('/menus/store',[
        'uses'=>'MenuController@store',
        'as'=>'menu.store'
    ]);

Route::post('/submenus/store',[
        'uses'=>'SubmenuController@store',
        'as'=>'submenu.store'
    ]);

//to update submenus...
Route::get('/submenu/{id}/edit','SubmenuController@edit');

Route::patch('/submenu/update/{id}',[
    'uses' => 'SubmenuController@update',
    'as'  => 'submenu.update'
]);

Route::get('/teacher/update_profile/{id}','TeacherController@show');