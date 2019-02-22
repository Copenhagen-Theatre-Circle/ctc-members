<script type="text/javascript">
    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#{{$id}}', {
            // paramName: "files",
            url: '/upload-document',
            method: 'post',
            maxFilesize: 50,
            maxFiles: 10,
            parallelUploads: 4,
            uploadMultiple: false,
            autoProcessQueue: true,
            acceptedFiles: ".pdf, .doc, .docx",
            addRemoveLinks: false,
        });
</script>
