<?php 

class Helper{

    public function field_validation($fields){
        // check if provided arg is an array. No need to try to loop non iterable arg.
        if(is_array($fields)){
            $error = false;

            foreach($fields as $fieldname){
                if(!isset($_POST[$fieldname]) || empty($fieldname)){
                    $error = true;
                    echo "The following fields require a value: $fieldname";
                }
            }

            if(!$error){
                return true;
            }

            return false;
        }else{
            echo "Fields not iterable";
        }

        
    }
}

?>