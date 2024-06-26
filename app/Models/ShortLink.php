<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model {
    use HasFactory;

    protected $fillable = ['user_id', 'url', 'code', 'ip_address'];

    public function statistics() {
        return $this->hasMany(Statistic::class);
    }
}
