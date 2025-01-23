<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    @vite(['resources/css/style.css'])
    @vite(['resources/css/popup.css'])

    {{-- @vite(['resources/js/testPost.js']) --}}

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

</head>
<body>
    <script>
        $(document).ready(function () {
            $('#category').change(function () {
                var categoryId = $(this).val();
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
                    });
                    // $('#post-list').html('<p>Category ID: </p>' + data );
                } else {
                    $('#post-list').html('<p>Select a category to filter posts.</p>');
                }
            });
        });

    </script>
    
<div>
    <label for="category">Select Category</label>
    <select id="category" name="category_id">
        <option value="">--Select Category--</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
        <button>Add New Category</button>
    </select>
</div>

<div id="post-list">
    <!-- Posts will be loaded here -->
</div>

</body>
</html>