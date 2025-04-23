<div class="col-xl-12 bg-primary py-3 my-2 border-radius shadow">
    <div class="d-flex justify-content-center align-items-center">
        <div class="text-center">
            <img src="{{ $team1_logo ?? asset('images/Real-Madrid-logo.png') }}" class="img-fluid" width="60" alt="">
            <h6>{{ $team1_name ?? 'team 1' }}</h6>
        </div>
        <H4 class="mx-4">vs</H4>
        <div class="text-center">
           <img src="{{ $team2_logo ?? asset('images/Real-Madrid-logo.png') }}" class="img-fluid" width="60" alt=""> 
           <h6>{{ $team2_name ?? 'team 2' }}</h6>
        </div>
    </div>
    <div class="text-center" style="font-size: 10px;">
        <p class="my-0"><b>{{ $date ?? 'Saturday 8 June' }}</b></p>
        <p class="my-0">{{ $venue ?? 'Complexe Elwaha' }}</p>
        <p class="my-0">{{ $time ?? '20:00' }}</p>
    </div>
</div>