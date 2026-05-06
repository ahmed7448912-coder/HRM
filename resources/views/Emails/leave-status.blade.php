<p>Hello {{ $leave->employee->name }}</p>

<p>Your leave request has been updated.</p>

<p><strong>Status:</strong> {{ $leave->status }}</p>

<p>From: {{ $leave->from_date }}</p>
<p>To: {{ $leave->to_date }}</p>