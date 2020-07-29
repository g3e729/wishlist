<h5 class="card-title">Wishes ({{ $wishes->total() }})
	@if($owned)
	<button class="btn btn-warning float-right" data-action="{{ route('items.store', $wishlist) }}" data-items="{{ $wishes->count() }}" data-toggle="modal" data-target="#addItemWishlistModal">Add Item</button>
	@endif
</h5>
<table class="table mt-4 mb-4">
    <tr>
        <th style="width: 50%;">Name</th>
        <th>Actions</th>
    </tr>
    @if (!$wishes->count())
    	@if (isset($buyList))
        <tr><td colspan="2">You have nothing to buy!</td></tr>
        @else
        <tr><td colspan="2">Wishlist is empty!</td></tr>
        @endif
    @endif
	@foreach($wishes as $wish)
		<tr>
			<td>
				<div style="width: 15%; height: 65px; float: left; margin-right: 10px; padding-top: 10px; overflow: hidden;">
					@if($wish->img_url)
					<img src="{{ $wish->img_url }}" alt="{{ $wish->name }}" style="width: 100%;">
					@endif
				</div>
				<div style="float: left;">
					<strong style="display: block;">{{ $wish->name }}</strong>
					<small style="display: block;">{{ $wish->price }}</small>
					@if(isset($buyList))
					<small>
						<a href="{{ route('wishlists.show', $wish->wishlist)}}">
							{{ $wish->wishlist->title }}
						</a>
					</small>
					@endif
				</div>
			</td>

			<td>
				@if(authUserId() && $wish->buyer_id == authUserId())
					@if($wish->purchased)
						<form action="{{ route('items.unpurchased', ['item' => $wish]) }}" method="POST" class="float-left">
		        			{{ csrf_field() }}
		        			{{ method_field('PATCH') }}
							<button type="submit" class="btn btn-primary mr-1">
								Not yet purchased
							</button>
						</form>
					@else
						<form action="{{ route('items.purchased', ['item' => $wish]) }}" method="POST" class="float-left">
		        			{{ csrf_field() }}
		        			{{ method_field('PATCH') }}
							<button type="submit" class="btn btn-primary mr-1">
								Purchased
							</button>
						</form>
					@endif
				@endif

				@if(auth()->check() && !$wish->buyer && !$owned)
					<form action="{{ route('items.to-buy', ['item' => $wish]) }}" method="POST" class="float-left">
	        			{{ csrf_field() }}
        				{{ method_field('PATCH') }}
						<button type="submit" class="btn btn-primary mr-1">Take Item</button>
					</form>
				@elseif(auth()->check() && $wish->buyer_id == authUserId() && !$wish->purchased && !$owned)
					<form action="{{ route('items.remove', ['item' => $wish]) }}" method="POST" class="float-left">
	        			{{ csrf_field() }}
        				{{ method_field('PATCH') }}
						<button type="submit" class="btn btn-danger mr-1">Remove Item</button>
					</form>
				@elseif(!$wish->buyer_id && !$wish->purchased && !$owned)
					<a href="{{ route('home', compact('invite_id')) }}" class="btn btn-primary mr-1" style="color: #ffffff;">Take Item</a>

				@endif
				<a class="btn btn-primary" target="_blank" href="{{ $wish->shop_url }}">Shop</a>

				@if($owned && !$wish->purchased)
					<div class="float-right">
						<button type="button" class="btn btn-default mr-1" data-action="{{ route('items.update', ['item' => $wish]) }}" data-name="{{ $wish->name }}" data-description="{{ $wish->description }}" data-price="{{ $wish->price }}" data-shop_url="{{ $wish->shop_url }}" data-img_url="{{ $wish->img_url }}" data-toggle="modal" data-target="#editItemWishlistModal">Edit</button>
						<button type="button" class="btn btn-danger mr-1" data-title="Remove Item" data-text="Are you sure you want to remove this item from your wishlist?" data-name="{{ $wish->name }}" data-action="{{ route('items.destroy', ['item' => $wish]) }}" data-toggle="modal" data-target="#removeItemWishlistModal">Remove</button>
					</div>
				@endif

				@if($owned && $wish->purchased)
				<span class="btn text-success float-right">Wrapped!</span>
				@endif
			</td>
		</tr>
	@endforeach
</table>

<div class="row justify-content-center">{{ $items->render() }}</div>
