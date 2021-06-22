<div class="main-carousel">



        {{-- <span class="carousel-span">&#139;</span>
        <span class="carousel-span right-arrow">&#155;</span> --}}

        @foreach ($categories as $category)
            <category-card-component
                :category = "{{ $category }}"
            ></category-card-component>
        @endforeach

    </div>