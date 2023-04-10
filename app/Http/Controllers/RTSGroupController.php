<?php

namespace App\Http\Controllers;

use App\Models\RTSGroup as ModelsRTSGroup;
use App\Models\RTSGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RTSGroupController extends Controller
{
    public function createGroup(Request $request)
    {
      try {
        $rtsGroup=new RTSGroup();
        $rtsGroup->group_name=$request->group_name;
        $rtsGroup->coordinator_name=$request->coordinator_name;
        $rtsGroup->coordinator_id=$request->coordinator_id;
        $rtsGroup->save();

        return response([
         'code'=>0,
         "message"=>'Group created successfully'
        ]);
      } catch (\Exception $th) {
        return response([
            'code'=>1,
            "message"=>$th->getMessage(),
            'exception_code'=>$th->getCode()
           ]);
      }
    }

    public function listUserGroup(Request $request)
    {
        try {
         
            $groupList=RtsGroup::where('coordinator_id', $request->user_id)
            ->orWhereHas('members', function ($query) use ($request) {
                $query->where('member_user_id', $request->user_id);
            })
            ->get();

            return response([
             'code'=>0,
             "message"=>'Group retrieved successfully',
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
    public function listOtherGroup(Request $request)
    {
        try {
            $groupList= DB::table('rts_group')
            ->where('coordinator_id', '!=', $request->user_id)
            ->whereNotIn('id', function ($query) use ($request) {
                $query->select('rts_id')
                    ->from('rts__members')
                    ->where('member_user_id', $request->user_id);
            })
            ->get();
            return response([
             'code'=>0,
             "message"=>'Group retrieved successfully',
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
}


