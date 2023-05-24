@if(Session::has('success'))
<div class="alert alert-soft-success d-flex align-items-center" role="alert">
  <span class="fas fa-check-circle text-success fs-3 me-3"></span>
  <p class="mb-0 flex-1">{{Session::get('success')}}</p>
  <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(Session::has('danger'))
<div class="alert alert-outline-danger d-flex align-items-center" role="alert">
    <span class="fas fa-times-circle text-danger fs-3 me-3"></span>
    <p class="mb-0 flex-1">{{Session::get('danger')}}</p>
    <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>

@endif