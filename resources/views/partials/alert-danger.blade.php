<div class="alert alert-danger alert-dismissible fade mt-5 {{ $errors->count() ? 'show' : 'd-none' }}" role="alert">
  <strong>Uh oh!</strong> {{ $errors->first() }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>