<?php

use App\Models\UserMessage;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(UserMessage::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger(UserMessage::MESSAGE_ID);
            $table->unsignedInteger(UserMessage::SENDER_ID);
            $table->unsignedInteger(UserMessage::RECEIVER_ID);
            $table->tinyInteger(UserMessage::TYPE)->default(UserMessage::MESSAGE_TYPE_PERSONAL)
            ->comment('1:group message, 0:personal messsage');
            $table->tinyInteger(UserMessage::SEEN_STATUS)->default(UserMessage::MESSAGE_NOT_SEEN)
            ->comment('1:seen, 0:not seen');
            $table->tinyInteger(UserMessage::DELIVERED_STATUS)->default(UserMessage::MESSAGE_NOT_DELIVERED)
                ->comment('1:delivered, 0:not delivered');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_messages');
    }
};
