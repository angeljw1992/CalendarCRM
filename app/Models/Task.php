<?php

namespace App\Models;

use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'tasks';

    public const GRUPO_SELECT = [
        'infantil' => 'Infantil',
        'adulto'   => 'Adulto',
    ];

    public const NAME_SELECT = [
        'piano'  => 'Piano',
        'violin' => 'Violin',
        'dibujo' => 'Dibujo',
    ];

    protected $dates = [
        'due_date',
        'final_date',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const DIAS_SELECT = [
        '0' => 'Domingo',
        '1' => 'Lunes',
        '2' => 'Martes',
        '3' => 'Miercoles',
        '4' => 'Jueves',
        '5' => 'Viernes',
        '6' => 'Sábado',
    ];

    protected $fillable = [
        'name',
        'grupo',
        'description',
        'due_date',
        'final_date',
        'start',
        'end',
        'dias',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDueDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDueDateAttribute($value)
    {
        $this->attributes['due_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getFinalDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setFinalDateAttribute($value)
    {
        $this->attributes['final_date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
