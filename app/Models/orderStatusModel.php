<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrderStatusModel extends Model {
  protected $table = 'order_status';
  protected $allowedFields = ['status'];
}