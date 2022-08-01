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
    $this->guid = session()->get('guid');
		$this->uid = session()->get('id');

		$this->data['user_jwt'] = getSignedJWTForUser($this->guid);

		$this->user_model = model('UserModel');
		$this->user_role_model = model('UserRoleModel');

		if($this->isLoggedIn !== 1) {
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

			$this->user_model->select('users.*, user_roles.role AS user_role');
			$this->user_model->join('user_roles', 'users.role = user_roles.id', 'inner');
			$this->data['users'] = $this->user_model->where('deleted', 0)->get()->getResult();
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
		$this->data['validation'] = session()->getFlashdata('validation');

    return view('Users/add', $this->data);
	}

	public function save_user() {
		// print_r($this->request->getPost());
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
				// $this->data['validation'] = $this->validator;
				// print_r($this->data['validation']->listErrors());die();
				session()->setFlashdata('validation', $this->validator);
				return redirect()->to('/users/add');
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

	public function edit($uid) {
		if($this->role == 1 || $this->uid == $uid) {
			helper(['form']);

			$page_title = 'Edit User';

			$this->data['page_body_id'] = "edit_user";
			$this->data['breadcrumbs'] = [
				'parent' => [],
				'current' => $page_title,
			];
			$this->data['page_title'] = $page_title;
			$this->data['roles'] = $this->user_role_model->get()->getResult();
			$this->data['user'] = $this->user_model->where('id', $uid)->get()->getResult();
			$this->data['edit_uid'] = $uid;

			return view('Users/edit', $this->data);
		}
		else {
			return redirect()->to('/users/list');
		}		
	}

	public function edit_user($uid) {
		print_r($this->request->getPost());
		if($this->request->getPost()) {
			$user = $this->user_model->where('id', $uid)->get()->getResult();  // Get current user data

			// print_r($user);die();
			// Form validation here
			$rules = [
				'first_name' => 'required|min_length[3]|max_length[20]',
				'last_name' => 'required|min_length[3]|max_length[20]',
			];

			if($user[0]->email != $this->request->getVar('email')) {
				$rules['email'] = 'min_length[6]|max_length[50]|valid_email|is_unique[users.email]';
			}

			if($this->request->getVar('password') != '' && $this->request->getVar('confirm_password') != '' ) {
				$rules['password'] = 'required|min_length[8]|max_length[255]';
				$rules['confirm_password'] = 'matches[password]';
			}

			if(!$this->validate($rules)) {
				$this->data['validation'] = $this->validator;
			}
			else {
				$newData = [
					'first_name' => $this->request->getVar('first_name'),
					'last_name' => $this->request->getVar('last_name'),
					'email' => $this->request->getVar('email'),
					'role' => $this->request->getVar('role'),
				];

				if($this->request->getVar('password') != '' && $this->request->getVar('confirm_password') != '' ) {
					$newData['password'] = $this->request->getVar('password');
				}

				$this->user_model->set($newData)->where('id', $uid)->update();

				return redirect()->to('/users/list');
			}
		}
	}

	public function delete_user($uid) {
		$curr_date = date('Y-m-d H:i:s');

		$newData = [
			'updated_at' => $curr_date,
			'deleted' => 1,
		];

		$this->user_model->set($newData)->where('id', $uid)->update();
		return redirect()->to('/users/list');
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
