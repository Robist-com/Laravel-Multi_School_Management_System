
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">

<style>
    /* *{
  margin: 0;
  padding: 0;
  text-decoration: none;
  font-family: "montserrat";
} */
/* body{
  background: #333;
} */
/* .middle{
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%,-50%);
}
.card{
  cursor: pointer;
  width: 305px;
  height: 280px;
}
.front,.back{
  width: 100%;
  height: 100%;
  overflow: hidden;
  backface-visibility: hidden;
  position: absolute;
  transition: transform .6s linear;
}
.front img{
  height: 100%;
}
.front{
  transform: perspective(400px) rotateY(0deg);
}
.back{
  background: #f1f1f1;
  transform: perspective(400px) rotateY(180deg);
}
.back-content{
  color: #2c3e50;
  text-align: center;
  width: 100%;
}
.sm{
  margin: 20px 0;
}
.sm a{
  display: inline-flex;
  width: 40px;
  height: 40px;
  justify-content: center;
  align-items: center;
  color: #2c3e50;
  font-size: 18px;
  transition: 0.4s;
  border-radius: 50%
}
.sm a:hover{
  background: #2c3e50;
  color: white;
}
.card:hover > .front{
  transform: perspective(400px) rotateY(-180deg);
}
.card:hover > .back{
  transform: perspective(400px) rotateY(0deg);
}*/

.img {
    width: 100%;
    height: 300px;
    padding: 5em 3em;
    padding: 0px;
} 

.sm a{
  display: inline-flex;
  width: 40px;
  height: 40px;
  justify-content: center;
  align-items: center;
  color: #2c3e50;
  font-size: 18px;
  transition: 0.4s;
  border-radius: 50%
}
.sm a:hover{
  background: #2c3e50;
  color: white;
}

@import url('https://fonts.googleapis.com/css?family=Oswald:400,700');

:root {
  --level-one: translateZ(3rem);
  --level-two: translateZ(6rem);
  --level-three: translateZ(9rem);
  
  --fw-normal: 400;
  --fw-bold: 700;
  
  /* --clr: #b7c9e5; */
}

*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
}

/* body {
  height: 100vh;
  display: grid;
  place-items: center;
  font-family: 'Oswald', sans-serif;
} */

.card {
  width: 300px;
}

.card__content {
  text-align: center;
  position: relative;
  padding: 15em 5em;
  transition: transform 3s;
  // background: pink;
  transform-style: preserve-3d;
}

.card:hover .card__content {
  transform: rotateY(.5turn);
}

.card__front,
.card__back {
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  padding: 5em 3em;
  backface-visibility: hidden;
  transform-style: preserve-3d;
  display: grid;
  align-content: center;
}

.card__front {
  background-color: var(--clr);
  /* background-image: url(https://s3-us-west-2.amazonaws.com/s.cdpn.io/308367/fair.jpg); */
 
  background-size: cover;
  background-blend-mode: overlay;
  /* color: #333; */
  color: #605ca8;
}

.card__front::before {
  content: '';
  position: absolute;
  --spacer: 1em;
  top: var(--spacer);
  bottom: var(--spacer);
  left: var(--spacer);
  right: var(--spacer);
  border: 3px solid currentColor;
  transform: var(--level-one);
}

.card__title {
  font-size: 2.0rem;
  transform: var(--level-three);
  order: 2;
  text-transform: uppercase;
}

.card__subtitle {
  transform: var(--level-two);
  text-transform: uppercase;
  letter-spacing: 4px;
  font-size: .75rem;
  font-weight: var(--fw-bold);
  opacity: .7;
}

.card__body {
  transform: var(--level-two);
  font-weight: var(fw-normal);
  font-size: 1.5rem;
  line-height: 1.6;
}

.card__back {
  transform: rotateY(.5turn);
  color: var(--clr);
  /* background: #333; */
  color:#fff;
  background: #DDA0DD;
}






</style>
<!-- <div class="table-responsive">
<table>
  @foreach ($allStudentList as $key => $student)
  <div class="col-md-3">
  <div class="card middle" >
      <div class="front">
        <img  src="{{asset('student_images/' .$student->image)}}" alt="">
      </div>
      <div class="back">
        <div class="back-content middle">
          <h2>{{$student->first_name ." ". $student->last_name}}</h2>
          <span>Youtube Channel</span>
          <div class="sm">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-youtube"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @endforeach
  </table>
  </div> -->

  <!-- <table class="table table-hover" id="show-student-gallary"> -->
  <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action" id="show-student-gallary">
            <thead>
              
            </thead>
            <tbody id="items">
              @foreach ($allStudentList as $key => $student)
              <tr>
                  <div class="col-md-3">
                <!-- <div class="card middle" style="margin-top:45%">
                    <div class="front">
                        <img  src="{{asset('student_images/' .$student->image)}}" alt="">
                    </div>
                    <div class="back">
                        <div class="back-content middle">
                        <h2>{{$student->first_name ." ". $student->last_name}}</h2>
                        <span>Youtube Channel</span>
                        <div class="sm">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-youtube"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                        </div>
                        </div>
                    </div>
                    </div> -->
                    <div class="card">
                    <div class="card__content">
                        
                        <div class="card__front">
                        <img  src="{{asset('student_images/' .$student->image)}}" alt="" class="img">
                        <h5 class="card__title">{{$student->first_name ." ". $student->last_name}}</h5>
                        <p class="card__subtitle">Student</p>
                        </div> 
                        
                        <div class="card__back">
                        <p class="card__body">{{$student->class_name}}</p>
                        <span>{{$student->first_name ." ". $student->last_name}}</span>
                        <div class="clearfix"></div>
                        {!! Form::open(['route' => ['admissions.destroy', $student->id], 'method' => 'delete']) !!}
                        <div class="sm card__body">
                        <a href="{!! url('student/fee/list/collection/payment', [$student->student_id]) !!}" class="btn  btn-xs" title="Pay Fee"><i class="fa fa-usd"></i></a>
                        <a  class="btn btn-xs accordion-toggle"  data-toggle="collapse"
                        data-target="#demo{{$key}}" title="View"><span class="fa fa-eye"></span></a>
                            <!-- <a href="#"><i class="fab fa-facebook-f"></i></a> -->
                            <a href="{!! route('PromoteStudents') !!}" class="btn btn-xs" title="Promote Student"><i class="far fa-paper-plane"></i></a>
                            <!-- <a href="#"><i class="fab fa-youtube"></i></a> -->
                            <a href="#" type="submit" title="Delete" onclick="return confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                        </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    </div>
                </div>
              </tr>
              @endforeach
          </tbody>
      </table>

