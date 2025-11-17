<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="./assets/notesLogo.png" type="image/x-icon" />
    <title>About Us - Taskify</title>
    <link rel="stylesheet" href="style.css">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");

      :root {
        --primary: #8b5cf6;
        --secondary: #06b6d4;
        --accent: #f59e0b;
        --glass-bg: rgba(255, 255, 255, 0.15);
        --glass-border: rgba(255, 255, 255, 0.2);
        --glass-shadow: rgba(0, 0, 0, 0.1);
      }

      body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        position: relative;
        overflow-x: hidden;
      }

      body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: radial-gradient(
            circle at 10% 20%,
            rgba(255, 94, 247, 0.18) 0%,
            transparent 20%
          ),
          radial-gradient(
            circle at 90% 80%,
            rgba(120, 119, 198, 0.15) 0%,
            transparent 20%
          ),
          radial-gradient(
            circle at 30% 60%,
            rgba(255, 119, 119, 0.1) 0%,
            transparent 20%
          );
        z-index: -1;
      }

      .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        box-shadow: 0 8px 32px var(--glass-shadow);
        border-radius: 20px;
        transition: all 0.3s ease;
      }

      .glass-sidebar {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-right: 1px solid rgba(255, 255, 255, 0.2);
      }

      .gradient-text {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .sidebar-link {
        border-radius: 12px;
        transition: all 0.3s ease;
        color: rgba(255, 255, 255, 0.8);
      }

      .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        transform: translateX(5px);
      }

      .sidebar-link.active {
        background: rgba(255, 255, 255, 0.2);
        color: white;
      }

      .testimonial-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border-radius: 16px;
        transition: all 0.3s ease;
      }

      .testimonial-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
      }

      .floating-bubble {
        position: fixed;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        filter: blur(40px);
        z-index: -1;
      }

      .bubble-1 {
        width: 300px;
        height: 300px;
        top: -100px;
        right: -100px;
        background: rgba(120, 119, 198, 0.3);
      }

      .bubble-2 {
        width: 200px;
        height: 200px;
        bottom: -50px;
        left: -50px;
        background: rgba(255, 119, 119, 0.2);
      }

      .bubble-3 {
        width: 150px;
        height: 150px;
        top: 50%;
        left: 10%;
        background: rgba(255, 94, 247, 0.2);
      }

      @keyframes float {
        0%,
        100% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-10px);
        }
      }

      .floating {
        animation: float 6s ease-in-out infinite;
      }

      .text-shadow {
        text-shadow: 0 0px 1px rgba(225, 225, 225, 0.7);
      }

      .glass-card p,
      .glass-card span:not(.gradient-text),
      .testimonial-card p,
      .testimonial-card span,
      .sidebar-link span {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
      }

      .main-content {
        margin-left: 0;
      }

      @media (min-width: 640px) {
        .main-content {
          margin-left: 16rem;
        }
      }

      @media (max-width: 640px) {
        #logo-sidebar {
          height: 100dvh;
        }
      }

      .transition-all {
        transition: all 0.3s ease;
      }
    </style>
  </head>
  <body class="min-h-screen text-white">
    <!-- Floating Background Elements -->
    <div class="floating-bubble bubble-1"></div>
    <div class="floating-bubble bubble-2"></div>
    <div class="floating-bubble bubble-3"></div>

    <!-- ##############    Sidebar    ################   -->
    <button
      type="button"
      id="openSidebarBtn"
      class="inline-flex items-center p-2 mt-2 ms-3 text-sm rounded-lg sm:hidden focus:outline-none glass-card"
    >
      <span class="sr-only">Open sidebar</span>
      <svg
        class="w-6 h-6"
        aria-hidden="true"
        fill="currentColor"
        viewBox="0 0 20 20"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          clip-rule="evenodd"
          fill-rule="evenodd"
          d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
        ></path>
      </svg>
    </button>

    <aside
      id="logo-sidebar"
      class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 glass-sidebar"
      aria-label="Sidebar"
    >
      <div class="h-full px-3 py-4 overflow-y-auto flex flex-col">
        <div class="flex justify-between items-center mb-5">
          <a href="/Taskify" class="flex items-center ps-2.5">
            <img
              src="./assets/notesLogo.png"
              class="h-6 me-3 sm:h-7"
              alt="Taskify Logo"
            />
            <span class="self-center text-xl font-semibold whitespace-nowrap text-white"
              >Taskify</span
            >
          </a>
          <button
            type="button"
            id="closeSidebarBtn"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm rounded-lg sm:hidden focus:outline-none glass-card"
          >
            <span class="sr-only">Close sidebar</span>
            <img src="./assets/X.svg" alt="X" class="h-5" />
          </button>
        </div>

        <ul class="space-y-2 font-medium">
          <li>
            <a
              href="/Taskify/"
              class="flex items-center p-2 rounded-lg sidebar-link"
            >
              <img src="./assets/allTodos.svg" alt="allTodos" class="h-4" />
              <span class="ms-3">Todos</span>
            </a>
          </li>
          <li>
            <a
              href="/Taskify/about.php"
              class="flex items-center p-2 rounded-lg sidebar-link active"
            >
              <img src="./assets/about.svg" alt="aboutUs" class="h-4" />
              <span class="flex-1 ms-3 whitespace-nowrap">About Us</span>
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <!-- ##############    Main Content    ################   -->
    <div class="main-content p-4 sm:ml-64">
      <!-- ##############    About us    ################   -->
      <div class="flex flex-col sm:flex-row items-center justify-center min-h-[80vh] py-8">
        <div class="w-full sm:w-1/2 p-4 sm:p-10 order-2 sm:order-1">
          <div class="text text-center sm:text-left">
            <span class="text-white/80 border-b-2 border-indigo-400 uppercase"
              >Himanshu</span
            >
            <h2 class="my-4 font-bold text-3xl sm:text-4xl">
              About <span class="gradient-text text-shadow">Taskify</span>
            </h2>
            <p class="text-white/90 leading-relaxed mb-4">
              Taskify is a thoughtfully designed productivity application
              created by
              <span class="gradient-text font-semibold text-shadow">Himanshu</span> to help
              users efficiently manage their daily tasks, notes, and reminders
              in a clean, intuitive interface.
            </p>
            <p class="text-white/90 leading-relaxed">
              Our mission is to simplify task management and help you stay
              organized with an elegant, user-friendly application that works
              seamlessly across all your devices.
            </p>
          </div>
        </div>
        <div class="w-full sm:w-1/2 p-4 sm:p-10 order-1 sm:order-2">
          <div class="image object-center text-center floating">
            <img
              src="https://i.imgur.com/WbQnbas.png"
              alt="Taskify App Illustration"
              class="mx-auto max-w-full h-auto"
            />
          </div>
        </div>
      </div>

      <!-- ##############    Testimonials    ################   -->
      <section class="py-12 sm:py-16 lg:py-20">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
          <div class="flex flex-col items-center">
            <div class="text-center">
              <p class="text-lg font-medium text-white/80 font-pj">
                2,157 people have said how good Taskify is
              </p>
              <h2 class="mt-4 text-3xl font-bold sm:text-4xl xl:text-5xl font-pj">
                Our happy clients say about us
              </h2>
            </div>

            <div class="mt-8 text-center md:mt-16 md:order-3">
              <a
                href="#"
                title=""
                class="pb-2 text-base font-bold leading-7 text-white transition-all duration-200 border-b-2 border-white/60 hover:border-white/40 font-pj focus:outline-none focus:ring-1 focus:ring-white focus:ring-offset-2 hover:text-white/80 text-shadow"
              >
                Check all 2,157 reviews
              </a>
            </div>

            <div class="relative mt-10 md:mt-24 md:order-2">
              <div class="absolute -inset-x-1 inset-y-16 md:-inset-x-2 md:-inset-y-6">
                <div
                  class="w-full h-full max-w-5xl mx-auto rounded-3xl opacity-30 blur-lg filter"
                  style="
                    background: linear-gradient(
                      90deg,
                      #44ff9a -0.55%,
                      #44b0ff 22.86%,
                      #8b44ff 48.36%,
                      #ff6644 73.33%,
                      #ebff70 99.34%
                    );
                  "
                ></div>
              </div>

              <div class="relative grid max-w-lg grid-cols-1 gap-6 mx-auto md:max-w-none lg:gap-10 md:grid-cols-3">
                <div class="flex flex-col overflow-hidden testimonial-card">
                  <div class="flex flex-col justify-between flex-1 p-6 lg:py-8 lg:px-7">
                    <div class="flex-1">
                      <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      </div>

                      <blockquote class="flex-1 mt-8">
                        <p class="text-lg leading-relaxed text-white font-pj text-shadow">
                          "You made it so simple. It is so much faster and easier to keep my notes in check."
                        </p>
                      </blockquote>
                    </div>

                    <div class="flex items-center mt-8">
                      <img class="flex-shrink-0 object-cover rounded-full w-11 h-11 border-2 border-white/20" src="https://cdn.rareblocks.xyz/collection/clarity/images/testimonial/4/avatar-male-1.png" alt="Leslie Alexander"/>
                      <div class="ml-4">
                        <p class="text-base font-bold text-white font-pj text-shadow">Leslie Alexander</p>
                        <p class="mt-0.5 text-sm font-pj text-white/70 text-shadow">Freelance React Developer</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="flex flex-col overflow-hidden testimonial-card">
                  <div class="flex flex-col justify-between flex-1 p-6 lg:py-8 lg:px-7">
                    <div class="flex-1">
                      <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      </div>

                      <blockquote class="flex-1 mt-8">
                        <p class="text-lg leading-relaxed text-white font-pj text-shadow">
                          "Simply the best. Better than all the rest. I'd recommend this product to everyone"
                        </p>
                      </blockquote>
                    </div>

                    <div class="flex items-center mt-8">
                      <img class="flex-shrink-0 object-cover rounded-full w-11 h-11 border-2 border-white/20" src="https://cdn.rareblocks.xyz/collection/clarity/images/testimonial/4/avatar-male-2.png" alt="Jacob Jones"/>
                      <div class="ml-4">
                        <p class="text-base font-bold text-white font-pj text-shadow">Jacob Jones</p>
                        <p class="mt-0.5 text-sm font-pj text-white/70 text-shadow">Digital Marketer</p>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="flex flex-col overflow-hidden testimonial-card">
                  <div class="flex flex-col justify-between flex-1 p-6 lg:py-8 lg:px-7">
                    <div class="flex-1">
                      <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                      </div>

                      <blockquote class="flex-1 mt-8">
                        <p class="text-lg leading-relaxed text-white font-pj text-shadow">
                          "This app has completely transformed how I manage my daily workflow. The clean interface means I can quickly add tasks during meetings without getting distracted."
                        </p>
                      </blockquote>
                    </div>

                    <div class="flex items-center mt-8">
                      <img class="flex-shrink-0 object-cover rounded-full w-11 h-11 border-2 border-white/20" src="https://cdn.rareblocks.xyz/collection/clarity/images/testimonial/4/avatar-female.png" alt="Jenny Wilson"/>
                      <div class="ml-4">
                        <p class="text-base font-bold text-white font-pj text-shadow">Jenny Wilson</p>
                        <p class="mt-0.5 text-sm font-pj text-white/70 text-shadow">Graphic Designer</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <script>
      // Mobile sidebar toggle
      const openSidebarBtn = document.getElementById("openSidebarBtn");
      const closeSidebarBtn = document.getElementById("closeSidebarBtn");
      const sidebar = document.getElementById("logo-sidebar");

      openSidebarBtn.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
      });

      closeSidebarBtn.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
      });

      // Close sidebar when clicking outside on mobile
      document.addEventListener("click", (e) => {
        if (window.innerWidth < 640) {
          if (!sidebar.contains(e.target) && !openSidebarBtn.contains(e.target)) {
            sidebar.classList.add("-translate-x-full");
          }
        }
      });
    </script>
  </body>
</html>