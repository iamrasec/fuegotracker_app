<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use Shuchkin\SimpleXLSXGen;

class Order extends BaseController {
  
  public function __construct() {
    helper(['jwt']);
    date_default_timezone_set('America/Los_Angeles');

    $this->isLoggedIn = session()->get('isLoggedIn');
    $this->role = session()->get('role');

    if($this->isLoggedIn != 1) {
      return redirect()->to('/');
    }

    $this->guid = session()->get('guid');
    $this->uid = session()->get('id');

    $this->data = [];
    $this->data['user_jwt'] = getSignedJWTForUser($this->guid);

    $this->user_model = model('UserModel');
		$this->order_model = model('OrderModel');
    $this->order_sources_model = model('OrderSourcesModel');
    $this->order_status_model = model('OrderStatusModel');
  }

  public function index() {
    if($this->isLoggedIn !== 1) {
      return redirect()->to('/');
    }

    $page_title = 'All Orders List';

    $this->data['page_body_id'] = "orders_list";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;

    if($this->role == 1) {
      $this->data['orders'] = $this->order_model->get()->getResult();
    }
    else {
      $this->data['orders'] = $this->order_model->where('author', $this->uid)->get()->getResult();
    }

    $this->data['order_sources'] = $this->order_sources_model->get()->getResult();
    $this->data['order_status'] = $this->order_status_model->get()->getResult();

    return view('Dashboard/index', $this->data);
  }

  public function list() {
    if($this->isLoggedIn != 1) {
      return redirect()->to('/');
    }

    $page_title = 'All Orders List';

    // print_r($this->role);die();

    $this->data['page_body_id'] = "orders_list";
    $this->data['breadcrumbs'] = [
      'parent' => [],
      'current' => $page_title,
    ];
    $this->data['page_title'] = $page_title;

    if($this->role == 1) {
      $this->data['orders'] = $this->order_model->get()->getResult();
    }
    else {
      $this->data['orders'] = $this->order_model->where('author', $this->uid)->get()->getResult();
    }
    
    $this->data['order_sources'] = $this->order_sources_model->get()->getResult();
    $this->data['order_status'] = $this->order_status_model->get()->getResult();

    return view('Dashboard/index', $this->data);
  }

  public function close($oid) {
    if($this->isLoggedIn) {

      // $data = [
      //   'end_time' => date('Y-m-d H:i:s'),
      // ];

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

    return view('Order/create', $this->data);
  }

  public function save() {
    if($this->request->getPost()) {
      // print_r($this->request->getPost());

      $post = $this->request->getPost();

      $save_data = [
        'start_time' => $post['start_time'],
        'customer_name' => $post['customer_name'],
        'phone' => $post['phone'],
        'order_number' => $post['order_number'],
        'order_source' => $post['order_source'],
        'order_status' => $post['order_status'],
        'additional_note' => $post['additional_note'],
        'created_at' => $post['start_time'],
        'author' => session()->get('id'),
      ];

      $this->order_model->save($save_data);

      return redirect()->to('/order/list');
    }
  }

  public function update_order() {
    $data = $this->request->getPost();
    
    $oid = $this->request->getPost("order_id");
    $curr_status = $this->request->getPost("curr_status");
    $new_status = $this->request->getPost("new_status");
    $close_order = $this->request->getPost("close_order");

    if($close_order == 1) {
      $this->order_model->set('end_time', date('Y-m-d H:i:s'));
    }

    if($curr_status != $new_status) {
      $this->order_model->set('order_status', $new_status);
    }
    
    $this->order_model->where('id', $oid)->update();

    echo json_encode(["status" => 200, "data" => $data]);
    exit;
  }

  public function export_data() {

    $data = $this->request->getPost();

    $conditions = [
      'start_time >=' => $this->request->getPost("export_start_date") . " 00:00:00",
      'end_time <=' => $this->request->getPost("export_end_date") . " 23:59:59",
    ];

    if($this->role != 1) {
      $conditions['author'] = $this->uid;
    }

    $this->order_model->select('orders.*, CONCAT(users.first_name, " ",users.last_name) AS author_name, order_source.source AS orderSource, order_status.status AS orderStatus');
    $this->order_model->where($conditions);
    $this->order_model->join('users', 'orders.author = users.id', 'inner');
    $this->order_model->join('order_source', 'orders.order_source = order_source.id', 'inner');
    $this->order_model->join('order_status', 'orders.order_status = order_status.id', 'inner');

    $result = $this->order_model->get()->getResult();

    $data_arr = [
      ["Order Number", "Start Time", "End Time", "Customer Name", "Phone", "Order Source", "Order Status", "Additional Note", "Author"],
    ];

    foreach($result as $row) {
      $data_arr[] = [
        $row->order_number,
        "\0".$row->start_time,
        "\0".$row->end_time,
        $row->customer_name,
        $row->phone,
        $row->orderSource,
        $row->orderStatus,
        $row->additional_note,
        $row->author_name,
      ];
    }

    $xlsx = SimpleXLSXGen::fromArray($data_arr)->downloadAs('order-export--'.$this->request->getPost("export_start_date").'-to-'.$this->request->getPost("export_end_date").'.xlsx');

    // echo json_encode(["status" => 200, "data" => $data, "conditions" => $conditions, "result" => $result]);
    exit;
  }
}