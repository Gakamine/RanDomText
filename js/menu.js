$('.accueil').click(function () {
  $('.current').removeClass('current');
  $(this).addClass('current');
});
$('.voc').click(function () {
  $('.current').removeClass('current');
  $(this).addClass('current');
});
$('.theme').click(function () {
  $('.current').removeClass('current');
  $(this).addClass('current');
});
$('.compte').click(function () {
  $('.current').removeClass('current');
  $(this).addClass('current');
});
$('.contact').click(function () {
  $('.current').removeClass('current');
  $(this).addClass('current');
});
$('#home').inView(function(){},function(){
  $('.current').removeClass('current');
  $('.accueil').addClass('current');
});
$('#voc').inView(function(){},function(){
  $('.current').removeClass('current');
  $('.voc').addClass('current');
});
$('#theme').inView(function(){},function(){
  $('.current').removeClass('current');
  $('.theme').addClass('current');
});
$('#news').inView(function () {
  $('.current').removeClass('current');
  $('.actus').addClass('current');
});
$('#contact').inView(function () {
  $('.current').removeClass('current');
  $('.contact').addClass('current');
});