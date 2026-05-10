<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PeopleDesk | Access Denied</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/approval-status.css') }}">
</head>
<body class="is-rejected is-status-page">
    <div class="approval-card">
        <div class="icon-circle">
            <i class="bi bi-x-circle-fill"></i>
        </div>
        <h2>Access Denied</h2>
        <p>Your account request has been rejected by the Administrator. If you believe this is a mistake, please contact support.</p>
        
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-logout w-100">
                <i class="bi bi-box-arrow-right me-2"></i> Sign Out
            </button>
        </form>
    </div>
</body>
</html>
