<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'clientes';

    public static $searchable = [
        'fullname',
        'identificacion',
    ];

    public const ACTIVO_SELECT = [
        'active'   => 'Activo',
        'inactive' => 'Inactivo',
    ];

    protected $dates = [
        'fecha_nacimiento',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const NIVEL_SELECT = [
        'basico'     => 'Básico',
        'intermedio' => 'Intermedio',
        'avanzado'   => 'Avanzado',
    ];

    protected $fillable = [
        'fullname',
        'identificacion',
        'fecha_nacimiento',
        'correo',
        'telefono',
        'nivel',
        'observaciones',
        'activo',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function estudiantePagos()
    {
        return $this->hasMany(Pago::class, 'estudiante_id', 'id');
    }

    public function estudianteAsistencia()
    {
        return $this->hasMany(Asistencium::class, 'estudiante_id', 'id');
    }

    public function getFechaNacimientoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaNacimientoAttribute($value)
    {
        $this->attributes['fecha_nacimiento'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
