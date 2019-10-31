<?php

class Calculator{

    private $request;
    private $netResult = [
      'base_value' => 0,
      'premium_rate'=>0.11,
      'total_commission' => 0,
      'total_tax' => 0,
      'total'=>0,
      'per_installment_base_value'=>0,
      'per_installment_commission'=>0,
      'per_installment_tax'=>0,
      'per_installment_total'=>0,
    ];

    public function __construct()
    {

        $this->request = $_POST;
        $this->calculate();
    }

    public function addBaseValue(){
        $weekDay = date("D");
        $hour  = date("H");
        if ($weekDay == 'Fri' && $hour >= 15 && $hour <= 20) {
            $this->netResult['premium_rate'] = 0.13;
        }

        $this->netResult['base_value'] = round($this->netResult['premium_rate'] * $this->request['car_value'],2);
        $this->netResult['per_installment_base_value'] = round($this->netResult['base_value'] / $this->request['no_of_installments'],2);
        return $this;
    }

    public function addCommission(){
        $this->netResult['total_commission'] = round(0.17 *  $this->netResult['base_value'],2);
        $this->netResult['per_installment_commission'] = round($this->netResult['total_commission'] / $this->request['no_of_installments'],2);
        return $this;
    }

    public function addTaxPercent(){
        $this->netResult['total_tax'] = round( ( $this->request['tax_percent']/100 ) *  $this->netResult['base_value'], 2);
        $this->netResult['per_installment_tax'] = round($this->netResult['total_tax'] / $this->request['no_of_installments'],2);
        return $this;
    }

    public function calculate(){

        $this->request['tax_percent'] = (int) $this->request['tax_percent'];
        $this->request['no_of_installments'] = (int) $this->request['no_of_installments'] ?:1;
        $this->request['installment_list'] = range(1,$this->request['no_of_installments']);

        $this->addBaseValue()->addCommission()->addTaxPercent();
        $this->netResult['total'] = round($this->netResult['base_value'] + $this->netResult['total_commission'] + $this->netResult['total_tax'],2);
        $this->netResult['per_installment_total'] = round($this->netResult['total'] / $this->request['no_of_installments'],2);

        Session::setValue('calc_details', ['netResult'=>$this->netResult,'payload'=>$this->request] );
        header('Location:index.php');

    }

}


?>