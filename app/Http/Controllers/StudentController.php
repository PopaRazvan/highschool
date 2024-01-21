<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class StudentController extends Controller
{
    protected $apiPath;

    public function __construct()
    {
        $this->apiPath = Config::get('highschool-api.highschool_api_path');
    }


    public function show(string $idStudent)
    {
        $responseStudent = Http::withToken(session('access_token'))->get($this->apiPath . '/students/' . $idStudent);
        $responseClassrooms = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms');
        $responseSubject = Http::withToken(session('access_token'))->get($this->apiPath . '/subjects');

        if ($responseStudent->successful() && $responseSubject->successful() && $responseClassrooms->successful()) {
            $responseDataStudent = $responseStudent->json();
            $responseDataSubject = $responseSubject->json();
            $responseDataClassrooms = $responseClassrooms->json();
            return view('student.show', ['student' => $responseDataStudent, 'subjects' => $responseDataSubject, 'classrooms' => $responseDataClassrooms]);
        } else return redirect()->back()->with('message', "!");
    }

    public function index()
    {
        $responseStudents = Http::withToken(session('access_token'))->get($this->apiPath . '/students');
        $responseClassrooms = Http::withToken(session('access_token'))->get($this->apiPath . '/classrooms');

        if ($responseStudents->successful() && $responseClassrooms->successful()) {
            $responseStudentsData = $responseStudents->json();
            $responseDataClassrooms = $responseClassrooms->json();
            return view('student.index', ['students' => $responseStudentsData, 'classrooms' => $responseDataClassrooms]);
        } 
            else  return redirect()->back()->with('message', "!");
        
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'scholarship' => 'required',
            'birthDate' => 'required',
        ]);

        $idClassroom = $request->input('idClassroom');

        $formFields['idClassroom'] = $idClassroom;

        $response = Http::withToken(session('access_token'))->post($this->apiPath . '/students', $formFields);

        if ($response->successful()) {
            $idStudent = $response->json()['id'];
            return redirect('/students/' . $idStudent)->with('message', 'Student created successfully!');
        } else  return redirect('/students/')->with('message', $response->json()['message']);
    }

    public function addGrade(Request $request)
    {
        $formFields = $request->validate([
            'value' => 'required',
        ]);

        $idStudent = $request->input('idStudent');
        $idSubject = $request->input('idSubject');

        $formFields['idStudent'] = $idStudent;
        $formFields['idSubject'] = $idSubject;

        $response = Http::withToken(session('access_token'))->post($this->apiPath . '/grades', $formFields);
        if ($response->successful()) {
            return redirect('/students/' . $idStudent)->with('message', 'Grade added successfully!');
        } else  return redirect('/students/' . $idStudent)->with('message', $response->json()['message']);
    }

    public function destroy(Request $request, string $idStudent)
    {
        $response = Http::withToken(session('access_token'))->delete($this->apiPath . '/students/' . $idStudent);

        $idClassroom = $request->input('idClassroomDELETE');
        if ($response->successful()) {
            return redirect('/classrooms/' . $idClassroom)->with('message', 'Student deleted successfully!');
        } else  return redirect('/students/' . $idStudent)->with('message', $response->json()['message']);
    }

    public function changeClassroom(Request $request, string $idStudent)
    {
        $idClassroom = $request->input('idClassroom');

        $response = Http::withToken(session('access_token'))->patch($this->apiPath . '/students/' . $idStudent, ['idClassroom' => $idClassroom]);
        if ($response->successful()) {
            return redirect('/classrooms/' . $idClassroom)->with('message', 'Student moved successfully!');
        } else  return redirect('/students/' . $idStudent)->with('message', $response->json()['message']);
    }
}
