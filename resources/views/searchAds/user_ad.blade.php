<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between flex-end">
            <h2 class="p-2 font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Search') }}
            </h2>
            <div class="flex flex-row">
                <form action=" {{ route('search') }} " method="post">
                    @csrf

                    <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                        <div class="form-group">
                            <input type="text" name="search" class="form-control" placeholder="Search...">
                            <select name="tag" id="searchTag">
                                <option value="titre">Title</option>
                                <option value="price">Price</option>
                            </select>
                            <select name="by" id="searchBy">
                                <option value="updated_at">Recent</option>
                                <option value="popular">Popular</option>
                            </select>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if (isset($ads))
                    @foreach ($ads as $item)
                        <div class="p-6 bg-white border-b border-gray-200">
                            <div class="pull-right">
                                <h2 class="font-semibold text-xl text-center bottom-6"> {{ $item->titre }} </h2>
                                <div class="flex flex-row content-around">
                                    @foreach ($images as $image)
                                        @foreach ($image as $imgPath)
                                            @if ($imgPath['ad_id'] === $item->ad_id)
                                                <img src="images/{{ $imgPath['image_path'] }}"
                                                    class="object-contain max-w-md max-h-48 m-auto">
                                            @endif
                                        @endforeach
                                    @endforeach
                                </div>
                                <p> {{ $item->description }} </p>
                                <p> {{ $item->price }} </p>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
