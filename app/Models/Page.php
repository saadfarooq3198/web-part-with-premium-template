<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class page extends Model
{
    use HasFactory;
     protected $fillable = [
         'page_title',
         'page_description',
         'button_text',
         'button_background_color',
         'button_text_color',
         'page_slug',
         'page_text_font'
     ];
}
