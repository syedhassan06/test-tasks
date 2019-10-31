<?php
    function renderInstallmentColumn($installmentList,$perInstallmentValue){
        $td = '';
        foreach($installmentList as  $item){
            $td .= "<td>".number_format($perInstallmentValue,2)."</td>";
        }
        return $td;
    }

    function renderInstallmentHeading($installmentList){
        $th = '';
        foreach($installmentList as  $item){
            $th .= "<th>".$item." Installment </th>";
        }
        return $th;
    }
?>