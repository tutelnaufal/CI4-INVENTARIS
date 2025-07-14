<?php
namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'name', 'quantity', 'price_per_unit', 'type',
        'wattage', 'warranty', 'material', 'dimensions',
        'expiry_date', 'storage_condition'
    ];
}
