var insuranceCalculator = (function(){
    var _this;
    return {
        fieldNames : ['car_value','tax_percent','no_of_installments'],
        validationRules : {
            car_value:[
                {'rule':'required','msg':'Car value is required'}
            ],
            tax_percent:[
                {'rule':'required','msg':'Tax percentage is required'}
            ],
            no_of_installments:[
                {'rule':'required','msg':'Number of installments is required'}
            ]
        },
        requiredValiator: function(fieldName){
            var value = document.getElementsByName(fieldName)[0].value;
            var numericValue = parseFloat(value);

            if(typeof value == 'string' && value.trim().length<=0){
                return { valid:false, msg:_this.validationRules[fieldName][0]['msg'] };
            }

            if( fieldName=='no_of_installments' ){
                if(numericValue>=1 && numericValue<=12){
                    return { valid:true, msg: '' };
                }else{
                    return { valid:false, msg: 'Installment should between 1 to 12' };
                }
            }

            if( fieldName=='tax_percent' ){
                if(numericValue>=1 && numericValue<=100){
                    return { valid:true, msg: '' };
                }else{
                    return { valid:false, msg: 'Tax pecentage should not exceeds to 100' };
                }
            }

            if( fieldName=='car_value' ){
                if(numericValue>=100 && numericValue<=100000){
                    return { valid:true, msg: '' };
                }else{
                    return { valid:false, msg: 'Car value should be in between 100 to 100,000' };
                }
            }
            return { valid:true, msg: '' };
        },
        inValidateForm: function () {
            var filteredResult = Object.keys(_this.validationRules)
                .map(function (itemName) {
                    return { field: itemName } ;
                })
                .filter(function (item) {
                    var validatorInstance = _this.requiredValiator(item['field']);
                    return validatorInstance.valid == false;
                });
            if(filteredResult.length>0){
                return true;
            }else{
                return false;
            }
        },
        onChange : function (e) {

            var charCode = (e.which) ? e.which : e.keyCode;
            //console.log('charCode',charCode);
            if (charCode > 31 && (charCode < 48 || charCode > 57)){
                e.target.value = e.target.value.replace(/[^0-9\.]/g,'');
                return false;
                e.preventDefault();
            }

            var validatorInstance = _this.requiredValiator(e.target.name);
            var parentElement =  e.target.parentElement.parentElement;
            var errorParentBlockElement = parentElement.querySelector(".help-block");

            if(!validatorInstance.valid){
                var errorElement = document.createElement("div");
                errorElement.className = "error";
                errorElement.innerHTML = validatorInstance.msg;
                //console.log('errorElement',errorElement);
                errorParentBlockElement.innerHTML = "<div class='error'>"+errorElement.innerHTML+"</div>";
            }else{
                if(errorParentBlockElement.firstChild){
                    errorParentBlockElement.removeChild( errorParentBlockElement.firstElementChild );
                }
            }
        },
        onSubmit:function(){
            var invalidate = _this.inValidateForm();
            if(invalidate){
                for(var index in _this.fieldNames){
                    var keyupEvent = new Event('keyup');
                    document.querySelector("input[name='"+ _this.fieldNames[index] +"']").dispatchEvent(keyupEvent);
                }
            }else{
                document.getElementById('calculator-form').submit();
            }

            //console.log("invalidate",invalidate);
        },
        attachEventHandler: function(){
            document.getElementById("btn-submit").addEventListener("click", _this.onSubmit);
            for(var index in _this.fieldNames){
                document.querySelector("input[name='"+ _this.fieldNames[index] +"']").addEventListener("keyup", _this.onChange);
            }


        },
        init : function () {
            _this = this;
            _this.attachEventHandler()
        }
    }
})().init();