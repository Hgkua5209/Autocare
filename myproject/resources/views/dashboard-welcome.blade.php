<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to AutoCare Compass</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            font-family: 'Segoe UI', sans-serif;
        }
        .welcome-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .welcome-icon {
            font-size: 5rem;
            color: #667eea;
            margin-bottom: 20px;
        }
        h1 {
            color: #333;
            margin-bottom: 15px;
        }
        p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 30px;
        }
        .btn-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1em;
            border-radius: 50px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            margin: 10px;
            transition: transform 0.3s;
        }
        .btn-primary:hover {
            transform: translateY(-3px);
        }
        .btn-secondary {
            background: #f8f9fa;
            color: #666;
            border: 1px solid #ddd;
            padding: 12px 30px;
            border-radius: 50px;
            text-decoration: none;
            display: inline-block;
            margin: 10px;
        }
        .features {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }
        .feature {
            flex: 1;
            min-width: 150px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="welcome-card">
        <div class="welcome-icon">
            🩺
        </div>
        <h1>Welcome to Your Health Dashboard</h1>
        <p>
            To unlock your personalized health analytics, autoimmune analysis, 
            and personalized recommendations, please complete your medical survey first.
        </p>
        
        <div>
            <a href="{{ route('checksurvey') }}" class="btn-primary">
                <i class="fas fa-play-circle"></i> Start Medical Survey
            </a>
            <a href="{{ route('home') }}" class="btn-secondary">
                <i class="fas fa-home"></i> Return Home
            </a>
        </div>
        
        <div class="features">
            <div class="feature">
                <i class="fas fa-chart-bar fa-2x text-primary mb-2"></i>
                <h4>Health Analytics</h4>
                <small>Track your symptoms and progress</small>
            </div>
            <div class="feature">
                <i class="fas fa-stethoscope fa-2x text-primary mb-2"></i>
                <h4>Autoimmune Analysis</h4>
                <small>Personalized condition matching</small>
            </div>
            <div class="feature">
                <i class="fas fa-lightbulb fa-2x text-primary mb-2"></i>
                <h4>Recommendations</h4>
                <small>Actionable health advice</small>
            </div>
        </div>
        
        <div style="margin-top: 30px; color: #999; font-size: 0.9em;">
            <i class="fas fa-shield-alt"></i> Your data is private and secure. 
            Survey results are for informational purposes only.
        </div>
    </div>
</body>
</html>