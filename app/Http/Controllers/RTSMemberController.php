<?php

namespace App\Http\Controllers;

use App\Models\RTSMember;
use Illuminate\Http\Request;

class RTSMemberController extends Controller
{
    public function joinGroup(Request $request)
    {
        try {
            $rtsGroup=new RTSMember();
            $rtsGroup->members_name=$request->members_name;
            $rtsGroup->member_user_id=$request->member_user_id;
            $rtsGroup->rts_id=$request->rts_id;
            $rtsGroup->save();
            return response([
             'code'=>0,
             "message"=>'Group join successfully'
            ]);
          } catch (\Exception $th) {
            return response([
                'code'=>1,
                "message"=>$th->getMessage(),
                'exception_code'=>$th->getCode()
               ]);
          }
    }

    public function listMembers(Request $request)
    {
        try {

            $memberList=RTSMember::where('rts_id', $request->rts_id)->get();

            return response([
             'code'=>0,
             "message"=>'Group retrieved successfully',
             'data'=>$memberList
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
