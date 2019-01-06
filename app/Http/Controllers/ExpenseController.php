<?php

namespace App\Http\Controllers;

use App\Expense;
use Storage;

class ExpenseController extends AppController
{
    /**
     * 領収書のダウンロード
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function receipt($id)
    {
        $expense = Expense::find($id);
        $result = Storage::disk('s3')->get($expense->receipt_path);
        logger($result);
        header('Content-Type: application/octet-stream');
        header("Content-Disposition: attachment; filename={$expense->receipt_original_name}");
        print($result);
        return null;

    }

}
