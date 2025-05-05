<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{

    protected $fillable = [
        'cancelled_cheque',
        'account_name',
        'bank_name',
        'branch_name',
        'bank_account_no',
        'ifsc_code',
        'company_id',
        'user_id'
    ];

    // Relationships

    public function companyVendors()
    {
        return $this->hasMany(CompanyVendor::class);
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

}
