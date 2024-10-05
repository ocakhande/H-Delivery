
document.addEventListener('DOMContentLoaded', function() {
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget;
        var cargoId = button.getAttribute('data-id');
        var status = button.getAttribute('data-status');

        var modalBodyInputId = editModal.querySelector('#cargoId');
        var modalBodyInputStatus = editModal.querySelector('#status');

        modalBodyInputId.value = cargoId;
        modalBodyInputStatus.value = status;
    });
});

