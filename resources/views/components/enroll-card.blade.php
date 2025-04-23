<div class="col-xl-9 my-2 enroll-card p-2 text-center shadow">
    <div class="row">
        <div class="col-xl-2 d-flex align-items-center justify-content-center">
            <img src="{{ $logo ?? asset('images/ONFIVE.png') }}" width="100px" alt="">
        </div>
        <div class="col-xl-2 d-flex align-items-center justify-content-center">
            <a href="{{ $primary_link ?? '#' }}" class="action-btn">{{ $primary_text ?? 'STAFF' }}</a>
        </div>
        <div class="col-xl-6 d-flex align-items-center justify-content-center">
            <p>{{ $description ?? 'Host matches, save their data and much more ...' }}</p>
        </div>
        <div class="col-xl-2 d-flex align-items-center justify-content-center">
            <a href="{{ $secondary_link ?? '#' }}" class="action-btn">{{ $secondary_text ?? 'Enroll' }}</a>
        </div>
    </div>
</div>