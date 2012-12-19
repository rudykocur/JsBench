<html>
    <head>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-base.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-richards.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-deltablue.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-crypto.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-raytrace.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-earley-boyer.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-regexp.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-splay.js"></script>
        <script src="<?php echo base_url()?>assets/benchmarks/v8-navier-stokes.js"></script>
    </head>
    
    <body onload="start()">
        <script>

var completed = 0;
var benchmarks = BenchmarkSuite.CountBenchmarks();



function ShowProgress(name) {
    //console.log('PROGRESS', name);
    
    if(window.parent && window.parent.onTestStep) {
        window.parent.onTestStep();
    }
}


function AddResult(name, result) {
    //console.log('RESULT', name, '::', result);
}


function AddError(name, error) {
    console.log('ERROR', name, '::', error);
}


function AddScore(score) {
    //console.log('SCORE', score);
    
    if(window.parent && window.parent.onTestComplete) {
        window.parent.onTestComplete();
    }
}



function start() 
{
    if(window.parent && window.parent.onTestStart) {
        window.parent.onTestStart(benchmarks);
    }
    
    BenchmarkSuite.RunSuites({ NotifyStep: ShowProgress,
                               NotifyError: AddError,
                               NotifyResult: AddResult,
                               NotifyScore: AddScore });
}
        </script>
        <div id="frameparent"></div>
    </body>
</html>