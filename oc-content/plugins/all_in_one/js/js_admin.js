$(document).ready(function() {
  $('.sup-go').click(function() {
    event.stopPropagation();
    var this_class = $(this).attr('class');
    this_class = this_class.replace('sup-go ','')
    $('.sup-' + this_class).parent().animate({ borderColor: "rgba(0, 0, 0, 0.45) rgba(0, 0, 0, 0.45) rgba(0, 0, 0, 0.7)" }, 'fast');
    var pos = $('.sup-' + this_class).offset().top - $('.navbar').outerHeight() - 12;
    $('html, body').animate({
      scrollTop: pos
    }, 1400);
    return false;
  });

  $('html').click(function() {
    $('.warn').animate({ borderColor: "rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25)" }, 'fast');
  });

  $('.unlock-link').click(function() {
    var link_id = $(this).attr('id');
    $("input[name='seo_title"+link_id+"'], input[name='seo_desc"+link_id+"'], input[name='seo_keywords"+link_id+"']").removeAttr('disabled');
    $("input[name='seo_title"+link_id+"'], input[name='seo_desc"+link_id+"'], input[name='seo_keywords"+link_id+"']").css('opacity','1');
    $("input[name='seo_title"+link_id+"'], input[name='seo_desc"+link_id+"'], input[name='seo_keywords"+link_id+"']").css('border','1px solid #aaaaaa');
    $(this).fadeOut(300);
    return false;
  });

  $('.unlock-link').hover(function(){
    $(this).find('.fa').addClass('fa-unlock-alt').removeClass('fa-lock');
  }, function(){
    $(this).find('.fa').addClass('fa-lock').removeClass('fa-unlock-alt');
  });

  $('#sitemap_items').click(function(){
    if($('#sitemap_items').val() == 0) { $('#sitemap_items_limit').css('opacity', '0.7');$('#sitemap_items_limit').prop('disabled', true); $('#sitemap_items_limit').css('color', '#666'); $('#sitemap_items_limit').css('background-color', '#fefefe'); } else { $('#sitemap_items_limit').prop('disabled', false); $('#sitemap_items_limit').css('color', '#000'); $('#sitemap_items_limit').css('background-color', '#fff');$('#sitemap_items_limit').css('opacity', '1'); }
  });

  $('#robotsEnabled').click(function(){
    if($('#robotsEnabled').val() == 0) { $('#robots').css('opacity', '0.7'); $('#robots').prop('disabled', true); $('#robots').css('color', '#666'); $('#robots').css('background-color', '#fefefe'); } else { $('#robots').prop('disabled', false); $('#robots').css('color', '#000'); $('#robots').css('background-color', '#fff');$('#robots').css('opacity', '1'); }
  });

  $('#htaccessEnabled').click(function(){
    if($('#htaccessEnabled').val() == 0) { $('#htaccess').css('opacity', '0.7'); $('#htaccess').prop('disabled', true); $('#htaccess').css('color', '#666'); $('#htaccess').css('background-color', '#fefefe'); } else { $('#htaccess').prop('disabled', false); $('#htaccess').css('color', '#000'); $('#htaccess').css('background-color', '#fff');$('#htaccess').css('opacity', '1'); }
  });

  $('.link-add').click(function(){
    $('#link_add_update').val('add');
  });

  $('.link-update').click(function(){
    $('#link_add_update').val('update');
  });

  $('.link-rec-add').click(function(){
    $('#link_rec_add_update').val('add');
  });

  $('.link-rec-update').click(function(){
    $('#link_rec_add_update').val('update');
  });

  $('.link-rec-email').click(function(){
    $('#link_rec_add_update').val('email');
  });
});