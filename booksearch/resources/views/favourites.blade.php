<x-layout>
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Your Favourite Books</h1>

        <style>
            .favourites-container {
                display: flex;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .favourite-item {
                flex: 1 1 calc(33.333% - 1rem);
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

                            <!-- Uncomment the line below to use the actual book cover image -->
                            <img src="{{ $favourite->book->cover_image_link ?? 'https://via.placeholder.com/150' }}" alt="Book Cover" style="width: 100%; height: auto; border-radius: 8px;">
                            <!-- <img src="{{ 'https://randomwordgenerator.com/img/picture-generator/50e5d6474e5bb10ff3d8992cc12c30771037dbf85254784d712f7dd59245_640.jpg' }}" alt="Book Cover" style="width: 100%; height: auto; border-radius: 8px;"> -->
                            
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
