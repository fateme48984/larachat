<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    const TABLE = 'messages';

    const PARENT_ID = 'parent_id';
    const MESSAGE = 'message';
    const TYPE = 'type';
    const STATUS = 'status';

    const MESSAGE_STATUS_ENABLE = 1;
    const MESSAGE_STATUS_DISABLE = 2;

    const MESSAGE_TYPE_TEXT = 1;
    const MESSAGE_TYPE_FILE = 2;
}
