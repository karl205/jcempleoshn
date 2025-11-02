use Illuminate\Support\Facades\Auth;

public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        return redirect()->intended('/'); // redirige al dashboard
    }

    return back()->withErrors([
        'email' => 'Las credenciales no son válidas.',
    ])->withInput();
}


