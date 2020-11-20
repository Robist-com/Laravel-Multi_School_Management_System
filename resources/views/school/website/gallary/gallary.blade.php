@extends('layouts.websiteLayout.app')

@section('content')

@include('school.website.gallary.style')

  <h1 class="text-center">Responsive Bootstrap Masonry Gallery</h1>
  <div class="container_gallary">
  <h2 style='margin-left:8.5%;'>Gallary</h2>
    <div class="gallery row">
      <!-- 3 -->
      @foreach($school_gallary as $gallary)
      <div class="gallery-list col-md-4 col-xs-6">
        <div class="image-grid">
          <img src="{{asset('school_images/media_manager/' .$gallary->filename)}}">
          <figcaption>
	    		  <p class="font20 font-roboto-regular font-color-dark">click to expand</p>
	    		</figcaption>
	    		<a class="click-to-expand" href="#" data-toggle="modal" data-target="#modalGallery"></a>
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

@section('scripts')
<script>
(function() {
  $(document).on("click", ".click-to-expand", function() {
    var imageSrc = $(this).parents(".image-grid").find("img").attr("src");
    $(".js-modal-image").attr("src", imageSrc);
  });
})();
</script>
@endsection