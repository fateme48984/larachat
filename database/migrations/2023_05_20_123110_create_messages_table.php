<?php

use App\Models\Message;
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
        Schema::create(Message::TABLE, function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger(Message::PARENT_ID)->nullable();
            $table->longText(Message::MESSAGE)->nullable();
            $table->tinyInteger(Message::TYPE)->default(Message::MESSAGE_TYPE_TEXT)->comment('1:text, 2:file');
            $table->tinyInteger(Message::STATUS)->default(Message::MESSAGE_STATUS_ENABLE);
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
        Schema::dropIfExists('messages');
    }
};
