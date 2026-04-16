<div class="sidebar">

<div class="logo">
    <a href="{{ route('dashboard') }}" style="text-decoration: none;">
        <h1 class="logo-text">
            AutoCare<span>Compass</span>
        </h1>
    </a>
</div>
    
    <div class="nav-menu">
        <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>

        <a href="{{ route('medical.survey') }}" class="nav-item {{ request()->routeIs('medical.survey') ? 'active' : '' }}">
            <i class="fas fa-user-md"></i>
            <span>Check condition</span>
        </a>

        <a href="#" class="nav-item">
            <i class="fas fa-chart-line"></i>
            <span>Health Trends</span>
        </a>

        <a href="{{ route('treatment') }}" class="nav-item {{ request()->routeIs('treatment') ? 'active' : '' }}">
            <i class="fas fa-pills"></i>
            <span>Treatment Hub</span>
        </a>

        <a href="{{ route('food.hub') }}" class="nav-item {{ request()->routeIs('food.hub') ? 'active' : '' }}">
            <i class="fas fa-utensils"></i>
            <span>Food Hub</span>
        </a>

        <a href="#" class="nav-item">
            <i class="fas fa-calendar-check"></i>
            <span>Community</span>
        </a>

        <a href="#" class="nav-item">
            <i class="fas fa-cog"></i>
            <span>Settings</span>
        </a>
    </div>

    <div class="user-profile">
        <div class="user-avatar">
            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
        </div>
        <div class="user-info">
            <h4>{{ auth()->user()->name ?? 'User' }}</h4>
            <p>Member</p>
        </div>
    </div>

</div>

