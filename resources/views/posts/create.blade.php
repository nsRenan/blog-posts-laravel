@extends('layouts.home')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Criar Novo Post') }}
        </h2>
    </x-slot>

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="bg-black w-1/3  p-4 rounded shadow space-y-2">
        @csrf
        <div class="mx-auto max-w-2xl space-y-4" x-data="{ showNewTopic: false }">
            <div>
                <label for="topic_id" class="block text-xl font-medium text-gray-400 my-2">Tópico</label>
                <div class="flex items-center gap-2">
                    <select name="topic_id" id="topic_id"
                            :disabled="showNewTopic"
                            class="w-full text-gray-300 bg-gray-900 border border-cyan-950 p-2 rounded">
                        <option value="">Selecione um tópico existente</option>
                        @foreach($topics as $topic)
                            <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                        @endforeach
                    </select>
                    <button type="button"
                            @click="showNewTopic = !showNewTopic; if(showNewTopic) $refs.newTopic.focus()"
                            class="px-2 py-1 text-white bg-cyan-800 rounded hover:bg-cyan-600">
                        +
                    </button>
                </div>
                <input x-show="showNewTopic"
                       x-ref="newTopic"
                       type="text"
                       name="new_topic_name"
                       id="new_topic_name"
                       placeholder="Digite um novo tópico"
                       class="w-full text-gray-300 bg-gray-900 border border-cyan-950 p-2 rounded mt-2"
                       x-transition
                >
            </div>
        </div>
            <div>
                <label for="title" class="block text-xl font-medium text-gray-400 my-2">Título</label>
                <input type="text" placeholder="Digite o título" name="title"
                       class="w-full text-gray-300 bg-gray-900 border border-cyan-950 p-2 rounded" required>
            </div>
            <div>
                <label for="body" class="block text-xl font-medium text-gray-400 my-2">Conteúdo</label>
                <textarea name="body" rows="5" placeholder="Digite o conteúdo"
                          class=" w-full text-gray-300 bg-gray-900 border border-cyan-950 p-2 rounded"
                          required></textarea>
            </div>
            <div>
                <label class="block text-xl font-medium text-gray-400 my-2">Imagem do Post</label>
                <input type="file" name="image_path"
                       accept="image/*"
                       class="w-full text-gray-300 bg-gray-900 border border-cyan-950 p-2 rounded" required>
            </div>
            <button type="submit" class="bg-cyan-800 text-white px-4 py-2 cursor-pointer rounded hover:bg-cyan-600">
                Criar Post
            </button>
    </form>
</x-app-layout>
