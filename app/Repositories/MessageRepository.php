<?php

namespace App\Repositories;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MessageRepository
{
    public function getConversation(int $senderId, int $receiverId) {
        return Message::query()
            ->where(
                function ($query) use ($senderId, $receiverId)   {
                    $query->where(Message::SENDER_ID,$senderId)
                        ->where(Message::RECEIVER_ID,$receiverId);
                })
            ->OrWhere(
                function ($query) use ($senderId, $receiverId)   {
                    $query->where(Message::SENDER_ID,$receiverId)
                        ->where(Message::RECEIVER_ID,$senderId);
                }
            )
            ->orderBy(Message::CREATED_AT,'asc')->get();
    }


    public function getRecentReceiversWithMessages(int $senderId): \Illuminate\Database\Eloquent\Collection|array
    {
        DB::statement('SET SESSION SQL_MODE=""');
        $recentMessages =  Message::query()
            ->select(Message::RECEIVER_ID, Message::SENDER_ID,Message::MESSAGE)
            ->where(Message::SENDER_ID, $senderId)
            ->orWhere(Message::RECEIVER_ID, $senderId)
            ->groupBy(Message::RECEIVER_ID,Message::SENDER_ID)
            ->orderBy(Message::ID)
            ->limit(100)
            ->get();

        if(!empty($recentMessages)) {
            $recentMessages = $this->filterRecentReceiversWithMessages($recentMessages, $senderId);
        }

        return $recentMessages;
    }

    /**
     * @param $messages
     * @param $senderId
     * @return array
     */
    public function filterRecentReceiversWithMessages($messages, $senderId): array
    {
        $usedUserId = [];
        $result = [];
        foreach ($messages as $message) {
            if(!in_array($message->{Message::SENDER_ID} , $usedUserId) &&  !in_array($message->{Message::RECEIVER_ID} , $usedUserId)) {
                $userId = $message->{Message::SENDER_ID} == $senderId ? $message->{Message::RECEIVER_ID} : $message->{Message::SENDER_ID};
                $result[] = [
                    'user_id' => $userId,
                    'message' => $message->{Message::MESSAGE}
                ];
                $usedUserId[] = $userId;
            }
        }

        $usersData = User::whereIn(User::ID, $usedUserId)
            ->withCount([
                'sentMessages as unread_message_count' => function($query) use ($senderId) {
                    $query->where(Message::RECEIVER_ID, $senderId)
                        ->whereIn(Message::STATUS, [Message::STATUS_DELIVERED,Message::STATUS_SENT]);
                }
            ])
            ->get();

        $users = $usersData->pluck('name', 'id')->map(function ($name, $id) use ($usersData) {
            $user = $usersData->where('id', $id)->first();
            return [
                'name' => $name,
                'unread_message_count' => $user->unread_message_count,
            ];
        })->toArray();

        foreach ($result as $key=>$value) {
            $result[$key]['name'] = $users[$value['user_id']]['name'];
            $result[$key]['unread_message_count'] = $users[$value['user_id']]['unread_message_count'];
        }

        return $result;
    }

    public function sendMessage(array $data, int $receiverId)
    {
      //  try {
            return Message::create([
                'sender_id' => $data['sender_id'],
                'receiver_id' => $receiverId,
                'message' => $data['message'],
                'status' => 0
            ]);
//        }
//        catch (\Exception $e) {
//
//        }

    }
}
