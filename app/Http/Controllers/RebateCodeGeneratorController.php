<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rebatecode;



class RebateCodeGeneratorController extends Controller
{

  public function __construct()
  {
    $this->middleware('auth');
    $this->middleware('member');
    $this->middleware('Illuminate\View\Middleware\ShareErrorsFromSession');
  }

  public function index()
  {
    if (!user_is_admin_or_superuser()) {
      abort(403, 'Unauthorized action.');
    }
    $projects = \App\Project::all();
    $projects = $projects->sortByDesc('id');
    return view('rebatecodegenerator.index', compact('projects'));
  }
  public function generateCodes(Request $request)
  {
    $request->validate([
      'project_id' => 'required',
      'rebate' => 'required',
      'number_of_codes' => 'required',
    ]);
    /* if the project_id is not set, return an error */
    if ($request->input('project_id') == null) {
      return response()->json([
        'error' => 'project_id is required'
      ], 400);
    }
    $project_id = $request->input('project_id');
    /* default number of codes is 10 */
    $number_of_codes = $request->input('number_of_codes');
    /* default rebate amount is 20 */
    $rebate = $request->input('rebate');

    $codes = [];
    for ($i = 0; $i < $number_of_codes; $i++) {
      $code = new Rebatecode;
      $code->project_id = $project_id;
      /* check that the code is unique in the codes array */
      $code->code = $this->generateOneAlphanumericCode();
      while (in_array($code->code, array_column($codes, 'code'))) {
        $code->code = $this->generateOneAlphanumericCode();
      }
      $code->rebate = $rebate;
      $code->save();
      $codes[] = $code;
    }

    /* return the codes as a downloadable txt file with newline-delimited codes */
    $file_content = implode("\n", array_column($codes, 'code'));
    $file_name = 'rebate_codes_' . $project_id . '_' . date('Y-m-d_H-i-s') . '.txt';
    fwrite(fopen($file_name, 'w'), $file_content);
    $response = response()->download($file_name)->deleteFileAfterSend(true);
    /* return $response and redirect to rebate-codes */
    return $response;
  }

  private function generateOneAlphanumericCode()
  {
    $code = '';
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    for ($i = 0; $i < 8; $i++) {
      $code .= $characters[rand(0, $charactersLength - 1)];
    }
    return $code;
  }


/**
 * Show the form for creating a new resource.
 *
 * @return \Illuminate\Http\Response
 */

}