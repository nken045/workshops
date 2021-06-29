<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Workshop Detail') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg leading-6 font-medium text-gray-900">
                    {{ $workshop->title }}
                </h3>
            </div>
            <div class="border-t border-gray-200">
                <dl>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Description') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->description }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Event Date Time') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->event_date_time->format('Y/m/d') }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Participation Fee') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ number_format($workshop->participation_fee) }}円/回
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Venue') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->venue }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Cancellation Deadline') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->cancellation_deadline->format('Y/m/d') }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Min Participants') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->min_participants }}
                        </dd>
                    </div>
                    <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Case Of Rain') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->case_of_rain }}
                        </dd>
                    </div>
                    <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                        <dt class="text-sm font-medium text-gray-500">
                            {{ __('Caution') }}
                        </dt>
                        <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                            {{ $workshop->caution }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>

        @if (Auth::id() === $workshop->host_user_id)
            @if ($workshop->status === config('const.workshop.status.published'))
                <p>参加予定のメンバー</p>
                @foreach ($participationUsers as $user)
                    <div class="bg-white p-6 shadow-lg rounded-lg flex justify-between items-center">
                        <div class="flex">
                            <div>
                                <span class="text-xl font-medium">{{ $user->name }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
            {{ Form::open(['url' => route('workshop.edit'), 'method' => 'GET']) }}
                <!-- 更新 -->
                <button name="id" value="{{ $workshop->id }}" type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">編集する</button>
            {{ Form::close() }}
            {{ Form::open(['url' => route('workshop.destroy')]) }}
                <!-- 削除 -->
                <button name="id" value="{{ $workshop->id }}" type="submit" onclick="return confirmDialog('ワークショップの削除')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">このワークショップを削除する</button>
            {{ Form::close() }}
        @elseif (!$alreadyApplied)
            {{ Form::open(['url' => route('workshop.join.confirm')]) }}
                <!-- 参加申し込み確認画面に遷移 -->
                <button name="id" value="{{ $workshop->id }}" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">参加申し込み</button>
            {{ Form::close() }}
        @endif
    </div>
</x-app-layout>
