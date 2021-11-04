<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Repository\Classes\ClassInterface;

class ClassController extends Controller
{
    public function __construct(ClassInterface $classRepository)
    {
        $this->classRepository = $classRepository;
    }
    public function index()
    {
        return view('classes.create_class',[
            'count' => $this->classRepository->count(),
        ]);
    }
    public function store(Request $request)
    {
        $this->classRepository->store($request);
        return redirect()->back();
    }
    public function list(Request $request)
    {
        return view('classes.all_class',[
            'count' => $this->classRepository->count(),
            'classes' => $this->classRepository->list($request),
        ]);
    }
    public function update(Request $request){
        $this->classRepository->update($request);
        return redirect()->back();
    }
    public function delete($id){
        $this->classRepository->delete($id);
        return redirect()->back();
    }
}
