<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        @if (session()->has('isEdit'))
        {{ __('Workshop Edit') }}
        @else    
            {{ __('Workshop Register') }}
        @endif    
        </h2>
    </x-slot>
    <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        {{ Form::open(['url' => route('workshop.confirm')]) }}
            <!-- タイトル -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('title', __('Title')) }}
                {{ Form::text('title', session('title'), ['class' => 'mt-1 block w-full divide-gray-100', 'placeholder' => '例）〇〇制作']) }}
                @if ($errors->has('title'))
                    <p class="error-msg">{{ $errors->first('title') }}</p>
                @endif
            </div>

            <!-- 開催地 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('venue_id', __('Venue ID')) }}
                {{ Form::select('venue_id', App\Consts\AreaConsts::PREFECTURE_LIST, session('venue_id'), ['class' => 'mt-1 block w-full']) }}
                @if ($errors->has('venue_id'))
                    <p class="error-msg">{{ $errors->first('venue_id') }}</p>
                @endif
            </div>
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('venue', __('Venue')) }}
                {{ Form::text('venue', session('venue'), ['class' => 'mt-1 block w-full', 'placeholder' => '例）渋谷区〇〇']) }}
                @if ($errors->has('venue'))
                    <p class="error-msg">{{ $errors->first('venue') }}</p>
                @endif
            </div>

            <!-- 紹介文 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('description', __('Description')) }}
                {{ Form::textarea('description', session('description'), ['class' => 'mt-1 block w-full', 'placeholder' => '']) }}
                @if ($errors->has('description'))
                    <p class="error-msg">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <!-- カテゴリ -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('category_id', __('Category')) }}
                {{ Form::select('category_id', App\Consts\Category::CATEGORY_LIST_PHYSICS, session('category_id'), ['class' => 'mt-1 block w-full', 'placeholder' => '']) }}
                @if ($errors->has('description'))
                    <p class="error-msg">{{ $errors->first('description') }}</p>
                @endif
            </div>

            <!-- 開催日時 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('eventDateTime', __('Event Date Time')) }}
                {{ Form::date('eventDateTime', optional(session('eventDateTime'))->format('Y-m-d'), ['class' => 'mt-1 block w-full']) }}
                @if ($errors->has('eventDateTime'))
                    <p class="error-msg">{{ $errors->first('eventDateTime') }}</p>
                @endif
            </div>

            <!-- 注意・警告事項 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('caution', __('Caution')) }}
                {{ Form::text('caution', session('caution'), ['class' => 'mt-1 block w-full', 'placeholder' => '例）貴重品は各自で管理をお願いします。']) }}
                @if ($errors->has('caution'))
                    <p class="error-msg">{{ $errors->first('caution') }}</p>
                @endif
            </div>

            <!-- キャンセル期限 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('cancellationDeadline', __('Cancellation Deadline')) }}
                {{ Form::date('cancellationDeadline', optional(session('cancellationDeadline'))->format('Y-m-d'), ['class' => 'mt-1 block w-full']) }}
                @if ($errors->has('cancellationDeadline'))
                    <p class="error-msg">{{ $errors->first('cancellationDeadline') }}</p>
                @endif
            </div>

            <!-- 最少催行人数 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('minParticipants', __('Min Participants')) }}
                {{ Form::text('minParticipants', session('minParticipants'), ['class' => 'mt-1 block w-full', 'placeholder' => '例）開催前日までに4人未満なら中止']) }}
                @if ($errors->has('minParticipants'))
                    <p class="error-msg">{{ $errors->first('minParticipants') }}</p>
                @endif
            </div>

            <!-- 雨天時の開催 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('caseOfRain', __('Case Of Rain')) }}
                {{ Form::text('caseOfRain', session('caseOfRain'), ['class' => 'mt-1 block w-full', 'placeholder' => '例）雨天決行']) }}
                @if ($errors->has('caseOfRain'))
                    <p class="error-msg">{{ $errors->first('caseOfRain') }}</p>
                @endif
            </div>

            <!-- 参加費 -->
            <div class="col-span-6 sm:col-span-4 my-4">
                {{ Form::label('participationFee', __('Participation Fee'), ['class' => 'block']) }}
                {{ Form::text('participationFee', session('participationFee'), ['class' => 'mt-1 block w-2/5 inline-block', 'placeholder' => '例）1000']) }}  円
                @if ($errors->has('participationFee'))
                    <p class="error-msg">{{ $errors->first('participationFee') }}</p>
                @endif
            </div>

            <!-- 確認 -->
            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded my-4">確認</button>
        {{ Form::close() }}
    <div>
</x-app-layout>
