<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentStoreRequest;
use App\Models\Payment;
use App\Models\Tenant;
use App\Models\Transection;
use App\Models\UserNotification;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // payment listing page
    public function index(Payment $payment)
    {
        $row = 10;
        if (request('row') != '')
            $row = request('row');

        $record = Payment::orderBy('payment_id', 'DESC');

        if (request('search') != '') {
            $record = $record->search(request('search'), null, true, true)->distinct();
        }

        $record = $this->dataSearch($record);

        $record = $record->paginate($row);

        $operationPermission = [
            'create' => hasPermission(['payment_list', 'payment_create']),
        ];
        $tenant = Tenant::getActiveUser();
        return view('payments.index', compact('record', 'operationPermission', 'tenant'));
    }

    // add new payment page view
    public function create()
    {
        $tenant = Tenant::getActiveUser();
        return view('payments.create', compact('tenant'));
    }

    // add new payment method
    public function store(PaymentStoreRequest $request)
    {
        unset($request['_token']);
        $payment = $request->all();
        $payment['date'] = date('Y-m-d H:i:s', strtotime($payment['date']));
        $payment['status'] = 'Completed';
        $payment['total'] = $payment['amount'];
        $payment['type'] = 'Payment';
        $payment['paypal_fees'] = 0.00;
        $payment['final_amount'] = 0.00;
        $tenant = Tenant::where('account_number', $payment['account_number'])->first();
        $payment['balance'] = bcadd($tenant->balance, $payment['amount'], 5);
        $payment_add = Payment::create($payment);

        if (isset($payment_add) && isset($payment_add->payment_id) && $payment_add->payment_id > 0) {
            $tenant_log['account_number'] = $tenant->account_number;
            $tenant_log['summary'] = 'Add Payment by ' . Auth::user()->firstname . ' ' . Auth::user()->lastname . ' with reference number #' . $payment['reference_number'];
            $tenant_log['credit'] = $payment['amount'];
            $tenant_log['balance'] = bcadd($tenant->balance, $payment['amount'], 5);
            $tenant_log['referenceno'] = $payment_add->payment_id;
            $tenant_log['created_date'] = date('Y-m-d H:i:s');
            Transection::create($tenant_log);

            $tenant['balance'] = $tenant_log['balance'];
            $tenant['effective_balance'] = bcadd($tenant->effective_balance, $payment['amount'], 5);

            if ($tenant->balance > 0 && $tenant->suspended == 'YES' && $tenant->suspend_reason != 'MANUALLY') {
                $tenant['suspended'] = 'NO';
                $tenant['suspend_date'] = NULL;
                $tenant['suspend_reason'] = NULL;
                $tenant['reactivate_date'] = date('Y-m-d H:i:s');
            }
            $tenant->save();

            $user_notification['tenant_id'] = $tenant->id;
            $user_notification['note'] = 'Your payment of $' . $payment['amount'] . ' is done';
            $user_notification['url'] = 'payment/index';
            $user_notification['notification_type'] = 'PAYMENT';
            UserNotification::create($user_notification);
        }


        return redirect()->route('payments.index')->with('success', 'Payment Added successfully.');
    }

    public function creditDebit()
    {
        $model = new Transection;
        $user = Tenant::getActiveUser();

        $model->amount = '0.00000';

        if (isset($_POST['Transection'])) {
            $model->attributes = $_POST['Transection'];
            $model->amount = $_POST['Transection']['amount'];

            if ($model->validate()) {

                $tenant = Tenant::model()->findByAttributes(array('account_number' => $model->account_number));
                $admin = User::model()->findByPk(Yii::app()->user->id);

                if ($model->type == 'DEBIT') {

                    $model->debit = $model->amount;
                    $model->balance = bcsub($tenant->balance, $model->amount, 5);

                    $tenant->balance = $model->balance;
                    $tenant->effective_balance = bcsub($tenant->effective_balance, $model->amount, 5);
                } else if ($model->type == 'CREDIT') {

                    $model->credit = $model->amount;
                    $model->balance = bcadd($tenant->balance, $model->amount, 5);

                    $tenant->balance = $model->balance;
                    $tenant->effective_balance = bcadd($tenant->effective_balance, $model->amount, 5);
                }

                $model->summary = $model->summary . ' by ' . $admin->firstname . ' ' . $admin->lastname;
                $model->created_date = date('Y-m-d H:i:s');
                $model->save();

                if ($tenant->balance > 0 && $tenant->suspended == 'YES' && $tenant->suspend_reason != 'MANUALLY') {
                    $tenant->suspended = 'NO';
                    $tenant->suspend_date = NULL;
                    $tenant->suspend_reason = NULL;
                    $tenant->reactivate_date = date('Y-m-d H:i:s');
                }
                $tenant->save();

                Yii::app()->user->setFlash('success', Yii::t('yii', 'Data saved successfully.'));

                echo CJSON::encode(array('success' => TRUE,));
                Yii::app()->end();
            }
        }
    }

    // search function
    private function dataSearch($query)
    {

        if (request('date') != '')
            $query = $query->where('date', 'like', '%' . request('date') . '%');

        if (request('account_number') != '')
            $query = $query->where('account_number', 'like', '%' . request('account_number') . '%');

        if (request('status') != '')
            $query = $query->where('status', 'like', '%' . request('status') . '%');

        return $query;
    }
}
