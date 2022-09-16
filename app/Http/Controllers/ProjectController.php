<?php

namespace App\Http\Controllers;

use App\Actions\Alxcommunity\Media;
use App\Models\Board;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Laravel\Jetstream\Jetstream;

class ProjectController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Projects/Index', ['projects' => 'fiba']);
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

    public function storeBoard(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        Board::create($request->all());

        return back();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        
        $res = $this->createGitRepo($request['repo']);
        if(!$res['success']) return back();
        
        $repoName = $res['data']['name'];

        $addOwnerToRepo =  $this->addUserToGitRepo($repoName, auth()->user()->github_username, 'admin');
        $project = Project::create($request->all());
        return back();
    }

    public function storeTask(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        Task::create($request->all());
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show($id, $p_id)
    {   
	    $project = Project::where('id', $p_id)->with(['team', 'users', 'boards.tasks.user', 'events' => function($q) {
		    return $q->with(['user'])->limit(5)->orderBy('created_at', 'DESC')->get();
	    }])->first();
 
        if (Auth::user()) {
            $user = Auth::user();
            $user->hasTeamPermission($project, 'show');
            $permissions = $user->teamPermissions($project);
        }

        return Inertia::render('Projects/Index', ['project'  => $project, 'permissions' => $permissions ?? [], 'token' => csrf_token()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function task($id, $p_id)
    {
        $project = Project::where('id', $p_id)
                            ->where('team_id', $id)
                            ->with(['boards.tasks', 'team'])->first();
        
        if(!$project) return back(404);

        if (Auth::user()) {
            $user = Auth::user();
            $user->hasTeamPermission($project, 'show');
            $permissions = $user->teamPermissions($project);
        }
        return Inertia::render('Projects/Boards', ['project'  => $project, 'permissions' => $permissions ?? [], 'token' => csrf_token()]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function people($id, $p_id)
    {
        $project = Project::where('id', $p_id)->with(['users', 'team', ])->first();
        return Inertia::render('Projects/People', ['project'  => $project,  'token' => csrf_token()]);

    }

    public function Join(Project $project) {
        $user = Auth()->user();
        $project->users()->attach($user, ['is_accpted' => true]);
        return back();
     }
    
    /**
    * upload projects overview images to the database.
    *  
    * @param Request 
    * @return json Response  url with key url 
    */
    public function upload(Request $request)
    {  
        $data = [];
        $project = Project::find($request->project_id);
        if($request->file('upload'))
        {
           $data = Media::create($request['upload'], 'Projects',  $project);
        }
        return response()->json(['url' => asset('uploads/'.$data[0])]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the project overview and other specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $project)
    {
    
        $proj = Project::find($project);

        $proj->overview = $request->overview;
        $proj->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        //
    }
    /**
     * create new git repo
     * 
     * @param string $name
     * @return array $name
     */
    private function createGitRepo($name) {
       

       $res = Http::withHeaders(config('github.GITHUB_HEADERS'))
        ->post(config('github.GITHUB_URL').'orgs/alxcommunity/repos', [
            'name' => $name
        ]);

        return ['success' => $res->successful(), 'data' => $res->json()];
    }

    /**
     * add User to github repository
     * 
     * @param string $repo
     * @param string $username
     * @param string $permission
     * @return array
     */
    private function addUserToGitRepo($repo, $username, $permission) {
        $res = Http::withHeaders(config('github.GITHUB_HEADERS'))
        ->put(config('github.GITHUB_URL').'repos/alxcommunity/'.$repo.'/collaborators/'.$username, [
            'permission' => $permission
        ]);

        return ['success' => $res->successful(), 'body' => $res->json()];
    }
}
