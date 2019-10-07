<?php

namespace App;

class RebateCodeAllocator
{
    protected $project;
    protected $person;

    public function __construct($project, $person)
    {
        $this->project = $project;
        $this->person = $person;
        $this->season = Settings::first()->active_season_id;
    }

    public function allocateCodes()
    {
        // $this_season = Settings::first()->active_season_id;
        $members = Membership::where(function ($query) {
            $query->where('season_id', '>', $this->season - 1)
                ->where('person_id', $this->person);
        })->orWhere(function ($query) {
            $query->where('season_id', '>', $this->season - 1)
                ->where('person_purchaser_id', $this->person);
        })->get();
        // return $members;
        $array = [];
        foreach ($members as $member) {
            $rebatecode = Rebatecode::where('person_id', $member->person_id)->where('project_id', $this->project)->where('rebate', 22)->get();
            $count = count($rebatecode);
            if ($count == 2) {
                $rebatecode1 = $rebatecode[0];
                $rebatecode2 = $rebatecode[1];
            }
            if ($count < 2) {
                $first_code = Rebatecode::where('rebate', 22)->where('project_id', $this->project)->where('person_id', null)->first();
                $first_code->person_id = $member->person_id;
                $first_code->save();
                $rebatecode1 = $first_code;
            }
            if ($count < 1) {
                $second_code = Rebatecode::where('rebate', 22)->where('project_id', $this->project)->where('person_id', null)->first();
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
