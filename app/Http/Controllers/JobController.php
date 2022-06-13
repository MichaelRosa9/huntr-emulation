<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::all();
        return $jobs->toJson();
    }

    public function store(Request $request) {
        $data = $request->all();
        $job = new Job();
        $job->fill($data);
        $job->save();

        return response()->json([
            'message' => 'New job created.'
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();
        $job = Job::find($data['id']);
        $job->update($data);
        return response()->json([
            'message' => 'Job updated.'
        ]);
    }

    public function delete(Job $job) {
        $job->delete();
        return response()->json([
            'message' => 'Job deleted.'
        ]);
    }
}
