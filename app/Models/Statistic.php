<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model {
    use HasFactory;

    protected $fillable = ['short_link_id', 'ip_address'];

    public function link() {
        return $this->belongsTo(ShortLink::class, 'short_link_id', 'id');
    }
}
