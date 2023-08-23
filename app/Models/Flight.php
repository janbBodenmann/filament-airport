<?php
class Flight extends Model
{
    use HasFactory;

    public $fillable = [
        'airplane_id',
        'number',
        'start_airport_id',
        'end_airport_id',
        'departure_date',
        'arrival_date',
        'ready',
    ];

    public $dates = [
        'departure_date',
        'arrival_date',
    ];

    public function airplane(){
        return $this->belongsTo(Airplane::class);
    }

    public function start(){
        return $this->belongsTo(Airport::class,'start_airport_id');
    }

    public function end(){
        return $this->belongsTo(Airport::class,'end_airport_id');
    }

    public function comments(){
        return $this->morphMany(config('comments.comment_class'), 'commentable');
    }
}


