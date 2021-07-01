<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable=[
        'title',
        'image',
        'pdfUrl'
        
    ];
    use HasFactory;
}
