<div class="col-lg-6">
    <div class="row">
        <div class="col-lg-4 position-relative">
            <div class="form-check toogle-day-of-the-week">
                <label>
                    <input class="form-check-input" data-day-of-week="{{$dayOfWeek}}" name="enable{{$dayOfWeek}}" type="checkbox"
                           {{  employeeWorksOnDay($employee, $dayOfWeek) ? 'checked' : '' }} value="true">
                    <span class="font-weight-bold">{{ days()[$dayOfWeek] }}</span>
                </label>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="entrada{{$dayOfWeek}}">Entrada:</label>
                <input class="form-control text-right" id="entrada{{$dayOfWeek}}" name="entrada{{$dayOfWeek}}" type="text" {{ !employeeWorksOnDay($employee, $dayOfWeek) ? 'disabled' : '' }}
                       value="{{ employeeWorksOnDay($employee, $dayOfWeek) ? employeeGetStartTime($employee, $dayOfWeek) : '' }}">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label for="saida{{$dayOfWeek}}">Saída:</label>
                <input class="form-control text-right" id="saida{{$dayOfWeek}}" name="saida{{$dayOfWeek}}" type="text" {{ !employeeWorksOnDay($employee, $dayOfWeek) ? 'disabled' : '' }}
                       value="{{ employeeWorksOnDay($employee, $dayOfWeek) ? employeeGetEndTime($employee, $dayOfWeek) : '' }}">
            </div>
        </div>
    </div>
</div>
