<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CompanyUser;
use App\Models\Company;
use App\Models\BankAccount;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class ManageProfileController extends Controller
{
    //
    public function GetProfile() {
    	return view('vendor/manage-profile');
    }

    public function GetDocument() {
    	return view('includes/document-Attached');
    }


	public function GetManageProfile(){
		$user = Auth::user();
		$ownerId = $user->owner_id ?? $user->id;
		 $ManageProfile = Company::where('owner_id',$ownerId)->first();
		 $company = Company::where('owner_id', $ownerId)->first();
		if ($company && $company->pivot) {
        $banAccount = $company->vendorBankAccount;
	    } else {
	        $banAccount = $company?->bankAccounts()?->first(); 
	    }
		//return $banAccount;
		try {
			return response()->json([
				'success' => true,
				'user' => [
					'name' => $ManageProfile->name,
					'email' => $ManageProfile->email,
					'constitution' => $ManageProfile->constitution,
					'mobile' => $ManageProfile->mobile_no,
					'pan_number' => $ManageProfile->pan_number,
					'gst_status' => $ManageProfile->gst_status,
					'msme_registered' => $ManageProfile->msme_registered,
					'address1' => $ManageProfile->address_line_one,
					'address2' => $ManageProfile->address_line_two,
					'city' => $ManageProfile->city,
					'bank_name' => $banAccount->bank_name,
					'account_no' => $banAccount->bank_account_no,
					'bank_ifsc' => $banAccount->bank_account_no,
					'state' => $ManageProfile->state,
					'country' => $ManageProfile->country,
					'pincode' => $ManageProfile->pincode
				]
			]);
		} catch (\Exception $e) {
			return response()->json([
				'success' => false,
				'message' => 'Failed to fetch user data'
			], 500);
		}
	}

   public function SubmitProfile(Request $request) {
    //return $request->all();
    $user = Auth::user();
    $ownerId = $user->owner_id ?? $user->id;

    $company = Company::where('owner_id', $ownerId)->first();

    if (!$company) {
        return response()->json(['success' => false, 'message' => 'Company not found'], 404);
    }

    // Update the company fields
    $company->name = $request->input('vendor-name');
    $company->email = $request->input('email');
    $company->mobile_no = $request->input('mobile');
    $company->address_line_one = $request->input('address1');
    $company->address_line_two = $request->input('address2');
    $company->city = $request->input('city');
    $company->state = $request->input('state');
    $company->country = $request->input('country');
    $company->pincode = $request->input('pincode');
    $company->save();

    return response()->json(['success' => true, 'message' => 'Profile updated successfully']);

   }

   public function GetCompliance(){
   	   $user = Auth::user();
       $ownerId = $user->owner_id ?? $user->id;

    return view('includes.manage-compliance', [
        'user_id' => $ownerId
    ]);
   }

   public function GetPanDetails($id){
   	$user = Company::where('owner_id',$id)->first();
   	//return $user;
    return response()->json([
        'pan' => $user->pan_number,
        'dob' => $user->pan_dob,
        'file' => $user->pan_card,

    ]);
   }

   public function GetBankDetails($id){
   	$user = BankAccount::where('user_id',$id)->first();
   	//return $user;
    return response()->json([
        'cancelled_cheque' => $user->cancelled_cheque,
        'bank_name' => $user->bank_name,
        'account_number' => $user->bank_account_no,
        'ifsc' => $user->ifsc_code,

    ]);
   }	

   public function Removepan($encryptedUserId){

   	try {
        $userId = $encryptedUserId;
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid ID'], 400);
    }

    //$user = User::findOrFail($userId);
    $user = Company::where('owner_id',$userId)->first();

    $user->pan_number = null;
    $user->pan_dob = null;
    $user->pan_card = null;
    $user->save();

    return response()->json(['success' => true]);

   }

   public function Savepan(Request $request, $encryptedUserId){
   	try {
        $userId = $encryptedUserId;
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid ID'], 400);
    }

    $request->validate([
        'pan_number' => 'required|string|max:10',
        //'pan_dob' => 'required|date_format:d-m-Y'
    ]);

    $user = Company::where('owner_id',$userId)->first();
    $user->pan_number = $request->pan_number;
    $user->pan_dob = $request->pan_dob;
    $user->save();

    return response()->json(['success' => true]);

   }

   public function RemoveBankDetails($encryptedUserId){
   	   	try {
        $userId = $encryptedUserId;
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid ID'], 400);
    }
    $user = BankAccount::where('user_id',$userId)->first();


    $user->cancelled_cheque = null;
    $user->bank_name = null;
    $user->bank_account_no = null;
    $user->ifsc_code = null;
    $user->save();

    return response()->json(['success' => true]);

   }


   public function updateBank(Request $request, $id){
    $user = BankAccount::where('user_id',$id)->first();
   	$user->bank_name = $request->bank_name;
    $user->bank_account_no = $request->bank_account;
    $user->ifsc_code = $request->bank_ifsc;
    $user->save();

    return response()->json(['message' => 'Bank details updated successfully']);

   }

   public function GetMSMEDetails($id){
   	   	$user = Company::where('owner_id',$id)->first();
   	//return $user;
    return response()->json([
        'file_path' => $user->msme_certificate,
        'msme_no' => $user->msme_registration_number,
        'credit_period' => $user->msme_credit_period,

    ]);

   }

   public function RemoveMsmeDetails($encryptedUserId){
   	try {
        $userId = $encryptedUserId;
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid ID'], 400);
    }

    //$user = User::findOrFail($userId);
    $user = Company::where('owner_id',$userId)->first();
    $user->msme_registered = null;
    $user->msme_registration_number = null;
    $user->msme_credit_period = null;
    $user->save();
    return response()->json(['success' => true]);
   }

    public function updateMsme(Request $request, $encryptedUserId){
    	//return $request->all();
   	try {
        $userId = $encryptedUserId;
    } catch (\Exception $e) {
        return response()->json(['error' => 'Invalid ID'], 400);
    }

    $user = Company::where('owner_id',$userId)->first();
    $user->msme_registration_number = $request->msme_no;
    $user->msme_credit_period = $request->creditPeriod;
    $user->save();

    return response()->json(['success' => true]);

   }

   public function GetMyClients(){
        $companies = auth()->user()
        ->currentCompany
        ->companiesWhereVendor()
        ->latest()
        ->paginate(7);
       // return  $companies;
    return view('vendor/my-clients', compact('companies'));
   }


}
