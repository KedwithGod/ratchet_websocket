<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RTSGroupController;
use App\Http\Controllers\RTSMemberController;
use App\Models\RTSMember;
use Illuminate\Http\Request;
use Livewire\Component;

class ChatPage extends Component
{

    public $chatmessages=[];

    protected $listeners=['chat-message'=>'chatMessage'];

    public $mygroup=[];
    public $othergrop=[];

    public $group_name;

    public $user_id;

    public $showDialog=false;

    public $setContributionBool=false;
    public $acceptContributionBool=false;
    public $recievedContributionBool=false;

    public $contribuionAmount=0.0;
    public $index;

    public $accept;

    public $senderName;

    protected $rules = [
        'group_name' => 'required|string|min:3|max:255',

    ];

    protected $messages = [
        'group_name.required' => 'You can\'t create a group without a group name.',
        'group_name.min' => 'The minimum is 3 digits, aba.',
    ];


    public function toggleSetContribution($index)
    {
       if($this->mygroup[$index]['coordinator_id']==$this->user_id){
        $this->group_name=$this->mygroup[$index]['group_name'];
        $this->setContributionBool=true;
        $this->index=$index;
       }
    }

    public function setContribution()
    {
       $message=[
        'tag'=>'group_sent','id'=>$this->mygroup[$this->index]['id'],
        'contibution_amount'=>$this->contribuionAmount,"group"=>["name"=>$this->mygroup[$this->index]['group_name'],
        "coordinator"=>$this->mygroup[$this->index]['coordinator_name'],"members"=>[],"groupId"=>$this->mygroup[$this->index]['id'],
        "coordinatorId"=>$this->mygroup[$this->index]['coordinator_id']]
       ];
       $this->sendMessage(json_encode($message));
       $this->setContributionBool=false;
    }
    public function sendContribution($accept)
    {
       $message=[
        'tag'=>'group_recieved','id'=>$this->mygroup[$this->index]['id'],'accept'=>$accept,'sender_name'=>'Samuel-'. $this->user_id,
        'contibution_amount'=>$this->contribuionAmount,"group"=>["name"=>$this->mygroup[$this->index]['group_name'],
        "coordinator"=>$this->mygroup[$this->index]['coordinator_name'],"members"=>[],"groupId"=>$this->mygroup[$this->index]['id'],
        "coordinatorId"=>$this->mygroup[$this->index]['coordinator_id']]
       ];
       $this->sendMessage(json_encode($message));
       $this->acceptContributionBool=false;
    }

    public function cancelRequest()
    {
        $this->setContributionBool=false;
        $this->recievedContributionBool=false;
    }

    public function mount($user_id)
    {

        $this->user_id = $user_id;

    }

    public function sendMessage($message)
    {

        $this->emit('sendMessage',$message);
    }

    public function joinGroup($rts_id)
    {
        $rts=new RTSMemberController();
        $request = new Request();
            $request->replace(
        [
        'members_name'=>'Samuel' ,
        'member_user_id'=>$this->user_id ,
        'rts_id'=>$rts_id ,
        ]);
        $rts->joinGroup(
            $request);
    }

    public function createGroup()
    {
       try {
        $this->validate();
        $group_name=$this->validateOnly(
                'group_name',$this->rules,$this->messages

            );
            $rts=new RTSGroupController();
            $request = new Request();
            $request->replace([
            'group_name'=> $group_name['group_name'],
            'coordinator_name'=>'Samuel',
            'coordinator_id'=>$this->user_id,
        ]);
            $rts->createGroup($request);
            $this->group_name='';
       } catch (\Exception $th) {
          dd($th->getMessage());
       }
    }


    public function chatMessage($message)
    {

        $sentMessage=json_decode($message);

        if(collect($this->mygroup)->contains('id',$sentMessage->id))
        {

            if($sentMessage->tag=='group_sent' || $sentMessage->tag=='group_general' ){
                $this->chatmessages[]=$message;
                 $this->acceptContributionBool=true;
                 $this->group_name=$sentMessage->group->name;
                 $this->contribuionAmount=$sentMessage->contibution_amount;
                 $this->index=array_search($this->group_name,array_column($this->mygroup,'group_name'));
                return true;
            }
           if($sentMessage->tag=='group_recieved' && $sentMessage->group->coordinatorId==$this->user_id ){
            $this->recievedContributionBool=true;
            $this->group_name=$sentMessage->group->name;
            $this->contribuionAmount=$sentMessage->contibution_amount;
            $this->contribuionAmount=$sentMessage->contibution_amount;
            $this->accept=$sentMessage->accept=='No'?false:true;
            $this->senderName=$sentMessage->sender_name;
            $this->index=array_search($this->group_name,array_column($this->mygroup,'group_name'));
            return true;
           }

        }

        $this->chatmessages[]=$message;
    }
    public function render()
    {
        $rts=new RTSGroupController();
        $request = new Request();
        $request->replace(['user_id'=>$this->user_id]);
        $mygroup=$rts->listUserGroup($request);
        $othergrop=$rts->listOtherGroup($request);
        $mygroup= $mygroup->getContent();
        $othergrop= $othergrop->getContent();
        $this->mygroup=json_decode($mygroup,true);
        $this->mygroup=$this->mygroup['data'];
        $this->othergrop=json_decode($othergrop,true);
        $this->othergrop=$this->othergrop["data"];
        return view('livewire.chat-page');
    }
}
