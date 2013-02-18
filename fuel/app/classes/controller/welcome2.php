<?php

/**
 * The Welcome Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 * 
 * @package  app
 * @extends  Controller
 */
class Controller_Welcome extends Controller
{

	public function action_index3()
    {
        foreach ($display_vars['vars'] as $config_key => $vars) 
        {
            if (!is_array($vars) && strpos($config_key, 'legend') === false) 
            { 
                continue; 
            }
        }
        return Response::forge(View::forge('welcome/index'));
	}
}
