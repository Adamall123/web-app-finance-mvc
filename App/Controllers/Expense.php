<?php

namespace App\Controllers;

use Core\View;
use App\Models\User;
use App\Models\_Expense;
use App\Models\ExpenseDB;
use App\Models\Walidator;
use App\Models\PaymentDB;
use \App\Auth; 
use \App\Flash;

class Expense extends Authenticated
{
   
    protected function before()
    {
        parent::before();
        $this->user = Auth::getUser();
    }
    public function indexAction()
    {
        $expense = new _Expense($this->user);
        $expenseDB = new ExpenseDB();
        $paymentDB = new PaymentDB();
        View::renderTemplate('Expense/index.html', [
            'userExpenses' => $expenseDB->getExpensesCategoryAssignedToUser($this->user),
            'userPaymentMethods' => $paymentDB->getPaymentMethodsAssignedToUser($this->user)
        ]);
    }
    public function addAction()
    {
        $expense = new _Expense($_POST);
        $expenseDB = new ExpenseDB();
        $paymentDB = new PaymentDB();
        $walidator = new Walidator(); 
        if ($walidator->validateAmountAndComment($_POST)) {
            $expenseDB->saveExpense($expense, $this->user);
            Flash::addMessage('A new expense has been added succesfuly to your account.');
            $this->redirect('/Expense/index');

        } else {
            Flash::addMessage('Failed.', FLASH::WARNING);
            View::renderTemplate('Expense/index.html', [
                'user' => $this->user,
                'userExpenses' => $expenseDB->getExpensesCategoryAssignedToUser($this->user),
                'userPaymentMethods' => $paymentDB->getPaymentMethodsAssignedToUser($this->user),
                'walidator' => $walidator
            ]);
        }
    }
    public function changeAction()
    {
        $expenseDB = new ExpenseDB();
        echo json_encode(array("MonthlyCostsOfEachExpenseFromSelectedDate" =>  $expenseDB->MonthlyCostsOfEachExpenseFromSelectedDate( $_POST['expense_id'], $_POST['date'], $this->user)));
    }
    public function getAction()
    {
        $expenseDB = new ExpenseDB();
         if (isset($_GET['expense_category_id'])){
             $this->value = $_GET['expense_category_id'];
         }
         echo json_encode(array("MonthlyCostsOfEachExpenseFromSelectedDate" =>  $expenseDB->MonthlyCostsOfEachExpenseFromSelectedDate($_GET['expense_category_id'], $_GET['date'], $this->user)));
    }
}
