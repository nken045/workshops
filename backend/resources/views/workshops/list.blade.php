<x-app-layout>
    <div>
        <div class="rounded overflow-hidden">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">ワークショップ一覧</div>
            </div>
            <div class="px-6 pt-4 pb-2">
                {{ Form::open(['url' => route('workshop.create'), 'method' => 'GET']) }}
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">新規登録</button>
                {{ Form::close() }}
                {{ Form::open(['url' => route('workshop.list'), 'method' => 'GET']) }}
                    <button type="submit" name="status" value={{ config('const.workshop.status.unpublished') }} class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">未公開</button>
                    <button type="submit" name="status" value={{ config('const.workshop.status.published') }} class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">公開</button>
                {{ Form::close() }}
                {{ Form::open(['url' => route('workshop.detail'), 'method' => 'GET']) }}
                    @foreach ($workshops as $workshop)
                        {{ Form::hidden('status', $workshop->status) }}
                        <button type="submit" name="id" value="{{ $workshop->id }}" class="bg-white p-6 shadow-lg rounded-lg flex justify-between items-center">
                            <div class="md:flex">
                                <div class="md:flex-shrink-0">
                                    <img class="h-48 w-full object-cover md:w-48" src="{{ asset('images/image_sample.png') }}" alt="">
                                </div>
                                <div class="p-8">
                                    <p class="block mt-1 text-lg leading-tight font-medium text-black">{{ $workshop->title }}</p>
                                    <p class="uppercase tracking-wide text-sm text-gray-400 font-semibold">{{ $workshop->venue }}</p>
                                    <span class="mt-2">{{ $workshop->description }}</span>
                                </div>
                            </div>
                        </button>
                    @endforeach
                {{ Form::close() }}
            </div>
        </div>
    </div>
</x-app-layout>