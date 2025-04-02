<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Fields that are mass assignable

    protected $fillable = ['username', 'first_name', 'last_name', 'phone', 'email', 'gender', 'course', 'photo',];

    // Convert username to lowercase and trim whitespace

    public function setUsernameAttribute($value)
    {
        $this->attributes['username'] = strtolower(trim($value));
    }

    // Convert email to lowercase and trim whitespace

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower(trim($value));
    }

    // Generate full name by combining first and last name with proper capitalization

    public function getFullNameAttribute()
    {
        return ucwords(trim("{$this->first_name} {$this->last_name}"));
    }
}
