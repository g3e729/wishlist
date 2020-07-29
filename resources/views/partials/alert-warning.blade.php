<div class="alert alert-danger alert-dismissible fade mt-5 {{ session()->has('errorMessage') ? 'show' : 'd-none' }}" role="alert">
  <strong>Too bad!</strong> {{ session()->get('errorMessage') }}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<div class="alert alert-warning alert-dismissible fade mt-5 {{ isset($hasUser) && !$hasUser && $invite_id != null ? 'show' : 'd-none' }}" role="alert">
  <strong>Hmmmmm...</strong> Looks like someone is not yet registered... <a href="{{ route('register.show', compact('invite_id')) }}">Register now!</a>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>