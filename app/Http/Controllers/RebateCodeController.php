<?php

namespace App\Http\Controllers;

use App\Rebatecode;
use App\Settings;
use App\Project;
use App\Person;
use Fico7489\Laravel\EloquentJoin\Tests\Models\Order;
use Illuminate\Http\Request;

class RebateCodeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('member');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!user_is_admin_or_superuser()) {
            abort(403, 'Unauthorized action.');
        }
        // select rebate codes with non null project id field
        // only for projects in the active season which we get from settings
        $active_season_id = Settings::all()->first()->active_season_id;
        $projects_in_active_season = Project::where('season_id', $active_season_id)->get();
        $rebatecodes = Rebatecode::whereIn('project_id', $projects_in_active_season->pluck('id'))->get();
        // sort rebate codes by id descending, so the newest are on top
        $rebatecodes = $rebatecodes->sortByDesc('id');
        return view('rebatecodes.index', compact('rebatecodes'));
    }

    public function show(string $id, Request $request)
    {
        $people = Person::all();
        $rebatecode = Rebatecode::find($id);
        return view('rebatecodes.show', compact('rebatecode', 'people'));
    }

    public function update()
    {
        $rebatecode = Rebatecode::find(request('id'));
        $rebatecode->person_id = request('person_id');
        $rebatecode->save();
        return redirect('/rebate-codes');
    }

    public function destroy(string $id)
    {
        $rebatecode = Rebatecode::find($id);
        $rebatecode->delete();
        return redirect('/rebate-codes');
    }
}