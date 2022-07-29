<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use Exception;
use ReflectionException;

class Order extends ResourceController
{
  public function __construct() {
    $this->data = [];
    $this->user_model = model('UserModel');
		$this->order_model = model('OrderModel');
    $this->order_sources_model = model('OrderSourcesModel');
    $this->order_status_model = model('OrderStatusModel');
  }

  public function index()
  {
    echo "Forbidden";
  }

  public function update_order()
  {
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
    // $return = $this->brand_model->insert($data);

    // for debug
    echo json_encode(["status" => 200, "data" => $data]);

    // if(is_numeric($return)) {
    //   echo json_encode(["message" => true, "data" => $return]);
    // }
    // else {
    //   echo json_encode(["message" => "error"]);
    // }
    exit;
  }

  // ...
}