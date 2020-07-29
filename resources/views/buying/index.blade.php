@extends('layouts.app')
@section('title', 'To Buy')

@section('content')
<section class="page-section">
    <div class="container">
        <h2 class="page-section-heading text-center text-uppercase text-secondary mt-5">To Buy</h2>
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>

        @include('partials.alert-success')
        @include('partials.alert-warning')
        
        <div class="row">
            <div class="col-lg-8 mx-auto">
				@include('partials.items', [
					'wishes' => $items,
					'buyList' => true, 
					'owned' => false
				])
            </div>
        </div>
    </div>
</section>
@endsection

@section('js')
@endsection