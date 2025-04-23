<div class="col-xl-12 my-2 p-4 bg-primary text-white shadow border-radius">
    <div class="row justify-content-center align-items-center">
        <div class="col-xl-2 my-2">
            <img src="{{ $image ?? asset('images/Tournament.png') }}" width="100" class="img-fluid" alt="">
        </div>
        <div class="col-xl-3 my-2">
            <h4 class="mb-2 h4">{{ $name ?? 'Tournament Name' }}</h4>
            @if(isset($status))
            <div class="">
                <span class="badge" style="background-color: #FF8000;">{{ $status }}</span>
            </div>
            @endif
        </div>
        <div class="col-xl my-2">
            <h6 class="h6">Start:</h6>
            <p style="font-size: 12px;">{{ $start ?? 'Today at 20:00' }}</p>
        </div>
        <div class="col-xl my-2">
            <h6 class="h6">Category:</h6>
            <p style="font-size: 12px;">{{ $category ?? 'U17' }}</p>
        </div>
        <div class="col-xl my-2">
            <h6 class="h6">Participants:</h6>
            <p style="font-size: 12px;">{{ $participants ?? '14/16' }}</p>
        </div>
        <div class="col-xl my-2">
            <h6 class="h6">Region:</h6>
            <p style="font-size: 12px;">{{ $region ?? 'Errachidia' }}</p>
        </div>
        <div class="col-xl my-2">
            <h6 class="h6">Prize:</h6>
            <p style="font-size: 12px;">{{ $prize ?? '2000MAD' }}</p>
        </div>
    </div>
</div>