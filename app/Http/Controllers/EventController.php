<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Project;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = [];
        try {

                $data['repo_name'] = $request['repository']['name'];
                $commits = $request['commits'][0];
                $data['event_id'] = $commits['id'];
                $data['email'] = $commits['author']['email'];
                $data['type'] = 'unknown';
                $data['description'] = $commits['message'];
	} catch(Exception $e) {
		Log::debug('data not filled');
		Log::debug($data);
                return;
        }
	$repo_name = Str::replace('-', ' ', $data['repo_name']);

        $user = User::where('email', $data['email'])->first();
        $project = Project::where('repo', $repo_name)->first();
        $data['user_id'] = $user ? $user['id'] : 1;
        $data['project_id'] = $project ? $project['id'] : 1;
	
	Event::create($data);
	try {
		$response = Http::withHeaders(config('github.GITHUB_HEADERS'))
                    ->get("http://raw.githubusercontent.com/alxcommunity/".$data['repo_name']."/main/README.md");
	if ($project) {
                $project->forceFill([
                        'overview' => $response
                ])->save();
        }
	} catch(Exception $e) {
		Log::debug($e);
	}
        return;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(event $event)
    {
        //
    }
}

