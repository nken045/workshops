<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Workshop Register') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="border-t border-gray-200">
                <dl>
                    {{-- タイトル --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Title') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('title')) }}
                        </dd>
                    </div>
                    {{-- カテゴリ --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Category') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            @if (session('category_id'))
                            {{ Form::label('', App\Consts\Category::CATEGORY_LIST_PHYSICS[session('category_id')]) }}
                            @else
                            未選択
                            @endif
                        </dd>
                    </div>
                    {{-- 開催地(都道府県) --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Venue ID') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', App\Consts\AreaConsts::PREFECTURE_LIST[session('venue_id')]) }}
                        </dd>
                    </div>

                    {{-- 開催地 --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Venue') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('venue')) }}
                        </dd>
                    </div>

                    {{-- 紹介文 --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('description')) }}
                        </dd>
                    </div>

                    {{-- 開催日時 --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Event Date Time') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('eventDateTime')->format('Y/m/d')) }}
                        </dd>
                    </div>

                    {{-- 注意・警告事項 --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Caution') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('caution')) }}
                        </dd>
                    </div>

                    {{-- キャンセル期限 --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Cancellation Deadline') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('cancellationDeadline')->format('Y/m/d')) }}
                        </dd>
                    </div>

                    {{-- 最少催行人数 --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Min Participants') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('minParticipants')) }}
                        </dd>
                    </div>

                    {{-- 雨天時の開催 --}}
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Case Of Rain') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ Form::label('', session('caseOfRain')) }}
                        </dd>
                    </div>

                    {{-- 参加費 --}}
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Participation Fee') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ number_format(session('participationFee')) }}円
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
        {{ Form::open(['url' => $inputRoute, 'method' => 'GET']) }}
            <!-- 入力画面に遷移 -->
            @if (session()->has('id'))
                {{ Form::hidden('id', session('id')) }}
            @endif
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">入力内容を変更する</button>
        {{ Form::close() }}

        {{ Form::open(['url' => $doneRoute]) }}
            <!-- 確認 -->
            <button type="submit" name="status" value={{ config('const.workshop.status.unpublished') }} class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">未公開で登録する</button>
            <button type="submit" name="status" value={{ config('const.workshop.status.published') }} class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">公開する</button>
        {{ Form::close() }}
    </div>
</x-app-layout>
