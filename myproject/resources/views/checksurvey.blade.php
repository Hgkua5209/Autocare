<!DOCTYPE html>
<html lang="en">
    <!-- test -->
<head>
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

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
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
</head>
<body>

    <div class="container">
        <div class="header">
            <h1>🏥 AutoCare Compass</h1>
            <p>Complete this survey for personalized autoimmune analysis</p>
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
        </div>

            <!-- Section 2: Symptoms -->
            <div class="form-section">
                <h2 class="section-title">🤒 Symptoms Assessment</h2>

                <div class="form-group">
                    <label>Main Symptoms (Select all that apply) <span class="required">*</span></label>
                    <div class="checkbox-group">
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Joint Pain"
                                {{ in_array('Joint Pain', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Joint Pain</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Fatigue"
                                {{ in_array('Fatigue', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Fatigue</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Brain Fog"
                                {{ in_array('Brain Fog', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Brain Fog</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Skin Rash"
                                {{ in_array('Skin Rash', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Skin Rash</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Muscle Pain"
                                {{ in_array('Muscle Pain', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Muscle Pain</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Digestive Issues"
                                {{ in_array('Digestive Issues', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Digestive Issues</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Hair Loss"
                                {{ in_array('Hair Loss', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Hair Loss</label>
                        </div>
                        <div class="checkbox-item">
                            <input type="checkbox" name="main_symptoms[]" value="Fever"
                                {{ in_array('Fever', old('main_symptoms', [])) ? 'checked' : '' }}>
                            <label>Fever</label>
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
        // Show alerts
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            const validationAlert = document.getElementById('validationAlert');

            // Check diet length
            if (dietText.length < 50) { // Changed from 5 to 50 to match your helper text
                alert('Please provide more details about your diet (at least 50 characters).');
                event.preventDefault();
                return false;
            }

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
                const dietText = document.querySelector('[name="diet_description"]').value;
                if (dietText.length < 5) {
                    alert('Please provide more details about your diet (at least 50 characters).');
                    event.preventDefault();
                    return false;
                }

                // Check if at least one symptom is selected
                const checkboxes = document.querySelectorAll('input[name="main_symptoms[]"]:checked');
                if (checkboxes.length === 0) {
                    alert('Please select at least one symptom.');
                    event.preventDefault();
                    return false;
                }
            });
        });
    </script>
</body>
</html>
