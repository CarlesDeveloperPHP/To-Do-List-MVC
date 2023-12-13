<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 */
$routes = array(
	
	//Create
	'/getinsertform'		=>  'application#getViewInsertForm',
	'/createTask'			=>  'application#createTask',
	//Read
	'/'						=>  'application#getAllTasksList',
	'/getAllTasksList'  	=>	'application#getAllTasksList',
	//Update
	'/showEditTask/:id'		=> 'application#showEditTask',
	'/showEditTask/editTask'=> 'application#editTask',
	//Delete
	'/deleteTask/:id' 		=> 'application#deleteTask',
	'/getViewPreDelete/:id' => 'application#getViewPreDelete',
	// Search
	'/getsearchform'		=>  'application#getViewSearchForm',
	'/getsearchresults'		=>  'application#getSearchResults',
	//Test
	'/test' 				=> 'test#index'
	

	
	

);
