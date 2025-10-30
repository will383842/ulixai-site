<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Press extends Model
{
    protected $table = 'press';
    
    protected $fillable = [
        'title',
        'description',
        'language',
        'pdf',
        'photo',
        'icon',
        'guideline_pdf'
    ];
    
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
```

---

## 📂 Récapitulatif:
```
app/Models/Press.php                    ← CRÉER (code PHP ci-dessus)
resources/views/admin/press.blade.php   ← EXISTE (document 11, HTML/Blade)