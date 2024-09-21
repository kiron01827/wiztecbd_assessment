<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = ['name','description','date','total_seats','available_seats'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
