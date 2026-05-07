<h3>Salary Details</h3>

<p>Name: {{ $payroll->employee->name }}</p>
<p>Month: {{ date('F Y', strtotime($payroll->month)) }}</p>

<hr>

<p>Basic Salary: {{ $payroll->basic_salary }}</p>
<p>Absents: {{ $payroll->absents }}</p>
<p>Deductions: {{ $payroll->deductions }}</p>

<h4>Net Salary: {{ $payroll->net_salary }}</h4>