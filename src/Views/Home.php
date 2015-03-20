<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>Home | SimplePSR4</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h1>Home</h1>
            {% for post in data %}
            <h3>{{post.title}}</h3>
            <p>{{post.content}}</p>
            <a href="post/{{post.id}}">Read Post</a>
            <hr/>
            {% endfor %}
        </div>
    </div>
</div>
</body>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</html>