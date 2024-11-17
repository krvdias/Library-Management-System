<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    //add new member 
    public function add(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|integer|max:15',
            'address' => 'required|string|max:255',
            'role' => 'nullable|string|in:admin,member', 
            'password' => 'nullable|string|min:8', 
        ]);

        //if he is member role and password add default values
        $validated['role'] = $validated['role'] ?? 'member';
        $validated['password'] = $validated['password'] ?? '12345678';    

        $existingUser = User::where('name', $request->name)
                                    ->where('email', $request->email)
                                    ->first();

        if ($existingUser) {
            return redirect()->back()->withErrors(['duplicate' => 'A person with the same name and birthday in this family already exists.']);
        }
        
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'role' => $request->role,
            'password' => Hash::make($request->password),
            'membership_date' => DB::raw('CURRENT_DATE'),
        ]);

        return redirect()->route('addmember')->with('success', 'Member added successfully!');
    }

    //pass all the users in users table
    public function index()
    {
        $members = User::all(); // Fetch all members
        return view('viewmember', compact('members'));
    }

    // Delete a member
    public function destroy($id)
    {
        //if delete default admin, block it
        if ($id == 1) {
            return redirect()->route('members.index')->with('error', 'Cannot Delete');
        }

        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }

    //search member eccordin to name , email and mobile
    public function search(Request $request)
    {
        $query = $request->input('search');

        // Retrieve users whose name, email, or phone contains the search query
        $members = User::where('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%')
                    ->orWhere('mobile', 'LIKE', '%' . $query . '%')
                    ->get();

        // Return the view with the search results
        return response()->view('viewmember',compact('members'));
    }

    //show member info according to user_id
    public function edit($id) 
    {
        $member = User::findOrFail($id); 

        return view('editmember', compact('member'));
    }

    //update member info
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|integer|max:15',
            'address' => 'required|string|max:255',
            'role' => 'nullable|string|in:admin,member',
            'password' => 'nullable|string|min:8', 
        ]);

        $member = User::findOrFail($id);
        
        $member->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'address' => $request->address,
            'role' => $request->role,
            'password' => $request->password ?? '12345678',
        ]);

        return redirect()->route('members.index')->with('success', 'Member updated successfully!');
    }

}
