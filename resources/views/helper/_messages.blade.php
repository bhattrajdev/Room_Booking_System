@if (!empty(session('primary')))
    <div class="alert alert-primary alert-dismissible" role="alert">
        {{ session('primary') }}
    </div>
@endif


@if (!empty(session('secondary')))
    <div class="alert alert-secondary alert-dismissible" role="alert">
        {{ session('secondary') }}
    </div>
@endif

@if (!empty(session('success')))
    <div class="alert alert-success alert-dismissible " role="alert">
        {{ session('success') }}
    </div>
@endif

@if (!empty(session('error')))
    <div class="alert alert-danger alert-dismissible " role="alert">
        {{ session('error') }}
    </div>
@endif

@if (!empty(session('warning')))
    <div class="alert alert-warning alert-dismissible " role="alert">
        {{ session('warning') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (!empty(session('info')))
    <div class="alert alert-info alert-dismissible " role="alert">
        {{ session('info') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (!empty(session('light')))
    <div class="alert alert-light alert-dismissible " role="alert">
        {{ session('light') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (!empty(session('dark')))
    <div class="alert alert-dark alert-dismissible     " role="alert">
        {{ session('dark') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
