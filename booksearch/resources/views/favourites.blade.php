<x-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Your Favourite Books</h1>

        <style>
            .favourites-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
                justify-content: center;
            }

            .favourite-item {
                width: 250px;
                background-color: white;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
                padding: 1rem;
                cursor: pointer;
                text-align: center;
                transition: transform 0.2s, box-shadow 0.2s;
            }

            .favourite-item:hover {
                background-color: #81e0ff;
                transform: translateY(-5px);
                box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            }

            .favourite-item p {
                margin: 0.5rem 0;
                color: #4a5568;
            }
        </style>

        @if($favourites->isEmpty())
            <p>You have no favourite books yet.</p>
        @else
            <ul class="space-y-4">
                <div class="favourites-container">
                    @foreach($favourites as $favourite)
                        <div class="favourite-item" onclick="window.location.href='{{ url('/books/' . $favourite->book->id) }}'">

                            @if($favourite->book->cover_image_link && file_exists(public_path($favourite->book->cover_image_link)))
                            <img src="{{ $favourite->book->cover_image_link }}" alt="Book Cover" style="width: 100%; height: auto; border-radius: 8px;">
                        @else
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.0" stroke="currentColor"> 
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" 
                            style="width: 100%; height: auto; border-radius: 8px;"/> 
                        </svg>
                        @endif
                        
                            <p>{{ $favourite->book->title ?? 'Unknown Title' }}</p>
                            <p>Rating: 
                                @if ($favourite->book->ratings_avg_score)
                                    {{ number_format($favourite->book->ratings_avg_score, 1) }}/5.0
                                @else
                                    No Rating
                                @endif
                            </p>
                        </div>
                    @endforeach
                </div>
            </ul>
        @endif
    </div>
</x-layout>
