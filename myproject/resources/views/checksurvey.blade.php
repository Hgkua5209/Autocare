@extends('layouts.app')

@section('content')
    <!-- test -->

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Survey - AutoCare Compass</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
.page-wrapper {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 20px 0; /* 🔥 BUANG kiri kanan */
}

.main-content {
    padding: 10px 20px 20px !important;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

        .container {
            max-width: 900px;
    margin: 40px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.2em;
            margin-bottom: 10px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .header p {
            opacity: 0.9;
        }

        .form-section {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 1.1em;
        }

        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #ddd;
            border-radius: 10px;
            font-size: 1em;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            border-color: #667eea;
            outline: none;
        }

        .checkbox-group {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 10px;
            margin-top: 10px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        .checkbox-item label {
            margin: 0;
            font-weight: normal;
        }

        .slider-container {
            margin: 20px 0;
        }

        .slider-value {
            font-weight: 600;
            color: #667eea;
            margin-left: 10px;
        }

        input[type="range"] {
            width: 100%;
            height: 10px;
            -webkit-appearance: none;
            background: #ddd;
            border-radius: 5px;
            outline: none;
        }

        input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 25px;
            height: 25px;
            background: #667eea;
            border-radius: 50%;
            cursor: pointer;
        }

        .scale-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            color: #666;
            font-size: 0.9em;
        }

        .submit-btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 1.1em;
            border-radius: 50px;
            cursor: pointer;
            width: 100%;
            transition: transform 0.3s, box-shadow 0.3s;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .submit-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
        }

        .error {
            color: #ff4757;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .section-title {
            color: #667eea;
            font-size: 1.3em;
            margin: 30px 0 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eee;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .required {
            color: #ff4757;
        }

        /* Alert styles */
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: none;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* Feedback styling for validation errors */
        .is-invalid {
            border: 2px solid #ff4757 !important; /* Red border */
            background-color: #fffafb !important; /* Light red tint */
        }

        .error-message {
            color: #ff4757;
            font-size: 0.85em;
            font-weight: 600;
            margin-top: 5px;
            display: block;
        }
    </style>


    <div class="container">
        <div class="header">
            <h1>🏥 AutoCare Compass</h1>
            <p>Complete this survey to understand your symptom patterns and lifestyle insights</p>
            <div style="background:#fff3cd; padding:10px; border-radius:10px; margin-top:15px;">
                <small style="color:red;">
                ⚠️ This tool is not intended to diagnose medical conditions. Please consult a healthcare professional for diagnosis.
                </small>
            </div>
        </div>

        <!-- Success/Error Messages -->
        @if(session('success'))
            <div class="alert alert-success" id="successAlert">
                ✅ {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error" id="errorAlert">
                ❌ {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-error" id="validationAlert">
                ❌ Please fix the following errors:
                <ul style="margin-top: 10px; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('medical.survey.store') }}" id="medicalSurveyForm">
            @csrf

            <!-- Section 1: Personal Information -->
        <div class="form-section">
            <h2 class="section-title">👤 Personal Information</h2>

            <div class="form-group">
                <label>Full Name <span class="required">*</span></label>
                <input type="text" name="patient_name" value="{{ old('patient_name') }}"
                    class="@error('patient_name') is-invalid @enderror" required>
                @error('patient_name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Age <span class="required">*</span></label>
                <input type="number" name="age" value="{{ old('age') }}" min="1" max="120"
                    class="@error('age') is-invalid @enderror" required>
                @error('age')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Gender <span class="required">*</span></label>
                <select name="gender" class="@error('gender') is-invalid @enderror" required>
                    <option value="">Select Gender</option>
                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Height (cm) <span class="required">*</span></label>
                <input type="number" name="height_cm" value="{{ old('height_cm') }}" min="50" max="250"
                    class="@error('height_cm') is-invalid @enderror" required>
                @error('height_cm')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Weight (kg) <span class="required">*</span></label>
                <input type="number" step="0.1" name="weight_kg" value="{{ old('weight_kg') }}" min="20" max="300"
                    class="@error('weight_kg') is-invalid @enderror" required>
                @error('weight_kg')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label>Do you have a diagnosed autoimmune condition?</label>

                <select id="autoimmuneType" name="autoimmune_type" class="form-control">
                    <option value="">Not diagnosed / Not sure</option>
                    <option value="Lupus" {{ old('autoimmune_type') == 'Lupus' ? 'selected' : '' }}>Lupus</option>
                    <option value="Rheumatoid Arthritis" {{ old('autoimmune_type') == 'Rheumatoid Arthritis' ? 'selected' : '' }}>Rheumatoid Arthritis</option>
                    <option value="Psoriasis" {{ old('autoimmune_type') == 'Psoriasis' ? 'selected' : '' }}>Psoriasis</option>
                </select>

                <small style="color:#666;">
                This is optional and will only be used to personalize your report.
                </small>
            </div>
        </div>


            <!-- Section 2: Symptoms -->
            <div class="form-section">
                <h2 class="section-title">🤒 Symptoms Assessment</h2>

                <div class="symptom-group general-group">
                    <!-- ⚡ GENERAL -->
                    <h3 style="margin-top:20px;">⚡ General Symptoms</h3>
                    <div class="form-group checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Fatigue"
                                {{ in_array('Fatigue', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Fatigue</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Fever"
                                {{ in_array('Fever', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Fever</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Muscle Pain"
                                {{ in_array('Muscle Pain', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Muscle Pain</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Hair Loss"
                                {{ in_array('Hair Loss', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Hair Loss</label>
                        </div>
                    </div>
                </div>

                <!-- 🦴 JOINT -->
                <div class="symptom-group joint-group">
                    <h3 >🦴 Joint Symptoms</h3>
                    <div class="form-group checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="jointPain" name="main_symptoms[]" value="Joint Pain"
                                {{ in_array('Joint Pain', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Joint Pain</label>
                        </div>
                    </div>


                    <!-- Joint Detail -->
                    <div id="jointSection" class="form-group" style="display:none;">
                        <label>Morning Stiffness Duration</label>
                        <select name="morning_stiffness">
                            <option value="">Select duration</option>
                            <option value="none" {{ old('morning_stiffness') == 'none' ? 'selected' : '' }}>No stiffness</option>
                            <option value="less_30min" {{ old('morning_stiffness') == 'less_30min' ? 'selected' : '' }}>Less than 30 minutes</option>
                            <option value="30min_1h" {{ old('morning_stiffness') == '30min_1h' ? 'selected' : '' }}>30 min - 1 hour</option>
                            <option value="1_2h" {{ old('morning_stiffness') == '1_2h' ? 'selected' : '' }}>1-2 hours</option>
                            <option value="more_2h" {{ old('morning_stiffness') == 'more_2h' ? 'selected' : '' }}>More than 2 hours</option>
                        </select>
                    </div>
                </div>

                <!-- 🧴 SKIN -->
                <div class="symptom-group skin-group">
                    <h3>🧴 Skin Symptoms</h3>
                    <div class="form-group checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="skinRash" name="main_symptoms[]" value="Skin Rash"
                                {{ in_array('Skin Rash', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Skin Rash</label>
                        </div>
                    </div>

                    <!-- Skin Detail -->
                    <div id="skinSection" class="form-group" style="display:none;">
                        <label>Specific Skin Symptoms</label>
                        <div class="checkbox-group">
                            <div class="checkbox-item">
                                <input type="checkbox" name="skin_symptoms[]" value="butterfly_rash"
                                    {{ in_array('butterfly_rash', old('skin_symptoms', [])) ? 'checked' : '' }}>
                                <label>Butterfly-shaped face rash</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="skin_symptoms[]" value="silvery_scales"
                                    {{ in_array('silvery_scales', old('skin_symptoms', [])) ? 'checked' : '' }}>
                                <label>Silvery scales</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="skin_symptoms[]" value="sun_sensitivity"
                                    {{ in_array('sun_sensitivity', old('skin_symptoms', [])) ? 'checked' : '' }}>
                                <label>Worsens with sun</label>
                            </div>
                            <div class="checkbox-item">
                                <input type="checkbox" name="skin_symptoms[]" value="none"
                                    {{ in_array('none', old('skin_symptoms', [])) ? 'checked' : '' }}>
                                <label>None of these</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 👁️ EYE -->
                <div class="symptom-group eye-group">
                    <h3>👁️ Eye Symptoms</h3>
                    <div class="form-group checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="eyeIssue" name="main_symptoms[]" value="Eye Issues"
                                {{ in_array('Eye Issues', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Eye Problems</label>
                        </div>
                    </div>

                    <!-- Eye Detail -->
                    <div id="eyeSection" class="form-group" style="display:none;">
                        <select name="eye_symptoms">
                            <option value="">Select</option>
                            <option value="none" {{ old('eye_symptoms') == 'none' ? 'selected' : '' }}>No symptoms</option>
                            <option value="dry_eyes" {{ old('eye_symptoms') == 'dry_eyes' ? 'selected' : '' }}>Dry eyes</option>
                            <option value="red_painful" {{ old('eye_symptoms') == 'red_painful' ? 'selected' : '' }}>Red/painful eyes</option>
                            <option value="vision_changes" {{ old('eye_symptoms') == 'vision_changes' ? 'selected' : '' }}>Vision changes</option>
                            <option value="uveitis" {{ old('eye_symptoms') == 'uveitis' ? 'selected' : '' }}>Uveitis (diagnosed)</option>
                        </select>
                    </div>
                </div>

                <!-- 🍽️ DIGESTIVE -->
                <div class="symptom-group digestive-group">
                    <h3>🍽️ Digestive</h3>
                    <div class="form-group checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" id="digestiveIssues" name="main_symptoms[]" value="Digestive Issues"
                                {{ in_array('Digestive Issues', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Digestive Issues</label>
                        </div>
                    </div>

                    <!-- Digestive Detail -->
                    <div id="digestiveSection" class="form-group" style="display:none;">
                        <select name="digestive_pattern">
                            <option value="">Select pattern</option>
                            <option value="none" {{ old('digestive_pattern') == 'none' ? 'selected' : '' }}>No issues</option>
                            <option value="pain_relief" {{ old('digestive_pattern') == 'pain_relief' ? 'selected' : '' }}>Relief after bowel movement</option>
                            <option value="blood_stool" {{ old('digestive_pattern') == 'blood_stool' ? 'selected' : '' }}>Blood/mucus in stool</option>
                            <option value="worse_food" {{ old('digestive_pattern') == 'worse_food' ? 'selected' : '' }}>Worse after eating</option>
                            <option value="bloating" {{ old('digestive_pattern') == 'bloating' ? 'selected' : '' }}>Bloating/gas</option>
                        </select>
                    </div>
                </div>






                <!-- Trigger Identification -->
                <div class="form-group">
                    <label>What triggers symptom flares? (Select top 2)</label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="stress"
                                {{ in_array('stress', old('triggers', [])) ? 'checked' : '' }}>
                            <label>Stress</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="food"
                                {{ in_array('food', old('triggers', [])) ? 'checked' : '' }}>
                            <label>Specific foods</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="infection"
                                {{ in_array('infection', old('triggers', [])) ? 'checked' : '' }}>
                            <label>Infections/colds</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="weather"
                                {{ in_array('weather', old('triggers', [])) ? 'checked' : '' }}>
                            <label>Damp weather</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="hormonal"
                                {{ in_array('hormonal', old('triggers', [])) ? 'checked' : '' }}>
                            <label>Menstrual cycle</label>
                        </div>
                                <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="respiratory"
                                {{ in_array('respiratory', old('triggers', [])) ? 'checked' : '' }}>
                            <label>Respiratory</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="triggers[]" value="none"
                                {{ in_array('none', old('triggers', [])) ? 'checked' : '' }}>
                            <label>None identified</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Symptom Duration <span class="required">*</span></label>
                    <select name="symptom_duration" required>
                        <option value="">Select Duration</option>
                        <option value="Less than 1 week" {{ old('symptom_duration') == 'Less than 1 week' ? 'selected' : '' }}>Less than 1 week</option>
                        <option value="1-4 weeks" {{ old('symptom_duration') == '1-4 weeks' ? 'selected' : '' }}>1-4 weeks</option>
                        <option value="1-3 months" {{ old('symptom_duration') == '1-3 months' ? 'selected' : '' }}>1-3 months</option>
                        <option value="3-6 months" {{ old('symptom_duration') == '3-6 months' ? 'selected' : '' }}>3-6 months</option>
                        <option value="6-12 months" {{ old('symptom_duration') == '6-12 months' ? 'selected' : '' }}>6-12 months</option>
                        <option value="More than 1 year" {{ old('symptom_duration') == 'More than 1 year' ? 'selected' : '' }}>More than 1 year</option>
                    </select>
                </div>

                <!-- Pain Level -->
                <div class="form-group">
                    <label>Pain Level (1-10) <span class="required">*</span></label>
                    <div class="slider-container">
                        <input type="range" name="pain_level" min="1" max="10" value="{{ old('pain_level', 5) }}"
                               oninput="document.getElementById('painValue').textContent = this.value">
                        <span class="slider-value">Current: <span id="painValue">{{ old('pain_level', 5) }}</span>/10</span>
                        <div class="scale-labels">
                            <span>1 (Mild)</span>
                            <span>10 (Severe)</span>
                        </div>
                    </div>
                </div>

                <!-- Fatigue Level -->
                <div class="form-group">
                    <label>Fatigue Level (1-10) <span class="required">*</span></label>
                    <div class="slider-container">
                        <input type="range" name="fatigue_level" min="1" max="10" value="{{ old('fatigue_level', 5) }}"
                               oninput="document.getElementById('fatigueValue').textContent = this.value">
                        <span class="slider-value">Current: <span id="fatigueValue">{{ old('fatigue_level', 5) }}</span>/10</span>
                        <div class="scale-labels">
                            <span>1 (No fatigue)</span>
                            <span>10 (Extreme fatigue)</span>
                        </div>
                    </div>
                </div>
                <!-- Impact on Daily Life -->
                <div class="form-group">
                    <label>How much do symptoms impact your daily life? (1-10) <span class="required">*</span></label>
                    <div class="slider-container">
                        <input type="range" name="impact_on_daily_life" min="1" max="10" value="{{ old('impact_on_daily_life', 5) }}"
                            oninput="document.getElementById('impactValue').textContent = this.value">
                        <span class="slider-value">Current: <span id="impactValue">{{ old('impact_on_daily_life', 5) }}</span>/10</span>
                        <div class="scale-labels">
                            <span>1 (No impact)</span>
                            <span>10 (Can't function)</span>
                        </div>
                    </div>
                    <small style="color: #666;">How much do your symptoms interfere with work, household, or social activities?</small>
                </div>
                <!-- Find this in your checksurvey.blade.php -->


<!-- ================================== -->
<!-- END OF NEW QUESTIONS -->
<!-- The next line should be the closing </div> for Section 2 -->
 <!-- This closes the <div class="form-section"> for Symptoms Assessment -->
            </div>
            

            

            <!-- Section 3: Lifestyle & Diet -->
            <div class="form-section">
                <h2 class="section-title">🥗 Lifestyle & Diet</h2>

                <div class="form-group">
                    <label>Describe your typical diet <span class="required">*</span></label>
                    <textarea name="diet_description" required placeholder="What do you typically eat in a day? Include breakfast, lunch, dinner, snacks...">{{ old('diet_description') }}</textarea>
                    <small style="color: #666;">Please provide at least 50 characters for better analysis</small>
                </div>

                <div class="form-group">
                    <label>Sleep Quality (1-10) <span class="required">*</span></label>
                    <div class="slider-container">
                        <input type="range" name="sleep_quality" min="1" max="10" value="{{ old('sleep_quality', 5) }}"
                               oninput="document.getElementById('sleepValue').textContent = this.value">
                        <span class="slider-value">Current: <span id="sleepValue">{{ old('sleep_quality', 5) }}</span>/10</span>
                        <div class="scale-labels">
                            <span>1 (Poor)</span>
                            <span>10 (Excellent)</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Average Sleep Duration (hours) <span class="required">*</span></label>
                    <select name="sleep_duration" required>
                        <option value="">Select Hours</option>
                        <option value="Less than 5" {{ old('sleep_duration') == 'Less than 5' ? 'selected' : '' }}>Less than 5 hours</option>
                        <option value="5-6" {{ old('sleep_duration') == '5-6' ? 'selected' : '' }}>5-6 hours</option>
                        <option value="6-7" {{ old('sleep_duration') == '6-7' ? 'selected' : '' }}>6-7 hours</option>
                        <option value="7-8" {{ old('sleep_duration') == '7-8' ? 'selected' : '' }}>7-8 hours</option>
                        <option value="8+" {{ old('sleep_duration') == '8+' ? 'selected' : '' }}>8+ hours</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Stress Level (1-10) <span class="required">*</span></label>
                    <div class="slider-container">
                        <input type="range" name="stress_level" min="1" max="10" value="{{ old('stress_level', 5) }}"
                               oninput="document.getElementById('stressValue').textContent = this.value">
                        <span class="slider-value">Current: <span id="stressValue">{{ old('stress_level', 5) }}</span>/10</span>
                        <div class="scale-labels">
                            <span>1 (No stress)</span>
                            <span>10 (Extreme stress)</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Daily Water Consumption (glasses) <span class="required">*</span></label>
                    <select name="water_consumption" required>
                        <option value="">Select</option>
                        @for($i = 1; $i <= 15; $i++)
                            <option value="{{ $i }}" {{ old('water_consumption') == $i ? 'selected' : '' }}>
                                {{ $i }} {{ $i == 1 ? 'glass' : 'glasses' }}
                            </option>
                        @endfor
                    </select>
                </div>
            </div>

            <!-- Section 4: Habits -->
            <div class="form-section">
                <h2 class="section-title">🚬 Habits</h2>

                <div class="form-group">
                    <label>Smoking Status <span class="required">*</span></label>
                    <select name="smoking_status" required>
                        <option value="">Select</option>
                        <option value="Non-smoker" {{ old('smoking_status') == 'Non-smoker' ? 'selected' : '' }}>Non-smoker</option>
                        <option value="Occasional" {{ old('smoking_status') == 'Occasional' ? 'selected' : '' }}>Occasional</option>
                        <option value="Regular" {{ old('smoking_status') == 'Regular' ? 'selected' : '' }}>Regular</option>
                        <option value="Former smoker" {{ old('smoking_status') == 'Former smoker' ? 'selected' : '' }}>Former smoker</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Alcohol Consumption <span class="required">*</span></label>
                    <select name="alcohol_consumption" required>
                        <option value="">Select</option>
                        <option value="Non-drinker" {{ old('alcohol_consumption') == 'Non-drinker' ? 'selected' : '' }}>Non-drinker</option>
                        <option value="Occasionally" {{ old('alcohol_consumption') == 'Occasionally' ? 'selected' : '' }}>Occasionally</option>
                        <option value="Moderately" {{ old('alcohol_consumption') == 'Moderately' ? 'selected' : '' }}>Moderately</option>
                        <option value="Heavily" {{ old('alcohol_consumption') == 'Heavily' ? 'selected' : '' }}>Heavily</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Physical Activity Level <span class="required">*</span></label>
                    <select name="physical_activity_level" required>
                        <option value="">Select</option>
                        <option value="Sedentary" {{ old('physical_activity_level') == 'Sedentary' ? 'selected' : '' }}>Sedentary (little to no exercise)</option>
                        <option value="Light" {{ old('physical_activity_level') == 'Light' ? 'selected' : '' }}>Light (1-2 days/week)</option>
                        <option value="Moderate" {{ old('physical_activity_level') == 'Moderate' ? 'selected' : '' }}>Moderate (3-5 days/week)</option>
                        <option value="Active" {{ old('physical_activity_level') == 'Active' ? 'selected' : '' }}>Active (daily exercise)</option>
                        <option value="Athlete" {{ old('physical_activity_level') == 'Athlete' ? 'selected' : '' }}>Athlete (intense training)</option>
                    </select>
                </div>
            </div>

            <!-- Section 5: Medical History -->
            <div class="form-section">
                <h2 class="section-title">🏥 Medical History</h2>

                <div class="form-group">
                    <label>Existing Diagnosis (if any)</label>
                    <input type="text" name="existing_diagnosis" value="{{ old('existing_diagnosis') }}"
                           placeholder="e.g., Rheumatoid Arthritis, Diabetes, etc.">
                </div>

                <div class="form-group">
                    <label>Current Medications</label>
                    <textarea name="medications" placeholder="List any medications you're currently taking">{{ old('medications') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Family History of Autoimmune Diseases</label>
                    <textarea name="family_history" placeholder="Any family history of autoimmune diseases?">{{ old('family_history') }}</textarea>
                </div>

                <div class="form-group">
                    <label>Additional Notes</label>
                    <textarea name="diagnosis_details" placeholder="Any other health concerns or details...">{{ old('diagnosis_details') }}</textarea>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="form-section">
                <button type="submit" class="submit-btn">
                    📊 Generate My Analysis Report
                </button>
            </div>
        </form>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const autoimmuneType = document.getElementById('autoimmuneType');
    const joint = document.getElementById('jointPain');
    const skin = document.getElementById('skinRash');
    const digestive = document.getElementById('digestiveIssues');
    const eyeSection = document.getElementById('eyeSection');
    const jointSection = document.getElementById('jointSection');
    const skinSection = document.getElementById('skinSection');
    const eye = document.getElementById('eyeIssue');
    const digestiveSection = document.getElementById('digestiveSection');

    function filterSymptoms() {

        const type = autoimmuneType.value;

        // reset semua detail bila tukar type
        jointSection.style.display = 'none';
        skinSection.style.display = 'none';
        eyeSection.style.display = 'none';
        digestiveSection.style.display = 'none';

        // reset checkbox untuk section yang hide
        document.querySelectorAll('.symptom-group').forEach(group => {
            if (window.getComputedStyle(group).display === 'none') {
                group.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = false);
            }
        });

        // reset semua dulu
        document.querySelectorAll('.symptom-group').forEach(el => {
            el.style.display = 'block';
        });

        // kalau tak pilih → show semua
        if (!type) return;

        // hide semua dulu (except general)
        document.querySelectorAll('.symptom-group').forEach(el => {
            if (!el.classList.contains('general-group')) {
                el.style.display = 'none';
            }
        });

        // SHOW BASED ON TYPE
        if (type === 'Lupus') {
            document.querySelectorAll('.skin-group, .eye-group').forEach(el => el.style.display = 'block');
        }

        if (type === 'Rheumatoid Arthritis') {
            document.querySelectorAll('.joint-group, .eye-group').forEach(el => el.style.display = 'block');
        }

        if (type === 'Psoriasis') {
            document.querySelectorAll('.skin-group, .eye-group').forEach(el => el.style.display = 'block');
        }
    }

    // trigger bila tukar dropdown
    autoimmuneType.addEventListener('change', filterSymptoms);

    // run on load
    filterSymptoms();

    function toggleSections() {
        // Joint → stiffness
        if (joint && joint.offsetParent !== null) {
            jointSection.style.display = joint.checked ? 'block' : 'none';
        }

        // Skin → skin details + eye (optional link)
        skinSection.style.display = skin.checked ? 'block' : 'none';

        // Eye (kau boleh decide logic)
        eyeSection.style.display = eye.checked ? 'block' : 'none';

        // Digestive
        digestiveSection.style.display = digestive.checked ? 'block' : 'none';
    }

    document.querySelectorAll('input[name="triggers[]"]').forEach(cb => {
            cb.addEventListener('change', function () {

                if (this.value === 'none' && this.checked) {
                    document.querySelectorAll('input[name="triggers[]"]').forEach(c => {
                        if (c.value !== 'none') c.checked = false;
                    });
                }

                if (this.value !== 'none' && this.checked) {
                    document.querySelector('input[value="none"]').checked = false;
                }
            });
        });


    // trigger bila click
    document.querySelectorAll('input[name="main_symptoms[]"]').forEach(cb => {
        cb.addEventListener('change', toggleSections);
    });

    // run on load (for old value)
    toggleSections();

            const successAlert = document.getElementById('successAlert');
        const errorAlert = document.getElementById('errorAlert');
        const validationAlert = document.getElementById('validationAlert');

        // Show alerts if they exist
        if (successAlert) {
            successAlert.style.display = 'block';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000);
        }

        if (errorAlert || validationAlert) {
            if (errorAlert) errorAlert.style.display = 'block';
            if (validationAlert) validationAlert.style.display = 'block';
        }

        // Form validation
        const form = document.getElementById('medicalSurveyForm');
        form.addEventListener('submit', function(event) {
            let isValid = true;
            
            // 2. Check if at least one symptom is selected
            const symptomCheckboxes = document.querySelectorAll('input[name="main_symptoms[]"]:checked');
            if (symptomCheckboxes.length === 0) {
                alert('Please select at least one symptom.');
                isValid = false;
            }

            // 3. Validate triggers (max 2)
            const triggerCheckboxes = document.querySelectorAll('input[name="triggers[]"]:checked');
            if (triggerCheckboxes.length > 2) {
                alert('Please select maximum 2 triggers only.');
                isValid = false;
            }

            // 4. Validate at least one trigger OR "none" is selected
            if (triggerCheckboxes.length === 0) {
                alert('Please select at least one trigger or choose "None identified".');
                isValid = false;
            }

            // 5. Validate skin symptoms (at least one OR "none" selected)
            if (skin.checked) {
                const skinChecked = document.querySelectorAll('input[name="skin_symptoms[]"]:checked');
                if (skinChecked.length === 0) {
                    alert('Please select at least one skin symptom.');
                    isValid = false;
                }
            }

            // 6. Validate morning stiffness is selected
            if (joint.checked && joint.offsetParent !== null) {
                const morningStiffness = document.querySelector('[name="morning_stiffness"]').value;
                if (!morningStiffness) {
                    alert('Please select morning stiffness duration.');
                    isValid = false;
                }
            }

            // 7. Validate eye symptoms is selected
            if (eye.checked) {
                const eyeSymptoms = document.querySelector('[name="eye_symptoms"]').value;
                if (!eyeSymptoms) {
                    alert('Please select eye symptoms.');
                    isValid = false;
                }
            }

            // 8. Validate digestive pattern is selected
            if (digestive.checked) {
                const digestivePattern = document.querySelector('[name="digestive_pattern"]').value;
                if (!digestivePattern) {
                    alert('Please select digestive pattern.');
                    isValid = false;
                }
            }

            // If any validation failed, prevent form submission
            if (!isValid) {
                event.preventDefault();
                return false;
            }

            // If "none" is selected with other skin symptoms, confirm with user
            const skinCheckboxes = document.querySelectorAll('input[name="skin_symptoms[]"]:checked');
            const noneSkinSelected = Array.from(skinCheckboxes).some(cb => cb.value === 'none');
            if (noneSkinSelected && skinCheckboxes.length > 1) {
                if (!confirm('You selected "None of these" with other skin symptoms. Continue?')) {
                    event.preventDefault();
                    return false;
                }
            }

            // If "none" is selected with other triggers, confirm with user
            const noneTrigger = Array.from(triggerCheckboxes).some(cb => cb.value === 'none');
            if (noneTrigger && triggerCheckboxes.length > 1) {
                if (!confirm('You selected "None identified" with other triggers. Continue?')) {
                    event.preventDefault();
                    return false;
                }
            }

            // All validations passed
            return true;
});
    });
</script>

@endsection