<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full bg-white">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Flowbit -->
        <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
        <!-- Fonts -->
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <!-- Styles / Scripts -->
         <!-- Link CSS Bootstrap dari CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
      <body>
    <!-- navbar -->
    <header class="antialiased">
<nav class="fixed top-0 left-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
  <div class="w-full px-0 py-3">
    <div class="flex items-center justify-between">
    <div class="flex justify-start items-center">
      <a href="#" class="flex mr-4 ml-20">
    <img src="/img/lazis-logo.png" class="mr-3 h-16" alt="Lazismu Logo" height="55" width="100" />
  </a>
</div>
     <div class="flex items-center">
          <div class="flex items-center ms-3">
            
              <!-- Notifications -->
              <button type="button" data-dropdown-toggle="notification-dropdown" class="p-2 mr-1 text-gray-500 rounded-lg hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600">
                  <span class="sr-only">View notifications</span>
                  <!-- Bell icon -->
                  <img src="/img/notifications.png" class="mr-3 h-8" alt="Lazismu Logo">       
              </button>
              <!-- Dropdown menu -->
              <div class="hidden overflow-hidden z-50 my-4 max-w-sm text-base list-none bg-white rounded divide-y divide-gray-100 shadow-lg dark:divide-gray-600 dark:bg-gray-700" id="notification-dropdown">
                  <div class="block py-2 px-4 text-base font-medium text-center text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                      Notifications
                  </div>
                  <div>
                  <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                      <div class="flex-shrink-0">
                      <img class="w-11 h-11 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/bonnie-green.png" alt="Bonnie Green avatar">
                      <div class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 rounded-full border border-white bg-primary-700 dark:border-gray-700">
                          <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18"><path d="M15.977.783A1 1 0 0 0 15 0H3a1 1 0 0 0-.977.783L.2 9h4.239a2.99 2.99 0 0 1 2.742 1.8 1.977 1.977 0 0 0 3.638 0A2.99 2.99 0 0 1 13.561 9H17.8L15.977.783ZM6 2h6a1 1 0 1 1 0 2H6a1 1 0 0 1 0-2Zm7 5H5a1 1 0 0 1 0-2h8a1 1 0 1 1 0 2Z"/><path d="M1 18h16a1 1 0 0 0 1-1v-6h-4.439a.99.99 0 0 0-.908.6 3.978 3.978 0 0 1-7.306 0 .99.99 0 0 0-.908-.6H0v6a1 1 0 0 0 1 1Z"/></svg>
                      </div>
                      </div>
                      <div class="pl-3 w-full">
                          <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400">New message from <span class="font-semibold text-gray-900 dark:text-white">Bonnie Green</span>: "Hey, what's up? All set for the presentation?"</div>
                          <div class="text-xs font-medium text-primary-700 dark:text-primary-400">a few moments ago</div>
                      </div>
                  </a>
                  <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                      <div class="flex-shrink-0">
                      <img class="w-11 h-11 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png" alt="Jese Leos avatar">
                      <div class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-gray-900 rounded-full border border-white dark:border-gray-700">
                          <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18"><path d="M6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Zm11-3h-2V5a1 1 0 0 0-2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 0 0 2 0V9h2a1 1 0 1 0 0-2Z"/></svg>
                      </div>
                      </div>
                      <div class="pl-3 w-full">
                          <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">Jese leos</span> and <span class="font-medium text-gray-900 dark:text-white">5 others</span> started following you.</div>
                          <div class="text-xs font-medium text-primary-700 dark:text-primary-400">10 minutes ago</div>
                      </div>
                  </a>
                  <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                      <div class="flex-shrink-0">
                      <img class="w-11 h-11 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/joseph-mcfall.png" alt="Joseph McFall avatar">
                      <div class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-red-600 rounded-full border border-white dark:border-gray-700">
                        <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18"> <path d="M17.947 2.053a5.209 5.209 0 0 0-3.793-1.53A6.414 6.414 0 0 0 10 2.311 6.482 6.482 0 0 0 5.824.5a5.2 5.2 0 0 0-3.8 1.521c-1.915 1.916-2.315 5.392.625 8.333l7 7a.5.5 0 0 0 .708 0l7-7a6.6 6.6 0 0 0 2.123-4.508 5.179 5.179 0 0 0-1.533-3.793Z"/> </svg>                      
                      </div>
                      </div>
                      <div class="pl-3 w-full">
                          <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">Joseph Mcfall</span> and <span class="font-medium text-gray-900 dark:text-white">141 others</span> love your story. See it and view more stories.</div>
                          <div class="text-xs font-medium text-primary-700 dark:text-primary-400">44 minutes ago</div>
                      </div>
                  </a>
                  <a href="#" class="flex py-3 px-4 border-b hover:bg-gray-100 dark:hover:bg-gray-600 dark:border-gray-600">
                      <div class="flex-shrink-0">
                      <img class="w-11 h-11 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/roberta-casas.png" alt="Roberta Casas image">
                      <div class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-green-400 rounded-full border border-white dark:border-gray-700">
                          <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18"><path d="M18 0H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h2v4a1 1 0 0 0 1.707.707L10.414 13H18a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm-5 4h2a1 1 0 1 1 0 2h-2a1 1 0 1 1 0-2ZM5 4h5a1 1 0 1 1 0 2H5a1 1 0 0 1 0-2Zm2 5H5a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Zm9 0h-6a1 1 0 0 1 0-2h6a1 1 0 1 1 0 2Z"/></svg>
                      </div>
                      </div>
                      <div class="pl-3 w-full">
                          <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">Leslie Livingston</span> mentioned you in a comment: <span class="font-medium text-primary-700 dark:text-primary-500">@bonnie.green</span> what do you say?</div>
                          <div class="text-xs font-medium text-primary-700 dark:text-primary-400">1 hour ago</div>
                      </div>
                  </a>
                  <a href="#" class="flex py-3 px-4 hover:bg-gray-100 dark:hover:bg-gray-600">
                      <div class="flex-shrink-0">
                      <img class="w-11 h-11 rounded-full" src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/robert-brown.png" alt="Robert image">
                      <div class="flex absolute justify-center items-center ml-6 -mt-5 w-5 h-5 bg-purple-500 rounded-full border border-white dark:border-gray-700">
                          <svg class="w-2 h-2 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14"><path d="M11 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h9a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2Zm8.585 1.189a.994.994 0 0 0-.9-.138l-2.965.983a1 1 0 0 0-.685.949v8a1 1 0 0 0 .675.946l2.965 1.02a1.013 1.013 0 0 0 1.032-.242A1 1 0 0 0 20 12V2a1 1 0 0 0-.415-.811Z"/></svg>
                      </div>
                      </div>
                      <div class="pl-3 w-full">
                          <div class="text-gray-500 font-normal text-sm mb-1.5 dark:text-gray-400"><span class="font-semibold text-gray-900 dark:text-white">Robert Brown</span> posted a new video: Glassmorphism - learn how to implement the new design trend.</div>
                          <div class="text-xs font-medium text-primary-700 dark:text-primary-400">3 hours ago</div>
                      </div>
                  </a>
                  </div>
                  <a href="#" class="block py-2 text-base font-medium text-center text-gray-900 bg-gray-50 hover:bg-gray-100 dark:bg-gray-700 dark:text-white dark:hover:underline">
                      <div class="inline-flex items-center ">
                      <svg aria-hidden="true" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 12a2 2 0 100-4 2 2 0 000 4z"></path><path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"></path></svg>
                      View all
                      </div>
                  </a>
              </div>
              <button type="button" class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                  <span class="sr-only">Open user menu</span>
                  <img class="w-8 h-8 rounded-full" src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
              </button>
              <!-- Dropdown menu -->
              <!-- Sidebar untuk Mitras dan Admin -->
              <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600" id="dropdown">
                <div class="py-3 px-4">
                    <!-- Cek Auth -->
                    @if(Auth::guard('admin')->check())
                        <!-- Untuk Admin -->
                        <span class="block text-sm font-semibold text-gray-900 dark:text-black">
                            {{ Auth::guard('admin')->user()->nama ?? 'Admin' }}
                        </span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ Auth::guard('admin')->user()->email ?? 'admin@example.com' }}
                        </span>
                    @elseif(Auth::guard('mitras')->check())
                        <!-- Untuk Mitras -->
                        <span class="block text-sm font-semibold text-gray-900 dark:text-black">
                            {{ Auth::guard('mitras')->user()->nama ?? 'Mitra' }}
                        </span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">
                            {{ Auth::guard('mitras')->user()->email ?? 'mitra@example.com' }}
                        </span>
                    @else
                        <!-- Default untuk Guest -->
                        <span class="block text-sm font-semibold text-gray-900 dark:text-black">Guest</span>
                        <span class="block text-sm text-gray-500 truncate dark:text-gray-400">guest@example.com</span>
                    @endif
                </div>
                <!-- Logout -->
                <ul class="py-1 text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                    <li>
                        <form method="POST" action="{{ Auth::guard('admin')->check() ? route('admin.logout') : route('mitras.logout') }}">
                            @csrf
                            <button type="submit" class="block py-2 px-4 text-sm text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
              </div>



          </div>
        </div>
    </div>
  </div>
</nav>

<!-- sidebar -->
<aside
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-[#FF8D1B] text-white border-r border-gray-200 md:translate-x-0 dark:border-gray-700"
  aria-label="Sidenav"
  id="drawer-navigation"
>
  <div class="overflow-y-auto py-5 px-3 h-full bg-[#FF8D1B] text-white">
    <ul class="space-y-2">
      <!-- DASHBOARD -->
      <li class="border-b border-gray-300">
        <a
          href="/admin/dashboard"
          class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
        >
        <img
            aria-hidden="true"
            class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            src="/img/dashboard-logo.png"  
            alt="Icon Description"
            />
          <span class="ml-3">Dashboard</span>
        </a>
      </li>

      <!-- MLO -->
      <li class="border-b border-gray-300">
        <a
          href="/{{ Auth::guard('admin')->user()->role }}/mitramanager"
          class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
        >
        <img
            aria-hidden="true"
            class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            src="/img/people-dashboard.png"  
            alt="Icon Description"
            />
          <span class="ml-3">Mitra</span>
        </a>
      </li>

      <!-- Laporan -->
      <li class="border-b border-gray-300">
            <button
              type="button"
              class="flex items-center p-2 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-[#F2CC89] dark:text-white dark:hover:bg-gray-700"
              aria-controls="dropdown-pages"
              data-collapse-toggle="dropdown-pages"
            >
            <img
            aria-hidden="true"
            class="w-6 h-6 text-gray-900 transition duration-75 group-hover:text-gray-900 dark:text-white dark:hover:bg-gray-70 hover:bg-[#F2CC89]"
            src="/img/laporan-dashboard.png"  
            alt="Icon Description"
            />
              <span class="flex-1 ml-3 text-left whitespace-nowrap"
                >Laporan</span
              >
              <svg
                aria-hidden="true"
                class="w-6 h-6"
                fill="currentColor"
                viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                  clip-rule="evenodd"
                ></path>
              </svg>
            </button>
            <ul id="dropdown-pages" class="hidden py-2 space-y-2">
              <li>
                <a
                  href="/{{ Auth::guard('admin')->user()->role }}/proposalmanager"
                  class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-[#F2CC89] dark:text-white dark:hover:bg-gray-700 no-underline"
                  >Proposal</a
                >
              </li>
              <li>
                <a
                  href="/{{ Auth::guard('admin')->user()->role }}/lpjmanager"
                  class="flex items-center p-2 pl-11 w-full text-base font-medium text-gray-900 rounded-lg transition duration-75 group hover:bg-[#F2CC89] dark:text-white dark:hover:bg-gray-700 no-underline"
                  >LPJ</a
                >
              </li>
            </ul>
          </li>
          <!-- Sidebar Buat BP-->
          @if(Auth::guard('admin')->user()->role === 'BP')
            <li class="border-b border-gray-300">
            <a
              href="/bp/bp"
              class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
            >
            <img
                aria-hidden="true"
                class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                src="/img/admin2.png"  
                alt="Icon Description"
                />
              <span class="ml-3">Badan Pengurus</span>
            </a>
          </li>

          <!-- MANAGEMENT USER -->
          <li class="border-b border-gray-300">
            <a
              href="/bp/managementuserbp"
              class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
            >
            <img
                aria-hidden="true"
                class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                src="/img/manuser.png"  
                alt="Icon Description"
                />
              <span class="ml-3">Management User</span>
            </a>
          </li>
          @endif

          <!-- Navbar Buat Front Office -->
          @if(Auth::guard('admin')->user()->role === 'Frontoffice')
            <li class="border-b border-gray-300">
              <a
                href="/frontoffice/frontoffice"
                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
              >
              <img
                  aria-hidden="true"
                  class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                  src="/img/admin2.png"  
                  alt="Icon Description"
                  />
                <span class="ml-3">Front-Office</span>
              </a>
            </li>
          @endif

          <!-- Navbar Buat Keuangan -->
          @if(Auth::guard('admin')->user()->role === 'Keuangan')
            <li class="border-b border-gray-300">
              <a
                href="/keuangan/keuangan"
                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
              >
              <img
                  aria-hidden="true"
                  class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                  src="/img/admin2.png"  
                  alt="Icon Description"
                  />
                <span class="ml-3">Keuangan</span>
              </a>
            </li>
          @endif

          <!-- Navbar Buat Manager -->
            @if(Auth::guard('admin')->user()->role === 'Manager')
              <li class="border-b border-gray-300">
                <a
                  href="/manager/manager"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/admin2.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Manager</span>
                </a>
              </li>

              <!-- MANAGEMENT USER -->
              <li class="border-b border-gray-300">
                <a
                  href="/manager/managementusermanager"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/manuser.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Management User</span>
                </a>
              </li>
            @endif

            <!-- Navbar Buat Program -->
            @if(Auth::guard('admin')->user()->role === 'Program')
              <li class="border-b border-gray-300">
                <a
                  href="/program/program"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/admin2.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Program</span>
                </a>
              </li>
            @endif

            <!-- Navbar Buat SUPERADMIN ONLY FOR DEVELOPMENT -->
            @if(Auth::guard('admin')->user()->role === 'superadmin')
              <li class="border-b border-gray-300">
              <a
                href="/bp/bp"
                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
              >
              <img
                  aria-hidden="true"
                  class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                  src="/img/admin2.png"  
                  alt="Icon Description"
                  />
                <span class="ml-3">Badan Pengurus</span>
              </a>
            </li>

            <!-- MANAGEMENT USER -->
            <li class="border-b border-gray-300">
              <a
                href="/bp/managementuserbp"
                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
              >
              <img
                  aria-hidden="true"
                  class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                  src="/img/manuser.png"  
                  alt="Icon Description"
                  />
                <span class="ml-3">Management User</span>
              </a>
            </li>

              <li class="border-b border-gray-300">
                <a
                  href="/frontoffice/frontoffice"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/admin2.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Front-Office</span>
                </a>
              </li>

              <li class="border-b border-gray-300">
                <a
                  href="/keuangan/keuangan"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/admin2.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Keuangan</span>
                </a>
              </li>

              <li class="border-b border-gray-300">
                <a
                  href="/manager/manager"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/admin2.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Manager</span>
                </a>
              </li>

              <!-- MANAGEMENT USER -->
              <li class="border-b border-gray-300">
                <a
                  href="/manager/managementuser"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/manuser.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Management User</span>
                </a>
              </li>
              <li class="border-b border-gray-300">
                <a
                  href="/program/program"
                  class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
                >
                <img
                    aria-hidden="true"
                    class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                    src="/img/admin2.png"  
                    alt="Icon Description"
                    />
                  <span class="ml-3">Program</span>
                </a>
              </li>
            @endif
      

      <!-- SETTING -->
      <li class="border-b border-gray-300">
        <a
          href="/{{ Auth::guard('admin')->user()->role }}/setting"
          class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-[#F2CC89] group no-underline"
        >
        <img
            aria-hidden="true"
            class="w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
            src="/img/settings-dashboard.png"  
            alt="Icon Description"
            />
          <span class="ml-3">Setting</span>
        </a>
      </li>
    </ul>
  </div>
</aside>
  
</header>
    </body>

    <!-- list table -->
     
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</html>