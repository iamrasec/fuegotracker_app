<?php

namespace App\Controllers;

class Home extends BaseController
{
    var $view_data = array();

    public function __construct() {
		$data = [];
		$this->user_model = model('UserModel');
	}

    public function index()
    {
        if(session()->get('isLoggedIn')) {
            return redirect()->to('order/list');
        }
        else {
            echo view('home_view');
        }
    }

    public function login()
    {
        // print_r($this->request->getPost()); die();

        if($this->request->getPost()) {
			// Form login validation here
			// $rules = [
			// 	'email' => 'min_length[6]|max_length[50]|valid_email',
			// 	'password' => 'required|min_length[3]|max_length[255]|validateUser[username,password]',
			// ];

			// $errors = [
			// 	'password' => [
			// 		'validateUser' => 'Email or Password don\'t match',
			// 	]
			// ];

            $user = $this->user_model->where('email', $this->request->getVar('email'))->first();

            if(password_verify($this->request->getPost('password'), $user['password'])) {
                $this->setUserSession($user);

                return redirect()->to('order/list');
            }
            else {
                return redirect()->to('/');
            }
		}
    }

    private function setUserSession($user) {
		$this->data = [
			'id' => $user['id'],
			'guid' => $user['guid'],
			// 'username' => $user['username'],
			'first_name' => $user['first_name'],
			'last_name' => $user['last_name'],
			'email' => $user['email'],
			'role' => $user['role'],
			'isLoggedIn' => true,
		];

		session()->set($this->data);
		return true;
	}
}
