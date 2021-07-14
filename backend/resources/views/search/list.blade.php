<x-app-layout>
    <div>
        <div class="rounded overflow-hidden">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">検索結果一覧</div>
            </div>
            <div class="px-6 pt-4 pb-2">
                @empty ($workshops[0])
                    <p>条件に一致するワークショップはありません<p>
                @else
                    @include ('components.workshop-list', ['workshops' => $workshops])
                @endempty
            </div>
        </div>
    </div>
</x-app-layout>