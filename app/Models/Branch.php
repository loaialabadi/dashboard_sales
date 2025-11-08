<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BranchProduct;
use App\Models\StockTransfer;
use App\Models\Product;

class Branch extends Model
{
    protected $fillable = ['name', 'address', 'phone'];

    public function products()
    {
        return $this->hasMany(BranchProduct::class);
    }

    public function transfersFrom()
    {
        return $this->hasMany(StockTransfer::class, 'from_branch_id');
    }

    public function transfersTo()
    {
        return $this->hasMany(StockTransfer::class, 'to_branch_id');
    }
}

