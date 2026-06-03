<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class PermisoDescarga extends Model
{
    use HasFactory;
    protected $fillable = ['curriculo_id', 'empresa_id', 'validado'];
    protected $table = 'permisos_descargas';


    
}
