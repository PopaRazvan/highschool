<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class ClassroomController extends Controller
{
    protected $apiPath;

    public function __construct()
    {
        $this->apiPath = Config::get('highschool-api.highschool_api_path');
    }

    public function index()
    {
        $responseClassroom = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms');
        $responseProfessor = Http::withToken(session('access_token'))->get($this->apiPath . '/professors');

        if ($responseClassroom->successful() && $responseProfessor->successful()) {
           
            return view('classroom.index', ['classrooms' => $responseClassroom->json(),'professors'=>$responseProfessor->json()]);
        } else return view('home.index');
    }

    public function show(string $id)
    {
        $responseClassroom = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms/' . $id);
        $responseClassrooms = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms/');

        if ($responseClassroom->successful() && $responseClassrooms->successful()) {
            $responseClassroomData = $responseClassroom->json();
            $responseClassroomsData = $responseClassrooms->json();

            return view('classroom.show', ['classroom' => $responseClassroomData, 'classrooms' => $responseClassroomsData]);
        } else return view('home.index');
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'year' => 'required',
            'group' => 'required',
        ]);

        $idProfessor = $request->input('idProfessor');
       
        $formFields['idProfessor'] = $idProfessor;

        $response = Http::withToken(session('access_token'))->post($this->apiPath . '/classrooms', $formFields);

        if ($response->successful())
            return redirect('/classrooms')->with('message', 'Classroom added successfully!');
        else return redirect('/classrooms')->with('message', $response->json()['message']);
    }

    public function destroy(string $idClassroom)
    {
        $response = Http::withToken(session('access_token'))->delete($this->apiPath . '/classrooms/' . $idClassroom);

        if ($response->successful())
            return redirect('/classrooms')->with('message', 'Classroom deleted successfully!');
        else return redirect('/classrooms')->with('message', $response->json()['message']);
    }
}
