<?php

namespace App\Http\Controllers;

use App\Models\RTSContribution;
use Illuminate\Http\Request;

class RTSContributionsController extends Controller
{
    public function createContributionAmount(Request $request)
    {
      try {
        $rtsGroup=new RTSContribution();
        $rtsGroup->save(
         [
             'contribution_amount_suggestion'=>$request->contribution_amount_suggestion,
             'rts_id'=>$request->rts_id,
         ]
        );

        return response([
         'code'=>0,
         "message"=>'contribution amount created successfully'
        ]);
      } catch (\Exception $th) {
        return response([
            'code'=>1,
            "message"=>$th->getMessage(),
            'exception_code'=>$th->getCode()
           ]);
      }
    }

    public function listContributionResult(Request $request)
    {
        try {
            $groupList=RTSContribution::where('rts_id', $request->rts_id)->first()->contribution_detail;
            return response([
             'code'=>0,
             "message"=>'Contribution answer retrieved successfully',
             'data'=>$groupList
            ]);
          } catch (\Exception $th) {
            return response([
                'code'=>1,
                "message"=>$th->getMessage(),
                'exception_code'=>$th->getCode()
               ]);
          }
    }

    public function sendContributionResponse(Request $request)
    {
      try {
        $rtsGroup=new RTSContribution();
        $rtsGroup->save(
         [
             'contribution_detail'=>$request->contribution_detail
         ]
        );

        return response([
         'code'=>0,
         "message"=>'contribution amount submitted successfully'
        ]);
      } catch (\Exception $th) {
        return response([
            'code'=>1,
            "message"=>$th->getMessage(),
            'exception_code'=>$th->getCode()
           ]);
      }
    }
}

