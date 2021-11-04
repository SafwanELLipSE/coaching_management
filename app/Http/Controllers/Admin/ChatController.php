<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Chat\ChatInterface;
use App\Http\Repository\Classroom\ClassroomInterface;

class ChatController extends Controller
{
    public function __construct(ClassroomInterface $classroomRepository, ChatInterface $chatRepository)
    {
        $this->classroomRepository = $classroomRepository;
        $this->chatRepository = $chatRepository;
    }
    public function chatView($id){
        return view('chats.chat_index',[
            'classroom' => $this->classroomRepository->get($id),
            'enrolledStudentLists' => $this->classroomRepository->listOfEnrolledStudent($id),
            'comments' => $this->chatRepository->getByClassroom($id),
        ]);
    }
    public function storeChat(Request $request){
        $this->chatRepository->store($request);
        return redirect()->back();
    }
}
