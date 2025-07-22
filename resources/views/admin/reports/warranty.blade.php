<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warranty Coverage Report - {{ $dateRange['label'] }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #2c3e50;
            background: #ffffff;
        }

        .header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .header .subtitle {
            font-size: 18px;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .header .period {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 16px;
            border-radius: 20px;
            display: inline-block;
            font-size: 14px;
            font-weight: 500;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 30px;
        }

        .section {
            margin-bottom: 40px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .section-header {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 20px 30px;
            font-size: 20px;
            font-weight: 600;
            border-bottom: 3px solid #a71e2a;
        }

        .section-content {
            padding: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            border: 1px solid #dee2e6;
            transition: transform 0.2s;
        }

        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stat-value {
            font-size: 28px;
            font-weight: 700;
            color: #dc3545;
            margin-bottom: 8px;
        }

        .stat-label {
            font-size: 12px;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .table th,
        .table td {
            padding: 15px 12px;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .table th {
            background: linear-gradient(135deg, #495057 0%, #343a40 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 11px;
            letter-spacing: 0.5px;
        }

        .table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }

        .table tbody tr:hover {
            background: #e3f2fd;
        }

        .warranty-status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-active { background: #d4edda; color: #155724; }
        .status-expired { background: #f8d7da; color: #721c24; }
        .status-voided { background: #fff3cd; color: #856404; }

        .days-left {
            font-weight: 600;
            color: #28a745;
        }

        .days-expired {
            font-weight: 600;
            color: #dc3545;
        }

        .chart-container {
            background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
            color: white;
            padding: 40px;
            border-radius: 10px;
            text-align: center;
            margin: 20px 0;
            font-size: 16px;
        }

        .highlight {
            background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
            color: #333;
            padding: 2px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        .no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            padding: 40px;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .footer {
            margin-top: 50px;
            padding: 25px;
            text-align: center;
            background: #f8f9fa;
            border-radius: 8px;
            color: #666;
            font-size: 11px;
        }

        .summary-insight {
            background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);
            border: 1px solid #ffeaa7;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
        }

        .summary-insight h4 {
            color: #856404;
            margin-bottom: 10px;
            font-size: 16px;
        }

        .summary-insight p {
            color: #856404;
            margin: 0;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🛡️ Warranty Coverage Report</h1>
        <div class="subtitle">Comprehensive Warranty Tracking & Expiration Analysis</div>
        <div class="period">{{ $data['period'] }}</div>
    </div>

    <div class="container">
        <!-- Summary Statistics -->
        <div class="section">
            <div class="section-header">📊 Warranty Summary Statistics</div>
            <div class="section-content">
                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($data['summary']->total_sold) }}</div>
                        <div class="stat-label">Total Products Sold</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($data['summary']->under_warranty) }}</div>
                        <div class="stat-label">Under Warranty</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($data['summary']->expired_warranty) }}</div>
                        <div class="stat-label">Warranty Expired</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ number_format($data['summary']->voided_warranty) }}</div>
                        <div class="stat-label">Warranty Voided</div>
                    </div>
                </div>

                @if($data['summary']->total_sold > 0)
                    @php
                        $coveragePercentage = round(($data['summary']->under_warranty / $data['summary']->total_sold) * 100, 1);
                        $expiredPercentage = round(($data['summary']->expired_warranty / $data['summary']->total_sold) * 100, 1);
                    @endphp
                    <div class="summary-insight">
                        <h4>🔍 Coverage Analysis</h4>
                        <p>
                            <strong>{{ $coveragePercentage }}%</strong> of sold products are currently under warranty coverage.
                            <strong>{{ $expiredPercentage }}%</strong> have expired warranties and may need attention for renewal or service opportunities.
                        </p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Detailed Warranty Information -->
        <div class="section">
            <div class="section-header">📋 Detailed Warranty Coverage</div>
            <div class="section-content">
                @if($data['warranty_details']->count() > 0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Model Name</th>
                                <th>Serial Number</th>
                                <th>Owner</th>
                                <th>Days Left Till Warranty Expiration</th>
                                <th>Warranty End Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data['warranty_details'] as $item)
                                <tr>
                                    <td><strong>{{ $item['model_name'] }}</strong></td>
                                    <td>{{ $item['serial_number'] }}</td>
                                    <td>{{ $item['owner_name'] }}</td>
                                    <td>
                                        @if($item['status'] === 'Active')
                                            <span class="days-left">{{ $item['days_left'] }}</span>
                                        @else
                                            <span class="days-expired">{{ $item['days_left'] }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $item['warranty_end'] }}</td>
                                    <td>
                                        <span class="warranty-status status-{{ strtolower($item['status']) }}">
                                            {{ $item['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="no-data">
                        <p>No warranty data available for the selected period.</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Key Insights -->
        <div class="section">
            <div class="section-header">💡 Key Insights & Recommendations</div>
            <div class="section-content">
                @php
                    $activeCount = $data['warranty_details']->where('status', 'Active')->count();
                    $expiredCount = $data['warranty_details']->where('status', 'Expired')->count();
                    $voidedCount = $data['warranty_details']->where('status', 'Voided')->count();

                    // Find products with less than 30 days remaining
                    $expiringSoon = $data['warranty_details']->filter(function($item) {
                        if ($item['status'] === 'Active' && strpos($item['days_left'], 'days') !== false) {
                            $days = (int) filter_var($item['days_left'], FILTER_SANITIZE_NUMBER_INT);
                            return $days <= 30;
                        }
                        return false;
                    })->count();
                @endphp

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-value">{{ $activeCount }}</div>
                        <div class="stat-label">Active Warranties</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $expiringSoon }}</div>
                        <div class="stat-label">Expiring Soon (≤30 days)</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $expiredCount }}</div>
                        <div class="stat-label">Requires Attention</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">{{ $voidedCount }}</div>
                        <div class="stat-label">Voided Cases</div>
                    </div>
                </div>

                <div class="chart-container">
                    <h3>🎯 Strategic Recommendations</h3>
                    <p>
                        @if($expiringSoon > 0)
                            • <span class="highlight">{{ $expiringSoon }}</span> warranties expiring soon - Contact customers for renewal opportunities<br>
                        @endif
                        @if($expiredCount > 0)
                            • <span class="highlight">{{ $expiredCount }}</span> expired warranties - Follow up for service packages or new product sales<br>
                        @endif
                        @if($activeCount > 0)
                            • <span class="highlight">{{ $activeCount }}</span> active warranties - Maintain customer satisfaction and prepare for future renewals<br>
                        @endif
                        • Monitor warranty expiration dates monthly for proactive customer engagement<br>
                        • Implement automated notification system for warranty renewals
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>
            Warranty Coverage Report generated on {{ date('F j, Y \a\t g:i A') }} by SoosanEgypt Warranty Management System<br>
            This report contains confidential business information and should be handled accordingly.
        </p>
    </div>
</body>
</html>
