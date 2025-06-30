<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StorestudentRequest;
use App\Http\Requests\UpdatestudentRequest;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'student');

        // Jika ada pencarian berdasarkan nama student
        if ($request->has('search') && $request->search !== '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // Mendapatkan data student dengan paginasi
        $students = $query->paginate(5);

        return view('librarian.student.index', [
            'students' => $students
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorestudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorestudentRequest $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:student',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
            'class' => 'nullable|string',
            'age' => 'nullable|string',
            'phone' => 'nullable|string',
        ], [
            'email.unique' => 'The email address is already in use.',
        ]);

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'address' => $request->address,
                'gender' => $request->gender,
                'class' => $request->class,
                'age' => $request->age,
                'phone' => $request->phone,
            ]);

            return redirect()->route('librarian.students')->with('success', 'Student added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('librarian.students')->with('error', 'The email address is already in use.');
        }
}


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = User::findOrFail($id); // Use findOrFail to ensure the student exists
        return view('librarian.student.show', compact('student')); // Return a view with student data
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(User $student)
    {
        return view('librarian.student.edit', [
            'student' => $student
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatestudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatestudentRequest $request, $id)
    {
        $student = User::find($id);

        // Validate the request data, including optional password fields
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'gender' => 'nullable|in:male,female',
            'class' => 'nullable|string',
            'age' => 'nullable|numeric',
            'phone' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $id, // Exclude current student's email
            'password' => 'nullable|string|min:6|confirmed', // Password is optional, but if provided, must be confirmed
        ]);

        // Update the student's details
        $student->name = $request->name;
        $student->address = $request->address;
        $student->gender = $request->gender;
        $student->class = $request->class;
        $student->age = $request->age;
        $student->phone = $request->phone;
        $student->email = $request->email;

        // Check if password is provided and update if necessary
        if ($request->filled('password')) {
            $student->password = Hash::make($request->password); // Hash the password before saving
        }

        $student->save();

        return redirect()->route('librarian.students')->with('success', 'Student updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('librarian.students')->with('success', 'Student deleted successfully.');
    }
}
