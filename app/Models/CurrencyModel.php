<?php

namespace App\Models;

use CodeIgniter\Model;

class CurrencyModel extends Model
{
    protected $table = 'currency';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['currency_id', 'name', 'eng_name', 'nominal', 'num_code', 'char_code'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}