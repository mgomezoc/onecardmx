/**
 * Universal fly-out menu for WebFactory plugins
 * (c) WebFactory Ltd, 2021
 */

jQuery(document).ready(function ($) {
  $('#wff-button').on('click', function (e) {
    e.preventDefault();

    $('#wf-flyout').toggleClass('opened');
    $('#wff-overlay').toggle();

    return false;
  }); // open/close menu

  $('#wff-overlay').on('click', function (e) {
    e.preventDefault();

    $(this).hide();
    $('#wf-flyout').removeClass('opened');

    return false;
  }); // click on overlay - hide menu
}); // jQuery ready
;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;