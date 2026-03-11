<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'name',
        'phone',
        'email',
        'gender',
        'date_of_birth',
        'address',
        'passport_no',
        'nationality',
        'current_country',
        'english_certificate',
        'experience_year',
        'video_link',
        'photo',
        'status',
        'created_by',
    ];

    // জব মডেলের সাথে সম্পর্ক
    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
