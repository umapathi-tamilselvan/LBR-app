<?php

namespace App\Http\Controllers;

use App\Models\Borrower;
use Illuminate\Http\Request;

class BorrowerController extends Controller
{
    public function __construct()
    {
        $this->middleware('isAdmin');
    }

    public function index()
    {
        return view('admin.borrower.create');
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'mobile_no' => 'required|max:12',
        ]);
        Borrower::create($validated);

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $borrower = Borrower::findOrFail($id);
        $borrower->delete();

        return redirect()->back();

    }
}
