<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    use HasFactory;

    // ✅ force table name to "press"
    protected $table = 'press';

    protected $fillable = [
        'title',
        'description',
        'pdf',
        'photo',
        'icon',
        'guideline_pdf',
    ];
}
