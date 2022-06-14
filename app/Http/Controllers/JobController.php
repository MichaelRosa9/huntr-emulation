<?php

namespace App\Http\Controllers;

use App\Events\Job as EventsJob;
use App\Models\Job;
use App\Models\Stage;
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
        broadcast(new EventsJob);
        return response()->json([
            'message' => 'New job created.'
        ]);
    }

    public function update(Request $request) {
        $data = $request->all();
        $job = Job::find($data['id']);
        $job->update($data);
        broadcast(new EventsJob);

        return response()->json([
            'message' => 'Job updated.'
        ]);
    }

    public function updateStage(Request $request, Job $job) {
        $data = $request->all();
        $stage= Stage::find($data['id']);
        $job->stage_id = $stage->id;
        $job->save();
        broadcast(new EventsJob);

        return response()->json([
            'message' => 'Job stage updated.'
        ]);
    }

    public function delete(Job $job) {
        
        $job->delete();
        broadcast(new EventsJob);

        return response()->json([
            'message' => 'Job deleted.'
        ]);
    }
}
