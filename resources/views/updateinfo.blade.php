
  
  <!DOCTYPE html>
  <html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">
  

    <head>

    <style>
        .table-container {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            position: sticky;
            top: 0;
            background-color: chocolate;
            color: blanchedalmond;
            z-index: 1;
        }

        th, td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ccc;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody {
            background-color: white;
        }
    </style>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Admin  Dashboard</title>
      <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
      />
      <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
      <script
        src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"
        defer
      ></script>
      <script src="./assets/js/init-alpine.js"></script>
      <!-- You need focus-trap.js to make the modal accessible -->
      <script src="./assets/js/focus-trap.js" defer></script>
    </head>

    <body>
      <div
        class="flex h-screen bg-gray-50 dark:bg-gray-900"
        :class="{ 'overflow-hidden': isSideMenuOpen}"
      >
        <!-- Desktop sidebar -->
        <aside
          class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white dark:bg-gray-800 md:block"
        >
          <div class="py-4 text-gray-500 dark:text-gray-400">
            <a
              class="ml-6 text-lg font-bold text-gray-800 dark:text-gray-200"
              href="#"
            >
              Admin
            </a>
            <ul class="mt-6">
              
            </ul>
            <ul>
              
            <li class="relative px-6 py-3">
                <span
                  class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>
                <a
                  class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                  href="modals.html"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                    ></path>
                  </svg>
                  <span class="ml-4">Department Report</span>
                </a>
              </li>
      
              <li class="relative px-6 py-3">
                <span
                  class="absolute inset-y-0 left-0 w-1 bg-purple-600 rounded-tr-lg rounded-br-lg"
                  aria-hidden="true"
                ></span>
                <a
                  class="inline-flex items-center w-full text-sm font-semibold text-gray-800 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                  href="modals.html"
                >
                  <svg
                    class="w-5 h-5"
                    aria-hidden="true"
                    fill="none"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"
                    ></path>
                  </svg>
                  <span class="ml-4">Admin Report</span>
                </a>
              </li>
         
              <li class="relative px-6 py-3">

                      <path
                        d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                      ></path>
                
                 
                    <path
                      fill-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      clip-rule="evenodd"
                    ></path>
                  </svg>
                </button>
                <template x-if="isPagesMenuOpen">
                  <ul
                    x-transition:enter="transition-all ease-in-out duration-300"
                    x-transition:enter-start="opacity-25 max-h-0"
                    x-transition:enter-end="opacity-100 max-h-xl"
                    x-transition:leave="transition-all ease-in-out duration-300"
                    x-transition:leave-start="opacity-100 max-h-xl"
                    x-transition:leave-end="opacity-0 max-h-0"
                    class="p-2 mt-2 space-y-2 overflow-hidden text-sm font-medium text-gray-500 rounded-md shadow-inner bg-gray-50 dark:text-gray-400 dark:bg-gray-900"
                    aria-label="submenu"
                  >
                    <li
                      class="px-2 py-1 transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200"
                    >
                      <a class="w-full" href="pages/login.html">Login</a>
                    </li>
                  
                  </ul>
                </template>
              </li>
            </ul>
          
          </div>
        </aside>
        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div
          x-show="isSideMenuOpen"
          x-transition:enter="transition ease-in-out duration-150"
          x-transition:enter-start="opacity-0"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in-out duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0"
          class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center"
        ></div>
        <aside
          class="fixed inset-y-0 z-20 flex-shrink-0 w-64 mt-16 overflow-y-auto bg-white dark:bg-gray-800 md:hidden"
          x-show="isSideMenuOpen"
          x-transition:enter="transition ease-in-out duration-150"
          x-transition:enter-start="opacity-0 transform -translate-x-20"
          x-transition:enter-end="opacity-100"
          x-transition:leave="transition ease-in-out duration-150"
          x-transition:leave-start="opacity-100"
          x-transition:leave-end="opacity-0 transform -translate-x-20"
          @click.away="closeSideMenu"
          @keydown.escape="closeSideMenu"
        >
          <div class="py-4 text-gray-500 dark:text-gray-400">
           
          
           
                </template>
              </li>
            </ul>
            <div class="px-6 my-6">
              
            </div>
          </div>
        </aside>
        <div class="flex flex-col flex-1">
          <header class="z-10 py-4 bg-white shadow-md dark:bg-gray-800">
            <div
              class="container flex items-center justify-between h-full px-6 mx-auto text-purple-600 dark:text-purple-300"
            >
              <!-- Mobile hamburger -->
              <button
                class="p-1 mr-5 -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
                @click="toggleSideMenu"
                aria-label="Menu"
              >
                <svg
                  class="w-6 h-6"
                  aria-hidden="true"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"
                  ></path>
                </svg>
              </button>
              <!-- Search input -->
              <div class="flex justify-center flex-1 lg:mr-32">
                <div
                  class="relative w-full max-w-xl mr-6 focus-within:text-purple-500"
                >
                  <div class="absolute inset-y-0 flex items-center pl-2">
                    <svg
                      class="w-4 h-4"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fill-rule="evenodd"
                        d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                        clip-rule="evenodd"
                      ></path>
                    </svg>
                  </div>
                  <input
                    class="w-full pl-8 pr-2 text-sm text-gray-700 placeholder-gray-600 bg-gray-100 border-0 rounded-md dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                    type="text"
                    placeholder="Search for projects"
                    aria-label="Search"
                  />
                </div>
              </div>
              <ul class="flex items-center flex-shrink-0 space-x-6">
                <!-- Theme toggler -->
                <li class="flex">
                  <button
                    class="rounded-md focus:outline-none focus:shadow-outline-purple"
                    @click="toggleTheme"
                    aria-label="Toggle color mode"
                  >
                    <template x-if="!dark">
                      <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                      >
                        <path
                          d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"
                        ></path>
                      </svg>
                    </template>
                    <template x-if="dark">
                      <svg
                        class="w-5 h-5"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                      >
                        <path
                          fill-rule="evenodd"
                          d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                          clip-rule="evenodd"
                        ></path>
                      </svg>
                    </template>
                  </button>
                </li>
                <!-- Notifications menu -->
                <li class="relative">
                  <button
                    class="relative align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                    @click="toggleNotificationsMenu"
                    @keydown.escape="closeNotificationsMenu"
                    aria-label="Notifications"
                    aria-haspopup="true"
                  >
                    <svg
                      class="w-5 h-5"
                      aria-hidden="true"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"
                      ></path>
                    </svg>
                    <!-- Notification badge -->
                    <span
                      aria-hidden="true"
                      class="absolute top-0 right-0 inline-block w-3 h-3 transform translate-x-1 -translate-y-1 bg-red-600 border-2 border-white rounded-full dark:border-gray-800"
                    ></span>
                  </button>
                  <template x-if="isNotificationsMenuOpen">
                    <ul
                      x-transition:leave="transition ease-in duration-150"
                      x-transition:leave-start="opacity-100"
                      x-transition:leave-end="opacity-0"
                      @click.away="closeNotificationsMenu"
                      @keydown.escape="closeNotificationsMenu"
                      class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700"
                      aria-label="submenu"
                    >
                      <li class="flex">
                        <a
                          class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                          href="#"
                        >
                          <span>Messages</span>
                          <span
                            class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                          >
                            13
                          </span>
                        </a>
                      </li>
                      <li class="flex">
                        <a
                          class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                          href="#"
                        >
                          <span>Sales</span>
                          <span
                            class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-600 bg-red-100 rounded-full dark:text-red-100 dark:bg-red-600"
                          >
                            2
                          </span>
                        </a>
                      </li>
                      <li class="flex">
                        <a
                          class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                          href="#"
                        >
                          <span>Alerts</span>
                        </a>
                      </li>
                    </ul>
                  </template>
                </li>
                <!-- Profile menu -->
                <li class="relative">
                  <button
                    class="align-middle rounded-full focus:shadow-outline-purple focus:outline-none"
                    @click="toggleProfileMenu"
                    @keydown.escape="closeProfileMenu"
                    aria-label="Account"
                    aria-haspopup="true"
                  >
                    <img
                      class="object-cover w-8 h-8 rounded-full"
                      src="https://images.unsplash.com/photo-1502378735452-bc7d86632805?ixlib=rb-0.3.5&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=200&fit=max&s=aa3a807e1bbdfd4364d1f449eaa96d82"
                      alt=""
                      aria-hidden="true"
                    />
                  </button>
                  <template x-if="isProfileMenuOpen">
                    <ul
                      x-transition:leave="transition ease-in duration-150"
                      x-transition:leave-start="opacity-100"
                      x-transition:leave-end="opacity-0"
                      @click.away="closeProfileMenu"
                      @keydown.escape="closeProfileMenu"
                      class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                      aria-label="submenu"
                    >
                      <li class="flex">
        
                          
                   
                      <li class="flex">
                  <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                  <form action="{{ route('logout') }}" method="POST" style="display: inline;">
    @csrf
    <button type="submit" class="btn btn-link" style="padding: 0; border: none; background: none;">
        Logout
    </button>
</form>
      </li>            </li>
                    </ul>
                  </template>
                </li>
              </ul>
            </div>
          </header>
          

 
          <main class="h-full overflow-y-auto">
            <div class="container px-6 mx-auto grid">
              <h2s
                class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200"
              >
                Dashboard
              </h2>
              <br/>
             
              <br/>
              
              <!-- New Table -->
               
              <div class="w-full overflow-hidden rounded-lg shadow-xs">
                
            <br/>

      <form method="GET" action="{{ route('searcch') }}" style="background: #1e1e1e; padding: 25px; border-radius: 10px; max-width: 900px; margin: auto; color: blanchedalmond;">

    <h2 style="color: aliceblue; margin-bottom: 20px;">📊 Filter Employee Data</h2>

    <!-- Top Controls -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <a href="{{ route('show.showUSERS') }}">
            <button type="button" style="background: #555; color: white; padding: 8px 16px; border: none; border-radius: 5px;">
                🔄 Reset
            </button>
        </a>
    </div>



    

    <!-- Dropdown Filters -->
    <div style="display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 15px;">
        <!-- Department -->
        <div style="flex: 1; min-width: 200px;">
            <label for="departments">🏢 Department</label><br>
            <select name="deparments" style="width: 100%; padding: 8px; background: chocolate; color: blanchedalmond; border: none; border-radius: 5px;">
                @foreach ($userdepartments as $department)
                    <option value="{{ $department->ID }}">{{ $department->Names }}</option>
                @endforeach
            </select>
        </div>

        <!-- Team -->
        <div style="flex: 1; min-width: 200px;">
            <label for="teams">👥 Team</label><br>
            <select name="teams" style="width: 100%; padding: 8px; background: chocolate; color: blanchedalmond; border: none; border-radius: 5px;">
                <option value="All" {{ request('teams') == 'All' ? 'selected' : '' }}>All</option>
                @foreach ($teams as $team)
                    <option value="{{ $team->team_id }}" {{ request('teams') == $team->team_id ? 'selected' : '' }}>
                        {{ $team->team_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Employee -->
        <div style="flex: 1; min-width: 200px;">
            <label for="usersids">👤 Employee</label><br>
            <select name="usersids" id="usersids" style="width: 100%; padding: 8px; background: chocolate; color: blanchedalmond; border: none; border-radius: 5px;">
                <option value="All" {{ request('usersids') == 'All' ? 'selected' : '' }}>All</option>
                @foreach ($Allusers as $user)
                    <option value="{{ $user->id }}" {{ request('usersids') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Order ID -->
        <div style="flex: 1; min-width: 200px;">
            <label for="Employeeid">📦 Employee ID</label><br>
            <input type="text" name="Employeeid" value="{{ request('Employeeid') }}"
                   style="width: 100%; padding: 8px; background: chocolate; color: blanchedalmond; border: none; border-radius: 5px;">
        </div>
    </div>

    <div style="flex: 1; min-width: 200px;">
            <label for="Employeename">📦 Employee Name</label><br>
            <input type="text" name="Employeename" value="{{ request('Employeename') }}"
                   style="width: 100%; padding: 8px; background: chocolate; color: blanchedalmond; border: none; border-radius: 5px;">
        </div>
    </div>
    <!-- Submit Button -->
    <div style="text-align: right;">
        <button type="submit" style="background: seagreen; color: white; padding: 10px 30px; font-weight: bold; border: none; border-radius: 5px;">
            🔍 Filter
        </button>
    </div>
</form>

 

      </br></br>
                                  
</br>
</br>
</br>  
<center><h3>employees</h3></center>
  </br>  
<div style="overflow-y: auto;" class="table-container">
              <!-- New Table -->
              
                  <table class="w-full whitespace-no-wrap">
                    <thead>
                      <tr
                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800"
                      >
                      <th style="position: sticky; top: 0; " >Id</th>
                      <th >Employee</th>
                      <th >email  </th>
                      <th >Title</th>
                      <th >Department</th>
                      
                      <th >	current_team_id </th>
                      <th >DirectManagerID  </th>
         
                      
                      </tr>
                    </thead>
                    <tbody
                      class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800"
                    >
                    
                    @foreach ($users as $employees)
                  

                      <tr class="text-gray-700 dark:text-gray-400">
                        <td class="px-4 py-3 text-sm">
                        <a href="{{ route('employees.edit', $employees->id) }}" class="btn btn-sm btn-warning">{{ $employees->id  }}</a>

                        
                        </td>
                        <td class="px-4 py-3 text-sm">
                        {{ $employees->name  }}
                        </td>
                        
                        <td class="px-4 py-3 text-sm">
                        {{ $employees->Employee }}
                        </td>
    
                        <td class="px-4 py-3 text-xs">

{{ $employees->title  }}


</td>
                       
                        <td class="px-4 py-3 text-xs">

                          {{ $employees->Department  }}
                        
                          
                        </td>
                        
                       
                        <td class="px-4 py-3 text-xs">

                          {{ $employees->team_name  }}
                        
                          
                        </td>
                        <td class="px-4 py-3 text-xs">

{{ $employees->DirectManagerName  }}


</td>
                        @endforeach

                      </tr>
                    </tbody>
                    </div>
                  </table>
      </br>
    
               
              
      </div>  
      </br></br>
              <!-- Charts -->
          
              
            </div>
          </main>
        </div>
      </div>
    </body>
  </html>
 