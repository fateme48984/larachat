<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    use HasFactory;


    const TABLE = 'user_messages';

    const ID = 'id';
    const MESSAGE_ID = 'message_id';
    const SENDER_ID = 'sender_id';
    const RECEIVER_ID = 'receiver_id';
    const TYPE = 'type';
    const SEEN_STATUS = 'seen_status';
    const DELIVERED_STATUS = 'delivered_status';

    const MESSAGE_SEEN = 1;
    const MESSAGE_NOT_SEEN = 0;

    const MESSAGE_DELIVERED = 1;
    const MESSAGE_NOT_DELIVERED = 0;

    const MESSAGE_TYPE_PERSONAL = 0;
    const MESSAGE_TYPE_GROUP = 1;
}
