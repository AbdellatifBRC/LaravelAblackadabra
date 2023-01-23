@extends('Arfrontend.layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="mb-5">
      <div class="container">
        @if (isset($utilities->banner1))
             <div class="hero__item set-bg" data-setbg="{{ asset($utilities->banner1 ) }}">
              {{-- <div class="hero__text">
                  <span>FRUIT FRESH</span>
                  <h2>Vegetable <br />100% Organic</h2>
                  <p>Free Pickup and Delivery Available</p>
                  <a href="#" class="primary-btn">SHOP NOW</a>
              </div> --}}
          </div>
        @endif

      </div>
    </section>
      <!-- Breadcrumb Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
      <div class="container">
        <div class="row">
          <div class="categories__slider owl-carousel">
            @foreach($menu_categories as $menu_category)
              <div class="col-lg-3">
                <div
                  class="categories__item set-bg"
                  data-setbg="{{ $menu_category->photo->getUrl() }}"
                >
                  <h5><a href="{{ route('shop.index', $menu_category->slug) }}">{{ $menu_category->name }}</a></h5>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
                <h2>منتجات  متنوعة</h2>
            </div>
          </div>
        </div>
        <div class="row featured__filter" id="product-list">
        </div>
      </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
                @if (isset($utilities->banner2))
                    <img src="{{ asset($utilities->banner2) }}" alt="" />
                @endif
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
                @if (isset($utilities->banner3))
                    <img src="{{ asset($utilities->banner3) }}" alt="" />
                @endif
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Banner End -->
@endsection
