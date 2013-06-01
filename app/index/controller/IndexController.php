<?php

class IndexController extends App\Controller
{
	public function preDispatch() {
		
		switch (App::getAction()) {
			/**
			 * @todo if you neet to do $this->setLayout() to change a layout
			 * according to the action, you can do that here.
			 */
			default:
				break;
		}
		
		parent::preDispatch();
	}
	public function indexAction() {
		
	}
	
	public function spexAction() {
		
	}
	
	public function contactAction() {
		
	}
}