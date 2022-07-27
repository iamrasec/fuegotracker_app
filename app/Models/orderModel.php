<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model {

  protected $table = 'orders';
  protected $allowedFields = ['order_number', 'customer_name', 'phone', 'order_source', 'order_status', 'additional_note', 'start_time', 'end_time', 'created_at', 'updated_at', 'author'];

}