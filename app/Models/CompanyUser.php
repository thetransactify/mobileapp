<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyUser extends Model
{

    protected $fillable = [
        'company_id',
        'user_id',
        'role',
    ];

    // Relationships

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Check if the user is an owner
    public function isOwner()
    {
        return $this->role === 1;
    }

    // Check if the user is an admin
    public function isAdmin()
    {
        return $this->role === 2;
    }

    // Check if the user is staff
    public function isStaff()
    {
        return $this->role === 3;
    }

    // Check if the user is a vendor
    public function isVendor()
    {
        return $this->role === 4;
    }
}
