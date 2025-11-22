    <nav class="bg-neutral-primary fixed w-full z-20 top-0 start-0 border-b border-default">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-7" alt="Flowbite Logo" />
                <span class="self-center text-xl text-heading font-semibold whitespace-nowrap">Flowbite</span>
            </a>

            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
                <ul
                    class="font-medium flex flex-col p-4 md:p-0 mt-4 border border-default rounded-base bg-neutral-secondary-soft md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-neutral-primary">
                    <li>
                        <a href="{{ url('/') }}"
                            class="{{ request()->is('/') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                            Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/tasks') }}"
                            class="{{ request()->is('tasks') ? 'text-blue-600 font-semibold' : 'text-gray-700 hover:text-blue-600' }}">
                            Tasks
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
