<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class ProfessorController extends Controller
{
    protected $apiPath;

    public function __construct()
    {
        $this->apiPath = Config::get('highschool-api.highschool_api_path');
    }

    public function index()
    {
        $responseProfessors = Http::withToken(session('access_token'))->get($this->apiPath . '/professors');
        $responseClassrooms = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms');
        $responseSubjects = Http::withToken(session('access_token'))->get($this->apiPath . '/subjects');

        if ($responseProfessors->successful() && $responseClassrooms->successful() && $responseSubjects->successful()) {
            $responseProfessorsData = $responseProfessors->json();
            $responseClassroomsData = $responseClassrooms->json();
            $responseSubjectsData = $responseSubjects->json();
            return view('professor.index', ['professors' => $responseProfessorsData, 'classrooms' => $responseClassroomsData, 'subjects' => $responseSubjectsData]);
        } else {
        }
    }

    public function show(string $id)
    {
        $responseProfessor = Http::withToken(session('access_token'))->get($this->apiPath . '/professors/' . $id);
        $responseClassrooms = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms');

        if ($responseProfessor->successful() && $responseClassrooms->successful()) {
            $responseProfessorData = $responseProfessor->json();
            $responseClassroomsData = $responseClassrooms->json();
            return view('professor.show', ['professor' => $responseProfessorData, 'classrooms' => $responseClassroomsData]);
        } else {
        }
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
        ]);

        $selectedIdSubjects = $request->input('selectedSubjects', []);

        $idClassroom = $request->input('idClassroom');

        $formFields['idClassroom'] = $idClassroom;

        $formFields['idSubjects'] = $selectedIdSubjects;

        $response = Http::withToken(session('access_token'))->post($this->apiPath . '/professors', $formFields);

        if ($response->successful())
            return redirect('/professors')->with('message', 'Professor added successfully!');
        else return redirect('/professors')->with('message', $response->json()['message']);
    }

    public function destroy(string $idProfessor)
    {
        $response = Http::withToken(session('access_token'))->delete($this->apiPath . '/professors/' . $idProfessor);
        
        if ($response->successful())
            return redirect('/professors')->with('message', 'Professor deleted successfully!');
        else return redirect('/professors')->with('message', $response->json()['message']);
    }

    public function changeClassroom(Request $request, string $idProfessor)
    {
        $idClassroom = $request->input('idClassroom');

        $response = Http::withToken(session('access_token'))->patch($this->apiPath . '/professors/' . $idProfessor, ['idClassroom' => $idClassroom]);
        if ($response->successful())
            return redirect('/professors/' . $idProfessor)->with('message', 'Professor moved successfully!');
        else return redirect('/professors')->with('message', $response->json()['message']);
    }
}
