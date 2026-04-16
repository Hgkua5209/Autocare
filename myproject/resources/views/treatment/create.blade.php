@extends('layouts.app')

@section('content')

<div class="create-wrapper">

    <div class="form-card">
        
        <h2 class="form-title">+ Create Treatment Card</h2>
        <p class="form-subtitle">Add a new treatment plan for autoimmune care</p>

        <form action="{{ route('treatment.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" placeholder="e.g. Anti-inflammatory Diet" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Type</label>
                    <select name="type">
                        <option value="Medical">Medical</option>
                        <option value="Diet">Diet</option>
                        <option value="Lifestyle">Lifestyle</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Level</label>
                    <select name="level">
                        <option value="Easy">Easy</option>
                        <option value="Moderate">Moderate</option>
                        <option value="High">High</option>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Describe the treatment..."></textarea>
            </div>

            <div class="form-group">
                <label>Research Link</label>
                <input type="url" name="research" placeholder="https://example.com/research-study">
            </div>

            <div class="form-group">
                <label>Steps</label>
                <textarea name="steps" placeholder="Step-by-step guide..."></textarea>
            </div>

            <div class="form-group">
                <label>Category</label>
                <select name="category">
                    <option value="emergency">Emergency</option>
                    <option value="recommended">Recommended</option>
                </select>
            </div>

            <button type="submit" class="submit-btn">Save Treatment</button>

        </form>
    </div>

</div>

<style>

/* Background */

.main-content {
    padding: 0 !important;
}

.create-wrapper {
    min-height: 100vh;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 40px 20px;
}

/* Card */
.form-card {
    max-width: 800px;
    margin: auto;
    background: #ffffff;
    padding: 40px;
    border-radius: 20px;

    /* ✨ tambah ni */
    box-shadow: 
        0 10px 30px rgba(0,0,0,0.08),
        0 2px 10px rgba(0,0,0,0.05);

    border: 1px solid #f1f5f9;
}

/* Title */
.form-title {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 5px;
}

.form-subtitle {
    color: #64748b;
    margin-bottom: 30px;
}

/* Group */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #334155;
}

/* Inputs */
.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 13px 15px;
    border-radius: 12px;

    /* ❌ buang border lama */
    border: none;

    /* ✨ gantikan dengan ni */
    background: #f8fafc;
    box-shadow: inset 0 0 0 1px #e2e8f0;

    outline: none;
    transition: all 0.25s ease;
    font-size: 14px;
}

/* Focus effect */
.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    background: #ffffff;

    box-shadow: 
        inset 0 0 0 2px #667eea,
        0 5px 15px rgba(102,126,234,0.15);
}

/* Textarea */
textarea {
    min-height: 100px;
    resize: vertical;
}

/* Row (2 column) */
.form-row {
    display: flex;
    gap: 15px;
}

.form-row .form-group {
    flex: 1;
}

/* Button */
.submit-btn {
    width: 100%;
    padding: 14px;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s;
}

/* Hover */
.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(0,0,0,0.15);
}

</style>

@endsection