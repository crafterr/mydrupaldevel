(function ($, Drupal) {
  /**
   * Add new custom command.
   */
  Drupal.AjaxCommands.prototype.example = function (ajax, response, status) {
    console.log(response.message);

    var content = response.response;
    $('div.content').append(content);
  }
})(jQuery, Drupal);