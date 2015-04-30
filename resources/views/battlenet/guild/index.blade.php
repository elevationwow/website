<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <h1>{{$guild['name']}}</h1>

    <div class="container" style='display:flex'>
        <div class="members" style="flex:1">
            <h2>Members</h2>


            <ul style="display: flex; flex-flow: wrap row;">
            @foreach($guild['members'] as $member)
                <li style="display: block; margin:.2em .8em;">
                <img src="http://us.battle.net/static-render/us/{{$member['character']['thumbnail']}}">{{$member['character']['name']}}</li>
            @endforeach
            </ul>

        </div>
        <div class="achievements" style="flex:1">
            <h2>Achievements</h2>
            <ul>
            @foreach($guild['achievements'] as $ach)
               <li>{{$ach['title']}} - {{$ach['points']}} Points</li>
            @endforeach

            </ul>
        </div>
    </div>

</body>
</html>
