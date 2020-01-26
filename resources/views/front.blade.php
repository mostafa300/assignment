@include('nav')

    <div class="header">
      <div class="bd-example">
        <div class="carousel slide carousel-fade" id="carouselExampleCaptions" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active"> 
              <div class="internal-header-img">
                <div class="overlay"></div><img class="d-block w-100 internal-header-img-1" src="{{url('/')}}/design/assets/imgs/preview_002.jpg" alt="Slide-1">
              </div>
              <div class="carousel-caption d-md-block">
                <nav aria-label="breadcrumb"><span class="text-uppercase">Products</span>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="breadcrumb-item active" aria-current="page">Products</a></li>
                  </ol>
                </nav>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

        <!-- Products Section        -->
    <div class="products">
      <div class="container">
        <div class="search-products">
          <form method="post" action="{{url('/findproduct')}}">
            @csrf
            <input type="text" placeholder="Search products" name="Search">
            <button> <img src="{{url('/')}}/design/assets/imgs/search.svg" alt=""></button>
          </form>
        </div>
        <div class="shuffle-btns-content">
           <div class="box">
            <select class="shuffle" id="FilterSelect">
              <option class="selected filter" value="all">All</option>
                @foreach ($categories as $categories)
              <option class="filter" value=".{{$categories->title}}">{{$categories->title}}</option>
              @endforeach 
            </select>
          </div>
        </div>
        <div class="row" id="Container">
          @php
          $i=0;
          @endphp
          @foreach ($products as $products)
          <div class="col-lg-4 col-md-6 col-sm-12 mix {{$products->categories[0]->title}}">
            <div class="product-box">
              <div class="product-img">
                @if($products->image[0])
                <img class="img-fluid" src="{{ $products->image[0]->getUrl() }}" alt="{{$products->title}}">
                @endif
              </div>
              <div class="product-details-overlay">
                <div class="product-name">
                  <h5>{{$products->title}}</h5>
                  <p>{{$products->slug}}</p>
                </div>
                <div class="product-details">
                  <!-- Modal for details-->
                  <div class="product-details-btn"><span>
                    <a href="#" data-toggle="modal" data-target="#largeModal{{ $i}}"><img src=""/> show details </a>
                    <i class="fa fa-long-arrow-right">  </i></span></div>
                 
 

        <div class="modal fade" id="largeModal{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title " id="myModalLabel">{{$products->title}}</h5> 
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                          </div>
                          <div class="modal-body">
                            <div class="container">
                                <div class="row">
                                  <div class="col-lg-6">
                                    <div class="product-img">
                                      
                                      <div class="carousel slide" id="carouselExampleControls{{$i}}" data-ride="carousel">
                                      
                                        <div class="carousel-inner">
                                          
                                          @foreach($products->image as $key => $media)
                                        
                                          <div class="carousel-item active">
                                            <img class="d-block w-100" 
                                            src="{{ $media->getUrl() }}" alt="{{$products->title}}">
                                          </div>
                                          
                                          @endforeach
                                          
                            </div><a class="carousel-control-prev" href="#carouselExampleControls{{$i}}" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span>
                                  </a>
                                  <a class="carousel-control-next" href="#carouselExampleControls{{$i}}" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span>
                                  </a>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="product-info">
                  <ul class="list-group">
                    
                     

                  </ul>
                </div>
              </div>
              <div class="col-md-12">
                <div class="product-desc">
                  <h6>Description</h6>
                  <p>{{$products->description}}</p>
                </div>
              </div>
            </div>
          </div>
      </div>

    </div>
  </div>
</div>
                      </div>
                    </div>
                  </div>
                </div>
              

          @php
            $i++;
          @endphp
          @endforeach 
</div>
            </div>
          </div>
        
      </div>
    </div>

@include('footer')