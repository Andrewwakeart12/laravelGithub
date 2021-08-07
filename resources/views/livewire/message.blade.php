
<h1>Comments</h1>
<input wire:model="search" type="text" placeholder="Type Somthing">
<ul>
    @if ($comments)
    @foreach ($comments as $comment)
    <li>{{$comment->post_id}}</li>
    <li>{{$comment->author}}</li>
    <li>{{$comment->email}}</li>
    <li>{{$comment->body}}</li>
    @endforeach

    @endif
@livewireScripts
</ul>
