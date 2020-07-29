@extends('layouts.app')
@section('title', $type == 'mine' ? 'My Wishlists' : 'Participated Wishlists')

@section('content')
<section class="page-section">
    <div class="container pt-5">
        @include('partials.header2', ['h2' => $type == 'mine' ? 'My Wishlists' : 'Participated Wishlists'])

        @include('partials.alert-success')
        @include('partials.alert-warning')

        <div class="row">
            <div class="col-lg-8 mx-auto">
                @if($type == 'mine')
                <button class="btn btn-warning mb-1 float-right" data-toggle="modal" data-target="#createWishlistModal">Create Wishlist</button>
                @endif
                <table class="table">
                    <tr>
                        <th>Title</th>
                        @if ($type != 'mine')
                        <th>Organizer</th>
                        @endif
                        <th>Wishes/Participants</th>
                    </tr>
                    @if (!$wishlists->count())
                        @if ($type == 'mine')
                        <tr><td colspan="3">You don't have a wishlist.</td></tr>
                        @else
                        <tr><td colspan="3">You don't have participated wishlists.</td></tr>
                        @endif
                    @endif
                    @foreach($wishlists as $wishlist)
                        <tr>
                            <td><a href="{{ route('wishlists.show', $wishlist) }}">{{ $wishlist->title }}</a></td>
                            @if ($type != 'mine')
                            <td>
                                <a href="{{ route('wishlists.show', $wishlist) }}">
                                    {{ $wishlist->organizer->name }}
                                </a>
                            </td>
                            @endif
                            <td>{{ $wishlist->wishes->count() }}/{{ $wishlist->participants->count() }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection