
<style>
.color{
    background-color:silver
}
</style>
<div class="accordian-body collapse " id="demo{{$n}}">
<!-- <iframe  id="pdf" src="{{asset('teacher_homeworks/' .$homework->file)}}"   
height="100%" width="100%"></iframe> -->
<iframe src="{{asset('teacher_homeworks/' .$homework->file)}}" width="100%" height="300px">
    </iframe>

</div>


@section('scripts')

<!-- <script>
     $("#playvideo").click(function(){
      $("#pdf")[0].src += "?autoplay=1";
     });
    </script> -->

<!-- <script>
document.getElementById('demo{{$n}}').ready(function(event) {
  event.preventDefault();
  event.stopPropagation();
  event.stopImmediatePropagation();
  return false;
}, false)
</script> -->

@endsection