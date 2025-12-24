{{-- CKEditor CDN --}}
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.js-ckeditor').forEach((el) => {
            ClassicEditor.create(el, {
                toolbar: [
                    'heading',
                    '|',
                    'bold', 'italic', 'link',
                    '|',
                    'bulletedList', 'numberedList',
                    '|',
                    'blockQuote',
                    '|',
                    'undo', 'redo'
                ]
            }).catch(error => {
                console.error(error);
            });
        });
    });
</script>
