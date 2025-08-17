@extends('layouts.home')

@section('content')
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="mx-auto grid max-w-2xl auto-rows-fr grid-cols-1 gap-8 lg:mx-0 lg:max-w-none md:grid-cols-3  lg:grid-cols-3 xl:grid-cols-4">

            @foreach($posts as $post)
                <article
                    class="relative isolate flex flex-col justify-end overflow-hidden rounded-2xl bg-gray-900 px-8 pt-80 pb-8 sm:pt-48 lg:pt-80">
                    <img src="{{ $post->image_path }}" alt="{{ $post->title }}"
                         class="absolute inset-0 -z-10 w-full h-full object-cover"/>
                    <div class="absolute inset-0 -z-10 bg-gradient-to-t from-gray-900 via-gray-900/40"></div>
                    <div class="absolute inset-0 -z-10 rounded-2xl ring-1 ring-gray-900/10"></div>

                    <div class="flex flex-wrap items-center gap-y-1 overflow-hidden text-sm/6 text-gray-300">
                        <time datetime="{{ $post->created_at->format('Y-m-d') }}" class="mr-8">
                            {{ $post->created_at->format('d M, Y') }}
                        </time>
                        <div class="-ml-4 flex items-center gap-x-4">
                            <svg viewBox="0 0 2 2" class="-ml-0.5 w-0.5 h-0.5 flex-none fill-white/50">
                                <circle r="1" cx="1" cy="1"/>
                            </svg>
                            <div class="flex gap-x-2.5">
                                <img src="{{ $post->user->image_path ?? 'https://via.placeholder.com/40' }}"
                                     alt="{{ $post->user->name }}" class="w-6 h-6 flex-none rounded-full bg-white/10"/>
                                {{ $post->user->name }}
                            </div>
                        </div>
                    </div>

                    <h3 class="mt-3 text-lg/6 font-semibold text-white">
                        <a href="{{route('posts-show', $post)}}">
                            <span class="absolute inset-0"></span>
                            {{ $post->title }}
                        </a>
                    </h3>

                    <p class="mt-2 text-sm text-gray-300">{{ Str::limit($post->body, 100)  }}</p>
                </article>
            @endforeach

        </div>
    </div>
@endsection
