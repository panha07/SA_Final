<!DOCTYPE html>
<html>
<head>
    <title>CV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            width: 100%;
            margin: 0 auto;
        }
        .header, .section {
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }
        .section h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        .section p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>{{ $data['fullName'] }}</h1>
            <p>{{ $data['applyFor'] }}</p>
            <p>{{ $data['address'] }}</p>
            <p>{{ $data['phone'] }}</p>
            <p>{{ $data['email'] }}</p>
        </div>
        <div class="section">
            <h2>Personal Details</h2>
            <p><strong>Gender:</strong> {{ $data['gender'] }}</p>
            <p><strong>Nationality:</strong> {{ $data['nationality'] }}</p>
            <p><strong>Date Of Birth:</strong> {{ $data['dateOfBirth'] }}</p>
            <p><strong>Place of Birth:</strong> {{ $data['placeOfBirth'] }}</p>
            <p><strong>Marital Status:</strong> {{ $data['maritalStatus'] }}</p>
            <p><strong>Height:</strong> {{ $data['height'] }}</p>
            <p><strong>Health:</strong> {{ $data['health'] }}</p>
        </div>
        @if(count($data['education']))
        <div class="section">
            <h2>Educational Background</h2>
            <ul>
                @foreach($data['education'] as $education)
                <li>
                    ({{ $education['startYear'] }} - {{ $education['endYear'] }}): <strong>{{ $education['schoolName'] }}</strong>
                    @if($education['subject'])
                    ({{ $education['subject'] }})
                    @endif
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(count($data['experience']))
        <div class="section">
            <h2>Job Experience</h2>
            <ul>
                @foreach($data['experience'] as $experience)
                <li>
                    ({{ $experience['startYear'] }} - {{ $experience['endYear'] }}): <strong>{{ $experience['position'] }}</strong> at {{ $experience['companyName'] }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(count($data['skills']))
        <div class="section">
            <h2>Skills</h2>
            <ul>
                @foreach($data['skills'] as $skill)
                <li>
                    <strong>{{ $skill['name'] }}</strong> ({{ $skill['level'] }})
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(count($data['languages']))
        <div class="section">
            <h2>Languages</h2>
            <ul>
                @foreach($data['languages'] as $language)
                <li>
                    <strong>{{ $language['name'] }}</strong> ({{ $language['proficiency'] }})
                </li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(count($data['references']))
        <div class="section">
            <h2>References</h2>
            <ul>
                @foreach($data['references'] as $reference)
                <li>
                    <strong>{{ $reference['name'] }}</strong> ({{ $reference['position'] }}) - {{ $reference['contact'] }}
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>
</body>
</html>