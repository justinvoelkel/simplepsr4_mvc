<h1>Posts</h1>
{{dump(data)}}
{% for post in data %}
    <h2>{{ post.title }}</h2>
{% endfor %}