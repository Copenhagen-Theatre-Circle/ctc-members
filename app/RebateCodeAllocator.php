<?php

namespace App;

class RebateCodeAllocator
{
    protected $project_id;
    protected $person_id;
    protected $season_id;

    public function __construct($project_id, $person_id)
    {
        $this->project_id = $project_id;
        $this->person_id = $person_id;
        $this->season_id = Settings::first()->active_season_id;
    }

    public function allocateCodes()
    {
        // $this_season = Settings::first()->active_season_id;
        $members = Membership::where(function ($query) {
            $query->where('season_id', '>', $this->season_id - 1)
                ->where('person_id', $this->person_id);
        })->orWhere(function ($query) {
            $query->where('season_id', '>', $this->season_id - 1)
                ->where('person_purchaser_id', $this->person_id);
        })->get();
        $array = [];
        foreach ($members as $member) {
            $rebatecode = Rebatecode::where('person_id', $member->person_id)->where('project_id', $this->project_id)->where('rebate', 22)->get();
            $count = count($rebatecode);
            if ($count == 2) {
                $rebatecode1 = $rebatecode[0];
                $rebatecode2 = $rebatecode[1];
            }
            if ($count < 2) {
                $first_code = Rebatecode::where('rebate', 20)->where('project_id', $this->project_id)->where('person_id', null)->first();
                $first_code->person_id = $member->person_id;
                $first_code->save();
                $rebatecode1 = $first_code;
            }
            if ($count < 1) {
                $second_code = Rebatecode::where('rebate', 20)->where('project_id', $this->project_id)->where('person_id', null)->first();
                $second_code->person_id = $member->person_id;
                $second_code->save();
                $rebatecode2 = $second_code;
            }
            $item['member_id'] = $member->person_id;
            $item['member_id'] = $member->person_id;
            $item['count'] = $count;
            $item['first_code'] = $rebatecode1;
            $item['second_code'] = $rebatecode2;
            $array[] = $item;
        }
        return $array;
    }
}
