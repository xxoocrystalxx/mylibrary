<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<div id="AddLibraryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel">Choose a status:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-horizontal mt-3" action="{{ route('store.library') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" id="book_id">
                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input type="radio" class="btn-check" name="status" id="option1" value="Want to read"
                                autocomplete="off" checked>
                            <label class="btn btn-outline-secondary btn-rounded waves-effect w-100" for="option1">Want
                                to read</label>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input type="radio" class="btn-check" name="status" id="option2" value="Reading"
                                autocomplete="off">
                            <label class="btn btn-outline-secondary btn-rounded waves-effect w-100"
                                for="option2">Reading</label>
                        </div>
                    </div>
                    <div class="form-group mb-3 row">
                        <div class="col-12">
                            <input type="radio" class="btn-check" name="status" id="option3" value="Read"
                                autocomplete="off">
                            <label class="btn btn-outline-secondary btn-rounded waves-effect w-100"
                                for="option3">Read</label>
                        </div>
                    </div>

                    <div class="form-group mb-3 text-center row mt-3 pt-1">
                        <div class="col-12">
                            <button class="btn btn-info w-100 waves-effect waves-light" type="submit">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type='text/javascript'>
    $(document).ready(function() {
        var exampleModal = document.getElementById('AddLibraryModal')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget
            // Extract info from data-bs-* attributes
            var recipient = button.getAttribute('data-bs-book_id')
            // If necessary, you could initiate an AJAX request here
            // and then do the updating in a callback.
            //
            // Update the modal's content.
            // var modalTitle = exampleModal.querySelector('.modal-title')
            var modalBodyInput = exampleModal.querySelector('.modal-body #book_id')

            // modalTitle.textContent = 'New message to ' + recipient
            modalBodyInput.value = recipient
        })
        $('button').click(function() {
            var modal = bootstrap.Modal.getInstance(exampleModal);
            modal.hide()
        });
    });
</script>
