<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'date', 'achive_card_id'];

    public function archiveCard()
    {
        return AchiveCard::query()->find($this->achive_card_id)?->first('image')->image;
    }
}
