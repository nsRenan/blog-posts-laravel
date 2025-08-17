<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard-posts') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard-posts')" :active="request()->routeIs('dashboard-posts')">
                        {{ __('Todos os Posts') }}
                    </x-nav-link>
                    <x-nav-link :href="route('post-per-id')" :active="request()->routeIs('post-per-id')">
                        {{ __('Seus Posts') }}
                    </x-nav-link>
                    <x-nav-link :href="route('posts-most-liked')" :active="request()->routeIs('posts-most-liked')">
                        {{ __('Posts Mais Curtidos') }}
                    </x-nav-link>
                    <x-nav-link :href="route('create-post')" :active="request()->routeIs('create-post')">
                        {{ __('Criar Post') }}
                    </x-nav-link>
                    <div
                        class="inline-flex items-center px-1 pt-1 border-none outline-none ring-0
                                text-sm font-medium leading-5 transition duration-150"
                    >
                        <select
                            onchange="if(this.value) window.location.href=this.value"
                            class="bg-transparent border-0 focus:outline-none w-32 h-ful text-gray-400
               @if(request()->routeIs('posts-per-topic') && $topicId)
                    border-b-2 border-indigo-600 relative translate-y-2 pb-[20px]

               @endif
               px-1 pt-1 text-sm font-medium leading-5 transition duration-150"
                        >
                            @if(!$topicId)
                                <option value="" class="bg-gray-800">
                                    {{ __('Filtrar tópicos') }}
                                </option>
                            @endif
                            @foreach($topics as $topic)
                                <option
                                    value="{{ route('posts-per-topic', $topic->id) }}"
                                    @if($topicId == $topic->id) selected @endif
                                    class="bg-gray-800 "
                                >
                                    {{ $topic->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
            <div class="hidden sm:flex sm:items-center  ">
                <div class="w-10 h-10 rounded-full overflow-hidden">
                    <img alt="imagem do perfil" class="w-full h-full object-cover"
                         src="{{Auth::user()->image_path ?? 'https://via.placeholder.com/40'}}">
                </div>
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="w-max inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

        </div>
    </div>
</nav>
