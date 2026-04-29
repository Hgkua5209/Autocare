
<form method="POST" action="{{ route('daily.store') }}">
        @csrf

    <div class="form-grid">

        <div class="form-group">
            <label>Pain Level</label>
            <input type="number" name="pain_level">
        </div>

        <div class="form-group">
            <label>Fatigue Level</label>
            <input type="number" name="fatigue_level">
        </div>

        <div class="form-group">
            <label>Stress Level</label>
            <input type="number" name="stress_level">
        </div>

        <div class="form-group">
            <label>Sleep Hours</label>
            <input type="number" name="sleep_hours">
        </div>

        <div class="form-group">
            <label>Water Intake</label>
            <input type="number" name="water_intake">
        </div>

        <div class="form-group">
            <label>Activity Level</label>
            <select name="activity_level">
                <option>Low</option>
                <option>Moderate</option>
                <option>High</option>
            </select>
        </div>

        <div class="form-group">
            <label>Food Intake</label>
            <input type="text" name="food_intake" placeholder="e.g. Rice, chicken">
        </div>

        <div class="form-group">
            <label>Triggers</label>
            <input type="text" name="triggers" placeholder="e.g. stress, cold weather">
        </div>
                <div class="form-group">
            <label>Medication</label>
            <select name="took_medication">
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="form-group full-width">
            <label>Symptoms</label>
            <div class="checkbox-group">
                <label><input type="checkbox" name="symptoms[]" value="joint_pain"> Joint Pain</label>
                <label><input type="checkbox" name="symptoms[]" value="fatigue"> Fatigue</label>
            </div>
        </div>


<div class="form-group center-item">
            <label>Overall Condition</label>
            <input type="number" name="overall_condition">
        </div>

    </div>

    <button class="submit-btn">Submit Day</button>
</form>

<style>

.form-grid {
    display: grid;
    background: rgba(255,255,255,0.03);
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
    margin-top: 20px;
    padding: 25px;
    border-radius: 16px;
    width: 100%;
    max-width: 900px; /* 🔥 control size */
    margin: 20px auto; /* 🔥 NI PENTING */

}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    margin-bottom: 8px;
    font-size: 15px;   /* 🔥 BESARKAN */
    font-weight: 500;  /* 🔥 bagi tebal sikit */
    color: #ddd;
}

.form-group input,
.form-group select {
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #ccc;
    background: #fff;      /* 🔥 putih */
    color: #333;           /* 🔥 hitam */
}
.form-group input:focus,
.form-group select:focus {
    outline: none;
    border-color: #2979ff;
    box-shadow: 0 0 5px rgba(41,121,255,0.5);
}
.form-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 🔥 INI PENTING */
    gap: 20px;
}

.checkbox-group {
    display: flex;
    gap: 20px;
    color: #ddd;
}

.submit-btn {
    margin-top: 25px;
    padding: 12px 25px;
    background: #00c853;
    border: none;
    border-radius: 12px;
    color: white;
    cursor: pointer;
        font-size: 15px;
    font-weight: 600;
    background: linear-gradient(45deg, #00c853, #00e676);

    align-self: center; /* 🔥 tengah */
}

.center-item {
    grid-column: span 2; /* cukup dah */
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 15px;
}

.center-item input {
    width: 250px; /* kecil sikit bagi nampak center */
}
</style>