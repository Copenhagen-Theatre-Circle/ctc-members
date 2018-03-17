<?php

namespace App\Exports;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\AuditionFormAnswer;

class AuditionsExport implements FromCollection, WithHeadings
{

    public function __construct(int $project, string $sort)
      {
          $this->project = $project;
          $this->sort = $sort;
      }

    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Mail',
            'Mobile',
            'Audition Preferences',
            'Weekdays not available',
            'Dates not avilable',
            'Biography',
            'Heard about us',
        ];
    }

    public function collection()
    {
        $answers = AuditionFormAnswer::where('project_id',$this->project);
        $sort = $this->sort;
        if ($sort == 'first_name'){
            $answers = $answers->orderByJoin('person.first_name');
        } elseif ($sort == 'last_name') {
            $answers = $answers->orderByJoin('person.last_name');
        } elseif ($sort == 'last_update') {
            $answers = $answers->orderBy('created_at');
        }
        $answers = $answers->with('person');
        $answers = $answers->get()->toArray();

        $i = 0;

        foreach ($answers as $answer) {
          $i = $i + 1;
          $answers_array[$i]['first_name']=$answer['person']['first_name'];
          $answers_array[$i]['last_name']=$answer['person']['last_name'];
          $answers_array[$i]['mail']=$answer['person']['mail'];
          $answers_array[$i]['mobile']=$answer['person']['mobile'];
          $answers_array[$i]['date_preferences']=$answer['date_preferences'];
          $answers_array[$i]['not_available_weekdays']=$answer['not_available_weekdays'];
          $answers_array[$i]['not_available_dates']=$answer['not_available_dates'];
          $answers_array[$i]['member_bio']= str_replace('&#39;',"'",$answer['person']['member_bio']);
          $answers_array[$i]['heard_about']=$answer['heard_about'];
        }


        return collect($answers_array);

    }
}
