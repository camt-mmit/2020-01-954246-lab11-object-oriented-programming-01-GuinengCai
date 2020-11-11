<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    // START: shared class
    class MulTab {
        private $m;

        function __construct($m) {
            $this->m = $m;
        }

        function print($n) {
            for($j = 1; $j <= $this->m; $j++) {
                for($i = 2; $i <= $n; $i++) printf("%5d", $i * $j);
                printf("\n");
            }
        }
    }
    // END: shared class

    $mulTab = new MulTab((int)$_SERVER['argv'][1]);
    while(true) {
        printf("Input size (0 for exit): ");
        fscanf(STDIN, "%d", $size);
        if($size === 0) break;
        $mulTab->print($size);
    }
