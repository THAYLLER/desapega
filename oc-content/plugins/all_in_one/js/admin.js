$(document).ready(function(){

  // HELP TOPICS
  $('#mb-help > .mb-inside > .mb-row.mb-help > div').each(function(){
    var cl = $(this).attr('class');
    $('label.' + cl + ' span').addClass('mb-has-tooltip').prop('title', $(this).text());
  });

  $('.mb-row label').click(function() {
    var cl = $(this).attr('class');
    var pos = $('#mb-help > .mb-inside > .mb-row.mb-help > div.' + cl).offset().top - $('.navbar').outerHeight() - 12;;
    $('html, body').animate({
      scrollTop: pos
    }, 1400, function(){
      $('#mb-help > .mb-inside > .mb-row.mb-help > div.' + cl).addClass('mb-help-highlight');
    });

    return false;
  });


  // ON-CLICK ANY ELEMENT REMOVE HIGHLIGHT
  $('body, body *').click(function(){
    $('.mb-help-highlight').removeClass('mb-help-highlight');
  });


  // GENERATE TOOLTIPS
  Tipped.create('.mb-has-tooltip', { maxWidth: 200, radius: false });


  // CHECKBOX & RADIO SWITCH
  $.fn.bootstrapSwitch.defaults.size = 'small';
  $.fn.bootstrapSwitch.defaults.labelWidth = '0px';
  $.fn.bootstrapSwitch.defaults.handleWidth = '50px';

  $(".element-slide").bootstrapSwitch();



  // MARK ALL
  $('input.mb_mark_all').click(function(){
    if ($(this).is(':checked')) {
      $('input[name^="' + $(this).val() + '"]').prop( "checked", true );
    } else {
      $('input[name^="' + $(this).val() + '"]').prop( "checked", false );
    }
  });

  // HTACCESS CHANGE VALUE
  $('#htaccess_file').on('change', function(){
    if($(this).val() == 1) {
      $('#htaccess_custom').prop('readonly', false);
    } else {
      $('#htaccess_custom').prop('readonly', true);
    }
  });


  // LOCK-UNLOCK FOR INPUTS
  $('a.mb-lock').on('click', function(e){
    e.preventDefault();
    $(this).parent().parent().find('input').prop('disabled', false).css('opacity', 1);
    $(this).find('.fa').removeClass('fa-lock').addClass('fa-check');

  });


  // ON LOCALE CHANGE RELOAD PAGE
  $('select.mb-select-locale').on('change', function(){
    window.location.replace($(this).attr('rel') + "&ais-locale=" + $(this).val());
  });

});