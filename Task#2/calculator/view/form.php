<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Car Insurance Calculator</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
              integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="container"></div>
<form method="post" action="proccess.php" id="calculator-form">
    <div class="container h-100">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-8">
                <h3 class="text-center my-4">Car Insurance Calculator </h3>
                <div class="row">
                    <div class="col-12">


                        <div class="form-body">
                            <div class="row no-gutters">
                                <div class="col-md-12 mb-1">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required  my-auto" for="estimated_value">Car
                                            Value</label>
                                        <div class="col-md-7">
                                            <input type="text" id="estimated_value" class="form-control"
                                                   placeholder="Car Value" name="car_value"
                                                   value="">
                                        </div>
                                        <p class="help-block col-12  mb-0"></p>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required  my-auto" for="tax_percent">Tax
                                            percentage</label>
                                        <div class="col-md-7">
                                            <input type="text" id="tax_percent" class="form-control"
                                                   placeholder="Tax percentage" name="tax_percent"
                                                   value="">
                                        </div>
                                        <p class="help-block col-12  mb-0"></p>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-1">
                                    <div class="form-group row">
                                        <label class="col-md-3 label-control required  my-auto"
                                               for="no_of_installments">Number Of Installments</label>
                                        <div class="col-md-7">
                                            <input type="text" id="no_of_installments" class="form-control"
                                                   placeholder="Number Of Installments" name="no_of_installments"
                                                   value="">
                                        </div>
                                        <p class="help-block col-12  mb-0"></p>
                                    </div>
                                </div>


                            </div>


                        </div>
                        <div class="text-center border-top-grey p-2 mx-3">
                            <button type="button" class="btn btn-primary btn-min-width box-shadow-1 text-uppercase" id="btn-submit">
                                <strong>Calculate</strong>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php if(isset($payload) && isset($netResult)): ?>
            <div class="row">
                <div class="col-md-12 mx-auto table-responsive mb-2">
                    <hr>
                    <h5 class="py-2">Your Result :</h5>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Policy</th>
                            <?= renderInstallmentHeading($payload['installment_list']) ?>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>Car Value</td>
                            <td colspan="<?= count( $payload['installment_list'] )+1 ?>"><?= $payload['car_value']?number_format($payload['car_value'],2):0 ?></td>
                        </tr>
                        <tr>
                            <td>Base Premium ( <?=($netResult['premium_rate']*100)?>% )</td>
                            <td><?= number_format($netResult['base_value'],2) ?></td>
                            <?= renderInstallmentColumn($payload['installment_list'],$netResult['per_installment_base_value']) ?>
                        </tr>
                        <tr>
                            <td>Commission ( 17% )</td>
                            <td><?= number_format($netResult['total_commission'],2) ?></td>
                            <?= renderInstallmentColumn($payload['installment_list'],$netResult['per_installment_commission']) ?>
                        </tr>
                        <tr>
                            <td>Tax ( <?= $payload['tax_percent'] ?>% )</td>
                            <td><?= number_format($netResult['total_tax'],2) ?></td>
                            <?= renderInstallmentColumn($payload['installment_list'],$netResult['per_installment_tax']) ?>
                        </tr>
                        <tr>
                            <td><strong>Total Cost</strong></td>
                            <td><strong><?= number_format($netResult['total'],2) ?></strong></td>
                            <?= renderInstallmentColumn($payload['installment_list'],$netResult['per_installment_total']) ?>
                        </tr>

                        </tbody>

                    </table>
                </div>
            </div>
        <?php endif; ?>


    </div>

</form>

</div>
    <script src="js/custom.js"></script>
</body>
</html>