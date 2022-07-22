<!DOCTYPE html>
<html>
<head>
    <title>
        Simple Audio Player
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    /* styles the play pause fill colour*/
    * { fill: #43f443 }

    body{
        background-color: #010;
        color: #ccc;
        font-size: 18px;
        font-family: sans-serif;
    }
    .playerWrapper
    {
        margin-top: 10px;
    }
    .playlist
    {
        margin-top: 10px;
        font-size: 0.8rem;
        overflow: auto;
        height: 30vh;
    }
    .playlist div:hover
    {
        background-color: #003311;
    }
    #audioPlayer
    {
        margin: 10px;
        padding: 10px;
        border: 2px solid #666;
    }
    #playerText
    {
        margin: 10px;
        padding: 10px;
        border: 2px solid #666;
    }
    .track
    {
        margin: 10px;
        padding: 10px;
        border: 2px solid #666;
        cursor: pointer;
    }
    .current
    {
        opacity: 0.9;
        background-color:#336633;
    }

    input[type=range] {
        width: 100%;
        margin: 5.4px 0;
        background-color: transparent;
        -webkit-appearance: none;
    }
    input[type=range]:focus {
        outline: none;
    }
    input[type=range]::-webkit-slider-runnable-track {
        background: #81ff28;
        border: 2.8px solid rgba(0, 123, 0, 0.3);
        border-radius: 4.3px;
        width: 100%;
        height: 21.2px;
        cursor: pointer;
    }
    input[type=range]::-webkit-slider-thumb {
        margin-top: -8.2px;
        width: 32px;
        height: 32px;
        background: #43f443;
        border: 3.2px solid #000000;
        border-radius: 6px;
        cursor: pointer;
        -webkit-appearance: none;
    }
    input[type=range]:focus::-webkit-slider-runnable-track {
        background: #84ff2d;
    }
    input[type=range]::-moz-range-track {
        background: #81ff28;
        border: 2.8px solid rgba(0, 123, 0, 0.3);
        border-radius: 4.3px;
        width: 100%;
        height: 21.2px;
        cursor: pointer;
    }
    input[type=range]::-moz-range-thumb {
        width: 32px;
        height: 32px;
        background: #43f443;
        border: 3.2px solid #000000;
        border-radius: 6px;
        cursor: pointer;
    }
    input[type=range]::-ms-track {
        background: transparent;
        border-color: transparent;
        border-width: 8.4px 0;
        color: transparent;
        width: 100%;
        height: 21.2px;
        cursor: pointer;
    }
    input[type=range]::-ms-fill-lower {
        background: #7eff23;
        border: 2.8px solid rgba(0, 123, 0, 0.3);
        border-radius: 8.6px;
    }
    input[type=range]::-ms-fill-upper {
        background: #81ff28;
        border: 2.8px solid rgba(0, 123, 0, 0.3);
        border-radius: 8.6px;
    }
    input[type=range]::-ms-thumb {
        width: 32px;
        height: 32px;
        background: #43f443;
        border: 3.2px solid #000000;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 0px;
        /*Needed to keep the Edge thumb centred*/
    }
    input[type=range]:focus::-ms-fill-lower {
        background: #81ff28;
    }
    input[type=range]:focus::-ms-fill-upper {
        background: #84ff2d;
    }
    /*TODO: Use one of the selectors from https://stackoverflow.com/a/20541859/7077589 and figure out
    how to remove the virtical space around the range input in IE*/
    @supports (-ms-ime-align:auto) {
    /* Pre-Chromium Edge only styles, selector taken from hhttps://stackoverflow.com/a/32202953/7077589 */
        input[type=range] {
            margin: 0;
            /*Edge starts the margin from the thumb, not the track as other browsers do*/
        }
    }

    #volume
    {
        -webkit-appearance: none; /* Hides the slider so that custom slider can be made */
        width: 50%; /* Specific width is required for Firefox. */
        height: 30px;
        background: transparent; /* Otherwise white in Chrome */
        cursor: pointer;
    }
    #rate
    {
        -webkit-appearance: none; /* Hides the slider so that custom slider can be made */
        width: 50%; /* Specific width is required for Firefox. */
        height: 30px;
        background: transparent; /* Otherwise white in Chrome */
        cursor: pointer;
    }
    #progress
    {
        -webkit-appearance: none; /* Hides the slider so that custom slider can be made */
        width: 75%; /* Specific width is required for Firefox. */
        height: 30px;
        background: transparent; /* Otherwise white in Chrome */
        cursor: pointer;
    }
    label{
        position: relative;
        top:-9px;
    }
    button{
        background-color: transparent;
        border: none;
    }
    h1{
        font-size: 0.8rem;
    }
    h2{
        font-size: 1rem;
    }
    </style>
</head>
<body>
    <div class="playerWrapper">
        <audio id="audioPlayer">
            <source src="" type="audio/wav">
        </audio>
        <div><h1 id="playerText">Not playing anything</h1></div>
        <div id="playerControls">
            <div>
                <button id="pause">
                    <svg width="40px" height="40px" viewBox="100 100 800 800" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg">
                        <title>Pause</title>
                        <defs>
                            <style>.cls-1{fill:solid;stroke:#009000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:22px;}.cls-2{fill:#009000;}</style>
                        </defs>
                        <path class="cls-1" d="M420,206.66a306.22,306.22,0,0,1,160,0"/>
                        <path class="cls-1" d="M645.16,232.84C739.77,284.37,804,384.68,804,500c0,167.89-136.09,304-304,304S196,667.89,196,500c0-115.32,64.21-215.63,158.82-267.16"/>
                        <path class="cls-1" d="M383.36,675a210.31,210.31,0,0,1,0-350"/>
                        <path class="cls-1" d="M614.6,328.07a206.64,206.64,0,0,1,0,343.86"/>
                        <rect class="cls-2" height="177.46" rx="6.13" width="26.35" x="447.04" y="411.27"/>
                        <rect class="cls-2" height="177.46" rx="6.13" width="26.35" x="526.61" y="411.27"/>
                    </svg>
                </button>
                <button id="play">
                    <svg width="40px" height="40px" viewBox="100 100 800 800" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg">
                    <title>Play</title>
                        <defs>
                            <style>.cls-1{fill:solid;stroke:#009000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:22px;}.cls-2{fill:#009000;}</style>
                        </defs>
                        <path class="cls-1" d="M420,206.66a306.22,306.22,0,0,1,160,0"/>
                        <path class="cls-1" d="M645.16,232.84C739.77,284.37,804,384.68,804,500c0,167.89-136.09,304-304,304S196,667.89,196,500c0-115.32,64.21-215.63,158.82-267.16"/>
                        <path class="cls-1" d="M383.36,675a210.31,210.31,0,0,1,0-350"/>
                        <path class="cls-1" d="M614.6,328.07a206.64,206.64,0,0,1,0,343.86"/>
                        <path class="cls-2" d="M547.91,526.09l10.6-6.74a22.92,22.92,0,0,0,0-38.7L456.75,416a16.85,16.85,0,0,0-25.89,14.23v139.5A16.85,16.85,0,0,0,456.75,584l54.91-34.87"/>
                    </svg>
                </button>
                <button id="playall">
                    <svg width="40px" height="40px" viewBox="100 100 800 800" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg">
                        <title>
                            Play all
                        </title>
                        <defs>
                            <style>.cls-1{fill:solid;stroke:#009000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:22px;}.cls-2{fill:#009000;}</style>
                        </defs>
                        <rect class="cls-1" height="105.99" rx="12" width="105.99" x="174.65" y="266.09"/>
                        <path class="cls-1" d="M825.35,372.08v-94a12,12,0,0,0-12-12H365.25a12,12,0,0,0-12,12v82a12,12,0,0,0,12,12H744.64"/>
                        <rect class="cls-1" height="105.99" rx="12" width="105.99" x="174.65" y="627.92"/>
                        <path class="cls-1" d="M825.35,733.91v-94a12,12,0,0,0-12-12H365.25a12,12,0,0,0-12,12v82a12,12,0,0,0,12,12H744.64"/>
                        <path class="cls-2" d="M547.91,526.09l10.6-6.74a22.92,22.92,0,0,0,0-38.7L456.75,416a16.85,16.85,0,0,0-25.89,14.23v139.5A16.85,16.85,0,0,0,456.75,584l54.91-34.87"/>
                    </svg>
                </button>
                <button id="playnext">
                    <svg width="40px" height="40px" viewBox="100 100 800 800" data-name="Layer 2" id="Layer_2" xmlns="http://www.w3.org/2000/svg">
                        <title>
                            Play next
                        </title>
                        <defs>
                            <style>.cls-1{fill:solid;stroke:#009000;stroke-linecap:round;stroke-miterlimit:10;stroke-width:22px;}</style>
                        </defs>
                        <path class="cls-1" d="M204.91,654.32H646.36a12.29,12.29,0,0,0,8.81-3.78l136.1-140a13.9,13.9,0,0,0,.06-19.09L655.19,349.52a12.31,12.31,0,0,0-8.87-3.84H217.54c-7,0-12.63,6-12.63,13.36V523.49"/>
                    </svg>
                </button>
            </div>

            <div>
                <input type="range" id="volume" name="volume" min="0" max="1" step="0.1" value="1">
                <label for="volume">Volume</label>
            </div>
            <div>
                <input type="range" id="rate" name="rate" min="0.5" max="2" step="0.25" value="1">
                <label for="volume">Speed</label>
            </div>
            <div>
                <input type="range" id="progress" name="progress" min="0" max="100" step="0.1" value="0">
                <label for="volume">Progress</label>
            </div>

            <div>
                <span id="time">0:00</span> / <span id="duration">0:00</span>
            </div>

        </div>
    </div>

    <div><h2>Select a file to play</h2></div>
    <div id="playlist" class="playlist">
        <?php
            //replace "audio" here with the directory containing your files.
            $files = scandir("audio", SCANDIR_SORT_ASCENDING);
            foreach($files as $key=>$filename)
            {
                if($filename!="." && $filename!="..")
                {
                    print("<div id=\"track_" . str_replace(" ","-",$filename) . "\" class=\"track\" data-url=\"" . $filename . "\" onclick=\"setSource('".str_replace("'","\'",$filename)."')\">" . $filename . "</div>\n");
                }
            }
        ?>
    </div>
    <script>
    var audioPlayer = document.getElementById("audioPlayer");
    var userIsSettingProgress = false;
    var duration = audioPlayer.duration;
    var rate = audioPlayer.playbackRate;
    
    if(audioPlayer.src=="")
    {
        document.getElementById("play").disabled=true;
    }

    document.getElementById("volume").addEventListener("input", (event) => {
        setVolume(event.target);
    });
    document.getElementById("rate").addEventListener("input", (event) => {
        setPlaybackRate(event.target);
    });
    document.getElementById("progress").addEventListener("input", (event) => {
        userIsSettingProgress = true;
    });

    document.getElementById("progress").addEventListener("change", (event) => {
        setProgress(event.target);
        userIsSettingProgress = false;
    });

    document.getElementById("play").addEventListener("click", (event) => {
        playOrPause(event.target);
    });
    document.getElementById("pause").addEventListener("click", (event) => {
        playOrPause(event.target);
    });
    document.getElementById("playall").addEventListener("click", (event) => {
        playAll(event.target);
    });
    document.getElementById("playnext").addEventListener("click", (event) => {
        playNext(event.target);
    });
    window.addEventListener("resize", (event) => {
        setPlaylistHeight();
    });

    const setPlaybackRate = (element) =>
    {
        audioPlayer.playbackRate = element.value;
    };
    const updatePlayPauseButton = (element) =>
    {
        if(audioPlayer.paused)
        {
            document.getElementById("play").style.display="inline";
            document.getElementById("pause").style.display="none";
        }
        else
        {
            document.getElementById("play").style.display="none";
            document.getElementById("pause").style.display="inline";
        }
    }
    const playOrPause = (element) =>
    {
        if(audioPlayer.paused)
        {
            audioPlayer.play();
        }
        else
        {
            audioPlayer.pause()
        }
    }

    const setProgress = (element) =>
    {
        if(!isNaN(duration))
        {
            audioPlayer.currentTime = element.value * (duration/100);
        }
    };

    const setVolume = (element) =>
    {
        audioPlayer.volume = element.value;
    };

    const setSource = (filename) =>
    {
        var currentTrackDiv = document.getElementById('track_'+filename.replace(/\s+/g, '-'));
        var trackDivs = document.getElementById("playlist").querySelectorAll('.current');
        var playlist = document.getElementById('playlist');

        if(trackDivs!=null)
        {
            trackDivs.forEach(function(trackDiv){
                trackDiv.classList.remove("current");
            });
        }
        currentTrackDiv.classList.add("current");
        var topPos = currentTrackDiv.offsetTop;
        playlist.scrollTop = (topPos - playlist.offsetTop) - (playlist.offsetHeight/2);

        setCurrentInList(filename);

        document.getElementById("play").disabled=false;
        updatePlayPauseButton(document.getElementById("play"));

        filetype = filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2)
        //replace "audio\\" here with the directory containing your files (double slashes required for folder separators).
        audioPlayer.src="audio\\" + filename;
        switch(filetype)
        {
            case "mp3":
                audioPlayer.type="audio/mp3"
                break;
            case "wav":
                audioPlayer.type="audio/wav"
                break;

        }
        audioPlayer.playbackRate = document.getElementById("rate").value
        audioPlayer.play();
        document.getElementById("playerText").innerText= "" + filename;
    };

    const updateProgress = () => {
        if(!userIsSettingProgress)
        {
            let time = audioPlayer.currentTime;
            duration = audioPlayer.duration;
            if(!isNaN(duration))
            {
                document.getElementById("progress").value = (100/duration) * time;
            }
        }
        updatePlayPauseButton(document.getElementById("play"));
        updateTime();

    }

    const updateTime = () =>
    {
        if(!isNaN(duration))
        {
            document.getElementById("duration").innerText = Math.floor(duration/60) + ":" + String(Math.floor(duration % 60)).padStart(2, "0");
        }
        document.getElementById("time").innerText = Math.floor(audioPlayer.currentTime/60) + ":" + String(Math.floor(audioPlayer.currentTime % 60)).padStart(2, "0");
    };

    const audioArray = document.getElementsByClassName('track'); //Get a list of all songs
    let i = 0; //Initiate current Index

    const playAll = () =>
    {
        setSource(audioArray[i].getAttribute('data-url')); //set first song

        audioPlayer.addEventListener('ended',function()
        {
            audioPlayer.pause();
            //when a song finished playing
            i++; //increase index
            if (i < audioArray.length) { //If current index is smaller than count of songs
                setSource(audioArray[i].getAttribute('data-url')); //set next song
            return; // stop further processing of this function for now
            }
            // current index is greater than count of songs
            i = 0; // therefore we reset the current index to the first available song
            setSource(audioArray[i].getAttribute('data-url')); //set next song
        });
    };
    
    const setCurrentInList = (filename) =>
    {
        for(var index=0; index<audioArray.length; index++)
        {
            if(audioArray[index].getAttribute('data-url') == filename)
            {
                i=index;
            }
        }
        console.log(i);

    }

    const playNext = () =>
    {
        i++; //increase index
            if (i < audioArray.length) { //If current index is smaller than count of songs
                setSource(audioArray[i].getAttribute('data-url')); //set next song
            return; // stop further processing of this function for now
            }
            // current index is greater than count of songs
            i = 0; // therefore we reset the current index to the first available song
            setSource(audioArray[i].getAttribute('data-url')); //set next song
    };

    const setPlaylistHeight = () =>
    {
        var playlist = document.getElementById('playlist');
        var calulatedHeight = window.innerHeight - (playlist.offsetTop + 10);
        playlist.style.height = calulatedHeight+"px";
    }

    setPlaylistHeight();

    setInterval(updateProgress, 100);
    </script>

</body>
</html>
