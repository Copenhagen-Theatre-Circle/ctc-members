<script type="text/javascript">
    Dropzone.autoDiscover = false;
        var myDropzone = new Dropzone('#{{$id}}', {
            // paramName: "files",
            url: '/upload-photo',
            method: 'post',
            maxFilesize: 10,
            maxFiles: 10,
            parallelUploads: 4,
            uploadMultiple: false,
            autoProcessQueue: true,
            acceptedFiles: ".png, .jpg, .jpeg, .bpm, .gif",
            addRemoveLinks: false,
        });
</script>
