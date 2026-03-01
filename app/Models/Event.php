<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'organizer_id',
        'category_id',
        'start_time',
        'end_time',
        'venue',
        'city',
        'event_date',
        'banner',
        'status',
        'tickets_sold',
        'is_verified',
    ];

    public function organizer()
    {
        return $this->belongsTo(User::class, 'organizer_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function ticketTypes()
    {
        return $this->hasMany(TicketType::class);
    }
}
