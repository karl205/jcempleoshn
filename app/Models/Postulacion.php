namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postulacion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'plaza_id',
    ];

    public function plaza()
    {
        return $this->belongsTo(Plaza::class);
    }
}
