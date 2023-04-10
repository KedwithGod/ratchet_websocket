
<div>
  <h1>Create Group</h1>
  <div>
    <label for="group-name">Group Name:</label>
    <input type="text" id="group-name" name="group-name" wire:model='group_name'required>
    @error('group_name')
   <span> {{$message}}</span>
    @enderror
    <button type="button" wire:click='createGroup'>Create Group</button>
  </div>

  <h1>My Groups</h1>
  <ul id="my-groups">
    @forelse ($mygroup as $index =>$group)
    <li class="mine" wire:click='toggleSetContribution({{$index}})'>{{$group['group_name']}}</li>
    @empty
    <li>You have no group</li>
    @endforelse
  </ul>

  <h1>Join Group</h1>
  <p>Choose from the following groups:</p>
  <ul id="group-list">
    @forelse ($othergrop as $group)
    <li class='others_' wire:click="joinGroup({{$group['id']}})">{{$group['group_name']}}</li>
    @empty
    <li>There are no group</li>
    @endforelse
  </ul>
    {{-- set contribution --}}
    @if ($setContributionBool==true)
    <div class="dialog-container"  wire:ignore.self>
    <div class="disable_customer">
        <p class="disable_title">{{$group_name}} - Set Contribution</p>
        <input type="number" class=" text_field"
        placeholder="Set Contribution Amount" wire:model='contribuionAmount'
            title="Set Contribution Amount">
          @error('contribuionAmount') <span class="error small_error">{{ $message }}</span> @enderror
          <div class="disable_button">
            <button class="primary_button yes_disable"  wire:click='cancelRequest'>No, cancel</button>
            <button class="blue_border_button  no_cancel" wire:click='setContribution'>Send</button>
        </div>
    </div>
   </div>
    @endif
    {{-- accept contribution --}}
    @if ($acceptContributionBool==true)
    <div class="dialog-container"  wire:ignore.self>
    <div class="disable_customer">
        <p class="disable_title">{{$group_name}} - Accept Contribution</p>
        <p class="disable_subtitle">The Coordinator has suggest {{$contribuionAmount}}</p>
        <input type="number" class=" text_field" wire:model='contribuionAmount'
        placeholder="Enter your suggested amount"
            title="Enter your suggested amount">
          @error('contribuionAmount') <span class="error small_error">{{ $message }}</span> @enderror
          <div class="disable_button">
            <button class="blue_border_button  no_cancel" wire:click='sendContribution("Yes")'>Yes, Accept</button>
            <button  class="primary_button yes_disable" wire:click='sendContribution("No")'>No, set</button>
        </div>
    </div>
   </div>
    @endif
    {{-- accept contribution --}}
    @if ($recievedContributionBool==true)
    <div class="dialog-container"  wire:ignore.self>
    <div class="disable_customer">
        <p class="disable_title">{{$group_name}} - Contribution Report</p>
        @if ($accept==true)
        <p class="disable_subtitle">The {{$senderName}} has accepted the suggested amount {{$contribuionAmount}}, as the contribution amount</p>
        @else
        <p class="disable_subtitle">The {{$senderName}} has reject the suggested amount and suggested {{$contribuionAmount}}</p>
        @endif
           <div class='center'> <button  class="primary_button no_cancel " wire:click='cancelRequest'>Alright</button></div>
        </div>
    </div>
   </div>
    @endif
  {{-- <div class="modal">
    <div class="modal-content">
      <h2>Join Group</h2>
      <p>Do you want to join this group?</p>
      <button class="join-group-button">Join Group</button>
      <button class="cancel-button">Cancel</button>
    </div>
  </div> --}}


  {{-- <button wire:click="sendMessage()">send message</button> --}}
</div>

