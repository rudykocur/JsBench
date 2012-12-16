<html>
    <head>
        <script src="<?php echo base_url()?>assets/benchmarks/sunspider-test-prefix.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/sunspider-test-contents.js"></script>
    </head>
    
    <body onload="start()">
        <script>
var testIndex = -1;
var currentRepeat = -1;
var repeatCount = 1;

var output = [];
output.length = repeatCount;
for (var i = 0; i < output.length; i++) {
    output[i] = {};
}

function start() 
{
    if(window.parent) {
        window.parent.onTestStart((repeatCount+1) * tests.length);
    }
    window.setTimeout(reallyNext, 500);
}

function next() 
{
    window.setTimeout(reallyNext, 10);
}

function reallyNext() 
{
    document.getElementById("frameparent").innerHTML = "";
    document.getElementById("frameparent").innerHTML = "<iframe id='testframe'>";
    var testFrame = document.getElementById("testframe");
    testIndex++;
    if (testIndex < tests.length) {
        testFrame.contentDocument.open();
        testFrame.contentDocument.write(testContents[testIndex]);
        testFrame.contentDocument.close();
    } else if (++currentRepeat < repeatCount) { 
        testIndex = 0;
        testFrame.contentDocument.open();
        testFrame.contentDocument.write(testContents[testIndex]);
        testFrame.contentDocument.close();
    } else {
        finish();
    }
}

function recordResult(time)
{
    if (currentRepeat >= 0) // negative repeats are warmups
        output[currentRepeat][tests[testIndex]] = time;
    
    if(window.parent) {
        window.parent.onTestStep();
    }
    
    next();
}

function finish()
{
    console.log('OMG', output);
    
    if(window.parent) {
        window.parent.onTestComplete();
    }
}
        </script>
        <div id="frameparent"></div>
    </body>
</html>