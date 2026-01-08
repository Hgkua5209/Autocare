<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Dashboard | AutoCare Compass</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #667eea;
            --primary-dark: #5a67d8;
            --secondary: #764ba2;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --info: #3b82f6;
            --light: #f8fafc;
            --dark: #1e293b;
            --gray: #64748b;
            --gray-light: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        body {
            background: #f1f5f9;
            color: var(--dark);
            min-height: 100vh;
        }

        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            width: 260px;
            background: white;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            z-index: 100;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        .logo {
            padding: 25px 20px;
            border-bottom: 1px solid var(--gray-light);
            text-align: center;
        }

        .logo h1 {
            color: var(--primary);
            font-size: 1.5rem;
            font-weight: 700;
        }

        .logo span {
            color: var(--secondary);
        }

        .nav-menu {
            padding: 20px 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            color: var(--gray);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 4px solid transparent;
        }

        .nav-item:hover, .nav-item.active {
            background: #f1f5ff;
            color: var(--primary);
            border-left-color: var(--primary);
        }

        .nav-item i {
            width: 24px;
            margin-right: 12px;
            font-size: 1.1rem;
        }

        .user-profile {
            padding: 20px;
            border-top: 1px solid var(--gray-light);
            display: flex;
            align-items: center;
            margin-top: auto;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            margin-right: 12px;
        }

        .user-info h4 {
            font-size: 0.95rem;
            margin-bottom: 3px;
        }

        .user-info p {
            font-size: 0.8rem;
            color: var(--gray);
        }

        /* Main Content */
        .main-content {
            flex: 1;
            margin-left: 260px;
            padding: 20px;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0 25px;
        }

        .page-title h2 {
            font-size: 1.8rem;
            color: var(--dark);
        }

        .page-title p {
            color: var(--gray);
            font-size: 0.95rem;
            margin-top: 5px;
        }

        .date-display {
            background: white;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            font-weight: 500;
            color: var(--dark);
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: transform 0.3s;
            border-top: 5px solid var(--primary);
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card.warning {
            border-top-color: var(--warning);
        }

        .stat-card.danger {
            border-top-color: var(--danger);
        }

        .stat-card.success {
            border-top-color: var(--success);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-title {
            font-size: 0.9rem;
            color: var(--gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            color: white;
        }

        .stat-icon.primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
        }

        .stat-icon.warning {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
        }

        .stat-icon.danger {
            background: linear-gradient(135deg, #ef4444, #f87171);
        }

        .stat-icon.success {
            background: linear-gradient(135deg, #10b981, #34d399);
        }

        .stat-value {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 5px;
        }

        .stat-change {
            font-size: 0.85rem;
            color: var(--gray);
        }

        .stat-change.positive {
            color: var(--success);
        }

        .stat-change.negative {
            color: var(--danger);
        }

        /* Charts Section */
        .charts-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        @media (max-width: 1200px) {
            .charts-section {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }

        .chart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .chart-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        .chart-subtitle {
            font-size: 0.9rem;
            color: var(--gray);
            margin-top: 3px;
        }

        /* Autoimmune Matches */
        .matches-section {
            margin-bottom: 30px;
        }

        .matches-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .match-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            border-left: 5px solid var(--primary);
        }

        .match-card.autoimmune {
            border-left-color: #f5576c;
        }

        .match-card.immune-mediated {
            border-left-color: #4facfe;
        }

        .match-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .match-disease {
            font-weight: 600;
            font-size: 1.1rem;
            color: var(--dark);
        }

        .match-type {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .match-type.autoimmune {
            background: #ffeaea;
            color: #f5576c;
        }

        .match-type.immune {
            background: #e8f4ff;
            color: #4facfe;
        }

        .match-percentage {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .progress-bar {
            height: 10px;
            background: var(--gray-light);
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 15px;
        }

        .progress-fill {
            height: 100%;
            border-radius: 5px;
        }

        .progress-fill.high {
            background: linear-gradient(90deg, #f5576c, #f093fb);
        }

        .progress-fill.moderate {
            background: linear-gradient(90deg, #f59e0b, #fbbf24);
        }

        .progress-fill.low {
            background: linear-gradient(90deg, #10b981, #34d399);
        }

        .match-footer {
            display: flex;
            justify-content: space-between;
            font-size: 0.85rem;
            color: var(--gray);
        }

        /* Patient Info Card */
        .patient-info-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .patient-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .patient-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: 600;
            margin-right: 20px;
        }

        .patient-details h3 {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .patient-details p {
            color: var(--gray);
            margin-bottom: 3px;
        }

        .patient-meta {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .meta-item {
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
        }

        .meta-label {
            font-size: 0.85rem;
            color: var(--gray);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .meta-value {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--dark);
        }

        /* Recommendations */
        .recommendations-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 30px;
        }

        .rec-list {
            list-style: none;
        }

        .rec-item {
            padding: 15px;
            border-left: 4px solid var(--primary);
            background: #f8fafc;
            margin-bottom: 12px;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }

        .rec-item i {
            color: var(--primary);
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* Triggers Grid */
        .triggers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 15px;
        }

        .trigger-item {
            padding: 15px;
            background: #f8fafc;
            border-radius: 10px;
            text-align: center;
        }

        .trigger-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
            margin: 0 auto 12px;
        }

        .trigger-value {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        /* Footer */
        .dashboard-footer {
            text-align: center;
            padding: 20px;
            color: var(--gray);
            font-size: 0.9rem;
            border-top: 1px solid var(--gray-light);
            margin-top: 30px;
        }

        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
            }
            
            .sidebar .logo h1 span,
            .sidebar .nav-item span,
            .sidebar .user-info {
                display: none;
            }
            
            .main-content {
                margin-left: 70px;
            }
            
            .charts-section {
                grid-template-columns: 1fr;
            }
            
            .nav-item {
                justify-content: center;
                padding: 15px;
            }
            
            .nav-item i {
                margin-right: 0;
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <div class="logo">
                <h1>AutoCare<span>Compass</span></h1>
            </div>
            
            <div class="nav-menu">
                <a href="#" class="nav-item active">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-user-md"></i>
                    <span>Medical Report</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-chart-line"></i>
                    <span>Health Trends</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-pills"></i>
                    <span>Medication</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-utensils"></i>
                    <span>Diet Plan</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-calendar-check"></i>
                    <span>Appointments</span>
                </a>
                <a href="#" class="nav-item">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
            
            <div class="user-profile">
                <div class="user-avatar">
                    {{ substr($survey->patient_name ?? 'P', 0, 1) }}
                </div>
                <div class="user-info">
                    <h4>{{ $survey->patient_name ?? 'Patient' }}</h4>
                    <p>Member since {{ \Carbon\Carbon::parse($survey->created_at ?? now())->format('M Y') }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Bar -->
            <div class="top-bar">
                <div class="page-title">
                    <h2>Patient Dashboard</h2>
                    <p>Comprehensive overview of health metrics and autoimmune analysis</p>
                </div>
                <div class="date-display">
                    <i class="far fa-calendar-alt"></i>
                    {{ now()->format('l, F j, Y') }}
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <div class="stat-title">Overall Risk Level</div>
                        <div class="stat-icon primary">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $analytics->getRiskLevel() }}</div>
                    <div class="stat-change">Based on survey analysis</div>
                </div>
                
                <div class="stat-card warning">
                    <div class="stat-header">
                        <div class="stat-title">Pain Level</div>
                        <div class="stat-icon warning">
                            <i class="fas fa-hand-holding-medical"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $survey->pain_level ?? 0 }}/10</div>
                    <div class="stat-change">{{ $survey->pain_level >= 7 ? 'High severity' : 'Moderate' }}</div>
                </div>
                
                <div class="stat-card danger">
                    <div class="stat-header">
                        <div class="stat-title">Fatigue Level</div>
                        <div class="stat-icon danger">
                            <i class="fas fa-bed"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $survey->fatigue_level ?? 0 }}/10</div>
                    <div class="stat-change">{{ $survey->fatigue_level >= 7 ? 'Severe fatigue' : 'Manageable' }}</div>
                </div>
                
                <div class="stat-card success">
                    <div class="stat-header">
                        <div class="stat-title">Sleep Quality</div>
                        <div class="stat-icon success">
                            <i class="fas fa-moon"></i>
                        </div>
                    </div>
                    <div class="stat-value">{{ $survey->sleep_quality ?? 0 }}/10</div>
                    <div class="stat-change positive">{{ $survey->sleep_quality >= 7 ? 'Good sleep' : 'Needs improvement' }}</div>
                </div>
            </div>

            <!-- Patient Information -->
            <div class="patient-info-card">
                <div class="patient-header">
                    <div class="patient-avatar">
                        {{ substr($survey->patient_name ?? 'P', 0, 1) }}
                    </div>
                    <div class="patient-details">
                        <h3>{{ $survey->patient_name ?? 'Patient Name' }}</h3>
                        <p>Age: {{ $survey->age ?? 'N/A' }} • Gender: {{ $survey->gender ?? 'N/A' }}</p>
                        <p>Last Survey: {{ \Carbon\Carbon::parse($survey->created_at ?? now())->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="patient-meta">
                    <div class="meta-item">
                        <div class="meta-label">Height</div>
                        <div class="meta-value">{{ $survey->height_cm ?? 'N/A' }} cm</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Weight</div>
                        <div class="meta-value">{{ $survey->weight_kg ?? 'N/A' }} kg</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">BMI</div>
                        <div class="meta-value">{{ $survey->bmi ?? 'N/A' }}</div>
                    </div>
                    <div class="meta-item">
                        <div class="meta-label">Physical Activity</div>
                        <div class="meta-value">{{ $survey->physical_activity_level ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>

            <!-- Charts Section -->
            <div class="charts-section">
                <!-- Symptom Severity Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <div class="chart-title">Symptom Severity</div>
                            <div class="chart-subtitle">Current symptom intensity levels</div>
                        </div>
                        <div style="color: var(--primary); font-size: 1.5rem;">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                    </div>
                    <canvas id="symptomChart"></canvas>
                </div>

                <!-- Health Scores Chart -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <div class="chart-title">Health Metrics</div>
                            <div class="chart-subtitle">Overall health assessment scores</div>
                        </div>
                        <div style="color: var(--success); font-size: 1.5rem;">
                            <i class="fas fa-heartbeat"></i>
                        </div>
                    </div>
                    <canvas id="healthChart"></canvas>
                </div>
            </div>


<!-- Autoimmune Matches -->
<div class="matches-section">
    <div class="chart-header" style="margin-bottom: 20px;">
        <div>
            <div class="chart-title">Autoimmune Condition Matches</div>
            <div class="chart-subtitle">Probability analysis based on symptoms</div>
        </div>
    </div>
    
    <div class="matches-grid">
        @foreach($reportData['autoimmuneMatches'] as $condition => $percentage)
            @php
                $trueAutoimmune = ['Rheumatoid Arthritis (RA)', 'Lupus (SLE)', 'Sjögren\'s Syndrome', 'Celiac Disease'];
                $isAutoimmune = in_array($condition, $trueAutoimmune);
                $matchLevel = $percentage >= 70 ? 'high' : ($percentage >= 40 ? 'moderate' : 'low');
            @endphp
            
            <div class="match-card {{ $isAutoimmune ? 'autoimmune' : 'immune-mediated' }}">
                <div class="match-header">
                    <div class="match-disease">{{ $condition }}</div>
                    <div class="match-type {{ $isAutoimmune ? 'autoimmune' : 'immune' }}">
                        {{ $isAutoimmune ? 'Autoimmune' : 'Immune-Mediated' }}
                    </div>
                </div>
                <div class="match-percentage">{{ number_format($percentage, 1) }}%</div>
                <div class="progress-bar">
                    <div class="progress-fill {{ $matchLevel }}" style="width: {{ $percentage }}%"></div>
                </div>
                <div class="match-footer">
                    <span>Match Probability</span>
                    <span>{{ ucfirst($matchLevel) }} Match</span>
                </div>
            </div>
        @endforeach
    </div>
</div>

            <!-- Triggers & Recommendations -->
            <div class="charts-section">
                <!-- Triggers -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <div class="chart-title">Potential Triggers</div>
                            <div class="chart-subtitle">Factors that may exacerbate symptoms</div>
                        </div>
                        <div style="color: var(--warning); font-size: 1.5rem;">
                            <i class="fas fa-bolt"></i>
                        </div>
                    </div>
                    <div class="triggers-grid">
                        @foreach($reportData['triggers'] as $trigger => $score)
                            <div class="trigger-item">
                                <div class="trigger-icon">
                                    @if($trigger == 'Stress')
                                        <i class="fas fa-brain"></i>
                                    @elseif($trigger == 'Food')
                                        <i class="fas fa-utensils"></i>
                                    @elseif($trigger == 'Weather')
                                        <i class="fas fa-cloud-sun"></i>
                                    @else
                                        <i class="fas fa-exclamation-circle"></i>
                                    @endif
                                </div>
                                <div class="chart-subtitle">{{ $trigger }}</div>
                                <div class="trigger-value">{{ $score }}/10</div>
                                <div style="height: 8px; background: var(--gray-light); border-radius: 4px; margin-top: 10px;">
                                    <div style="width: {{ $score * 10 }}%; height: 100%; background: var(--warning); border-radius: 4px;"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recommendations -->
                <div class="chart-card">
                    <div class="chart-header">
                        <div>
                            <div class="chart-title">Personalized Recommendations</div>
                            <div class="chart-subtitle">Actionable health improvement steps</div>
                        </div>
                        <div style="color: var(--info); font-size: 1.5rem;">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                    </div>
                    <ul class="rec-list">
                        @foreach($analytics->getRecommendations() as $index => $recommendation)
                            <li class="rec-item">
                                <i class="fas fa-check-circle"></i>
                                {{ $recommendation }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Footer -->
            <div class="dashboard-footer">
                <p>© {{ date('Y') }} AutoCare Compass. This dashboard provides health insights based on survey data.</p>
                <p style="font-size: 0.8rem; margin-top: 5px; color: var(--danger);">
                    <i class="fas fa-exclamation-triangle"></i> For medical emergencies, contact your healthcare provider immediately.
                </p>
            </div>
        </div>
    </div>

    <script>
        // Chart data
        const symptomData = {
            labels: {!! json_encode(array_keys($reportData['symptomSeverity'])) !!},
            datasets: [{
                label: 'Severity Score',
                data: {!! json_encode(array_values($reportData['symptomSeverity'])) !!},
                backgroundColor: 'rgba(102, 126, 234, 0.7)',
                borderColor: 'rgba(102, 126, 234, 1)',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        };

        const healthData = {
            labels: {!! json_encode(array_keys($reportData['healthScores'])) !!},
            datasets: [{
                label: 'Health Score',
                data: {!! json_encode(array_values($reportData['healthScores'])) !!},
                backgroundColor: [
                    'rgba(16, 185, 129, 0.7)',
                    'rgba(245, 158, 11, 0.7)',
                    'rgba(59, 130, 246, 0.7)',
                    'rgba(139, 92, 246, 0.7)',
                    'rgba(14, 165, 233, 0.7)'
                ],
                borderColor: [
                    'rgb(16, 185, 129)',
                    'rgb(245, 158, 11)',
                    'rgb(59, 130, 246)',
                    'rgb(139, 92, 246)',
                    'rgb(14, 165, 233)'
                ],
                borderWidth: 1
            }]
        };

        // Initialize charts
        document.addEventListener('DOMContentLoaded', function() {
            // Symptom Chart
            const symptomCtx = document.getElementById('symptomChart').getContext('2d');
            new Chart(symptomCtx, {
                type: 'bar',
                data: symptomData,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 10,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                stepSize: 2
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Health Chart
            const healthCtx = document.getElementById('healthChart').getContext('2d');
            new Chart(healthCtx, {
                type: 'doughnut',
                data: healthData,
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    cutout: '70%',
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });

        // Sidebar toggle for mobile
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('collapsed');
        }
    </script>
</body>
</html>