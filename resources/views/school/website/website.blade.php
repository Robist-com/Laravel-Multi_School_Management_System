@extends('layouts.websiteLayout.app')

@section('content')

  @foreach($institute as $institute)
<div class="hero-slide owl-carousel site-blocks-cover" style="height:50%">
@if($school_banner)
@foreach( $school_banner as $banner)
      <div class="intro-section" style="background-image: url('{{ asset('school_images/banner/' .$banner->banner_image)}}');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>{{$banner->banner_name}}</h1>
            </div>
          </div>
        </div>
      </div>
      @endforeach
  @else
  <div class="intro-section" style="background-image: url('{{ asset('website/images/course_1.jpg')}}');">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12 mx-auto text-center" data-aos="fade-up">
              <h1>No Banner</h1>
            </div>
          </div>
        </div>
      </div>
  @endif
    </div>
 

    <div></div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-4 mb-5">
            <h2 class="section-title-underline mb-5">
              <span>Why {{$institute->name}}</span>
            </h2>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">

            <div class="feature-1 border">
              <div class="icon-wrapper btn-bg">
                <span class="flaticon-mortarboard text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Personalize Learning</h2>
                <p class="content_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                <p class="content_text"><a href="#" class="btn btn-bg px-4 rounded-0">Learn More</a></p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper btn-bg">
                <span class="flaticon-school-material text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Trusted Courses</h2>
                <p class="content_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                <p class="content_text"><a href="#" class="btn btn-bg px-4 rounded-0">Learn More</a></p>
              </div>
            </div> 
          </div>
          <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
            <div class="feature-1 border">
              <div class="icon-wrapper btn-bg">
                <span class="flaticon-library text-white"></span>
              </div>
              <div class="feature-1-content">
                <h2>Tools for Students</h2>
                <p class="content_text">Lorem ipsum dolor sit amet, consectetur adipiscing elit morbi hendrerit elit</p>
                <p class="content_text"><a href="#" class="btn btn-bg px-4 rounded-0">Learn More</a></p>
              </div>
            </div> 
          </div>
        </div>
      </div>
    </div>


    <div class="site-section">
      <div class="container">


        <div class="row mb-5 justify-content-center text-center">
          <div class="col-lg-6 mb-5">
            <h2 class="section-title-underline mb-3">
              <span>Popular Courses</span>
            </h2>
            <p class="content_text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Officia, id?</p>
          </div>
        </div>

        <div class="row">
          <div class="col-12">
              <div class="owl-slide-3 owl-carousel">
                  <div class="course-1-item">
                    <figure class="thumnail">
                      <a href="course-single.html"><img src="{{ asset('website/images/course_1.jpg')}}" alt="Image" class="img-fluid"></a>
                      <div class="price">$99.00</div>
                      <div class="category"><h3>Mobile Application</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>How To Create Mobile Apps Using Ionic</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4"> hey Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                      <p class="content_text"><a href="course-single.html" class="btn btn-bg rounded-0 px-4">Enroll In This Course</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                      <a href="course-single.html"><img src="{{ asset('website/images/course_2.jpg')}}" alt="Image" class="img-fluid"></a>
                      <div class="price">$99.00</div>
                      <div class="category"><h3>Web Design</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>How To Create Mobile Apps Using Ionic</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                      <p class="content_text"><a href="course-single.html" class="btn btn-bg rounded-0 px-4">Enroll In This Course</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                      <a href="course-single.html"><img src="{{ asset('website/images/course_3.jpg')}}" alt="Image" class="img-fluid"></a>
                      <div class="price">$99.00</div>
                      <div class="category"><h3>Arithmetic</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>How To Create Mobile Apps Using Ionic</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                      <p class="content_text"><a href="courses-single.html" class="btn btn-bg rounded-0 px-4">Enroll In This Course</a></p>
                    </div>
                  </div>

                  <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="course-single.html"><img src="{{ asset('website/images/course_4.jpg')}}" alt="Image" class="img-fluid"></a>
                      <div class="price">$99.00</div>
                      <div class="category"><h3>Mobile Application</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>How To Create Mobile Apps Using Ionic</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                      <p class="content_text"><a href="course-single.html" class="btn btn-bg rounded-0 px-4">Enroll In This Course</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="course-single.html"><img src="{{ asset('website/images/course_5.jpg')}}" alt="Image" class="img-fluid"></a>
                      <div class="price">$99.00</div>
                      <div class="category"><h3>Web Design</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>How To Create Mobile Apps Using Ionic</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                      <p class="content_text"><a href="course-single.html" class="btn btn-bg rounded-0 px-4">Enroll In This Course</a></p>
                    </div>
                  </div>
      
                  <div class="course-1-item">
                    <figure class="thumnail">
                        <a href="course-single.html"><img src="{{ asset('website/images/course_6.jpg')}}" alt="Image" class="img-fluid"></a>
                      <div class="price">$99.00</div>
                      <div class="category"><h3>Mobile Application</h3></div>  
                    </figure>
                    <div class="course-1-content pb-4">
                      <h2>How To Create Mobile Apps Using Ionic</h2>
                      <div class="rating text-center mb-3">
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                        <span class="icon-star2 text-warning"></span>
                      </div>
                      <p class="desc mb-4">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Similique accusantium ipsam.</p>
                      <p class="content_text"><a href="course-single.html" class="btn btn-bg rounded-0 px-4">Enroll In This Course</a></p>
                    </div>
                  </div>
      
              </div>
      
          </div>
        </div>

        
        
      </div>
    </div>

    


    <div class="section-bg style-1" style="background-image: url('images/about_1.jpg');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <h2 class="section-title-underline style-2">
              <span>About Our School</span>
            </h2>
          </div>
          <div class="col-lg-8">
            <p class="lead content_text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rem nesciunt quaerat ad reiciendis perferendis voluptate fugiat sunt fuga error totam.</p>
            <p class="content_text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatibus assumenda omnis tempora ullam alias amet eveniet voluptas, incidunt quasi aut officiis porro ad, expedita saepe necessitatibus rem debitis architecto dolore? Nam omnis sapiente placeat blanditiis voluptas dignissimos, itaque fugit a laudantium adipisci dolorem enim ipsum cum molestias? Quod quae molestias modi fugiat quisquam. Eligendi recusandae officiis debitis quas beatae aliquam?</p>
            <p class="content_text"><a href="#">Read more</a></p>
          </div>
        </div>
      </div>
    </div>

    <!-- // 05 - Block -->
  <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-4">
            <h2 class="section-title-underline">
              <span>Testimonials</span>
            </h2>
          </div>
        </div>


        <div class="owl-slide owl-carousel">

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="{{ asset('website/images/person_1.jpg')}}" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p class="content_text">&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="{{ asset('website/images/person_2.jpg')}}" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p class="content_text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="{{ asset('website/images/person_4.jpg')}}" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p class="content_text">&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="{{ asset('website/images/person_3.jpg')}}" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p class="content_text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="{{ asset('website/images/person_2.jpg')}}" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p class="content_text">&ldquo;Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!&rdquo;</p>
            </div>
          </div>

          <div class="ftco-testimonial-1">
            <div class="ftco-testimonial-vcard d-flex align-items-center mb-4">
              <img src="{{ asset('website/images/person_4.jpg')}}" alt="Image" class="img-fluid mr-3">
              <div>
                <h3>Allison Holmes</h3>
                <span>Designer</span>
              </div>
            </div>
            <div>
              <p class="content_text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Neque, mollitia. Possimus mollitia nobis libero quidem aut tempore dolore iure maiores, perferendis, provident numquam illum nisi amet necessitatibus. A, provident aperiam!</p>
            </div>
          </div>

        </div>
        
      </div>
    </div>
    

    <div class="section-bg style-1" style="background-image: url('{{ asset('website/images/hero_1.jpg')}}');">
      <div class="container">
        <div class="row">
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-mortarboard"></span>
            <h3>Our Philosphy</h3>
            <p class="content_text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea? Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-school-material"></span>
            <h3>Academics Principle</h3>
            <p class="content_text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
          <div class="col-lg-4 col-md-6 mb-5 mb-lg-0">
            <span class="icon flaticon-library"></span>
            <h3>Key of Success</h3>
            <p class="content_text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reiciendis recusandae, iure repellat quis delectus ea?
              Dolore, amet reprehenderit.</p>
          </div>
        </div>
      </div>
    </div>
    
    <div class="news-updates">
      <div class="container">
         
        <div class="row">
          <div class="col-lg-9">
             <div class="section-heading">
              <h2 class="text-black">News &amp; Events</h2>
              <a href="#">Read All News</a>
            </div>
            <div class="row">
              <div class="col-lg-6">
              @foreach($school_event as $event)
                <div class="post-entry-big">
                <a href="{{url('get/event/' .$event->event_id)}}" class="img-link"><img src="{{ asset('school_images/event/' .$event->image)}}" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta"> 
                      <a href="#">{{$event->start_date}}</a>
                      <span class="mx-1">/</span>
                      <a href="#">{{$event->event_name}}</a>, <a href="#">{{$event->place}}</a>
                    </div>
                    <!-- <h3 class="post-heading"> -->
                  <?php    $limited_word = Str::limit($event->body, 40); ?>
                            <p class="content_text">{{$limited_word}} <a href="{{url('get/event/' .$event->event_id)}}" class="btn btn-bg px-4 rounded-0">Read More</a></p> 
                    <!-- </h3> -->
                  </div>
                  @endforeach
                </div>
              </div>
              <div class="col-lg-6">
              @foreach($school_event as $event)
                <div class="post-entry-big horizontal d-flex mb-4">
                  <a href="{{url('get/event/' .$event->event_id)}}" class="img-link mr-4"><img src="{{ asset('school_images/event/' .$event->image)}}" alt="Image" class="img-fluid"></a>
                  <div class="post-content">
                    <div class="post-meta">
                      <a href="#">{{$event->start_date}}</a>
                      <span class="mx-1">/</span>
                      <a href="#">{{$event->event_name}}</a>, <a href="#">{{$event->place}}</a>
                    </div>
                    <h3 class="post-heading"><a href="news-single.html"></a></h3>
                  </div>
                </div>
              @endforeach
              </div>
            </div>
          </div>
          <div class="col-lg-3">
            <div class="section-heading">
              <h2 class="text-black">School Videos</h2>
              <a href="#">View All Videos</a>
            </div>
            <a href="https://www.youtube.com/watch?v=HT_8_P4noDc" class="video-1 mb-4" data-fancybox="" data-ratio="2">
              <span class="play">
                <span class="icon-play"></span>
              </span>
              <img src="{{ asset('website/images/course_5.jpg')}}" alt="Image" class="img-fluid">
            </a>
            <a href="https://www.youtube.com/watch?v=lWIPPAM5Uqw" class="video-1 mb-4" data-fancybox="" data-ratio="2">
                <span class="play">
                  <span class="icon-play"></span>
                </span>
                <img src="{{ asset('website/images/course_5.jpg')}}" alt="Image" class="img-fluid">
              </a>
          </div>
        </div>
      </div>
    </div>
@endforeach
@endsection