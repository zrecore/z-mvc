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
	 * @return \App\Controller\Request
	 */
	public function getRequest() {
		if (empty($this->request)) {
			$this->request = new \App\Controller\Request(\App::getParams());
		}
		return $this->request;
	}
	
	public function getView() {return $this->view;}
	public function setView($view) {$this->view = $view; return $this;}
	
	public function viewRender($view, $module, $controller, $action) {
		$result = null;
		
		foreach($this->view as $key => $value) {
			$this->$key = $value;
		}
		
		
		$renderer = $this->getRenderer();
		$useRenderer = $renderer instanceof \App\View\Renderer;
		
		if ( $useRenderer == true ) {
			$path = $view;

			if (!empty($this->layout)) {
				$top_layout = APP_PATH . '/' . $module . '/layout/' . $this->layout . '-top.phtml';
				if (file_exists($top_layout)) {
					$result .= $renderer->render($top_layout, $this->view);
				}
			}
			
			$result .= $renderer->render($path, $this->view);
			
			if (!empty($this->layout)) {
				$bottom_layout = APP_PATH . '/' . $module . '/layout/' . $this->layout . '-bottom.phtml';
				if (file_exists($bottom_layout)) {
					$result .= $renderer->render($bottom_layout, $this->view);
				}
			}
		} else {
			
			if (!empty($this->layout)) {
				$top_layout = APP_PATH . '/' . $module . '/layout/' . $this->layout . '-top.phtml';
				
				if (file_exists($top_layout)) {
					require_once($top_layout);
				}
			}
			if (file_exists($view)) {
				require_once($view);
				$result = true;
			} else {
				throw new Exception('View not found.');
			}
			
			if (!empty($this->layout)) {
				$bottom_layout = APP_PATH . '/' . $module . '/layout/' . $this->layout . '-bottom.phtml';
				require_once($bottom_layout);
			}
		}
		
		return $result;
	}
	
	public function setHttpResponseCode($code) {
		header('HTTP/1.0 ' . $code);
	}
}