<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autocare Compass</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
  <body>
    <nav>
      <div class="nav__header">
        <div class="nav__logo">
          <a href="#">
            <img src="/images/logo.png" alt="logo" class="logo-white" />
            <img src="/images/logo.png" alt="logo" class="logo-dark" />
          </a>
        </div>
        <div class="nav__menu__btn" id="menu-btn">
          <i class="ri-menu-4-line"></i>
        </div>
      </div>
        <ul class="nav__links" id="nav-links">
            <li><a href="#">HOME</a></li>
            <li><a href="#">SERVICE</a></li>

            @guest
                <li><a href="{{ route('register') }}">REGISTER</a></li>
                <li><a href="{{ route('login') }}">LOG IN</a></li>
            @endguest

            @auth
                <li>
                    <a href="{{ route('dashboard') }}" class="font-bold text-primary">
                        <i class="ri-user-line"></i> {{ Auth::user()->name }}
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="font-medium text-red-500">LOGOUT</button>
                    </form>
                </li>
            @endauth
        </ul>
    </nav>

    <header>
      <div class="header__image">
        <img src="/images/foto.png" alt="header" />
      </div>
      <div class="header__content">
        <h2>JOIN OUR COMMUNITY</h2>
        <h1>Smart Autoimmune Compass</h1>
        <p>
Monitor your condition, track progress, and discover diet plans built specifically for autoimmune wellness.
        </p>
        <div class="header__btn">
            @auth
                <button onclick="window.location.href='{{ route('dashboard') }}'">Explore Dashboard</button>
            @else
                <button onclick="window.location.href='{{ route('login') }}'">Explore</button>
            @endauth
        </div>
        <ul class="header__socials">
          <li>
            <a href="#"><i class="ri-facebook-fill"></i></a>
          </li>
          <li>
            <a href="#"><i class="ri-twitter-fill"></i></a>
          </li>
          <li>
            <a href="#"><i class="ri-instagram-line"></i></a>
          </li>
        </ul>
      </div>
    </header>

    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="main.js"></script>
  </body>

  <script>
    const menuBtn = document.getElementById("menu-btn");
const navLinks = document.getElementById("nav-links");
const menuBtnIcon = menuBtn.querySelector("i");

menuBtn.addEventListener("click", () => {
  navLinks.classList.toggle("open");

  const isOpen = navLinks.classList.contains("open");
  menuBtnIcon.setAttribute(
    "class",
    isOpen ? "ri-close-line" : "ri-menu-4-line"
  );
});

navLinks.addEventListener("click", () => {
  navLinks.classList.remove("open");
  menuBtnIcon.setAttribute("class", "ri-menu-4-line");
});

const scrollRevealOption = {
  distance: "50px",
  origin: "bottom",
  duration: 1000,
};

ScrollReveal().reveal(".header__image img", {
  ...scrollRevealOption,
  origin: "right",
});
ScrollReveal().reveal(".header__content h2", {
  ...scrollRevealOption,
  delay: 500,
});
ScrollReveal().reveal(".header__content h1", {
  ...scrollRevealOption,
  delay: 1000,
});
ScrollReveal().reveal(".header__content p", {
  ...scrollRevealOption,
  delay: 1500,
});
ScrollReveal().reveal(".header__btn", {
  ...scrollRevealOption,
  delay: 2000,
});
ScrollReveal().reveal(".header__socials li", {
  ...scrollRevealOption,
  delay: 2500,
  interval: 500,
});
  </script>
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap");

:root {
  --primary-color: #1e2478;
  --primary-color-dark: #1e2478;
  --text-dark: #333333;
  --white: #ffffff;
  --max-width: 1200px;
}

* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

img {
  display: flex;
  width: 100%;
}

a {
  text-decoration: none;
  transition: 0.3s;
}

ul {
  list-style: none;
}

body {
  font-family: "Montserrat", sans-serif;
}

nav {
  position: fixed;
  isolation: isolate;
  width: 100%;
  z-index: 9;
}

.nav__header {
  padding: 1rem;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background-color: var(--primary-color);
}

.nav__logo a img {
  max-width: 100px;
}

.nav__logo .logo-dark {
  display: none;
}

.nav__menu__btn {
  font-size: 1.5rem;
  color: var(--white);
  cursor: pointer;
}

.nav__links {
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  gap: 2rem;
  padding: 2rem;
  background-color: var(--primary-color);
  transition: transform 0.5s;
  z-index: -1;
}

.nav__links.open {
  transform: translateY(100%);
}

.nav__links a {
  font-weight: 500;
  color: var(--white);
  white-space: nowrap;
}

header {
  max-width: var(--max-width);
  margin: auto;
  padding: 2rem 1rem;

  display: grid;
  gap: 4rem 1rem;
}

.header__image {
  overflow: hidden;
}

.header__image img {
  max-width: 1200px;
  margin-inline: auto;
}

.header__content h2 {
  font-size: 2rem;
  font-weight: 700;
  color: var(--primary-color);
  text-align: center;
}

.header__content h1 {
  margin-bottom: 1rem;
  font-size: 4rem;
  font-weight: 800;
  line-height: 4.5rem;
  color: var(--text-dark);
  text-align: center;
}

.header__content p {
  margin-bottom: 2rem;
  font-weight: 500;
  line-height: 1.75rem;
  color: var(--text-dark);
  text-align: center;
}

.header__btn {
  margin-bottom: 5rem;
  text-align: center;
}

.header__btn button {
  padding: 1rem 1.5em;
  outline: none;
  border: none;
  font-size: 1rem;
  font-weight: 600;
  color: var(--white);
  background-color: var(--primary-color);
  border-radius: 5rem;
  transition: 0.3s;
  cursor: pointer;
}

.header__btn button:hover {
  background-color: var(--primary-color-dark);
}

.header__socials {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
}

.header__socials a {
  padding: 8px 10px;
  font-size: 1.5rem;
  color: var(--white);
  background-color: var(--primary-color);
  border-radius: 100%;
}

.header__socials a:hover {
  background-color: var(--primary-color-dark);
}

@media (width > 768px) {
  nav {
    position: static;
    padding: 2rem 1rem 1rem;
    max-width: var(--max-width);
    margin-inline: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .nav__header {
    padding: 0;
    background-color: transparent;
  }

  .nav__logo a img {
    max-width: 40px;
  }

  .nav__logo .logo-dark {
    display: flex;
  }

  .nav__logo .logo-white {
    display: none;
  }

  .nav__menu__btn {
    display: none;
  }

  .nav__links {
    position: static;
    width: fit-content;
    padding: 0;
    flex-direction: row;
    background-color: transparent;
    transform: none !important;
  }

  .nav__links a {
    font-weight: 600;
    color: var(--text-dark);
  }

  .nav__links a:hover {
    color: var(--primary-color);
  }

  header {
    grid-template-columns: repeat(2, 1fr);
    align-items: center;
  }

  .header__content {
    grid-area: 1/1/2/2;
  }

  .header__content :is(h2, h1, p, .header__btn) {
    text-align: left;
  }

  .header__socials {
    justify-content: flex-start;
  }

}
  </style>
</html>

