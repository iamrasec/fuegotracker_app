<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{

	public function __construct() {
		helper(['jwt']);

		$this->data = [];
		$this->role = session()->get('role');
    $this->isLoggedIn = session()->get('isLoggedIn');
		$this->role = session()->get('role');
    $this->guid = session()->get('guid');

		$this->data['user_jwt'] = getSignedJWTForUser($this->guid);

		$this->user_model = model('UserModel');
		$this->user_role_model = model('UserRoleModel');

		if($this->isLoggedIn !== 1 && $this->role !== 1) {
      return redirect()->to('/');
    }
	}

	public function index()
	{
		return redirect()->to('order/list');
	}

	public function dashboard() {
		$page_title = 'All Orders List';

    $this->data['page_body_id'] = "orders_list";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;
    $this->data['orders'] = $this->order_model->get()->getResult();
    return view('Dashboard/index', $this->data);
	}

	public function list() {
		if($this->isLoggedIn && $this->role == 1) {
			$page_title = 'All Users List';

			$this->data['page_body_id'] = "users_list";
			$this->data['breadcrumbs'] = [
				'parent' => [],
				'current' => $page_title,
			];
			$this->data['page_title'] = $page_title;
			$this->data['users'] = $this->user_model->get()->getResult();
			return view('Users/list', $this->data);
		}
		else {
			return redirect()->to('/order/list');
		}
	}

	public function add() {
		helper(['form']);

		$page_title = 'Add User';

    $this->data['page_body_id'] = "add_user";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;
		$this->data['roles'] = $this->user_role_model->get()->getResult();

    return view('Users/add', $this->data);
	}

	public function save_user() {
		if($this->request->getPost()) {
			// Form validation here
			$rules = [
				'first_name' => 'required|min_length[3]|max_length[20]',
				'last_name' => 'required|min_length[3]|max_length[20]',
				'email' => 'min_length[6]|max_length[50]|valid_email|is_unique[users.email]',  // check if email is valid.  check if email is unique on users table
				'password' => 'required|min_length[8]|max_length[255]',
				'confirm_password' => 'matches[password]',
			];

			if(!$this->validate($rules)) {
				$this->data['validation'] = $this->validator;
			}
			else {
				$newData = [
					'guid' => $this->_generate_guid(),
					'first_name' => $this->request->getVar('first_name'),
					'last_name' => $this->request->getVar('last_name'),
					'email' => $this->request->getVar('email'),
					'password' => $this->request->getVar('password'),
					'role' => $this->request->getVar('role'),
				];

				$this->user_model->save($newData);

				return redirect()->to('/users/list');
			}
		}
	}

	public function login() {
		// helper(['form']);
		// print_r($_POST);
		// die();
		print_r($this->request->getPost());
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

	public function logout() {
		session()->destroy();
		return redirect()->to('/');
	}

	private function _generate_guid() {
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
}
