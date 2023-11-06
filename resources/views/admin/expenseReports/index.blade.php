@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col">
        <h3 class="page-title">{{ trans('cruds.expenseReport.reports.title') }} - {{ trans('messages.months.' . Request::get('m', date('m'))) }} {{ Request::get('y', date('Y')) }}</h3>
        <form method="get">
            <div class="row">
				<div class="col-3 form-group">
					<label class="control-label" for="y">{{ trans('global.year') }}</label>
					<select name="y" id="y" class="form-control">
						@for ($year = 2026; $year >= 2023; $year--)
							<option value="{{ $year }}" @if($year === old('y', Request::get('y', date('Y'))) || $year == date('Y')) selected @endif>
								{{ $year }}
							</option>
						@endfor
					</select>
				</div>

                <div class="col-3 form-group">
                    <label class="control-label" for="m">{{ trans('global.month') }}</label>
                    <select name="m" for="m" class="form-control">
                        @foreach(range(1, 12) as $month)
                            <option value="{{ $month }}" @if($month === (int)Request::get('m', date('m'))) selected @endif>
                                {{ trans('messages.months.' . $month) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-4">
                    <label class="control-label">&nbsp;</label><br>
                    <button class="btn btn-primary" type="submit">{{ trans('global.filterDate') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Ingresos por estudiantes
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tr>
                <th>{{ trans('cruds.pago.fields.concepto') }}</th>
                <th>{{ trans('cruds.pago.fields.monto') }}</th>
            </tr>
            @foreach($pagos as $pago)
                <tr>
                    <td>{{ $pago->concepto }}</td>
                    <td>{{ number_format($pago->total, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <th>Total Ingresos Estudiantes</th>
                <td>{{ number_format($pagosTotal, 2) }}</td>
            </tr>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('cruds.expenseReport.reports.incomeReport') }}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ trans('cruds.expenseReport.reports.income') }}</th>
                        <td>{{ number_format($incomesTotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.expenseReport.reports.expense') }}</th>
                        <td>{{ number_format($expensesTotal, 2) }}</td>
                    </tr>
                    <tr>
                        <th>{{ trans('cruds.expenseReport.reports.profit') }}</th>
                        <td>{{ number_format($profit, 2) }}</td>
                    </tr>
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ trans('cruds.expenseReport.reports.incomeByCategory') }}</th>
                        <th>{{ number_format($incomesTotal, 2) }}</th>
                    </tr>
                    @foreach($incomesSummary as $inc)
                        <tr>
                            <th>{{ $inc['name'] }}</th>
                            <td>{{ number_format($inc['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            <div class="col">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>{{ trans('cruds.expenseReport.reports.expenseByCategory') }}</th>
                        <th>{{ number_format($expensesTotal, 2) }}</th>
                    </tr>
                    @foreach($expensesSummary as $inc)
                        <tr>
                            <th>{{ $inc['name'] }}</th>
                            <td>{{ number_format($inc['amount'], 2) }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Resto de tu vista... -->

@endsection

@section('scripts')
@parent
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.js"></script>
<script>
    $('.date').datepicker({
        autoclose: true,
        dateFormat: "{{ config('panel.date_format_js') }}"
    })
</script>
@stop
