<div class="gallery-photos masonry">
    @foreach($post->photos->take(4) as $photo)
        <figure class="gallery-image">
            @if ($loop->iteration === 4)
                <div class="overlay">{{ $post->photos->count() }} Fotos</div>
            @endif
            <img src="{{ Storage::url( $photo->url) }}" alt="" class="img-responsive">
        </figure>
    @endforeach
</div>