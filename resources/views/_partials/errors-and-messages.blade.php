@if($errors->all())
    @foreach($errors->all() as $message)
        {{--<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            {{ $message }}
        </div>--}}
        <div class="toast fade show bg-danger bottom-0 end-0" role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast">
            <div class="toast-header">
                <strong class="me-auto">{{env('APP_NAME')}}</strong>
                <small>Erreur</small>
                <button type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $message }}
            </div>
        </div> <!--end toast-->
    @endforeach

@elseif(session()->has('success'))
 {{--   <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('success') }}
    </div>--}}
    <div class="toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true" data-bs-toggle="toast">
        <div class="toast-header">
            <strong class="me-auto">{{env('APP_NAME')}}</strong>
            <small>Success</small>
            <button type="button" class="btn-close ms-2" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            {{ session()->get('success') }}
        </div>
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        {{ session()->get('error') }}
    </div>
@endif
