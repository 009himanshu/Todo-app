<?php
include 'config.php';

$sql = "SELECT * FROM tasks ORDER BY created_at DESC";
$result = mysqli_query($conn, $sql);

$tasks = [];
if ($result && mysqli_num_rows($result) >
0) { while ($row = mysqli_fetch_assoc($result)) { $tasks[] = $row; } } ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Taskify</title>
    <link
      rel="shortcut icon"
      href="./assets/notesLogo.png"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="style.css" />
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

      .task-card {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border-radius: 16px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
      }

      .task-card::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.3s ease;
      }

      .task-card:hover::before {
        transform: scaleX(1);
      }

      .task-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
      }

      .gradient-text {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
      }

      .btn-primary {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        border: none;
        border-radius: 12px;
        color: white;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(139, 92, 246, 0.3);
      }

      .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
      }

      .checkbox {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        border: 2px solid rgba(255, 255, 255, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
      }

      .checkbox.checked {
        background: linear-gradient(90deg, #10b981, #34d399);
        border-color: #10b981;
      }

      .search-input {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        color: white;
        transition: all 0.3s ease;
        min-height: 3.5rem;
        padding: 0.75rem 1rem;
        padding-left: 2rem;
        font-size: 1rem;
      }

      .search-input:focus {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.4);
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.1);
      }

      .search-input::placeholder {
        color: rgba(255, 255, 255, 0.7);
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

      .delete-btn {
        background: rgba(239, 68, 68, 0.2);
        border-radius: 10px;
        transition: all 0.3s ease;
      }

      .delete-btn:hover {
        background: rgba(239, 68, 68, 0.3);
        transform: scale(1.05);
      }

      .empty-state {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
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
        text-shadow: 0 0px 1px rgba(255, 255, 255, 0.5);
      }

      /* Apply to specific elements */
      .glass-card p,
      .glass-card span:not(.gradient-text) {
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
      }

      .task-card p,
      .task-card span {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
      }

      .sidebar-link span {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
      }

      .empty-state {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
      }

      /* Search input placeholder */
      .search-input::placeholder {
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
      }

      /* Status badges with better visibility */
      .status-badge {
        background: rgba(0, 0, 0, 0.25);
        padding: 2px 8px;
        border-radius: 12px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
      }

      /* Date text with better contrast */
      .date-text {
        background: rgba(0, 0, 0, 0.2);
        padding: 2px 6px;
        border-radius: 8px;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
      }

      /* Search bar visibility fixes */
      #search-container {
        display: none;
      }

      @media (min-width: 640px) {
        #search-container {
          display: block;
        }
      }

      #search-toggle {
        display: block;
      }

      @media (min-width: 640px) {
        #search-toggle {
          display: none;
        }
      }

      @media (max-width: 640px) {
        .task-card {
          margin-bottom: 1rem;
        }
      }

      .transition-all {
        transition: all 0.3s ease;
      }

      .main-content {
        margin-left: 0;
      }

      @media (min-width: 640px) {
        .main-content {
          margin-left: 16rem;
        }
      }
    </style>
  </head>
  <body class="min-h-screen text-white">
    <!-- Floating Background Elements -->
    <div class="floating-bubble bubble-1"></div>
    <div class="floating-bubble bubble-2"></div>
    <div class="floating-bubble bubble-3"></div>

    <!-- ##############    Header & Sidebar    ################   -->
    <button
      type="button"
      id="openSidebarBtn"
      class="inline-flex items-center p-2 mt-2 ms-3 text-sm rounded-lg sm:hidden focus:outline-none glass-card"
    >
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
      <div class="h-full px-3 py-4 overflow-y-auto">
        <div class="flex justify-between items-center mb-5">
          <a href="/Taskify" class="flex items-center ps-2.5">
            <img
              src="./assets/notesLogo.png"
              class="h-6 me-3 sm:h-7"
              alt="Flowbite Logo"
            />
            <span
              class="self-center text-xl font-semibold whitespace-nowrap text-white"
              >Taskify</span
            >
          </a>
          <button
            type="button"
            id="closeSidebarBtn"
            class="inline-flex items-center p-2 mt-2 ms-3 text-sm rounded-lg sm:hidden focus:outline-none glass-card"
          >
            <img src="./assets/X.svg" alt="X" class="h-5" />
          </button>
        </div>

        <!-- Mobile Search (hidden on desktop) -->
        <div
          id="mobile-search-expanded"
          class="mb-4 p-2 rounded-lg hidden sm:hidden glass-card"
        >
          <div class="relative">
            <div
              class="absolute inset-y-0 left-0 flex pl-3 items-center pointer-events-none"
            >
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
            </div>
            <input
              type="text"
              id="mobile-search-input"
              class="block w-full text-sm search-input"
              placeholder="Search tasks..."
            />
          </div>
        </div>

        <div class="flex items-center justify-between mb-4">
          <!-- Search Toggle for Mobile -->
          <button
            id="search-toggle"
            class="p-2 rounded-lg focus:outline-none sm:hidden glass-card"
          >
            <svg
              class="w-5 h-5"
              aria-hidden="true"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 20 20"
            >
              <path
                stroke="currentColor"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
              />
            </svg>
            <span class="sr-only">Search</span>
          </button>

          <div
            id="search-container"
            class="hidden sm:block relative flex-1 mr-2"
          >
            <div
              class="absolute inset-y-0 left-0 flex pl-3 items-center pointer-events-none"
            >
              <svg
                class="w-4 h-4"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 20 20"
              >
                <path
                  stroke="currentColor"
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  stroke-width="2"
                  d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"
                />
              </svg>
            </div>
            <input
              type="text"
              id="search-navbar"
              class="block w-full pl-16 text-sm search-input"
              placeholder="Search tasks..."
            />
          </div>
        </div>

        <ul class="space-y-2 font-medium">
          <li>
            <a
              href="/Taskify/"
              class="flex items-center p-2 rounded-lg sidebar-link active"
            >
              <img src="./assets/allTodos.svg" alt="allTodos" class="h-4" />
              <span class="ms-3 text-shadow">All Todos</span>
            </a>
          </li>
          <li>
            <a
              href="/Taskify/about.php"
              class="flex items-center p-2 rounded-lg sidebar-link"
            >
              <img src="./assets/about.svg" alt="aboutUs" class="h-4" />
              <span class="flex-1 ms-3 whitespace-nowrap text-shadow"
                >About Us</span
              >
            </a>
          </li>
        </ul>
      </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content p-4 sm:ml-64">
      <div class="container mx-auto px-4 py-8 max-w-6xl min-h-screen">
        <h1 class="text-2xl sm:text-5xl font-bold text-center mb-8 floating">
          <span class="gradient-text text-shadow">Your Todo List</span>
        </h1>

        <div class="glass-card p-6 mb-8">
          <form
            action="add_task.php"
            method="POST"
            class="flex flex-col sm:flex-row gap-4"
          >
            <input
              type="text"
              name="task"
              placeholder="Enter a new task..."
              class="flex-1 px-4 py-3 search-input rounded-xl focus:outline-none"
              required
            />
            <button
              type="submit"
              class="btn-primary px-6 py-3 rounded-xl transition duration-200 font-semibold"
            >
              Add Task
            </button>
          </form>
        </div>

        <div id="tasks-container">
          <?php if (empty($tasks)): ?>
          <div class="empty-state p-8 text-center">
            <svg
              class="w-16 h-16 mx-auto mb-4 opacity-70"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
              ></path>
            </svg>
            No tasks yet. Add your first task above!
          </div>
          <?php else: ?>
          <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"
            id="tasks-grid"
          >
            <?php foreach ($tasks as $task): ?>
            <div
              class="task-card p-6 <?= $task['is_completed'] ? 'opacity-75' : '' ?>"
            >
              <div class="flex items-start justify-between mb-4">
                <form action="update_task.php" method="POST" class="inline">
                  <input
                    type="hidden"
                    name="task_id"
                    value="<?= $task['id'] ?>"
                  />
                  <input
                    type="hidden"
                    name="completed"
                    value="<?= $task['is_completed'] ? '0' : '1' ?>"
                  />
                  <button type="submit" class="focus:outline-none">
                    <div
                      class="checkbox <?= $task['is_completed'] ? 'checked' : '' ?>"
                    >
                      <?php if ($task['is_completed']): ?>
                      <svg
                        class="w-4 h-4 text-white"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                      >
                        <path
                          stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="3"
                          d="M5 13l4 4L19 7"
                        ></path>
                      </svg>
                      <?php endif; ?>
                    </div>
                  </button>
                </form>

                <form action="delete_task.php" method="POST" class="inline">
                  <input
                    type="hidden"
                    name="task_id"
                    value="<?= $task['id'] ?>"
                  />
                  <button
                    type="submit"
                    class="p-2 delete-btn"
                    onclick="return confirm('Are you sure you want to delete this task?');"
                  >
                    <svg
                      class="w-5 h-5 text-red-400"
                      fill="none"
                      stroke="currentColor"
                      viewBox="0 0 24 24"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                      ></path>
                    </svg>
                  </button>
                </form>
              </div>

              <div class="mb-4">
                <p
                  class="task-text <?= $task['is_completed'] ? 'line-through text-gray-300' : 'font-medium' ?>"
                >
                  <?= htmlspecialchars($task['task_text']) ?>
                </p>
              </div>

              <div class="flex items-center justify-between text-sm">
                <span class="flex items-center opacity-80">
                  <svg
                    class="w-4 h-4 mr-1"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                    ></path>
                  </svg>
                  <?= date('M j, Y', strtotime($task['created_at'])) ?>
                </span>
                <span
                  class="<?= $task['is_completed'] ? 'text-green-300' : 'text-amber-300' ?> font-medium"
                >
                  <?= $task['is_completed'] ? 'Completed' : 'Pending' ?>
                </span>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>

    <script>
      const openSidebarBtn = document.getElementById("openSidebarBtn");
      const closeSidebarBtn = document.getElementById("closeSidebarBtn");
      const sidebar = document.getElementById("logo-sidebar");

      openSidebarBtn.addEventListener("click", () => {
        sidebar.classList.remove("-translate-x-full");
      });

      closeSidebarBtn.addEventListener("click", () => {
        sidebar.classList.add("-translate-x-full");
      });

      document.addEventListener("click", (e) => {
        if (window.innerWidth < 640) {
          if (
            !sidebar.contains(e.target) &&
            !openSidebarBtn.contains(e.target)
          ) {
            sidebar.classList.add("-translate-x-full");
          }
        }
      });

      document.addEventListener("DOMContentLoaded", function () {
        const searchContainer = document.getElementById("search-container");
        if (searchContainer) {
          searchContainer.classList.remove("hidden");
        }
      });

      document
        .getElementById("search-toggle")
        .addEventListener("click", function () {
          const mobileSearchExpanded = document.getElementById(
            "mobile-search-expanded"
          );
          mobileSearchExpanded.classList.toggle("hidden");

          if (!mobileSearchExpanded.classList.contains("hidden")) {
            setTimeout(() => {
              document.getElementById("mobile-search-input").focus();
            }, 100);
          }
        });

      function syncSearchInputs(value) {
        const desktopSearch = document.getElementById("search-navbar");
        const mobileSearch = document.getElementById("mobile-search-input");

        if (desktopSearch) desktopSearch.value = value;
        if (mobileSearch) mobileSearch.value = value;
      }

      document.addEventListener("DOMContentLoaded", function () {
        syncSearchInputs("");
      });

      const searchNavbar = document.getElementById("search-navbar");
      const mobileSearchInput = document.getElementById("mobile-search-input");

      if (searchNavbar) {
        searchNavbar.addEventListener("input", function (e) {
          syncSearchInputs(e.target.value);
          performSearch(e.target.value);
        });
      }

      if (mobileSearchInput) {
        mobileSearchInput.addEventListener("input", function (e) {
          syncSearchInputs(e.target.value);
          performSearch(e.target.value);
        });
      }

      function performSearch(searchTerm) {
        const taskCards = document.querySelectorAll(".task-card");
        const tasksGrid = document.getElementById("tasks-grid");
        let hasVisibleTasks = false;
        let visibleCount = 0;

        taskCards.forEach((card) => {
          const taskText = card.querySelector(".task-text");
          if (taskText) {
            const textContent = taskText.textContent.toLowerCase();
            if (textContent.includes(searchTerm.toLowerCase())) {
              card.style.display = "block";
              hasVisibleTasks = true;
              visibleCount++;
            } else {
              card.style.display = "none";
            }
          }
        });

        const existingMessage = document.getElementById("no-results-message");

        if (!hasVisibleTasks && searchTerm.trim() !== "") {
          if (!existingMessage && tasksGrid) {
            const message = document.createElement("div");
            message.id = "no-results-message";
            message.className = "empty-state p-8 text-center col-span-full";
            message.innerHTML = `
              <svg class="w-16 h-16 mx-auto mb-4 opacity-70" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
              No tasks found matching "${searchTerm}"
            `;
            tasksGrid.appendChild(message);
          }
        } else if (existingMessage) {
          existingMessage.remove();
        }

        if (tasksGrid && visibleCount > 0) {
          tasksGrid.style.display = "grid";
        }
      }

      document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
          syncSearchInputs("");
          performSearch("");
          const mobileSearchExpanded = document.getElementById(
            "mobile-search-expanded"
          );
          if (mobileSearchExpanded) {
            mobileSearchExpanded.classList.add("hidden");
          }
        }
      });

      window.addEventListener("resize", function () {
        const mobileSearchExpanded = document.getElementById(
          "mobile-search-expanded"
        );
        if (mobileSearchExpanded && window.innerWidth >= 640) {
          mobileSearchExpanded.classList.add("hidden");
        }
      });

      document.addEventListener("DOMContentLoaded", function () {
        performSearch("");
      });
    </script>
  </body>
</html>
