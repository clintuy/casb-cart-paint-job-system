@extends('layouts.app')

@section('content')
<div class="text-center py-5">
    <h1 class="font-weight-bold text-uppercase">Paint Jobs</h1>
</div>

<div class="row px-3">
    <div class="col-md-8">
        <div class="paint-job-progress pb-3">
            <h4 class="font-weight-bold px-3">Paint Jobs in Progress</h4>

            <table class="table table-bordered">
                <thead class="bg-secondary-color">
                    <tr>
                        <th>Plate No.</th>
                        <th>Current Color</th>
                        <th>Target Color</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($progress_jobs as $progress_job)
                        <tr>
                            <td>{{ $progress_job->plate_no }}</td>
                            <td>{{ $progress_job->current_color }}</td>
                            <td>{{ $progress_job->target_color }}</td>
                            <td>
                                <button type="button" data-id="{{ $progress_job->id }}" class="btn-text btn_complete">Mark As Completed</button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No in progress found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="paint-job-queue pt-3 pb-3">
            <h4 class="font-weight-bold px-3">Paint Queue</h4>

            <table class="table table-bordered">
                <thead class="bg-secondary-color">
                    <tr>
                        <th>Plate No.</th>
                        <th>Current Color</th>
                        <th>Target Color</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!$queued_paint_jobs->isEmpty())
                        @foreach($queued_paint_jobs as $queued_paint_job)
                            <tr>
                                <td>{{ $queued_paint_job->plate_no }}</td>
                                <td>{{ $queued_paint_job->current_color }}</td>
                                <td>{{ $queued_paint_job->target_color }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No queue found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 rounded-0">
            <div class="card-header text-white text-uppercase font-weight-bold bg-primary-color rounded-0">
                Shop Performance
            </div>
            <div class="card-body bg-secondary-color rounded-0">
                <div class="row">
                    <div class="col-6">
                        <h6 class="font-weight-bold">Total Cars Painted:</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="font-weight-bold text-right">{{ $total_count_completed }}</h6>
                    </div>
                </div>
                <h6 class="font-weight-bold">Break Down:</h6>
                <div class="row">
                    <div class="col-6">
                        <h6 class="font-weight-bold">Blue</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="font-weight-bold text-right">{{ $blue_count_completed }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6 class="font-weight-bold">Red</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="font-weight-bold text-right">{{ $red_count_completed }}</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h6 class="font-weight-bold">Green</h6>
                    </div>
                    <div class="col-6">
                        <h6 class="font-weight-bold text-right">{{ $green_count_completed }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).on("click", ".btn_complete", function() {
        const id = $(this).attr("data-id");

        $.ajax({
            type: "PUT",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('paint.update') }}",
            data: {
                id:id
            },
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successfull',
                    text: data.message,
                    timer: 1000
                }).then(function() { 
                    location.reload();
                });
            },
            error: function(data) {

               
            }
        });
    });
</script>

       
@endsection
