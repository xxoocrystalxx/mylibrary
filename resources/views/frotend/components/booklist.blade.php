<div class="mybox">
    <h3 class="mytitle"><i class="{{ $icon }}"></i> {{ $title }}</h3>
    <div class="newnovels">
        <ul>
            @foreach ($books as $item)
                <li>
                    <a href="{{ route('book.details', $item->id) }}">
                        <div class="book-image">
                            <img src="{{ !empty($item->image) ? url($item->image) : url('upload/no_image.jpg') }}">
                        </div>
                    </a>
                </li>
            @endforeach

        </ul>
    </div>
</div>
