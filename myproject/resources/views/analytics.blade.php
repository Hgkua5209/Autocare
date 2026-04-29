@extends('layouts.app')

@section('content')

<div class="progress-header">
    <h2 class="progress-title">{{ $title }}</h2>
    <div class="progress-meta">
        {{ $startDateFormatted }} → {{ $endDateFormatted }}
    </div>
</div>

<div class="kpi-row">
    <div class="kpi">Score<br><b>{{ $healthScore }}</b></div>
    <div class="kpi">Status<br><b>{{ $status }}</b></div>
    <div class="kpi">Trend<br><b>{{ $trend }}</b></div>
    <div class="kpi">Risk<br><b>{{ $risk }}</b></div>
</div>

<div class="chart-box big">
    <canvas id="healthChart"></canvas>
</div>

<div class="grid-4">

    <div class="mini-box">
        <h4>Worst Day</h4>
        <p>{{ $worstDay->created_at->format('d M') }}</p>
        <small>Pain: {{ $worstDay->pain_level }}</small>
    </div>

    <div class="mini-box">
        <h4>Correlation</h4>
        <p>{{ $correlation }}</p>
    </div>

    <div class="mini-box">
        <h4>Stability</h4>
        <p>{{ $consistency }}</p>
    </div>

    <div class="mini-box">
        <h4>Sleep Avg</h4>
        <p>{{ $avgSleep }}</p>
    </div>

</div>

<div class="grid-2">

    <div class="box">
        <h3>Insights</h3>
        @foreach($insights as $i)
            <p>{{ $i }}</p>
        @endforeach
    </div>

    <div class="box">
        <h3>Recommendations</h3>
        @foreach($recommendations as $r)
            <p>{{ $r }}</p>
        @endforeach
    </div>

</div>

<div class="highlight-box">
    {{ $summaryText }}
</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const ctx = document.getElementById('healthChart');

new Chart(ctx, {
    type: 'line',
    data: {
        labels: @json($dates),
        datasets: [
            {
                label: 'Pain',
                data: @json($pain),
                borderColor: '#ff4d4f',
                backgroundColor: 'rgba(255,77,79,0.2)',
                fill: true,
                tension: 0.4,

                pointRadius: function(context) {
                    const index = context.dataIndex;
                    return index === {{ $pain->search($worstDay->pain_level) }} ? 8 : 3;
                }
            },
            {
                label: 'Stress',
                data: @json($stress),
                borderColor: '#ffa940',
                backgroundColor: 'rgba(255,169,64,0.2)',
                fill: true,
                tension: 0.4
            },
            {
                label: 'Fatigue',
                data: @json($fatigue),
                borderColor: '#9254de',
                backgroundColor: 'rgba(146,84,222,0.2)',
                fill: true,
                tension: 0.4,
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
         plugins: {
            legend: {
                labels: {
                    color: '#fff'
                }
            }
        },
        scales: {
            x: { ticks: { color: '#fff' }},
            y: { ticks: { color: '#fff' }}
        }
    }

});




</script>

<style>
    .analytics-container {
    max-width: 1200px;
    margin: auto;
}
.analytics-container {
    max-width: 1100px;
    margin: 20px auto;
    background: #1e1e1e;
    padding: 30px;
    border-radius: 16px;
    color: white;
}

.summary div {
    background: #2c2c2c;
    padding: 15px;
    border-radius: 10px;
}

.box {
    margin-top: 8px;
    padding: 15px;
    background: #2c2c2c;
    border-radius: 10px;
}

.score-box {
    margin-top: 20px;
    background: linear-gradient(45deg, #2979ff, #6a11cb);
    padding: 20px;
    border-radius: 12px;
    text-align: center;
}

.score {
    font-size: 40px;
    font-weight: bold;
}

.summary {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}
.status {
    padding: 10px;
    border-radius: 8px;
    font-weight: bold;
}

.chart-box {
    margin-top: 8px;
    background: #2c2c2c;
    padding: 20px;
    border-radius: 12px;
    height: 350px;
}

.kpi-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-bottom: 8px;
}

.kpi {
    background: #2c2c2c;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
}

.grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 15px;
    margin-top: 8px;
}

.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;

}

.mini-box {
    background: #2c2c2c;
    padding: 15px;
    border-radius: 10px;
}

.highlight-box {
    margin-top: 8px;
    padding: 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 12px;
    font-weight: bold;
}
body {
    color: #e4e6eb;
}

/* title */
h2, h3, h4 {
    color: #ffffff;
}

/* normal text */
p, small {
    color: #b0b3b8;
}

/* KPI number */
.kpi b {
    color: #ffffff;
    font-size: 20px;
}

/* label kecil */
.kpi {
    color: #b0b3b8;
}

/* box content */
.box, .mini-box {
    color: #d1d5db;
}

/* highlight text */
.highlight-box {
    color: white;
}

.progress-header {
    margin-bottom: 20px;
}

.progress-header h2 {
    font-size: 24px;
    font-weight: bold;
    color: #202020;
}

.progress-title {
    font-size: 26px;
    font-weight: 600;
    color: #919191;
    margin: 0;
}

.progress-meta {
    font-size: 14px;
    color: #9ca3af;
    margin-top: 5px;
}
.date-range {
    color: #9ca3af;
    font-size: 14px;
}


.status.stable { background: #00c853; }
.status.moderate { background: #ffa000; }
.status.critical { background: #d50000; }
</style>

@endsection