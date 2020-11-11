<?php
/*ID: 612110237
Name: Guineng Cai 
*/
    // START: shared class
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

    $billing = new Billing($_SERVER['argv'][1]);
    while(true) {
        printf("Input usage unit(-1 for exit): ");
        fscanf(STDIN, "%d", $unit);
        if($unit === -1) break;
        printf("Price of electricity bill = %d\n", $billing->calculatePrice($unit));
    }

