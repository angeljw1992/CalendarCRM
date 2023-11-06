<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Pago; // Importa el modelo Pago
use Carbon\Carbon;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\DB; // Importa la clase DB

class ExpenseReportController extends Controller
{
    public function index()
    {
        $selectedYear = request()->query('y', Carbon::now()->year);
        $selectedMonth = request()->query('m', Carbon::now()->month);

        $from = Carbon::parse(sprintf('%s-%s-01', $selectedYear, $selectedMonth));
        $to = clone $from;
        $to->day = $to->daysInMonth;

        $expenses = Expense::with('expense_category')
            ->whereBetween('entry_date', [$from, $to]);

        $incomes = Income::with('income_category')
            ->whereBetween('entry_date', [$from, $to]);

        // Filtra los pagos por fecha y los agrupa por concepto
        $pagos = Pago::select('concepto', DB::raw('sum(monto) as total'))
            ->whereBetween('fecha', [$from, $to])
            ->groupBy('concepto')
            ->get();

        $pagosTotal = $pagos->sum('total');

        $expensesTotal = $expenses->sum('amount');
        // Aquí se suma pagosTotal a incomesTotal
        $incomesTotal = $incomes->sum('amount') + $pagosTotal;
 // Suma los ingresos de los pagos antes de restar gastos

    $groupedExpenses = $expenses->whereNotNull('expense_category_id')->orderBy('amount', 'desc')->get()->groupBy('expense_category_id');
    $groupedIncomes = $incomes->whereNotNull('income_category_id')->orderBy('amount', 'desc')->get()->groupBy('income_category_id');
	$totalIncome = $incomes->sum('amount') + $pagosTotal;
    $profit = $totalIncome - $expensesTotal;

    $expensesSummary = [];
    foreach ($groupedExpenses as $exp) {
        foreach ($exp as $line) {
            if (!isset($expensesSummary[$line->expense_category->name])) {
                $expensesSummary[$line->expense_category->name] = [
                    'name' => $line->expense_category->name,
                    'amount' => 0,
                ];
            }
            $expensesSummary[$line->expense_category->name]['amount'] += $line->amount;
        }
    }

    $incomesSummary = [];
    foreach ($groupedIncomes as $inc) {
        foreach ($inc as $line) {
            if (!isset($incomesSummary[$line->income_category->name])) {
                $incomesSummary[$line->income_category->name] = [
                    'name' => $line->income_category->name,
                    'amount' => 0,
                ];
            }
            $incomesSummary[$line->income_category->name]['amount'] += $line->amount;
        }
    }



return view('admin.expenseReports.index', compact(
    'expensesSummary',
    'incomesSummary',
    'expensesTotal',
    'incomesTotal',
    'profit',
    'pagos',
    'pagosTotal',
    'selectedYear',
    'selectedMonth',
    'totalIncome' // Asegúrate de pasar la variable a tu vista
));

}

}
