$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
    }
});

$(document).ready(function () {
    $('#request-video-form').on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: requestVideoURL,
            type: 'POST',
            data: {
                url: $('#url').val()
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#video-preview').show();
                    $('#video-frame').attr('src' , response.embed_url);
                    $('#title').val((response.title || 'Unknown Title'));
                    $('#channel').val((response.channel || 'Unknown Channel'));
                    $('#like').val((response.like || 'N/A'));
                    $('#viewer').val((response.views || 'N/A'));
                    $('#modal-title-preview').text(" "+(response.title || 'Unknown Title'))
                    $('#modal-channel-preview').text(" " +(response.channel || 'Unknown Channel'));
                }
            },
            error: function (xhr, status, error) {
                console.log("XHR Status:", status);
                console.log("AJAX Error:", error);
                console.log("Server Response:", xhr.responseText); // 👈 Yeh zaroori hai
                alert("Something went wrong. Check console for details.");
            }

        });
    });
    // confirm modal open
    $('#apply-confirm').click(function(e){
        e.preventDefault();

        let views = $('#num-view').val().trim();

        if (views === '' || views === null || views === '0') {
            alert('Please enter a valid number of views.');
            return; // Don’t open modal
        }

        // If input is valid, open modal
        $('#modal-views-preview').text(views); // Update value inside modal
        $('#applyModal').modal('show');

    });
    // modal hide click on cancel button
    $('body').on('click', '#closeconfirmviewmodel, #cancelconfirmviewmodel', function () {
        $('#applyModal').modal('hide');
    });

    // form save vedio detail on database
    $('#saveVideoDetail').click(function (){
        $('#saveVideoDetailForm').submit();
    });

    $('#apply-confirm').click(function () {
        let iframeSrc = $('#video-frame').attr('src'); // Get iframe src
        $('#video_src').val(iframeSrc); // Set it to hidden input correctly
    });
});
