<?php

namespace App\Http\Controllers;

use App\Repositories\MessageRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    private MessageRepository $messageRepository;
    private UserRepository $userRepository;

    public function __construct(MessageRepository $messageRepository, UserRepository $userRepository) {
        $this->messageRepository = $messageRepository;
        $this->userRepository = $userRepository;
    }

    public function conversation($userId) {
        //$messages = $this->messageRepository->getConversation($userId);
        $data['users'] = $this->userRepository->getContacts();
        $data['userInfo'] = $this->userRepository->getUser(Auth::id());
        $data['contactInfo'] = $this->userRepository->getUser($userId);
        $data['userId'] = $userId;

        return view('message.conversation',$data);
    }
}
