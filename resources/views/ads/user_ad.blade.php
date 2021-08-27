<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ads') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="pull-right">
                        <a class="hover:text-gray-500" href="{{ route('ads.create') }}" title="Create a project">
                            Add an ad
                        </a>
                    </div>
                </div>
                @foreach ($ads as $item)
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="pull-right">
                            <div class="bg-gray border-gray-400">
                                @if (auth()->user()->id === $item->id)
                                    <div class="flex content-center text-center">
                                        <form action="{{ route('ads.destroy', $item->ad_id) }}" method="POST">

                                            <a href="{{ route('ads.show', $item->ad_id) }}" title="show"
                                                class="hover:text-gray-500">
                                                View
                                            </a>

                                            <a href="{{ route('ads.edit', $item->ad_id) }}"
                                                class="hover:text-gray-500">
                                                Edit
                                            </a>

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" title="delete" class="hover:text-gray-500">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                    <hr>
                                @endif
                            </div>
                            <h2 class="font-semibold text-xl text-center bottom-6"> {{ $item->titre }} </h2>
                            <div class="flex flex-row content-around">
                                @foreach ($images as $image)
                                    @foreach ($image as $imgPath)
                                        @if ($imgPath['ad_id'] === $item->ad_id)
                                            <img src="images/{{ $imgPath['image_path'] }}" class="object-contain max-w-md max-h-48 m-auto">
                                        @endif
                                    @endforeach
                                @endforeach
                            </div>
                            <p> {{ $item->description }} </p>
                            <p> {{ $item->price }} </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
