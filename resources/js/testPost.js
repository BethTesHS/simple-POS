

$(document).ready(function () {
    $('#category').change(function () {
        var categoryId = $(this).val();

        $('#post-list').html('<p>Category ID: </p>' + categoryId);
        if (categoryId) {
            $.ajax({
                url: '{{ route("filter.posts") }}', // Correct route URL
                method: 'GET',
                data: { category_id: categoryId }, // Send the category_id
                success: function (data) {
                
                    var html = '';
                    if (data.length > 0) {
                        data.forEach(function (post) {
                            html += '<div class="post-item"><h3>' + post.title + '</h3><p>' + post.body + '</p></div>';
                        });
                    } else {
                        html = '<p>No posts found for this category.</p>';
                    }
                    $('#post-list').html(html); // Update the posts container
                },
                error: function (xhr, status, error) {
                    
                    $('#post-list').html('<p>Error: </p>' + error);
                    console.error("AJAX error:", error);
                }
            });
            // $('#post-list').html('<p>Category ID: </p>' + data );
        } else {
            $('#post-list').html('<p>Select a category to filter posts.</p>');
        }
    });
});
