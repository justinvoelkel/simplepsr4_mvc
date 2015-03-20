<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<h1>Posts</h1>
{% for post in data %}
<h3>{{post.title}}</h3>
<p>{{post.content}}</p>
<hr/>
{% endfor %}
</body>
</html>