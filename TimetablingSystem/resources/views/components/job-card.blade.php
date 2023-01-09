@props(['job'])

<div class="card">
    <h2> {{$job->title}}</h2>
    <p>Time:
        <time> {{$job->created_at->diffForHumans()}}</time>
    </p>
    <p>By <a href="/employers/{{$job->employer->username}}">{{$job->employer->name}}</a></p>
    <p><img src="category.png" alt="category" width="16" height="16"><a
            href="/categories/{{$job->category->slug}}">{{$job->category->name}}</a></p>
    <p><img src="company.jpg" alt="company" width="20" height="16">{{$job->company}}</p>
    <p><img src="location.png" alt="location" width="16" height="16">{{$job->location}}</p>
    <p><strong>$ </strong>{{$job->salary}}</p>
    <p class="description">{{$job->description}}</p>
    <a href="/job-record/{{$job->slug}}" class="view-button"><span
            class="span-button">View</span></a>
</div>
