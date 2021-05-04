<!DOCTYPE html>
<html>
<head>
    <title>
        Simple Audio Player
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    /* styles the play pause fill colour*/
    * { fill: #090 }

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
    .playlist{
        margin-top: 10px;
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
    </style>
</head>
<body>
    <div class="playerWrapper">
        <audio id="audioPlayer">
            <source src="" type="audio/wav">
        </audio>
        <div id="playerText">Not playing anything</div>
        <div id="playerControls">
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
                <button id="pause">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                        <title>
                            pause
                        </title>
                        <rect width="6" height="16" x="3" y="2" rx="1" ry="1"/>
                        <rect width="6" height="16" x="11" y="2" rx="1" ry="1"/>
                    </svg>
                </button>
                <button id="play">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 18">
                        <title>
                            play
                        </title>
                        <path fill-rule="evenodd" d="M16.75 10.83L4.55 19A1 1 0 0 1 3 18.13V1.87A1 1 0 0 1 4.55 1l12.2 8.13a1 1 0 0 1 0 1.7z"/>
                    </svg>
                </button>
                <span id="time">0:00</span> / <span id="duration">0:00</span>
            </div>
        </div>
    </div>

    <div id="playlist" class="playlist">
        <div>Select a file to play</div>
        <?php
            //replace "audio" here with the directory containing your files.
            $files = scandir("audio", SCANDIR_SORT_ASCENDING);
            foreach($files as $key=>$filename)
            {
                if($filename!="." && $filename!="..")
                {
                    print("<div class=\"track\" onclick=\"setSource('$filename')\">" . $filename . "</div>\n");
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
        document.getElementById("playerText").innerText= "Playing: " + filename;
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

    setInterval(updateProgress, 100);
    </script>

</body>
</html>
