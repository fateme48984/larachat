<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->middleware('auth');

        $this->userRepository = $userRepository;
    }

    public function index() {
        $users = $this->userRepository->getContacts();
        return view('chat', compact("users"));
    }
}
