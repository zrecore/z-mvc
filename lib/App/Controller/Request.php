<?php
namespace App\Controller;

class Request
{
	private $_vars;
	public function __construct($vars) {
		$this->_vars = $vars;
	}
	
	public function getParam($key, $default = null) {
		
		return isset($this->_vars[$key]) ? $this->_vars[$key] : $default;
	}
	
	public function setParam($key, $value) {
		if (empty($this->_vars)) $this->_vars = array();
		
		$this->_vars[$key] = $value;
		
		return $this;
	}
	
	public function getParams() {
		return $this->_vars;
	}
	
	public function setParams($values) {
		$this->_vars = $values;
		return $this;
	}
}