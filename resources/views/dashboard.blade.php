<!DOCTYPE html>
<html>
<head>
    <title>KenGen Gate Management Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h1 class="mb-4">KenGen Gate Management Dashboard</h1>

    <div class="row">

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Visitors Inside</h5>
                    <h2>{{ $visitorsInside }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Visitors Out</h5>
                    <h2>{{ $visitorsOutside }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Today's Visitors</h5>
                    <h2>{{ $todayVisitors }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow">
                <div class="card-body text-center">
                    <h5>Total Visitors</h5>
                    <h2>{{ $totalVisitors }}</h2>
                </div>
            </div>
        </div>

    </div>

</div>

</body>
</html>
