<div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between mb-5 mt-5" role="alert">
            <span>
                {{ session('success') }}
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between mb-5 mt-5" role="alert">
            <span>
                {{ session('error') }}
            </span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
