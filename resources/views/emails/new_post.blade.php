<!DOCTYPE html>
<html>
<head>
    <title>New Post Notification</title>
</head>
<body>
    <h1>{{ $postTitle }}</h1>
    <p>A new post has been published on our blog. You can view it by clicking the link below:</p>
    <a href="{{ $postUrl }}">{{ $postUrl }}</a>
</body>
</html>
