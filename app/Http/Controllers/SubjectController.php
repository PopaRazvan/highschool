<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    protected $apiPath;

    public function __construct()
    {
        $this->apiPath = Config::get('highschool-api.highschool_api_path');
    }

    public function index()
    {
        $responseSubjects = Http::withToken(session('access_token'))->get($this->apiPath . '/subjects');

        if ($responseSubjects->successful()) {

            $responseSubjectsData = $responseSubjects->json();
            return view('subject.index', ['subjects' => $responseSubjectsData]);
        } else {
        }
    }

    public function show(string $id)
    {
        $responseSubject = Http::withToken(session('access_token'))->get($this->apiPath . '/subjects/' . $id);

        if ($responseSubject->successful()) {
            $responseSubjectData = $responseSubject->json();
            return view('subject.show', ['subject' => $responseSubjectData]);
        } else {
        }
    }

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'name' => 'required',
        ]);

        $response = Http::withToken(session('access_token'))->post($this->apiPath . '/subjects', $formFields);

        return redirect('/subjects')->with('message', 'Subject created successfully!');
    }

    public function destroy(Request $request, string $idSubject)
    {
        $response = Http::withToken(session('access_token'))->delete($this->apiPath . '/subjects/' . $idSubject);


        return redirect('/subjects/')->with('message', 'Subject deleted successfully!');
    }
}
