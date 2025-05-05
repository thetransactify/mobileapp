<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Carbon\Carbon;
use App\Models\Company;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\VendorInvitation;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class Login extends Controller
{
    //
     public function showLoginForm()
    {
        return view('auth.login'); // This matches your Blade layout
    }

    public function currentCompany()
	{
	    return $this->belongsTo(Company::class, 'current_company_id');
	}


	public function login(Request $request)
	{
	    $request->validate([
	        'loginEmail' => ['required', 'email'],
	        'loginPassword' => ['required'],
	    ]);

	    $credentials = [
	        'email' => $request->input('loginEmail'),
	        'password' => $request->input('loginPassword'),
	    ]; 

	    if (!Auth::attempt($credentials)) {
	        return back()
	            ->withInput()
	            ->with('toast', [
	                'message' => 'Invalid credentials',
	                'type' => 'error',
	                'position' => 'bottom-right'
	            ]);
	    }

	    Session::regenerate();
	    $user = Auth::user();

	    if ($user->role !== 2) {
	        Auth::logout();
	        Session::flush();
	        return redirect()->route('login')->with('error', 'You do not have the required permissions.');
	    }

	    $company = Company::find($user->current_company_id);

	    $role = null;

	    if ($company) {
	        Session::put('currentCompany', $company->toArray());
	        if ($company->vendors()->exists()) {
	            $role = 'client';
	        } elseif ($company->client()->exists()) {
	            $role = 'vendor';
	        } else {
	            $role = 'unknown';
	        }

	        Session::put('companyRole', $role);
	    }

	    $user->last_login = Carbon::now();
	    $user->save();

	    // Role-based redirection
	    if ($role === 'client') {
	       // return redirect()->intended('/client-dashboard');
	        return redirect()->back()->with('toast', [
			    'message' => 'THE MOBILE IS APP IS NOT YET AVAILABLE FOR CLIENTS.',
			    'type' => 'info',
			    'position' => 'bottom-right'
			]);
	    } elseif ($role === 'vendor') {
	        return redirect()->intended('/vendor-dashboard');
	    } else {
	        Auth::logout();
	        Session::flush();
	        return redirect()->route('login')->with('error', 'Company role not identified.');
	    }
	}

    public function logout(Request $request)
    {
        // Logout user
        Auth::logout();

        // Completely flush all session data
        $request->session()->flush();

        // Regenerate CSRF token for security
        $request->session()->regenerateToken();

        // Redirect to login page
        return redirect('/login');
    }


    // register
    public function showForm(Request $request)
    {
        $step = $request->input('step', 1);
        return view('auth.register', compact('step'));
    }

    // public function handleForm(Request $request)
    // {
    //     $step = $request->input('step', 1);

    //     if ($request->step == 1) {
    //         $validated = $request->validate([
    //             'name_of_entity' => 'required|string',
    //             'name' => 'required|string',
    //         ]);
    //         Session::put('register.step1', $validated);
    //         return redirect()->route('register.form', ['step' => 2]);
    //     }

    //     if ($step == 2) {
    //         $validated = $request->validate([
    //             'email' => 'required|email',
    //             'contact_number' => 'required|digits:10',
    //         ]);
    //         Session::put('register.step2', $validated);
    //         return redirect()->route('register.form', ['step' => 3]);
    //     }

    //     if ($step == 3) {
    //         $validated = $request->validate([
    //             'password' => 'required|min:6|confirmed',
    //         ]);

    //         // Merge all session data
    //         $data = array_merge(
    //             Session::get('register.step1', []),
    //             Session::get('register.step2', []),
    //             ['password' => Hash::make($validated['password'])]
    //         );

    //         // Create user
    //         //User::create($data);

    //         Session::forget('register');
    //         return redirect()->route('register.success');
    //     }

    //     return redirect()->route('register.form');
    // }
    public function submitForm(Request $request)
    {
        // $validated = $request->validate([
        //     'entityName' => 'required|string|max:255',
        //     'fullName' => 'required|string|max:255',
        //     'email' => 'required|email|unique:users,email',
        //     'phoneNumber' => 'required|digits:10',
        //     'setPassword' => 'required|string|confirmed|min:6',
        // ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => $request->input('fullName'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('setPassword')),
                'mobile' => $request->input('phoneNumber'),
                'role' => 2,
            ]);

           // return  $user;

            $company = Company::create([
                'name' => $request->input('entityName'),
                'owner_id' => $user->id,
                'created_by' => $user->id,
            ]);

            $company->users()->attach($user->id, ['role' => 1]);

            $updateData = ['current_company_id' => $company->id];

            if ($pendingInvitation = session('pending_invitation')) {
                $updateData['has_client_permission'] = 0;

                $invitationCompany = Company::where('uuid', $pendingInvitation)->first();
                if ($invitationCompany) {
                    VendorInvitation::create([
                        'company_id' => $invitationCompany->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'token' => Str::random(32),
                        'expires_at' => now()->addDays(7),
                    ]);
                }
            }

            $user->update($updateData);
            // Log::info('user data'.$user);
            event(new Registered($user));
        });
       //return $user;
        return redirect()->route('register.success')->with('success', 'Account created successfully!');
    }

    public function RegisterSuccess()
    {
        return view('auth.Email');
    }

    public function clientDashboard(){
    	return view('client.client-dashboard');
    }

    public function ContactInfo()
    {
        $user = Auth::user();
        //return $user;
        return view('vendor.contact-info')->with('user',$user); // This matches your Blade layout
    }

    public function ChangePassword()
    {
        return view('vendor.change-password'); // This matches your Blade layout
    }

    public function UpdatePassword(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|different:currentPassword',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        // Check current password
        if (!Hash::check($request->currentPassword, auth()->user()->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Current password is incorrect'
            ], 401);
        }

        // Update password
        auth()->user()->update([
            'password' => Hash::make($request->newPassword)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully'
        ]);
    }
}
