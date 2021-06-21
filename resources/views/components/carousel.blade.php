<div class="main-carousel">

        <span class="carousel-span">&#139;</span>
        <span class="carousel-span right-arrow">&#155;</span>

        @foreach ($categories as $category)
            <div class="section-carousel">
                <div class="carousel-images">
                    
                    <img src="{{asset($category ->img_cover)}}" alt="{{ $category ->name }}">
                    
                </div>
            </div>
        @endforeach

    </div>