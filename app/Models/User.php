<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'mobile',
        'role',
        'owner_id',
        'company_role',
        'is_suspended',
        'current_company_id',
        'last_login',
        'has_client_permission'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getAvatarAttribute(): string
    {
        // Define avatar properties
        $size = 100;
        $textColor = '#ffffff';

        // Get the first letter of the name and generate a dynamic background color
        $initial = strtoupper($this->name[0]);
        $backgroundColor = $this->generateColor($initial);

        // Generate SVG content
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" width="' . $size . '" height="' . $size . '" viewBox="0 0 ' . $size . ' ' . $size . '">';
        $svg .= '<rect width="100%" height="100%" fill="' . $backgroundColor . '"/>';
        $svg .= '<text x="50%" y="50%" font-size="' . ($size / 2) . '" fill="' . $textColor . '" text-anchor="middle" dominant-baseline="central" font-family="Arial, sans-serif">' . $initial . '</text>';
        $svg .= '</svg>';

        return $svg;
    }

    private function generateColor(string $letter): string
    {
        // Simple color mapping for letters A-Z
        $colors = [
            'A' => '#F44336', 'B' => '#E91E63', 'C' => '#9C27B0', 'D' => '#673AB7', 'E' => '#3F51B5',
            'F' => '#2196F3', 'G' => '#03A9F4', 'H' => '#00BCD4', 'I' => '#009688', 'J' => '#4CAF50',
            'K' => '#8BC34A', 'L' => '#CDDC39', 'M' => '#FFEB3B', 'N' => '#FFC107', 'O' => '#FF9800',
            'P' => '#FF5722', 'Q' => '#795548', 'R' => '#9E9E9E', 'S' => '#607D8B', 'T' => '#FF5252',
            'U' => '#E040FB', 'V' => '#7C4DFF', 'W' => '#536DFE', 'X' => '#448AFF', 'Y' => '#18FFFF',
            'Z' => '#64FFDA'
        ];

        // Return the corresponding color or a default if the letter isn't mapped
        return $colors[$letter] ?? '#cccccc';
    }


    // Relationships




    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function currentCompany()
    {
        return $this->belongsTo(Company::class, 'current_company_id');
    }

    public function companiesOwned()
    {
        return $this->hasMany(Company::class, 'owner_id');
    }

    public function companiesCreated()
    {
        return $this->hasMany(Company::class, 'created_by');
    }

    public function companyUsers()
    {
        return $this->hasMany(CompanyUser::class);
    }

    public function companies() {
        return $this->belongsToMany(Company::class, 'company_user')->withTimestamps();
    }

    // public function vendors()
    // {
    //     return $this->hasMany(CompanyVendor::class);
    // }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    // Check if user is suspended
    public function isSuspended()
    {
        return $this->is_suspended;
    }


    public function vendors()
    {
        return $this->hasMany(Company::class, 'owner_id'); // A client owns multiple companies (vendors)
    }

    // 🔹 If user is a VENDOR, get their CLIENT
    public function client()
    {
        return $this->belongsTo(User::class, 'current_company_id', 'id'); // Vendor's `current_company_id` points to Client `users.id`
    }


}
