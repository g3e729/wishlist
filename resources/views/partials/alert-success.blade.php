<div class="alert alert-success alert-dismissible fade mt-5 {{ session()->has('successMessage') ? 'show' : 'd-none' }}" role="alert">
  <strong>Alright!</strong> {{ session()->get('successMessage') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>