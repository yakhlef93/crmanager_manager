<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBlackListCustomer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'phone_number',
        'city',
        'address',
        'cin_number',
        'cin_expiry_date',
        'drive_licence_number',
        'drive_licence_expiry_date',
        'comment',
        'customer_id',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function scopeWithFilters($query)
    {
        return $query->when(request('customers_ids'),function($query){
                $query->whereIn('customer_id',request('customers_ids'));
            })->latest();
    }
}
