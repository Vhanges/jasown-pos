<?php
require_once '../_init.php';

//Add Category
$categoryName = isset($_POST['category-name']) ? htmlspecialchars($_POST['category-name']) : '';
$categoryID = isset($_POST['category-id']) ? htmlspecialchars($_POST['category-id']) : '';

//Edit Category
$updateCategoryName = isset($_POST['category-name']) ? htmlspecialchars($_POST['category-name']) : '';
$updateCategoryID = isset($_GET['category-id']) ? htmlspecialchars($_GET['category-id']) : '';


switch(getAction('action')){

    case 'add-category': 
            Category::addCategory($categoryName);
            header('Location: ../admin/admin_category.php');
        break;
    case 'update-category': 
            Category::updateCategory($updateCategoryID, $updateCategoryName);
            header('Location: ../admin/admin_category.php');
        break;
    case 'delete-category': 
            Category::deleteCategory($categoryID);
            header('Location: ../admin/admin_category.php');
        break;
    default:
             header('Location: ../admin/admin_category.php');
        break;
 
}
