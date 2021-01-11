
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                    <li data-target="#slider-carousel" data-slide-to="1"></li>
                    <li data-target="#slider-carousel" data-slide-to="2"></li>
                </ol>
                @php
                    $i=0;
                @endphp
                <div class="carousel-inner">         
                    @foreach ($slider as $item)
                        @php
                            $i++;
                        @endphp
                        <div class="item {{$i==1 ? 'active': ''}}">
                            <div class="col-sm-6">
                                <h1><span>E</span>-SHOPPER</h1>
                                <h2>{{$item->slider_name}}</h2>
                                <p>{{$item->slider_desc}}</p>
                                <button type="button" class="btn btn-default get">Get it now</button>
                            </div>
                            <div class="col-sm-6">
                                <img src="public/uploads/products/{{$item->slider_image}}" class="img img-responsive" width="75%" height="80%" />
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
            
        </div>
    </div>
</div>
