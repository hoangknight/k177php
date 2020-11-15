<?php 
    function showErrors($errors, $input) {
        if ($errors->has($input)){
            return '<div class="alert alert-danger">' . $errors->first($input) . '</div>';
        }
    }

    // Lấy danh mục bằng phương pháp đệ quy
    function getCategories($mang, $parentId, $char, $isParent ){
   		foreach ($mang as $key => $value) {
   			if($value['parent'] == $parentId){
           if($value['id'] == $isParent){
              echo '<option selected value="'. $value['id'] .'">'.$char.$value['name'].'</option>';
           }else{
              echo '<option value="'. $value['id'] .'">'.$char.$value['name'].'</option>';
           }
   				
   				$new_parent = $value['id'];
   				getCategories($mang, $new_parent,$char."--|", $isParent);
   			}
   		}
   }

   function listCategories($mang, $parentId, $char){
   		foreach ($mang as $key => $value) {
   			if($value['parent'] == $parentId){
   				$string = '';
   				$string .= '<div class="item-menu"><span>';
   				$string .= $char.$value['name'];
   				$string .= '</span>';
   				$string .= '<div class="category-fix">';
   				$string .= '<a class="btn-category btn-primary" href="'.route('category.edit',['id'=>$value['id']]).'"><i class="fa fa-edit"></i></a>';
   				$string .= '<a class="btn-category btn-danger" href="'.route('category.delete',['id'=>$value['id']]).'"><i class="fas fa-times"></i></i></a>';
   				$string .= '</div>';
   				$string .= '</div>';
   				echo $string;
   				listCategories($mang, $value['id'],$char."--|");
   			}
   		}
   }


?>



