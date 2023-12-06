<?php 

/**
 * Used to define the routes in the system.
 * 
 * A route should be defined with a key matching the URL and an
 * controller#action-to-call method. E.g.:
 * 
 * '/' => 'index#index',
 * '/calendar' => 'calendar#index'
 * '/getViewPreDelete/(?P<task_id>[0-9]+)/(?P<task_name>[a-zA-Z]+)' => 'application#getViewPreDelete',
 */
$routes = array(
	'/test' => 'test#index',
	'/'				=>  'application#getAllTasksList',
	'/getAllTasksList'  =>	'application#getAllTasksList',
	'/getinsertform'	=>  'application#getViewInsertForm',
	'/createTask'		=>  'application#createTask',
	'/getViewPreDelete/:id' => 'application#getViewPreDelete',
	'/deleteTask/:id' => 'application#deleteTask',
	'/showEditTask/:id' => 'application#showEditTask',
	'/showEditTask/editTask' => 'application#editTask',
	
	

);
