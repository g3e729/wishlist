@if($owned)
<button class="btn btn-warning mb-2 float-right" data-dismiss="modal" data-toggle="modal" data-target="#inviteWishlistModal">Invite</button>
@endif
<table class="table mt-4 mb-4">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Actions</th>
    </tr>
    @if (!$participants->count())
        <tr><td colspan="3">Empty! @if($owned)<span class="pointer text-primary" data-dismiss="modal" data-toggle="modal" data-target="#inviteWishlistModal">Invite your friends now</span>! @endif</td></tr>
    @endif
	@foreach($participants as $participant)
		<tr>
			<td>{{ $participant->name }}</td>
			<td>{{ $participant->email }}</td>
			<td>
				<button type="button" class="btn btn-danger mr-1" data-dismiss="modal" data-title="Remove Participant" data-text="Are you sure you want to remove this participant from your wishlist?" data-name="{{ $participant->name }}" data-action="{{ route('wishlists.invite.destroy', compact('participant', 'wishlist')) }}" data-target="#removeItemWishlistModal" onclick="removeX($(this))">Remove</button>
			</td>
		</tr>
	@endforeach
</table>