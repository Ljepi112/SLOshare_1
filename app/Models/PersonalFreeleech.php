<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalFreeleech extends Model
{
    use HasFactory;
    use Auditable;

    /**
     * The Database Table Used By The Model.
     *
     * @var string
     */
    protected $table = 'personal_freeleech';
}
