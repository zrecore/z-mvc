<?php
namespace App;
class Controller
{
	protected $view;
	protected $renderer;
	protected $request;
	protected $layout = 'default';
	
	public function __construct()
	{
		$this->view = new \stdClass();
		$this->init();
	}
	
	public function getLayout() {return $this->layout;}
	public function setLayout($value) {$this->layout = $value; return $this;}
	
	protected function redirect($url)
	{
		header('Location:' . $url);
	}
	
	protected function forward($action) {
		$actionMethod = $this->actionToViewName($action) . 'Action';
		$this->$actionMethod();
	}
	
	
	/************/
	
	/************/
	
	public function preDispatch()
	{
		
	}
	
	public function init() {
		
	}
	
	public function setRenderer($renderer) {
		$this->renderer = $renderer;
		return $this;
	}
	
	public function getRenderer() {
		return $this->renderer;
	}
	/**
	 * Get the request object.
	 * @return Simple_Controller_Request
	 */
	public function getRequest() {
		if (empty($this->request)) {
			$this->request = new App\Controller\Request($_REQUEST);
		}
		return $this->request;
	}
	
	public function getView() {return $this->view;}
	public function setView($view) {$this->view = $view; return $this;}
	
	public function viewRender($view) {
		$result = null;
		
		foreach($this->view as $key => $value) {
			$this->$key = $value;
		}
		
		
		$renderer = $this->getRenderer();
		$useRenderer = $renderer instanceof App\View\Renderer;
		if ( $useRenderer == true ) {
			$path = $view;
			$result = $renderer->render($path, $this->view);
		} else {
			
			if (file_exists($view)) {
				require_once($view);
				$result = true;
			} else {
				throw new Exception('View not found.');
			}
		}
		
		return $result;
	}
	
	public function setHttpResponseCode($code) {
		header('HTTP/1.0 ' . $code);
	}
}