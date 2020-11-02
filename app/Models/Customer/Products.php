<?php

namespace App\Models\Customer;

use App\Models\Traits\OnProject;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use OnProject;

    public $guarded = [];

}
