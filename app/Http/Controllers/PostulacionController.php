use App\Models\Postulacion;

public function index()
{
    $usuarioId = auth()->id();
    $postulaciones = Postulacion::with('plaza')->where('user_id', $usuarioId)->get();

    return view('user.postulaciones', compact('postulaciones'));
}

