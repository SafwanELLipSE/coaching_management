<?php

namespace App\Http\Repository\Chat;

use App\Models\Classroom_group_chat;
use App\Models\Classroom_single_chat;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ChatRepository implements ChatInterface
{
    public function all(){
        return Classroom_group_chat::all();
    }
    public function getByClassroom($id){
        return Classroom_group_chat::where('classroom_id',$id)->oldest()->paginate(6);
    }
    public function store($request){
        $validator = Validator::make($request->all(), [
            'current_user'   => 'required',
            'chat'   => 'required|min:2',
            'classroom_id'   => 'required',
        ]);
        if ($validator->fails()) {
            alert()->warning('Error Occurred', $validator->errors()->all()[0]);
            return redirect()->back()->withInput()->withErrors($validator);
        }
        $chat = new Classroom_group_chat();
        $chat->user_id = $request->post('current_user');
        $chat->message = $request->post('chat');
        $chat->classroom_id = $request->post('classroom_id');
        $chat->save();
    }
    public function list($request){}
    public function update($request){}
    public function delete($id){}
}
