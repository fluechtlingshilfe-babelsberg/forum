/**
 * Replace occurences of {name} or {0} with provided values.
 * col is either an array or an object
 * Copied from http://stackoverflow.com/questions/1038746/equivalent-of-string-format-in-jquery
 */
function stringFormat(str, col) {
    return str.replace(/\{\{|\}\}|\{(\w+)\}/g, function (m, n) {
        if (m == "{{") { return "{"; }
        if (m == "}}") { return "}"; }
        return col[n];
    });
}

/**
 * Fetches the template with the given id from the document
 * and fills in the given values
 */
function template(id, replaceValues) {
  return stringFormat(document.getElementById(id).innerHTML, replaceValues);
}

/**
 * Replaces the text of the comment of the given ID
 * with a form allowing to edit the comment.
 */
function commentEdit(id) {
  var comment = jQuery('#comment-' + id);
  var content = comment.find('.comment-text');

  comment.find('.comment-edit').hide();

  var form = jQuery(template('template-comment-edit', {
    id: id,
    content: content.text()
  }))
    .find('.comment-edit-abort')
      .click(function(e) {
        e.preventDefault();
        comment.find('.comment-edit').show();
        jQuery(this).parents('form').replaceWith(content);
      })
    .end();

  content.replaceWith(form);
}
