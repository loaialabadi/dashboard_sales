<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Branch;
use App\Models\Product;
use App\Models\User;

class StockTransfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_branch_id',
        'to_branch_id',
        'product_id',
        'quantity',
        'transfer_date',
        'status',
        'created_by',
        'note',
    ];

    // علاقات الفروع
    public function from_branch()
    {
        return $this->belongsTo(Branch::class, 'from_branch_id');
    }

    public function to_branch()
    {
        return $this->belongsTo(Branch::class, 'to_branch_id');
    }

    // علاقة المنتج
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // علاقة المستخدم الذي أنشأ العملية
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
