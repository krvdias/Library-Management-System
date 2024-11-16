<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function add(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'mobile' => 'required|string|max:15',
            'address' => 'required|string|max:255',
            'role' => 'nullable|string|in:admin,member', 
            'password' => 'nullable|string|min:8', 
        ]);

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

    public function index()
    {
        $members = User::where('id','!=','1')->get(); // Fetch all members
        return view('viewmember', compact('members'));
    }

    // Delete a member
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        // Retrieve users whose name, email, or phone contains the search query
        $members = User::where('id','!=','1')
                    ->orwhere('name', 'LIKE', '%' . $query . '%')
                    ->orWhere('email', 'LIKE', '%' . $query . '%')
                    ->orWhere('mobile', 'LIKE', '%' . $query . '%')
                    ->get();

        // Return the view with the search results
        return response()->view('viewmember',compact('members'));
    }

    public function edit($id) 
    {
        $member = User::findOrFail($id); 

        return view('editmember', compact('member'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:15',
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
