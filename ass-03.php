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

    class Billing {
        private $pricings = [];

        function __construct($filename) {
            $fp = fopen($filename, 'r');
            fscanf($fp, "%d", $n);
            for($i = 0; $i < $n; $i++) {
                $pricing = [];
                fscanf($fp, "%d %f %d", $pricing['unit'], $pricing['price'], $pricing['isWhole']);
                if($pricing['unit'] === 0) $pricing['unit'] = PHP_INT_MAX;
                $this->pricings[] = $pricing;
            }
            fclose($fp);
        }

        function calculatePrice($unit) {
            $price = 0;
            foreach($this->pricings as $pricing) {
                $unitCal = ($unit > $pricing['unit'])? $pricing['unit'] : $unit;
                $price += ($pricing['isWhole'])? $pricing['price'] : $unitCal * $pricing['price'];
                $unit -= $unitCal;
            }

            return $price;
        }
    }
    // END: shared class

    class App {
        private $mulTab = null;
        private $billing = null;

        function __construct($mulTab, $billing) {
            $this->mulTab = $mulTab;
            $this->billing = $billing;
        }

        function run() {
            while(true) {
                printf(
<<<EOT

        1. Multiplication Table
        2. Electricity Bill calculation
        3. exit


EOT
                );
                printf("Input menu number: ");
                fscanf(STDIN, "%d", $menu);
                if($menu === 3) break;
                switch($menu) {
                    case 1:
                        printf("Input size: ");
                        fscanf(STDIN, "%d", $size);
                        $this->mulTab->print($size);
                        break;
                    case 2:
                        printf("Input usage unit: ");
                        fscanf(STDIN, "%d", $unit);
                        printf("Price for %d electricity unit(s) = %d\n", $unit, $this->billing->calculatePrice($unit));
                        break;
                    default:
                        fprintf(STDERR, "Invalid menu number %d!!!\n", $menu);
                }
            }
        }
    }

    $app = new App(new MulTab(15), new Billing('ass-03-pricing-data.txt'));
    $app->run();
