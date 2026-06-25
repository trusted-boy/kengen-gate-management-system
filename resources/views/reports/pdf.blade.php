<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>KenGen Gate Management Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            margin: 20px;
        }
        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 10px;
        }
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 12px;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr 1fr;
            gap: 15px;
            margin-bottom: 30px;
        }
        .stat-box {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .stat-label {
            font-size: 12px;
            color: #666;
            font-weight: bold;
            text-transform: uppercase;
        }
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            color: #667eea;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11px;
        }
        table th {
            background-color: #667eea;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .section-title {
            background-color: #e9ecef;
            padding: 10px;
            font-weight: bold;
            margin-top: 20px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <h1>KenGen Gate Management System</h1>
    <p class="subtitle">Comprehensive Report | Generated on {{ now()->format('M d, Y H:i') }}</p>

    <div class="stats-grid" style="grid-template-columns: 1fr 1fr 1fr;">
        <div class="stat-box">
            <div class="stat-label">Visitors Inside</div>
            <div class="stat-value">{{ $visitorsInside }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Interns Present</div>
            <div class="stat-value">{{ $internsPresent }}</div>
        </div>
        <div class="stat-box">
            <div class="stat-label">Active Vehicles</div>
            <div class="stat-value">{{ $activeVehicles }}</div>
        </div>
    </div>

    <div class="section-title">System Summary</div>
    <table>
        <tr>
            <th style="width: 50%;">Metric</th>
            <th style="width: 50%; text-align: right;">Count</th>
        </tr>
        <tr>
            <td>Total Visitors</td>
            <td style="text-align: right;">{{ $totalVisitors }}</td>
        </tr>
        <tr>
            <td>Visitors Outside</td>
            <td style="text-align: right;">{{ $visitorsOutside }}</td>
        </tr>
        <tr>
            <td>Today's Check-ins</td>
            <td style="text-align: right;">{{ $todayVisitors }}</td>
        </tr>
        <tr>
            <td>Total Vehicles</td>
            <td style="text-align: right;">{{ $totalVehicles }}</td>
        </tr>
        <tr>
            <td>Total Contractors</td>
            <td style="text-align: right;">{{ $totalContractors }}</td>
        </tr>
        <tr>
            <td>Total Equipment Movements</td>
            <td style="text-align: right;">{{ $totalMovements }}</td>
        </tr>
        <tr>
            <td>Total Interns</td>
            <td style="text-align: right;">{{ $totalInterns }}</td>
        </tr>
        <tr>
            <td>Today's Intern Check-ins</td>
            <td style="text-align: right;">{{ $todayInterns }}</td>
        </tr>
    </table>

    @if($visitors->count() > 0)
        <div class="section-title">Recent Visitors</div>
        <table>
            <tr>
                <th>Name</th>
                <th>ID Number</th>
                <th>Host</th>
                <th>Vehicle</th>
                <th>Status</th>
                <th>Check In</th>
            </tr>
            @foreach($visitors as $visitor)
                <tr>
                    <td>{{ $visitor->full_name }}</td>
                    <td>{{ $visitor->id_number }}</td>
                    <td>{{ $visitor->host_name }}</td>
                    <td>{{ $visitor->vehicle_registration ?: '-' }}</td>
                    <td>{{ $visitor->status }}</td>
                    <td>{{ $visitor->check_in_time->format('M d, H:i') }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if($interns->count() > 0)
        <div class="section-title">Recent Interns & Attachees</div>
        <table>
            <tr>
                <th>Name</th>
                <th>ID Number</th>
                <th>Institution</th>
                <th>Department</th>
                <th>Status</th>
                <th>Check In</th>
            </tr>
            @foreach($interns as $intern)
                <tr>
                    <td>{{ $intern->full_name }}</td>
                    <td>{{ $intern->id_number }}</td>
                    <td>{{ $intern->institution }}</td>
                    <td>{{ $intern->department }}</td>
                    <td>{{ $intern->status }}</td>
                    <td>{{ $intern->check_in_time->format('M d, H:i') }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if($vehicles->count() > 0)
        <div class="section-title">Recent Vehicles</div>
        <table>
            <tr>
                <th>Registration Number</th>
                <th>Type</th>
                <th>Owner</th>
                <th>Status</th>
            </tr>
            @foreach($vehicles as $vehicle)
                <tr>
                    <td>{{ $vehicle->registration_number }}</td>
                    <td>{{ $vehicle->vehicle_type }}</td>
                    <td>{{ $vehicle->owner_name }}</td>
                    <td>{{ $vehicle->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if($contractors->count() > 0)
        <div class="section-title">Recent Contractors</div>
        <table>
            <tr>
                <th>Company Name</th>
                <th>Contact Person</th>
                <th>License Number</th>
                <th>Status</th>
            </tr>
            @foreach($contractors as $contractor)
                <tr>
                    <td>{{ $contractor->company_name }}</td>
                    <td>{{ $contractor->contact_person }}</td>
                    <td>{{ $contractor->license_number }}</td>
                    <td>{{ $contractor->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    @if($equipments->count() > 0)
        <div class="section-title">Recent Equipment Movements</div>
        <table>
            <tr>
                <th>Equipment Name</th>
                <th>Type</th>
                <th>Owner</th>
                <th>Recipient</th>
                <th>Status</th>
            </tr>
            @foreach($equipments as $equipment)
                <tr>
                    <td>{{ $equipment->equipment_name }}</td>
                    <td>{{ $equipment->equipment_type }}</td>
                    <td>{{ $equipment->owner_name }}</td>
                    <td>{{ $equipment->recipient_name }}</td>
                    <td>{{ $equipment->status }}</td>
                </tr>
            @endforeach
        </table>
    @endif

    <div class="footer">
        <p>This is an automated report from the KenGen Gate Management System</p>
        <p>For questions or support, please contact the administration</p>
    </div>
</body>
</html>
