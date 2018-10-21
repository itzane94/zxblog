<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <head>
    <title>Learning Difficult</title>
    <meta name="author" content="itzane">
    <!-- Le styles -->
  </script><script type="text/javascript" async="" src="./embed.js"></script>
</head>
<body>

<div class="navbar">
    <div class="navbar-inner">
        <div class="container">
            <a class="brand" href="http://zane94.github.io/">zane94</a>
            <ul class="nav">

            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div id="idhyt-surprise-ball">
        <div id="idhyt-surprise-ball-animation">

            <!--xxxxxxx xxx xxxxx -->
            <!--why you are here? -->
            <span id="layer0Go" class="drag">w</span>
            <span id="layer1Go" class="drag">h</span>
            <span id="layer2Go" class="drag">y</span>
            <span id="layer3Go" class="drag">?</span>
            <span id="layer4Go" class="drag">y</span>
            <span id="layer5Go" class="drag">o</span>
            <span id="layer6Go" class="drag">u</span>
            <span id="layer7Go" class="drag">a</span>
            <span id="layer8Go" class="drag">r</span>
            <span id="layer9Go" class="drag">e</span>
            <span id="layer10Go" class="drag">h</span>
            <span id="layer11Go" class="drag">e</span>
            <span id="layer12Go" class="drag">r</span>
            <span id="layer13Go" class="drag">e</span>
            <span id="layer14Go" class="drag">?</span>
            <!--
            <span id="layer0Go" class="drag">烫</span>
            <span id="layer1Go" class="drag">烫</span>
            <span id="layer2Go" class="drag">烫</span>
            <span id="layer3Go" class="drag">烫</span>
            <span id="layer4Go" class="drag">烫</span>
            <span id="layer5Go" class="drag">烫</span>
            <span id="layer6Go" class="drag">烫</span>
            <span id="layer7Go" class="drag">锟</span>
            <span id="layer8Go" class="drag">斤</span>
            <span id="layer9Go" class="drag">拷</span>
            <span id="layer10Go" class="drag">屯</span>
            <span id="layer11Go" class="drag">屯</span>
            <span id="layer12Go" class="drag">屯</span>
            <span id="layer13Go" class="drag">屯</span>
            <span id="layer14Go" class="drag">屯</span>
            -->
            <span id="layer15Go" class="drag ball"></span>
        </div>
    </div>

    <div class="content">

        <div class="page-header">
            <h1>Learning Difficult</h1>
        </div>

        <div class="row">
            <div class="span8">

                <p> <em>Learning Difficult</em> </p>
                <p> <em>By Zane Yarbrough</em> </p>

                <p></p>

                <p></p>

                <blockquote>
                    <p>Dyslexia is the worst disease.</p>
                    <p>For it has no cure,</p>
                    <p>you can’t get sober from it,</p>
                    <p>there is no miracle drug,</p>
                    <p>no surgery.</p>
                    <p>Just crickets with arthritis </p>
                    <p>strumming the background noise</p>
                    <p>to the struggling misunderstood dunce.</p>
                </blockquote>

                <blockquote>
                    <p>They laughed at me.</p>
                    <p>Bullied by many who saw only a dumb kid.</p>
                    <p>The worst of the bullies was the one</p>
                    <p>seen only in the reflection </p>
                    <p>after a blunder of words</p>
                    <p>in front of the whole class.</p>
                </blockquote>

                <blockquote>
                    <p>Just a kid made up of tests and pills.</p>
                    <p>So I learned to fit in.</p>
                    <p>Don’t Speak.</p>
                    <p>Don’t Read.</p>
                    <p>Don’t Think.</p>
                    <p>You are dumb.</p>
                    <p>Don’t try.</p>
                    <p>You will never be anything.</p>
                    <p>This is what school taught me.</p>
                </blockquote>

                <blockquote>
                    <p>This is why I try</p>
                    <p>This is why I work </p>
                    <p>They will not define me</p>
                    <p>They are wrong.</p>
                    <p>I will</p>
                    <p>I will</p>
                    <p>prove them wrong.</p>
                </blockquote>
                <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
                <script type="text/javascript">
                    "use strict";
                    $(function(){

                        var getTextNodesIn = function(el) {
                            return $(el).find(":not(iframe,script)").addBack().contents().filter(function() {
                                return this.nodeType == 3;
                            });
                        };
                        // var textNodes = getTextNodesIn($("p, h1, h2, h3"));
                        var textNodes = getTextNodesIn($("*"));
                        function isLetter(char) {
                            return /^[\d]$/.test(char);
                        }
                        var wordsInTextNodes = [];
                        for (var i = 0; i < textNodes.length; i++) {
                            var node = textNodes[i];

                            var words = []

                            var re = /\w+/g;
                            var match;
                            while ((match = re.exec(node.nodeValue)) != null) {

                                var word = match[0];
                                var position = match.index;

                                words.push({
                                    length: word.length,
                                    position: position
                                });
                            }

                            wordsInTextNodes[i] = words;
                        };
                        function messUpWords () {

                            for (var i = 0; i < textNodes.length; i++) {

                                var node = textNodes[i];

                                for (var j = 0; j < wordsInTextNodes[i].length; j++) {

                                    // Only change a tenth of the words each round.
                                    if (Math.random() > 1/10) {

                                        continue;
                                    }

                                    var wordMeta = wordsInTextNodes[i][j];

                                    var word = node.nodeValue.slice(wordMeta.position, wordMeta.position + wordMeta.length);
                                    var before = node.nodeValue.slice(0, wordMeta.position);
                                    var after  = node.nodeValue.slice(wordMeta.position + wordMeta.length);

                                    node.nodeValue = before + messUpWord(word) + after;
                                };
                            };
                        }
                        function messUpWord (word) {

                            if (word.length < 3) {

                                return word;
                            }
                            return word[0] + messUpMessyPart(word.slice(1, -1)) + word[word.length - 1];
                        }

                        function messUpMessyPart (messyPart) {

                            if (messyPart.length < 2) {

                                return messyPart;
                            }
                            var a, b;
                            while (!(a < b)) {

                                a = getRandomInt(0, messyPart.length - 1);
                                b = getRandomInt(0, messyPart.length - 1);
                            }

                            return messyPart.slice(0, a) + messyPart[b] + messyPart.slice(a+1, b) + messyPart[a] + messyPart.slice(b+1);
                        }
                        function getRandomInt(min, max) {

                            return Math.floor(Math.random() * (max - min + 1) + min);
                        }
                        setInterval(messUpWords, 50);
                    });
                </script>
                <noscript>Pselae ebnlae JcSvraiapt to view the &lt;a href="http://duisqs.com/?rn_ofseprcit"&gt;comentms poewred by Disqus.&lt;/a&gt;</noscript>
            </div>
        </div>

    </div>
</div> <!-- /container -->
</body></html>