<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'domain',
        'uuid',
        'owner_id',
        'created_by',
        'representative_name',
        'name',
        'logo',
        'constitution',
        'constitution_certificate',
        'residential_status',
        'hsn_sac',
        'description',
        'special_description',
        'address_line_one',
        'address_line_two',
        'city',
        'state',
        'pincode',
        'country',
        'email',
        'mobile_no',
        'landline_no',
        'msme_registered',
        'msme_certificate',
        'msme_registration_number',
        'msme_credit_period',
        'pan_card',
        'pan_number',
        'pan_name',
        'pan_father_name',
        'pan_dob',
        'gst_status',
        'gst_number',
        'gst_certificate',
        'gst_return_filling',
    ];
    


    protected static function booted()
    {
        // Generate a UUID and ensure domain is set before saving
        static::creating(function ($company) {
            // Generate UUID
            if (empty($company->uuid)) {
                $company->uuid = (string) Str::uuid();
                $company->api_key = $company->api_key ?? Str::random(32);
                $company->secret_key = $company->secret_key ?? Str::random(64);
            }

            // Generate unique domain if not provided
            if (empty($company->domain)) {
                $company->domain = self::generateUniqueDomain($company->name);
            }
        });

    }

    protected function representativeName(): Attribute
    {
        return Attribute::make(
            get: fn (mixed $value, array $attributes) => self::getRepresentativeName($value),
        );
    }

    public function getRepresentativeName($value)
    {
       
        if ($this->owner) {
            return $this->owner->name; // Return user's name if user exists
        }
        return $value; // Fallback to representative_name if no user
    }


    // Relationships

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function companyUsers()
    {
        return $this->hasMany(CompanyUser::class);
    }

    public function vendorClient()
    {
        return $this->hasOne(CompanyVendor::class, 'vendor_id');
    }

    // public function vendors()
    // {
    //     return $this->belongsToMany(Company::class, 'company_vendors', 'company_id', 'vendor_id')
    //             ->withPivot('id', 'user_id', 'bank_acount_id', 'status')
    //             ->withTimestamps();
                
    // }

    public function vendors()
    {
        return $this->belongsToMany(Company::class, 'company_vendors', 'company_id', 'vendor_id')
                ->withPivot('id', 'user_id', 'bank_acount_id', 'status', 'tally_sync')
                ->withTimestamps()
                ->where(function ($query) {
                    $query->whereNull('company_vendors.user_id') // Select if user_id is NULL
                          ->orWhereIn('company_vendors.user_id', function ($subquery) {
                              $subquery->select('id')
                                       ->from('users')
                                       ->where('is_suspended', false); // Select if user is not suspended
                          });
                });

    }

    public function client()
    {
        return $this->belongsToMany(Company::class, 'company_vendors', 'vendor_id', 'company_id')
        ->withPivot('id', 'user_id', 'bank_acount_id', 'status', 'tally_sync')
        ->withTimestamps()
        ->where(function ($query) {
            $query->whereNull('company_vendors.user_id') // Select if user_id is NULL
                  ->orWhereIn('company_vendors.user_id', function ($subquery) {
                      $subquery->select('id')
                               ->from('users')
                               ->where('is_suspended', false); // Select if user is not suspended
                  });
        });
    }


    public function companiesWhereVendor()
    {
        return $this->belongsToMany(Company::class, 'company_vendors', 'vendor_id', 'company_id')
                    ->withPivot('id', 'user_id', 'bank_acount_id', 'status')
                    ->whereHas('owner', function ($query) {
                        $query->where('is_suspended', false);
                    });
    }

    public function vendorPanVerifications()
    {
        return $this->hasOneThrough(PanVerification::class, CompanyVendor::class, 'vendor_id', 'company_vendor_id');
    }

    public function vendorGstVerifications()
    {
        return $this->hasOneThrough(GstVerification::class, CompanyVendor::class, 'vendor_id', 'company_vendor_id');
    }

    public function vendorGstReturns()
    {
        return $this->hasManyThrough(GstReturn::class, CompanyVendor::class, 'vendor_id', 'company_vendor_id');
    }


    public function vendorPanUdyam()
    {
        return $this->hasOneThrough(PanUdaym::class, CompanyVendor::class, 'vendor_id', 'company_vendor_id');
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    public function vendorBankAccount()
    {
        return $this->hasOneThrough(
            BankAccount::class,
            CompanyVendor::class,
            'vendor_id',         // Foreign key on CompanyVendor table...
            'id',                 // Foreign key on BankAccount table...
            'id',                 // Local key on Company table...
            'bank_acount_id'      // Local key on CompanyVendor table...
        );
    }


    // public function users() {
    //     return $this->belongsToMany(User::class, 'company_user')->withTimestamps();
    // }   

    public function users()
    {
        return $this->belongsToMany(User::class, 'company_user')
                    ->withPivot('role');
    }


    public function otherDocuments()
    {
        return $this->hasMany(CompanyOtherDocument::class);
    }

    // Generate unique domain for company
    public static function generateUniqueDomain($name)
    {
        // Clean and trim the name for domain generation
        $baseDomain = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $name)));

        // Generate a unique domain by appending a random number if necessary
        $domain = $baseDomain . '.'.config('app.domain');
        $counter = 1;

        // Ensure the domain is unique in the database
        while (self::where('domain', $domain)->exists()) {
            $domain = $baseDomain . $counter . '.'.config('app.domain');
            $counter++;
        }

        return $domain;
    }



    // 🔹 A company has multiple vendors (users)
    public function vendors2()
    {
        return $this->hasMany(User::class, 'current_company_id');
    }



}
