<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocumentEntries extends Model
{
    //
    protected $fillable = [
        'payment_text',
        'file_upload',
        'file_type',
        'created_by',
    ];
}
