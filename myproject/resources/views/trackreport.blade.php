<!DOCTYPE html>
<html lang="en">
    <!-- test -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Survey Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .patient-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            background: #f8f9fa;
            padding: 25px 40px;
            border-bottom: 3px solid #e9ecef;
        }

        .info-item {
            padding: 15px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .info-item strong {
            color: #667eea;
            display: block;
            margin-bottom: 5px;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-item span {
            font-size: 1.2em;
            font-weight: 600;
            color: #333;
        }

        .section {
            padding: 30px 40px;
            border-bottom: 1px solid #eee;
        }

        .section-title {
            color: #667eea;
            font-size: 1.5em;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #667eea;
        }

        .charts-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 20px;
        }

        .chart-container {
            background: white;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            transition: transform 0.3s;
        }

        .chart-container:hover {
            transform: translateY(-5px);
        }

        .chart-title {
            text-align: center;
            color: #555;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .autoimmune-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 20px;
        }

        .autoimmune-item {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 20px;
            border-radius: 15px;
            text-align: center;
        }

/* Keep EXACT original style for true autoimmune */
.autoimmune-item-original {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
}

/* New blue style for auto-inflammatory */
.autoimmune-item-blue {
    background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
    color: white;
    padding: 20px;
    border-radius: 15px;
    text-align: center;
        min-height: 120px;
}

/* Keep the badge styles */
.disease-type-badge {
    display: block;
    font-size: 0.7em;
    background: rgba(255, 255, 255, 0.3);
    padding: 2px 10px;
    border-radius: 10px;
    margin-top: 5px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.match-level-badge {
    display: inline-block;
    font-size: 0.8em;
    font-weight: bold;
    background: rgba(0, 0, 0, 0.2);
    padding: 3px 12px;
    border-radius: 12px;
    margin-top: 8px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}
        .condition {
            font-size: 1.1em;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .match {
            font-size: 2em;
            font-weight: 700;
            margin: 10px 0;
        }

        .conditions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 20px;
        }

        .condition-category {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            border-left: 5px solid #667eea;
        }

        .category-title {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.2em;
            font-weight: 600;
        }

        .symptom-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px dashed #ddd;
        }

        .recommendations {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            color: white;
            padding: 30px;
            border-radius: 15px;
            margin-top: 20px;
        }

        .recommendations ul {
            list-style: none;
            padding-left: 20px;
        }

        .recommendations li {
            margin-bottom: 10px;
            padding-left: 25px;
            position: relative;
        }

        .recommendations li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #00ff88;
            font-weight: bold;
        }

        .footer {
            text-align: center;
            padding: 30px;
            background: #f8f9fa;
            color: #666;
        }

        .cta-button {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1em;
            border-radius: 50px;
            cursor: pointer;
            margin-top: 20px;
            margin:0 20px;
            transition: transform 0.3s, box-shadow 0.3s;
            font-weight: 600;
            text-transform: uppercase;
            text-decoration: none !important;
            letter-spacing: 1px;
        }

        .cta-button:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .autoimmune-block {
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
}

.autoimmune-block span {
    color: rgba(255,255,255,0.8);
}

.autoimmune-block strong {
    color: white;
}
        .severity-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.9em;
            font-weight: 600;
        }

@media print {

    /* RESET */
    * {
        box-shadow: none !important;
    }

    body {
        background: white !important;
        margin: 0;
        padding: 20px;
        -webkit-print-color-adjust: exact !important;
    }
    .section-title {
        page-break-after: avoid;
    }

    @media print {

    .condition-card {
        break-inside: auto !important;
        page-break-inside: auto !important;
    }

}
    /* HIDE BUTTON */
    button {
        display: none !important;
    }

    /* 💥 PAKSA SEMUA FLEX/GRID JADI BLOCK */
    div {
        display: block !important;
        width: 100% !important;
    }

    /* CARD LOOK */
    div {
        margin-bottom: 10px !important;
    }

    /* ELak pecah tengah */
    div {
        page-break-inside: avoid;
    }
        .no-print {
        display: none !important;
    }

}

        .severity-high { background: #ff4757; color: white; }
        .severity-medium { background: #ffa502; color: white; }
        .severity-low { background: #2ed573; color: white; }

        
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>📊 Analytical Report</h1>
            <p>Generated on {{ now()->format('F j, Y') }}</p>
        </div>

        <!-- Patient Information -->
        <div class="patient-info">
            <div class="info-item">
                <strong>Name</strong>
                <span>{{ $survey->patient_name ?? 'No Name provided' }}</span>
            </div>
            <div class="info-item">
                <strong>Age</strong>
                <span>{{ $survey->age ?? 'No Age provided'}}</span>
            </div>
            <div class="info-item">
                <strong>Gender</strong>
                <span>{{ $survey->gender ?? 'Gender Not specified' }}</span>
            </div>
            <div class="info-item">
                <strong>Height</strong>
                <span>{{ $survey->height_cm ?? 'Height Not specified' }}</span>
            </div>
            <div class="info-item">
                <strong>Weight</strong>
                <span>{{ $survey->weight_kg ?? 'Weight Not specified' }}</span>
            </div>
            <div class="info-item">
                <strong>BMI Status</strong>
                @php
                    $bmi = $survey->bmi;
                    $status = $bmi < 18.5 ? 'Underweight' : ($bmi < 25 ? 'Normal' : ($bmi < 30 ? 'Overweight' : 'Obese'));
                    $color = $bmi >= 18.5 && $bmi < 25 ? 'text-green-500' : 'text-red-500';
                @endphp
                <span class="{{ $color }}">{{ $status }}</span>
            </div>
            <div class="info-item autoimmune-block">
                    <strong>Condition</strong>
    <span>{{ $survey->autoimmune_type ?? 'N/A' }}</span>

</div>
        </div>


        <!-- Autoimmune Section -->
        <div class="section">

            <h2 class="section-title">🩺 Autoimmune Symptom Overview</h2>

            {{-- PRIMARY CONDITIONS --}}
            <h3 style="margin-bottom:15px; color:#f5576c;">
                🩺 Primary Autoimmune Conditions
            </h3>

            <div class="autoimmune-grid">

                @php
                    $primaryConditions = [
                        'Lupus (SLE)',
                        'Rheumatoid Arthritis (RA)',
                        'Psoriatic Arthritis'
                    ];
                @endphp

                @foreach($primaryConditions as $condition)

                    @php
                        $userSymptoms = is_string($survey->main_symptoms)
                            ? json_decode($survey->main_symptoms, true)
                            : ($survey->main_symptoms ?? []);
                    @endphp

                    <div class="autoimmune-item-original">

                        <div class="condition">
                            {{ $condition }}
                        </div>

                        <div style="margin-top:15px; text-align:left;">

                            <div style="
                                font-size:0.9em;
                                font-weight:600;
                                margin-bottom:10px;
                            ">
                                Associated symptoms:
                            </div>

                            @foreach($conditionSymptoms[$condition] as $symptom)

                                @php
                                    $coreSymptoms = [
                                        'Lupus (SLE)' => ['Skin Rash', 'Eye Issues', 'Fever'],
                                        'Rheumatoid Arthritis (RA)' => ['Joint Pain', 'Morning Stiffness'],
                                        'Psoriatic Arthritis' => ['Skin Rash'],

                                        'Sjögren\'s Syndrome' => ['Eye Issues'],
                                        'Ankylosing Spondylitis' => ['Joint Pain'],
                                        'Inflammatory Bowel Disease' => ['Digestive Issues'],
                                        'Celiac Disease' => ['Digestive Issues']
                                    ];

                                    $isSelected =
                                        in_array($symptom, $userSymptoms) &&
                                        in_array($symptom, $coreSymptoms[$condition] ?? []);
                                @endphp

                            <div style="
                                margin-bottom:8px;
                                padding:6px 10px;
                                border-radius:8px;
                                background: {{ $isSelected ? '#27c96f' : 'rgba(255,255,255,0.08)' }};
                                color: {{ $isSelected ? '#ffffff' : '#ffffff' }};
                                font-weight: {{ $isSelected ? '700' : '400' }};
                            ">
                                {{ $isSelected ? '✓' : '•' }} {{ $symptom }}
                            </div>

                            @endforeach

                        </div>

                    </div>

                @endforeach

            </div>

            {{-- RELATED CONDITIONS --}}
            <h3 style="
                margin-top:40px;
                margin-bottom:15px;
                color:#00c6ff;
            ">
                🔗 Related Immune-Mediated Conditions
            </h3>

            <div class="autoimmune-grid">

                @php
                    $relatedConditions = [
                        'Sjögren\'s Syndrome',
                        'Ankylosing Spondylitis',
                        'Inflammatory Bowel Disease',
                        'Celiac Disease'
                    ];
                @endphp

                @foreach($relatedConditions as $condition)

                    @php
                        $userSymptoms = is_string($survey->main_symptoms)
                            ? json_decode($survey->main_symptoms, true)
                            : ($survey->main_symptoms ?? []);
                    @endphp

                    <div class="autoimmune-item-blue" style="opacity:0.95;">

                        <div class="condition">
                            {{ $condition }}
                        </div>

                        <div style="margin-top:15px; text-align:left;">

                            <div style="
                                font-size:0.9em;
                                font-weight:600;
                                margin-bottom:10px;
                            ">
                                Associated symptoms:
                            </div>

                            @foreach($conditionSymptoms[$condition] as $symptom)

                                @php
                                    $coreSymptoms = [
                                        'Lupus (SLE)' => ['Skin Rash', 'Eye Issues', 'Fever'],
                                        'Rheumatoid Arthritis (RA)' => ['Joint Pain', 'Morning Stiffness'],
                                        'Psoriatic Arthritis' => ['Skin Rash'],

                                        'Sjögren\'s Syndrome' => ['Eye Issues'],
                                        'Ankylosing Spondylitis' => ['Joint Pain'],
                                        'Inflammatory Bowel Disease' => ['Digestive Issues'],
                                        'Celiac Disease' => ['Digestive Issues']
                                    ];

                                    $isSelected =
                                        in_array($symptom, $userSymptoms) &&
                                        in_array($symptom, $coreSymptoms[$condition] ?? []);
                                @endphp

                            <div style="
                                margin-bottom:8px;
                                padding:6px 10px;
                                border-radius:8px;
                                background: {{ $isSelected ? '#27c96f' : 'rgba(255,255,255,0.08)' }};
                                color: {{ $isSelected ? '#ffffff' : '#ffffff' }};
                                font-weight: {{ $isSelected ? '700' : '400' }};
                            ">
                                    {{ $isSelected ? '✔' : '•' }} {{ $symptom }}
                                </div>

                            @endforeach

                        </div>

                    </div>

                @endforeach

            </div>

        </div>

        
        <!-- Charts Section -->
        <div class="section">
            <h2 class="section-title">📈 Health Metrics</h2>
            <div class="charts-grid">
                <!-- Symptom Severity Chart -->
                <div class="chart-container">
                    <div class="chart-title">Symptom Severity</div>
                    <canvas id="symptomChart"></canvas>
                </div>

                <!-- Health Scores Chart -->
                <div class="chart-container">
                    <div class="chart-title">Health Scores</div>
                    <canvas id="healthChart"></canvas>
                </div>

                <!-- Triggers Chart -->
                <div class="chart-container">
                    <div class="chart-title">Potential Triggers</div>
                    <canvas id="triggerChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Conditions Section -->
        <div class="section">
            <h2 class="section-title">📋 Conditions & Symptoms</h2>
            <div class="conditions-grid">
                <!-- Symptoms -->
                <div class="condition-category">
                    <div class="category-title">Symptoms</div>
                    @foreach($reportData['symptomSeverity'] as $symptom => $score)
                    <div class="symptom-item">
                        <span>{{ $symptom }}</span>
                        <div>
                            @php
                                $badgeClass = $score >= 7 ? 'severity-high' :
                                             ($score >= 4 ? 'severity-medium' : 'severity-low');
                                $frequency = $score >= 7 ? 'Daily' :
                                            ($score >= 4 ? 'Weekly' : 'Monthly');
                            @endphp
                            <span class="severity-badge {{ $badgeClass }}">
                                {{ $frequency }}
                            </span>
                            <span style="margin-left: 10px; font-weight: 600;">{{ $score }}/10</span>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Triggers -->
                <div class="condition-category">
                    <div class="category-title">Potential Triggers</div>
                    @if(empty($reportData['triggers']))
                        <p class="text-sm text-gray-500 italic">No specific triggers reported.</p>
                    @else
                        @foreach($reportData['triggers'] as $trigger => $data)
                            @endforeach
                    @endif
                    @foreach($reportData['triggers'] as $trigger => $data)

    @php
        $score = $data['score'] ?? $data;
        $level = $data['level'] ?? ($score >= 7 ? 'High' : ($score >= 4 ? 'Medium' : 'Low'));
        $color = $score >= 7 ? '#ff4757' : ($score >= 4 ? '#ffa502' : '#2ed573');
    @endphp

    <div style="
        padding: 10px 0;
        border-bottom: 1px dashed #ddd;
    ">

        <div style="
            display:flex;
            justify-content:space-between;
            align-items:center;
        ">
            <span>{{ $trigger }}</span>

            <span style="color: {{ $color }}; font-weight: 600;">
                {{ $level }} ({{ $score }}/10)
            </span>
        </div>

        @if(strtolower($trigger) == 'food' && !empty($survey->diet_description))
        <div style="
            margin-top:6px;
            font-size:0.85em;
            color:#e84393;
        ">
            🍽 Reported trigger foods: {{ $survey->diet_description }}
        </div>
        @endif

    </div>

@endforeach
                </div>

                <!-- Lifestyle -->
                <div class="condition-category">
                    <div class="category-title">Lifestyle Factors</div>
                    <div class="symptom-item">
                        <span>Smoking Status</span>
                        <span style="font-weight: 600; color: {{ $survey->smoking_status == 'Regular' ? '#ff4757' : '#2ed573' }}">
                            {{ $survey->smoking_status }}
                        </span>
                    </div>
                    <div class="symptom-item">
                        <span>Alcohol Consumption</span>
                        <span style="font-weight: 600; color: {{ $survey->alcohol_consumption == 'Heavily' ? '#ff4757' : '#ffa502' }}">
                            {{ $survey->alcohol_consumption }}
                        </span>
                    </div>
                    <div class="symptom-item">
                        <span>Physical Activity</span>
                        <span style="font-weight: 600; color: {{ $survey->physical_activity_level == 'Sedentary' ? '#ff4757' : '#2ed573' }}">
                            {{ $survey->physical_activity_level }}
                        </span>
                    </div>
                    <div class="symptom-item">
                        <span>Water Consumption</span>
                        <span style="font-weight: 600;">{{ $survey->water_consumption }}/10</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommendations -->
        <div class="section ">
            <h2 class="section-title">💡 Personalized Recommendations</h2>
            <div class="recommendations">
        <ul>
            @foreach($analytics->getRecommendations() as $recommendation)
            <li>{{ $recommendation }}</li>
            @endforeach
        </ul>
            </div>
        </div>

        <!-- CTA Section -->
        <div class="section no-print" style="text-align: center;">
            <h2 class="section-title">🌟 Start Your Health Journey</h2>
            <p style="font-size: 1.2em; margin-bottom: 20px; color: #555;">
                <strong>"Start your journey for 2 weeks with us"</strong><br>
                <em>AutoCare Compass can help you</em>
            </p>
            
                <!-- BACK BUTTON -->
<button type="button"
        onclick="location.href='{{ route('dashboard') }}'"
        class="cta-button"
        style="background: #6c757d; margin-top: 10px;">
    ← Back
</button>


    <button type="button" class="cta-button"
     onclick="window.print()">
    📄 Download PDF
</button>
        </div>


        <!-- Footer -->
        <div class="footer">
            <p>© {{ date('Y') }} AutoCare Compass. All rights reserved.</p>
            <p>This report is generated based on your survey responses and is for informational purposes only.</p>
            <p>Consult with a healthcare professional for medical advice.</p>
        </div>
        <!-- Risk Level -->
        <div class="section" style="text-align: center; background: #f8f9fa; border-radius: 10px;">
            <h2 class="section-title">⚠️ Overall Risk Assessment</h2>
            @php
                $riskLevel = $analytics->getRiskLevel();
                $riskColor = $riskLevel == 'High' ? '#ff4757' :
                            ($riskLevel == 'Medium' ? '#ffa502' : '#2ed573');
            @endphp
            <div style="font-size: 2.5em; color: {{ $riskColor }}; font-weight: 700; margin: 10px 0;">
                {{ $riskLevel }} Risk
            </div>
            <p style="color: #666;">Based on your symptoms and lifestyle factors</p>
        </div>
    </div>

    <script>
        // Chart data from PHP
const symptomData = {
    labels: {!! json_encode(array_keys($reportData['symptomSeverity'])) !!},
    datasets: [{
        label: 'Severity Score',
        data: {!! json_encode(array_values($reportData['symptomSeverity'])) !!},
        backgroundColor: '#ff6b6b',
        borderWidth: 2
    }]
};

    const healthData = {
        labels: {!! json_encode(array_keys($reportData['healthScores'])) !!},
        datasets: [{
            label: 'Health Score',
            data: {!! json_encode(array_values($reportData['healthScores'])) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.6)'
        }]
    };

        const triggerData = {
            labels: {!! json_encode(array_keys($reportData['triggers'])) !!},
            datasets: [{
                label: 'Trigger Level',
                data: {!! json_encode(array_values($reportData['triggers'])) !!},
                backgroundColor: [
                    '#ff9ff3', '#feca57', '#48dbfb', '#1dd1a1'
                ],
                borderWidth: 2,
                borderColor: '#fff'
            }]
        };

        // Initialize charts when page loads
        document.addEventListener('DOMContentLoaded', function() {
            // Symptom Chart
            const symptomCtx = document.getElementById('symptomChart').getContext('2d');
            new Chart(symptomCtx, {
                type: 'bar',
                data: symptomData,
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 10,
                            title: {
                                display: true,
                                text: 'Severity (1-10)'
                            }
                        }
                    }
                }
            });

            // Health Chart
            const healthCtx = document.getElementById('healthChart').getContext('2d');
            new Chart(healthCtx, {
                type: 'radar',
                data: {
                    labels: healthData.labels,
                    datasets: [{
                        label: 'Your Score',
                        data: healthData.datasets[0].data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(54, 162, 235, 1)'
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        r: {
                            beginAtZero: true,
                            max: 10,
                            ticks: {
                                stepSize: 2
                            }
                        }
                    }
                }
            });

            // Trigger Chart
            const triggerCtx = document.getElementById('triggerChart').getContext('2d');
            new Chart(triggerCtx, {
                type: 'doughnut',
                data: triggerData,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });

        function startJourney() {
            // Check if user has high risk before starting
            const risk = "{{ $analytics->getRiskLevel() }}";

            if(risk === 'High') {
                alert('Notice: Based on your high risk level, we recommend consulting a doctor before starting this 2-week program.');
            }

            alert('Journey Started! We will track your progress daily.');
        }

        // Print functionality
        function printReport() {
            window.onload = function() {
    window.print();
}

        }

        
    </script>
</body>
</html>
