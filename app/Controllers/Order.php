<?php
namespace App\Controllers;
use App\Controllers\BaseController;

class Order extends BaseController {
  
  public function __construct() {
    helper(['jwt']);
    date_default_timezone_set('America/Los_Angeles');

		$this->data = [];
		$this->role = session()->get('role');
    $this->isLoggedIn = session()->get('isLoggedIn');
    $this->guid = session()->get('guid');

    $this->data['user_jwt'] = getSignedJWTForUser($this->guid);

    $this->user_model = model('UserModel');
		$this->order_model = model('OrderModel');
    $this->order_sources_model = model('OrderSourcesModel');
    $this->order_status_model = model('OrderStatusModel');

    if($this->isLoggedIn !== 1 && $this->role !== 1) {
      return redirect()->to('/');
    }
  }

  public function index() {
    $page_title = 'All Orders List';

    $this->data['page_body_id'] = "orders_list";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;
    $this->data['orders'] = $this->order_model->get()->getResult();
    $this->data['order_sources'] = $this->order_sources_model->get()->getResult();
    $this->data['order_status'] = $this->order_status_model->get()->getResult();

    return view('dashboard/index', $this->data);
  }

  public function list() {
    $page_title = 'All Orders List';

    $this->data['page_body_id'] = "orders_list";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;
    $this->data['orders'] = $this->order_model->get()->getResult();
    $this->data['order_sources'] = $this->order_sources_model->get()->getResult();
    $this->data['order_status'] = $this->order_status_model->get()->getResult();

    return view('Dashboard/index', $this->data);
  }

  public function close($oid) {
    if($this->isLoggedIn) {

      $data = [
        'end_time' => date('Y-m-d H:i:s'),
      ];

      // print_r($data);

      $this->order_model->set('end_time', date('Y-m-d H:i:s'))->where('id', $oid)->update();

      return redirect()->to('/order/list');
    }
  }

  public function create() {
    helper(['form']);

    $page_title = 'Create Order';

    $this->data['page_body_id'] = "create_ticket";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;

    $this->data['order_sources'] = $this->order_sources_model->get()->getResult();
    $this->data['order_status'] = $this->order_status_model->get()->getResult();

    return view('order/create', $this->data);
  }

  public function save() {
    if($this->request->getPost()) {
      // print_r($this->request->getPost());

      $post = $this->request->getPost();

      $save_data = [
        'customer_name' => $post['customer_name'],
        'phone' => $post['phone'],
        'order_number' => $post['order_number'],
        'order_source' => $post['order_source'],
        'order_status' => $post['order_status'],
        'additional_note' => $post['additional_note'],
        'author' => session()->get('id'),
      ];

      $this->order_model->save($save_data);

      return redirect()->to('/order/list');
    }
  }


}