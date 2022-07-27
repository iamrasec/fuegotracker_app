<?php 

namespace App\Models;

use CodeIgniter\Model;

class OrderSourcesModel extends Model {
  protected $table = 'order_source';
  protected $allowedFields = ['source'];
}