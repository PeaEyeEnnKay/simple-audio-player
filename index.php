<!doctype>
<html>
<head>
<title>
</title>
<style>
.playerWrapper{}
#audioPlayer{
    margin: 10px;
    padding: 10px;
    border: 2px solid #666;
}
#playerText{
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
</style>
</head>
<body>
    <div class="playerWrapper">
        <audio id="audioPlayer" controls>
            <source src="" type="audio/wav">
        </audio>
    <div id="playerText"></div>

    </div>

    <div id="playlist" class="playlist">
        <div>Select a file to play</div>
        <?php
            //replace "audio" here with the directory contining your files.
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

    const setSource = (filename) =>
    {
        filetype = filename.slice((filename.lastIndexOf(".") - 1 >>> 0) + 2)
        //replace "audio\\" here with the directory contining your files (double slashes required for folder separators).
        document.getElementById("audioPlayer").src="audio\\" + filename;
        switch(filetype)
        {
            case "mp3":
                document.getElementById("audioPlayer").type="audio/mp3"
                break;
            case "wav":
                document.getElementById("audioPlayer").type="audio/wav"
                break;

        }
        document.getElementById("audioPlayer").play();
        document.getElementById("playerText").innerText= "Playing: " + filename;
    }
    </script>

</body>
</html>
