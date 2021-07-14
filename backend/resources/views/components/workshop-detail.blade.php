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
                     {{ __('Category') }}
                 </dt>
                 <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     @if ($workshop->category_id)
                     {{ App\Consts\Category::CATEGORY_LIST_PHYSICS[$workshop->category_id] }}
                     @else
                     未選択
                     @endif
                 </dd>
             </div>
             <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                 <dt class="text-sm font-medium text-gray-500">
                     {{ __('Description') }}
                 </dt>
                 <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     {{ $workshop->description }}
                 </dd>
             </div>
             <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                 <dt class="text-sm font-medium text-gray-500">
                     {{ __('Event Date Time') }}
                 </dt>
                 <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     {{ $workshop->event_date_time->format('Y/m/d') }}
                 </dd>
             </div>
             <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                 <dt class="text-sm font-medium text-gray-500">
                     {{ __('Participation Fee') }}
                 </dt>
                 <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     {{ number_format($workshop->participation_fee) }}円/回
                 </dd>
             </div>
             <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                 <dt class="text-sm font-medium text-gray-500">
                     {{ __('Venue ID') }}
                 </dt>
                 <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                     {{ App\Consts\AreaConsts::PREFECTURE_LIST[$workshop->venue_id] }}
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