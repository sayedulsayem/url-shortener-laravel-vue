<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model {
    use HasFactory;

    protected $fillable = ['short_links_id', 'visitor'];

    public function link() {
        return $this->belongsTo(ShortLink::class);
    }
}
