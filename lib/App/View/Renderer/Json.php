<?php
namespace App\View\Renderer;

class Json extends \App\View\Renderer
{
	public function render($path = '', $view = null) {
		// Ignore path... just output $view vars as JSON.
		$vars = null;
		if (is_object($view)) {
			$vars = (array)$view;
		}
		
		header('Content-Type: application/json');
		
		echo @json_encode($vars);
	}
}