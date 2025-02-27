<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-light border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0 d-flex align-items-center">
                            <i class="bi bi-{{ $icon ?? 'grid' }} me-2 text-primary"></i>
                            {{ $title }}
                        </h3>
                        <p class="text-muted mt-2 mb-0">{{ $description ?? '' }}</p>
                    </div>
                    <div class="d-flex align-items-center">
                        @if(isset($slot) && trim($slot) !== '')  
                        {{ $slot }}
                        @endif
                    </div>
                </div>
            </div>
            <div class="progress" style="height: 4px;">
                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>