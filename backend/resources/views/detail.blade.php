<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Workshop Detail') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        @include ('components.workshop-detail', ['workshop' => $workshop])

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
        @elseif (!$alreadyApplied)
            {{ Form::open(['url' => route('workshop.join.confirm')]) }}
                <!-- 参加申し込み確認画面に遷移 -->
                <button name="id" value="{{ $workshop->id }}" type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">参加申し込み</button>
            {{ Form::close() }}
        @endif
    </div>
</x-app-layout>
