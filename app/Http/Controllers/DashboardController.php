<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\VendorInvitation;

class DashboardController extends Controller
{
     public function index()
    {   
    	$user = Auth::user();
    	$ownerId = $user->owner_id ?? $user->id;
    	$company = session('currentCompany');
    	//return $company;

        $currentCompany = $user->currentCompany;
       // return $currentCompany;
        $currentUser = $user;
	     return view('vendor.dashboard', [
	        'ownerId' => $ownerId,
	        'noOfClientsSubmitted' => $currentCompany->companiesWhereVendor()->where('status', 1)->count(),
	        'noOfClientsPending' => $currentCompany->companiesWhereVendor()->where('status', 2)->count(),
	        'noOfVendorsRejected' => $currentCompany->companiesWhereVendor()->where('status', 3)->count(),
	        'vendorInvitation' => VendorInvitation::with('company')
	            ->where('email', $user->email)
	            ->where('status', 0)
	            ->latest()
	            ->get(),
	        'isVendorRegistered' => $currentUser->has_client_permission,
	        'companyname' => $company['name'] ?? null,
	    ]);
    }
}
