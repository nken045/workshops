{{ Form::hidden('status', $workshop->status) }}
<button type="submit" name="id" value="{{ $workshop->id }}" >
<div class="ws-card">
  <img src="{{ asset('images/image_sample.png') }}" />
  @if (($workshop->category_id))
  <span>{{ App\Consts\Category::CATEGORY_TO_PHYSICS[$workshop->category_id] }}</span>
  @endif
  @if (($workshop->venue_id))
  <span>{{ App\Consts\AreaConsts::PREFECTURE_LIST[$workshop->venue_id] }}</span>
  @endif
  <h3 class="text-ellipsis m-2 ">{{ $workshop->title }}</h3>
</div>
</button>
