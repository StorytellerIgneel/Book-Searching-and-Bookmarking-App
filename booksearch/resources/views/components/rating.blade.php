@props(['book'])

@if (  $book->ratings_avg_score )
<span class="flex-shrink-0 text-xs font-semibold px-2 py-1 rounded-full 
        @if($book->ratings_avg_score >= 4) bg-green-50 text-green-700
        @elseif($book->ratings_avg_score >= 3) bg-yellow-50 text-yellow-700
        @else bg-red-50 text-red-700 @endif">
    ★ {{ number_format($book->ratings_avg_score ?? 0, 1) }}
</span>
@else
<span class="flex-shrink-0 text-xs font-semibold px-2 py-1 rounded-full bg-gray-50 text-gray-700">
    No ratings
</span>
@endif