@extends('layouts.app')
@section('title', $wishlist->title)

@section('content')
<section class="page-section">
    <div class="container" data-new="{{ $new ?? 0 }}">
    	
        @include('partials.alert-success')
        @include('partials.alert-warning')

        <div class="row mt-5">
            <div class="col-lg-8 mx-auto">
            	<div class="card mb-4">
				  <div class="card-header">
				  	<h5 class="m-0 float-left">
				  		{{ $wishlist->title }}
					  	@if($owned ?? false)
					  		<button class="btn btn-warning btn-sm ml-2 py-0" data-action="{{ route('wishlists.update', $wishlist) }}" data-title="{{ $wishlist->title }}" data-description="{{ $wishlist->description }}" data-toggle="modal" data-target="#editWishlistModal">edit</button>
							<button type="button" class="btn btn-danger btn-sm ml-2 py-0" data-dismiss="modal" data-title="Remove Wishlist" data-text="Are you sure to remove this wishlist?" data-name="{{ $wishlist->title }}" data-action="{{ route('wishlists.destroy', $wishlist) }}" data-target="#removeItemWishlistModal" onclick="removeX($(this))">remove</button>
				  		@endif
			  		</h5>
			  		<span class="float-right" data-toggle="tooltip" data-placement="right" title="Share this url with your friends!">{{ $wishlist->public_url }}</span>
				  </div>

				  <div class="card-body">
				    <p class="card-text">{{ $wishlist->description }}</p>
				    <strong class="float-left">
				    	@if($owned ?? false)
				    	<a href="#participantsListModal" data-action="{{ route('wishlists.invite', $wishlist) }}" data-toggle="modal" data-target="#participantsListModal" data-toggle="tooltip" data-placement="left" title="{{ $wishlist->participants->count() < 1 ? 'Start inviting your friends!' : 'More friends, more gifts! Invite now!' }}">Participants:</a> 
				    	@else
				    	Participants:
				    	@endif
				    	<span data-number_participants>{{ $wishlist->participants->count() }}</span>
				    </strong>
				    <strong class="float-right">By: {{ ($owned ?? false) ? 'You' : $wishlist->organizer->name }}</strong>
				  </div>
				</div>
				
				@include('partials.items', [
					'wishes' => $items,
					'wishlist' => $wishlist,
					'owned' => $owned ?? false,
				])

				@if(authUserId() == null)
                <p class="m-0 p-0 mt-5 text-center">Do you have an account? <a href="{{ route('login') }}">Login now</a>!</p>
                <p class="m-0 p-0 text-center">or</p>
                <p class="m-0 p-0 text-center"><a href="{{ route('register.show') }}">Register</a>!</p>
				@endif
            </div>
        </div>
    </div>

    <div id="participantList" class="d-none">
		@include('partials.participants', [
			'participants' => $wishlist->participants,
			'wishlist' => $wishlist,
			'owned' => $owned ?? false,
		])
	</div>
</section>
@endsection

@section('js')
<script type="text/javascript">
	var itmImgCont = $('.itemImageContainer');

	function setImgInpt(el) {
		el = $(el);
		let imgFld = $('[name="img_url"]');

		itmImgCont.find('.col-3 img').css('border-color', 'transparent');

		el.find('img').css('border-color', '#000000');
		imgFld.val(el.find('img').attr('src'));
	}

	if (Number($('[data-number_participants]').text()) < 1) {
		$('[data-target="#participantsListModal"]').tooltip('show');
	}

	$('.getImages').click(function () {
		let formHldr = $(this).parents('form');
		let form = new FormData();
		let settings = {
		  "url": "https://api.imgur.com/3/gallery/search/top/1?" + $.param({q: formHldr.find('[name="name"]').val()}),
		  "method": "GET",
		  "timeout": 0,
		  "headers": {
		    "Authorization": "Client-ID {{ env('IMGUR_CLIENT_ID') }}"
		  },
		  "processData": false,
		  "mimeType": "multipart/form-data",
		  "contentType": false,
		  "data": form
		};

		formHldr.find('.itemImageContainer').find('.col-3').remove();

		$.ajax(settings).done(function (response) {
			let items = JSON.parse(response);
			items = items.data;

			if (items.length > 0) {
				formHldr.find('.itemImageContainer').parent('div').removeClass('d-none');
			}

			$(items).each(function (index, item) {
				if (index < 25 && item.images && item.images.length) {
					let img = item.images[0];

					formHldr.find('.itemImageContainer').append('<div class="col-3" style="height: 120px; overflow: hidden; margin-botton: 5px;" onclick="setImgInpt($(this));">' +
                        '<img src="' + img.link + '" style="width:100%; border-width: 2px; border-style: solid; border-color: transparent;">' +
                    '</div>');
				}
			})

		});
	});
</script>
@endsection