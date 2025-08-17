@extends('layouts.home')
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Post Detalhes') }}
        </h2>
    </x-slot>

    <div class="bg-white py-24 sm:py-32 dark:bg-gray-900">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div
                class="mx-auto grid max-w-2xl grid-cols-1 items-start gap-x-8 gap-y-16 sm:gap-y-24 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="lg:pr-4">
                    <div
                        class="w-96 h-[450px] flex justify-end items-end relative overflow-hidden rounded-3xl bg-gray-900 px-6 pt-64 pb-9 shadow-2xl sm:px-12 lg:max-w-lg lg:px-8 lg:pb-8 xl:px-10 xl:pb-10 dark:bg-gray-800 dark:shadow-none dark:after:pointer-events-none dark:after:absolute dark:after:inset-0 dark:after:rounded-3xl dark:after:inset-ring dark:after:inset-ring-white/10">
                        <img src="{{$post->image_path}}" alt=""
                             class="absolute inset-0 size-full rounded-3xl object-cover"/>
                        <div class="absolute inset-0 bg-gray-700 mix-blend-multiply"></div>
                        <div aria-hidden="true"
                             class="absolute top-1/2 left-1/2 -ml-16 -translate-x-1/2 -translate-y-1/2 transform-gpu blur-3xl">
                            <div
                                style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"
                                class="aspect-1097/845 w-274.25 bg-linear-to-tr from-[#ff4694] to-[#776fff] opacity-40"></div>
                        </div>
                        <div class="relative isolate ml-4 flex items-center gap-x-4">
                            <div class="flex items-center gap-x-2.5 mt-6 text-lg  text-gray-300">
                                <img src="{{ $post->user->image_path ?? 'https://via.placeholder.com/40' }}"
                                     alt="{{ $post->user->name }}" class="w-8 h-8 flex-none rounded-full bg-white/10"/>
                                Autor:<strong class="font-semibold text-white">{{ $post->user->name }} </strong>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end px-28">
                        <div
                            x-data="{
        liked: {{ $post->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }},
        count: {{ $post->likes()->count() }},
        async toggleLike() {
            let url = this.liked ? '{{ route('posts.dislike', $post) }}' : '{{ route('posts.like', $post) }}';
            let method = this.liked ? 'DELETE' : 'POST';
            const res = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if(res.ok) {
                const data = await res.json();
                this.liked = data.liked;
                this.count = data.count;
            }
        }
    }" class="flex items-center gap-2 px-30 pt-4">
                            <button @click="toggleLike" :class="liked ? 'text-white scale-110' : ' text-gray-600'" class="bg-transparent transition transform px-4 py-2 rounded-full font-semibold duration-300 ease-in-out">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    :class="liked ? 'fill-red-400 stroke-red-500 scale-110' : 'fill-transparent stroke-black'"
                                    class="w-6 h-6 transition duration-300 ease-in-out"
                                >
                                    <path d="M12 21l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41 0.81 4.5 2.09  C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5 c0 3.78-3.4 6.86-8.55 11.18L12 21z"/>
                                </svg>
                            </button>
                            <p class="text-gray-500 font-semibold text-lg">
                                <span x-text="count"></span> Pessoas Curtiu o Post
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="text-base/7 text-gray-700 lg:max-w-lg dark:text-gray-400">
                        <a href="{{ route('posts-per-topic', $post->topic->id) }}"
                           class="text-base/7 font-semibold text-indigo-600 hover:underline dark:text-indigo-400">{{$post->topic->name}}</a>
                        <h1 class="mt-2 text-4xl font-semibold tracking-tight text-pretty text-gray-900 sm:text-5xl dark:text-white">{{$post->title}}</h1>
                        <div class="max-w-xl indent-8">
                            @foreach(explode("\n", $post->body) as $line)
                                @if(trim($line) !== '')
                                    <p class="mt-4 indent-8">{{ $line }}</p>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <a href="{{ route('dashboard-posts') }}" class="inline-block mt-4 text-blue-500 hover:underline">← Voltar</a>

</x-app-layout>
