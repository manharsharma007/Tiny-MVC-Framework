<?php

class defaultController extends Controller {

    function __construct()
    {

    }
    
	function actionMain() {

        $this->data['message'] = 'I am the "controller set" data';

        $this->view('dashboard', 'home');
	}

}



?>