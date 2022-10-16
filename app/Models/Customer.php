<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'account_id',
        'first_name',
        'last_name',
        'gender',
        'email', 
        'phone_number',
        'city',
        'address',
        'status',
        'global_black_list',
        'company_name',
        'ice',
        'website',
    ];

    public function blacklistcustomers()
    {
        return $this->hasMany(BlackList::class)->orderBy('created_at', 'DESC');
    }

    public function scopeWithFilters($query)
    {
        return $query->when(request('customers_ids'),function($query){
                $query->whereIn('customer_id',request('customers_ids'));
            })->latest();
    }
    public function scopeWithPagination($query)
    {
        if (request('per_page') == -1)
            return $query->paginate(Customer::count());
        else
            return $query->paginate(request('per_page', 15));
    }
}
