<div class="col-xl m-2 p-4 text-white bg-primary shadow border-radius">
    <div class="row">
        <div class="col-xl">
            <img src="{{ $logo ?? asset('images/league2 (1).png') }}" class="img-fluid" alt="">
        </div>
        <div class="col-xl p-5">
            <h1>{{ $name ?? 'League 1' }}</h1>
            <h4>{{ $organization ?? 'FRMBB' }}</h4>
        </div>
    </div>
    <div class="">
        <table class="table text-white table-borderless">
            <thead>
                <tr>
                    <th>Start:</th>
                    <th>Category</th>
                    <th>Participants</th>
                    <th>Region</th>
                    <th>Prize</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $start ?? 'Today at 20.00' }}</td>
                    <td>{{ $category ?? 'U17' }}</td>
                    <td>{{ $participants ?? '14/16' }}</td>
                    <td>{{ $region ?? 'Errachidia' }}</td>
                    <td>{{ $prize ?? '2000MAD' }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table table-hover text-white">
            <thead>
                <tr>
                    <th></th>
                    <th>G</th>
                    <th>W</th>
                    <th>D</th>
                    <th>L</th>
                    <th>P</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams ?? [] as $team)
                    <tr>
                        <td><img src="{{ $team['logo'] ?? asset('images/FCB-logo.png') }}" width="50" class="img-fluid" alt=""></td>
                        <td>{{ $team['games'] ?? '10' }}</td>
                        <td>{{ $team['wins'] ?? '9' }}</td>
                        <td>{{ $team['draws'] ?? '1' }}</td>
                        <td>{{ $team['losses'] ?? '0' }}</td>
                        <td>{{ $team['points'] ?? '28' }}</td>
                    </tr>
                @endforeach
                
                @if(empty($teams))
                <!-- Default teams if none provided -->
                @for($i = 0; $i < 4; $i++)
                <tr>
                    <td><img src="{{ asset('assets/images/FCB-logo.png') }}" width="50" class="img-fluid" alt=""></td>
                    <td>10</td>
                    <td>9</td>
                    <td>1</td>
                    <td>0</td>
                    <td>28</td>
                </tr>
                @endfor
                @endif
            </tbody>
        </table>
    </div>       
</div>