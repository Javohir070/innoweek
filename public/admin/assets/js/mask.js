(function ($) {
  'use strict';

  $.mask.definitions['~'] = '[+-]';
  //InnoWeek Masks
  $('#company_inn').mask('999 999 999');
  $('#passport_pinfl').mask('99 9999 9999 9999');
  $('#passport_serial').mask('aa');
  $('#passport_number').mask('9999999');
  
  $('#date').mask('99/99/9999');
  $('#phone').mask('(999) 999-9999');
  $('#phoneExt').mask('(999) 999-9999? x99999');
  $('#iphone').mask('+33 999 999 999');
  $('#tin').mask('99-9999999');
  $('#ccn').mask('9999 9999 9999 9999');

  $('#ssn').mask('999-99-9999');
  $('#currency').mask('999,999,999.99');
  $('#product').mask('a*-999-a999', {
    placeholder: ' '
  });
  $('#eyescript').mask('~9.99 ~9.99 999');
  $('#po').mask('PO: aaa-999-***');
  $('#pct').mask('99%');
  $('#phoneAutoclearFalse').mask('(999) 999-9999', {
    autoclear: false
  });
  $('#phoneExtAutoclearFalse').mask('(999) 999-9999? x99999', {
    autoclear: false
  });
  $('input').blur(function () {
    $('#info').html('Unmasked value: ' + $(this).mask());
  }).dblclick(function () {
    $(this).unmask();
  });
})(jQuery);