<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
<button>
   1x1 
</button>
   <button>
    2x2
</button>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script>
    hello = " ";
    document.addEventListener("click", function(e) {
        var wordclickedplace = "1x1";
        wordclickedplace = e.target.textContent ;
        console.log(wordclickedplace);
        $.get('testdemo.php', {
            mywordclickedplace: wordclickedplace
        }).done(function(data) {
            console.log(data);
            hello = data;
            console.log(hello);
        });
        
});
    var evtSource = new EventSource("testdemo.php");
        evtSource.addEventListener("ping", function(e) {
            var newElement = document.createElement("li");
            var eventList = document.querySelector('body');
            var obj = JSON.parse(e.data);
            
            newElement.innerHTML = "ping at " + obj.time + hello;
            eventList.appendChild(newElement);
            console.log(hello);
        }, false);
</script>

</html>
