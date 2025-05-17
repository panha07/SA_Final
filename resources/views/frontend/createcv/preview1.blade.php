@extends('frontend.layout.master')
{{-- @section('pg_createCV', 'active') --}}
@section('content')
<div class="container shadow-lg mt-4 p-0">
    <div class="resume-header">
        <img src="your-photo.jpg" alt="Profile Photo" class="rounded-circle" width="150" height="150">
        <h1>John Doe</h1>
        <p>Software Developer | john.doe@example.com | (123) 456-7890 | LinkedIn: linkedin.com/in/johndoe</p>
    </div>
    <div class="content">
        <div class="resume-section">
            <h2 class="section-title">About Me</h2>
            <p>Motivated software developer with 5+ years of experience in full-stack development. Passionate about
                creating innovative solutions to solve complex problems.</p>
        </div>
        <div class="resume-section">
            <h2 class="section-title">Education</h2>
            <ul class="list-unstyled">
                <li><strong>Bachelor of Science in Computer Science</strong> - XYZ University (2018)</li>
                <li><strong>Certifications:</strong> AWS Certified Solutions Architect, Google UX Design Professional
                    Certificate</li>
            </ul>
        </div>
        <div class="resume-section">
            <h2 class="section-title">Experience</h2>
            <div>
                <h5>Software Engineer</h5>
                <p><em>ABC Tech Company | Jan 2020 - Present</em></p>
                <ul>
                    <li>Developed and deployed scalable web applications using React and Node.js.</li>
                    <li>Improved application performance by 25% through code optimization and caching techniques.</li>
                </ul>
            </div>
        </div>
        <div class="resume-section">
            <h2 class="section-title">Skills</h2>
            <ul class="list-inline">
                <li class="list-inline-item badge bg-primary text-white">JavaScript</li>
                <li class="list-inline-item badge bg-primary text-white">React</li>
                <li class="list-inline-item badge bg-primary text-white">Node.js</li>
                <li class="list-inline-item badge bg-primary text-white">SQL</li>
            </ul>
        </div>
        <div class="resume-section">
            <h2 class="section-title">Projects</h2>
            <ul>
                <li><strong>E-commerce Platform:</strong> Designed a full-stack platform with payment integration and
                    inventory management. <a href="#">View Project</a></li>
                <li><strong>Weather App:</strong> Built a React-based weather forecasting app using OpenWeatherMap API.
                    <a href="#">View Project</a></li>
            </ul>
        </div>
        <div class="resume-section">
            <h2 class="section-title">References</h2>
            <p>Available upon request.</p>
        </div>
    </div>
</div>
@endsection
   


