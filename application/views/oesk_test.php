<h1>OESK Test</h1>

<?php echo oesk_nav('test') ?>

<div id="body">
    <script>
        
        
        var toRun = [
            {
                name:'kraken', 
                url: '<?php echo site_url("oesk/test_kraken") ?>'
            },
            {
                name:'sunspider', 
                url: '<?php echo site_url("oesk/test_sunspider") ?>'
            },
            {
                name:'v8', 
                url: '<?php echo site_url("oesk/test_v8") ?>'
            }
        ];
        
        var results = [];
        
        var running = false;
        
        var currentTestSteps = 0;
        var currentTestStep = 0;
        
        var curTestBegin = 0;
        var curTestEnd = 0;
        
        function start() {
            if(running) {
                alert('Test are running');
                return;
            }
            
            running = true;
            next();
        }
        
        function next() {
            var curTest = toRun[0];
//            console.log('running', curTest);
            
            $('testSuiteName').innerHTML = curTest.name;
            
            document.getElementById("testframeparent").innerHTML = "";
            document.getElementById("testframeparent").innerHTML = "<iframe id='testframe'>";
            var testFrame = document.getElementById("testframe");
            
            testFrame.src = curTest.url;
            
            //testFrame.contentDocument.open();
            //testFrame.contentDocument.write(curTest.url);
            //testFrame.contentDocument.close();
        }
        
        function onTestStart(steps) {
//            console.log('WILL RUN', steps, 'STEPS');
            curTestStart = new Date();
            currentTestSteps = steps;
            currentTestStep = 0;
            
            $('testNumber').innerHTML = currentTestStep;
            $('totalTests').innerHTML = currentTestSteps;
        }
        
        function onTestStep() {
            currentTestStep++;
            
            $('testNumber').innerHTML = currentTestStep;
            
//            console.log('STEP '+currentTestStep+'/'+currentTestSteps);
        }
        
        function onTestComplete() {
            curTestEnd = new Date();
            
            
            var curTest = toRun[0];
            curTest.time = (curTestEnd - curTestStart);
            results.push(curTest);
            
            
//            console.log('CURRENT TEST COMPLETED !!', (curTestEnd - curTestStart));
            toRun.splice(0,1);
            if(toRun.length > 0) {
//                console.log('MOAR TO GO');
                next();
            }
            else {
//                console.log('ALL DONE', results);
                
                $('testSuiteName').innerHTML = '';
                $('testNumber').innerHTML = '';
                $('totalTests').innerHTML = '';
                
                var toSend = results.map(function(row) {return {name:row.name, time:row.time}}); 
                
                
                new Request({
                    url: '<?php echo site_url("oesk/post_result") ?>',
                    data: {
                        results: JSON.encode(toSend),
                        platform: Browser.Platform.name,
                        browser: Browser.name + ' ' + Browser.version
                    },
                    onSuccess: function(responseText) {
                        var result = JSON.decode(responseText);
                        var resultUrl = '<?php echo site_url("oesk/results") ?>?runId='+result['runId'];
                        
                        window.location = resultUrl;
                    }
                }).send();
            }
            
        }
        
    </script>
    
    <a id="btn_run" href="javascript:start()">Uruchom testy</a>
    
    <div id="testframeparent"></div>
    
    <div id="teststats">
        Zestaw testów: <span id="testSuiteName"></span><br/>
        Postęp: <span id="testNumber"></span>/<span id="totalTests"></span>
    </div>
    
</div>