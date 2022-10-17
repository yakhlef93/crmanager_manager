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

    protected $with = ['customer'];
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function scopeWithFilters($query)
    {
        return $query->where('name','like', '%'.request('filter_string').'%')
                ->orWhere('cin_number','like', '%'.request('filter_string').'%')
                ->orWhere('drive_licence_number','like', '%'.request('filter_string').'%')->latest();
    }
    public function scopeWithPagination($query)
    {
        if (request('per_page') == -1)
            return $query->paginate(CustomerBlackListCustomer::count());
        else
            return $query->paginate(request('per_page', 15));
    }
}
