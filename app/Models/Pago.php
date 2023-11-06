<?php

namespace App\Models;

use App\Traits\Auditable;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Pago extends Model implements HasMedia
{
    use InteractsWithMedia, Auditable, HasFactory;

    public $table = 'pagos';

    protected $appends = [
        'comprobante',
    ];

    protected $dates = [
        'fecha_asignada_de_pago',
        'fecha',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const METODO_SELECT = [
        'Efectivo' => 'Efectivo',
        'ACH'      => 'ACH',
        'Yappy'    => 'Yappy',
        'Visa'     => 'Tarjeta',
    ];

    public const CONCEPTO_SELECT = [
        'abono'         => 'Abono',
        'matricula'     => 'Matrícula',
        'mensualidad'   => 'Mensualidad',
        'clase_privada' => 'Clase Privada',
        'otros'         => 'Otros',
    ];

    protected $fillable = [
        'estudiante_id',
        'concepto',
        'monto',
        'metodo',
        'fecha_asignada_de_pago',
        'fecha',
        'descripcion',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function estudiante()
    {
        return $this->belongsTo(Cliente::class, 'estudiante_id');
    }

    public function getFechaAsignadaDePagoAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaAsignadaDePagoAttribute($value)
    {
        $this->attributes['fecha_asignada_de_pago'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFechaAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFechaAttribute($value)
    {
        $this->attributes['fecha'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getComprobanteAttribute()
    {
        return $this->getMedia('comprobante')->last();
    }
}
