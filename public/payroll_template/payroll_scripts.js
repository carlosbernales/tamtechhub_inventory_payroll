document.addEventListener('DOMContentLoaded', function() {
  var cells = document.querySelectorAll('.agent-cell-clickable');

  cells.forEach(function(cell) {
    cell.addEventListener('click', function() {
      var editButton = this.parentElement.querySelector('button[data-toggle="modal"]');
      if (editButton) {
        editButton.click();
      }
    });
  });
});