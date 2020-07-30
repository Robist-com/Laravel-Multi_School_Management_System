<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist" id="myTab">
@foreach($admissions as $key => $admission)
  <li class="active"><a href="#{{$admission->batch}}" role="tab" data-toggle="tab">{{$admission->batch}}</a></li>
@endforeach
</ul>
