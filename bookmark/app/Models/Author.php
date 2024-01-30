<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * Define the One to Many relationship of authors to books
     */
    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    /**
     * Get data for authors in alphabetical order by last name
     */
    public static function getForDropdown()
    {
        return self::orderBy('last_name')->select(['id', 'first_name', 'last_name'])->get();
    }

    /**
     * Concatenate the first and last name of the author for display purposes
     */
    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
