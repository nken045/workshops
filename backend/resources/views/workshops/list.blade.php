<x-app-layout>
    <div>
        <div class="rounded overflow-hidden">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">ワークショップ一覧</div>
            </div>
            <div class="px-6 pt-4 pb-2">
                {{ Form::open(['url' => route('workshop.create'), 'method' => 'GET']) }}
                    <button type="submit" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-3 px-8 rounded">新規登録</button>
                {{ Form::close() }}
                {{ Form::open(['url' => route('workshop.list'), 'method' => 'GET', 'class' => 'table m-auto']) }}
                    @if ( $status === config('const.workshop.status.published') )
                        <button type="submit" name="status" value={{ config('const.workshop.status.unpublished') }} class="bg-white hover:bg-gray-300 text-gray-400 font-bold py-3 px-7 rounded btn-in-shadow">未公開</button>
                        <button type="submit" name="status" value={{ config('const.workshop.status.published') }} class="bg-white hover:bg-gray-300 text-gray-700 font-bold py-3 px-7 rounded btn-in-shadow">公開</button>
                    @else
                        <button type="submit" name="status" value={{ config('const.workshop.status.unpublished') }} class="bg-white hover:bg-gray-300 text-gray-700 font-bold py-3 px-7 rounded btn-in-shadow">未公開</button>
                        <button type="submit" name="status" value={{ config('const.workshop.status.published') }} class="bg-white hover:bg-gray-300 text-gray-400 font-bold py-3 px-7 rounded btn-in-shadow">公開</button>
                    @endif
                {{ Form::close() }}

                @include ('components.workshop-list', ['workshops' => $workshops])

            </div>
        </div>
    </div>
</x-app-layout>