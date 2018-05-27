@extends('layouts.app')
@section('content')

<h2 style="text-align:center">{{$event[0]->name}}</h2>

<div class="row">
  <?php $i = 1; ?>
  @foreach($images as $image)
  <div class="column">
    <img src="{{$image->image}}" style="width:100%" onclick="openModal();currentSlide(<?php echo $i; ?>)" class="hover-shadow cursor">
  </div>
  <?php $i++; ?>
  @endforeach
</div>

<div id="myModal" class="modal">
  <span class="close cursor" onclick="closeModal()">&times;</span>
  <div class="modal-content">
    @foreach($images as $image)
    <div class="mySlides">
      <div class="numbertext"></div>
      <img src="{{$image->image}}" style="width:100%">
    </div>
    @endforeach

    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>

    <div class="caption-container">
      <p id="caption"></p>
    </div>
    <?php $x=1;?>
    @foreach($images as $image)
    <div class="columnx">
      <img class="demo cursor" src="{{$image->image}}" style="width:100%" onclick="currentSlide(<?php echo $x; ?>)" alt="Nature and sunrise">
    </div>
    <?php $x++;?>
    @endforeach
  </div>
</div>

<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
@endsection
