@extends('layouts.app')

@section('content')
<div class="text-center pt-5">
    <h1 class="font-weight-bold text-uppercase">New Paint Job</h1>

    <div class="d-flex flex-column d-sm-flex flex-sm-row justify-content-center align-items-center my-5 ">
        <div class="current-color">
            <img id="car_current_color" src="/storage/img/DefaultCarColor.png" alt="Current Car Color">
        </div>
        
        <img class="p-5" src="/storage/img/Arrow.png" alt="Arrow">
        <img id="car_target_color" src="/storage/img/DefaultCarColor.png" alt="New Car Color">
    </div>
</div>

<div class="car-details px-4">
    <h3 class="font-weight-bold">Car Details</h3>

    <div class="form-group row">
        <label for="plate_no" class="col-sm-2 col-form-label">Plate No.</label>
        <div class="col-md-3">
            <input id="plate_no" name="plate_no" type="text" class="form-control"  placeholder="Plate No">

            <span id="err_plate_no" class="error-feedback" role="alert">
                <strong></strong>
            </span>
        </div>

        
    </div>

    <div class="form-group row">
        <label for="current_color" class="col-sm-2 col-form-label">Current Color</label>
        <div class="col-md-3">
            <select id="current_color" name="current_color" class="form-control">
                <option value="" disabled selected>Select your color</option>
                <option value="Red">Red</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
            </select>

            <span id="err_current_color" class="error-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>

    <div class="form-group row">
        <label for="target_color" class="col-sm-2 col-form-label">Target Color</label>
        <div class="col-md-3">
            <select id="target_color" name="target_color" class="form-control">
                <option value="" disabled selected>Select your color</option>
                <option value="Red">Red</option>
                <option value="Green">Green</option>
                <option value="Blue">Blue</option>
            </select>

            <span id="err_target_color" class="error-feedback" role="alert">
                <strong></strong>
            </span>
        </div>
    </div>
    <div class="mb-4">
        <button id="button_submit" type="button" class="btn btn-custom-primary rounded-0 px-5">Submit</button>
    </div>
    
</div>

<script>
    var plateNo = $('#plate_no').val();
    var currentColor = $('#current_color').val();
    var targetColor = $('#target_color').val();

    var currentBgColor = document.querySelector('#car_current_color');
    var targetBgColor = document.querySelector('#car_target_color');

    $(document).on("click", "#button_submit", function() {

        plateNo = $('#plate_no').val();
        currentColor = $('#current_color').val();
        targetColor = $('#target_color').val();
       
        $.ajax({
            type: "POST",
            headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "{{ route('new-paint.store') }}",
            data: {
                plate_no:plateNo,
                current_color:currentColor,
                target_color:targetColor
            },
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Successfull',
                    text: data.message,
                    timer: 1000
                });
                resetForms();
            },
            error: function(data) {

                var err = $.parseJSON(data.responseText);

                $('#err_plate_no').empty();
                $('#err_current_color').empty();
                $('#err_target_color').empty();

                if (data.status == 422) {
                    if(err.errors.plate_no !== undefined) {
                        $('#err_plate_no').append(
                            `<strong>${err.errors.plate_no}</strong>`
                        );
                    }

                    if(err.errors.current_color !== undefined) {
                        $('#err_current_color').append(
                            `<strong>${err.errors.current_color}</strong>`
                        );
                    }

                    if(err.errors.target_color !== undefined) {
                        $('#err_target_color').append(
                            `<strong>${err.errors.target_color}</strong>`
                        );
                    }  
                }
            }
        });
    });

    $(document).on("change", "#current_color", function() {
        if($(this).val() == "Red") {
            currentBgColor.style.filter = "brightness(50%) sepia(100%) hue-rotate(290deg)";
        } else if($(this).val() == "Green") {
            currentBgColor.style.filter = "brightness(50%) sepia(100%) hue-rotate(50deg)";
        } else if($(this).val() == "Blue") {
            currentBgColor.style.filter = "brightness(50%) sepia(100%) hue-rotate(170deg)";
        }
    });

    $(document).on("change", "#target_color", function() {
        if($(this).val() == "Red") {
            targetBgColor.style.filter = "brightness(50%) sepia(100%) hue-rotate(290deg)";
        } else if($(this).val() == "Green") {
            targetBgColor.style.filter = "brightness(50%) sepia(100%) hue-rotate(50deg)";
        } else if($(this).val() == "Blue") {
            targetBgColor.style.filter = "brightness(50%) sepia(100%) hue-rotate(170deg)";
        }
    });

    function resetForms() {
        currentBgColor.style.filter = "brightness(100%) sepia(0%) hue-rotate(0deg)";
        targetBgColor.style.filter = "brightness(100%) sepia(0%) hue-rotate(0deg)";

        $('#plate_no').val("");
        $('#current_color').val("");
        $('#target_color').val("");

        $('#err_plate_no').empty();
        $('#err_current_color').empty();
        $('#err_target_color').empty();
    }
</script>
@endsection

