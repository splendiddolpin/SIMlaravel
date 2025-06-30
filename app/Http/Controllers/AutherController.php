<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\auther;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreautherRequest;
use App\Http\Requests\UpdateautherRequest;

class AutherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Auther::query();

        // Jika ada parameter pencarian
        if ($request->has('search') && $request->input('search') !== '') {
            $search = $request->input('search');
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Ambil data author sesuai pencarian dan paginate
        $authors = $query->paginate(5);

        return view('librarian.auther.index', [
            'authors' => $authors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('librarian.auther.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreautherRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreautherRequest $request)
    {
        auther::create($request->validated());

        return redirect()->route('librarian.authors')->with('success', 'Author added successfully.');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\auther  $auther
     * @return \Illuminate\Http\Response
     */
    public function edit(Auther $auther)
    {
        return view('librarian.auther.edit', [
            'auther' => $auther
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateautherRequest  $request
     * @param  \App\Models\auther  $auther
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateautherRequest $request, $id)
    {
        $auther = Auther::find($id);
        $auther->name = $request->name;
        $auther->save();

        return redirect()->route('librarian.authors')->with('success', 'Author updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    // App\Http\Controllers\AutherController.php

    // App\Http\Controllers\AutherController.php

    public function destroy($id)
    {
        $auther = Auther::find($id);

        // Pastikan tidak ada buku yang terkait dengan author
        if ($auther->books()->count() > 0) {
            return redirect()->route('librarian.authors')->with('error', 'Cannot delete author because they have associated books.');
        }

        $auther->delete();
        return redirect()->route('librarian.authors')->with('success', 'Author deleted successfully.');
    }

    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Proses register
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'role' => 'required|in:student,librarian',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('login.form')->with('success', 'Registration successful. Please login.');
    }

    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // dd(Auth::user()->role);

            if (Auth::user()->role == 'librarian') {
                return redirect()->route('librarian.dashboard');
            } else {
                return redirect()->route('student.dashboard');
            }
        }

        return back()->withErrors([
            'email' => 'Email atau Password yang anda input salah.',
        ]);
    }

    // Proses logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }

    // Dashboard Student
    public function studentDashboard()
    {
        return view('dashboard');
    }

    // Dashboard Librarian
    public function librarianDashboard()
    {
        return view('librarian.dashboard');
    }
}
