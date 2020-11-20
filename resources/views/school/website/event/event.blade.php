@extends('layouts.websiteLayout.app')

@section('content')

<style>
body {
  /* background-color: #292f3b; */
  /* padding: 40px 0; */
}

h1 {
  color: #0000;
}

.container_gallary {
  padding: 40px 0;
  margin-top: 50px;
}

.gallery.row {
  margin-left: 110.5px;
  margin-right: 110.5px;
  /* border:1px solid; */
}

.gallery-list.col-md-12,
.gallery-list.col-md-6,
.gallery-list.col-md-4,
.gallery-list.col-md-3,
.gallery-list.col-md-2,
.gallery-list.col-md-1 {
  padding-left: 7.5px;
  padding-right: 7.5px;
}

.image-grid {
  width: 100%;
  height: 200px;
  margin-bottom: 15px;
  background-color: #fff;
  overflow: hidden;
  border:1px solid #fff;
  border-radius: 10px;
  object-fit: cover;
}

.image-grid * {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  -webkit-transition: all 0.45s ease;
  transition: all 0.45s ease;
  object-fit: cover;
}

.image-grid img {
  width: 100%;
  height: auto;
  transform: scale(3);
  object-fit: cover;
}

.image-grid figcaption {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1;
  align-items: center;
  bottom: 0;
  display: flex;
  flex-direction: column;
  justify-content: center;
  object-fit: cover;
}

.image-grid p {
  margin: 0;
  opacity: 0;
  letter-spacing: 1px;
  -webkit-transform: translateY(-100%);
  transform: translateY(-100%);
}

.image-grid a {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  z-index: 1;
}

.image-grid:hover > img,
.image-grid.hover > img {
  opacity: 0.1;
}

.image-grid:hover p {
  -webkit-transform: translateY(0);
  transform: translateY(0);
  opacity: 1;
}

.js-modal-image {
  max-width: 100%;
}

.modal-body {
  padding: 0;
}

.modal-open .modal {
    padding-top: 26vh;
    background-color: transparent;
}

@media (max-width: 992px) {
  .modal-open .modal {
    padding-top: 100px;
  }

  .image-grid {
    width: 100%;
    height: 180px;
  }

}


@media (max-width: 768px) {
  .gallery.container_gallary {
    padding-left: 15px;
    padding-right: 15px;
  }

  .gallery-list.col-md-12,
  .gallery-list.col-md-6,
  .gallery-list.col-md-4,
  .gallery-list.col-md-3,
  .gallery-list.col-md-2,
  .gallery-list.col-md-1 {
    padding-left: 0;
    padding-right: 0;
  }

  .gallery-row.row {
    margin-left: -15px;
    margin-right: -15px;
  }

  .gallery-row.row.pdtb-40 {
    padding-top: 10px;
  }

  .horizontal-nav {
    margin-bottom: 0;
  }

  .modal-open .modal {
    padding-top: 30vh;
  }

}
</style>

  <div class="container_gallary">
  <!-- <h2 style='margin-left:8.5%;'>Events</h2> -->
  <h2 style='margin-left:8.5%; margin-top:5%'>Events</h2>
    <div class="gallery row">
      <!-- 3 -->
      @foreach($school_event as $event)
      <div class="gallery-list col-md-4 col-xs-6">
        <div class="image-grid">
          <img src="{{asset('school_images/event/' .$event->image)}}" class="img-thumbnail">
          <figcaption>
	    		  <p class="font20 font-roboto-regular font-color-dark">click to expand</p>
	    		</figcaption>
	    		<a class="click-to-expand" href="{{url('get/event/' .$event->id)}}" data-toggle1="modal" data-target="#modalGallery"></a>
        </div>
      </div>
      @endforeach

    </div>
  </div>
  
    <div id="modalGallery" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="modalGalleryLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-body">
		        <img class="js-modal-image" src="" alt="..." />
		      </div>
		    </div>
		  </div>
		</div>
  
  
@endsection 

@section('js')
<script>
(function() {
  $(document).on("click", ".click-to-expand", function() {
    var imageSrc = $(this).parents(".image-grid").find("img").attr("src");
    $(".js-modal-image").attr("src", imageSrc);
  });
})();
</script>
@endsection